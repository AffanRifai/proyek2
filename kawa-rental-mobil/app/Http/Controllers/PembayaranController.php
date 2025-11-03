<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransHelper;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Transaction;

class PembayaranController extends Controller
{
    public function __construct()
    {
        MidtransHelper::initialize();
    }

    private function initializeMidtrans()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    // ======================= PEMBUATAN PEMBAYARAN ==========================

    public function buat($idBooking, $jenis)
    {
        $booking = Booking::with('car', 'user')->findOrFail($idBooking);
        $jumlah = $this->hitungJumlah($booking, $jenis);
        $hanyaOnline = in_array($jenis, ['dp', 'bayar_penuh']);

        return view('pembayaran.buat', compact('booking', 'jenis', 'jumlah', 'hanyaOnline'));
    }

    public function prosesOnline(Request $request, $idBooking)
    {
        $booking = Booking::findOrFail($idBooking);
        $jenis = $request->jenis;
        $jumlah = $this->hitungJumlah($booking, $jenis);

        $this->initializeMidtrans();

        try {
            // Buat record pembayaran
            $pembayaran = Pembayaran::create([
                'booking_id' => $idBooking,
                'jenis_pembayaran' => $jenis,
                'metode_pembayaran' => 'midtrans',
                'saluran_pembayaran' => 'online',
                'jumlah' => $jumlah,
                'status_pembayaran' => 'menunggu',
                'midtrans_order_id' => 'RENT-' . $booking->id_transaksi . '-' . $jenis . '-' . time(),
                'tanggal_jatuh_tempo' => now()->addDays(1),
            ]);

            // Parameter untuk Midtrans
            $params = $this->buatParameterMidtrans($pembayaran, $booking, $jumlah);
            $snapToken = Snap::getSnapToken($params);

            Log::info('Snap token generated', [
                'pembayaran_id' => $pembayaran->id,
                'order_id' => $pembayaran->midtrans_order_id,
                'snap_token' => $snapToken,
            ]);

            return view('pembayaran.midtrans', compact('snapToken', 'pembayaran', 'booking'));
        } catch (\Exception $e) {
            Log::error('Error in prosesOnline: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran.');
        }
    }

    // ======================= CALLBACK DARI MIDTRANS ==========================

    public function handleCallback(Request $request)
    {
        Log::info('=== MIDTRANS CALLBACK RECEIVED ===');
        Log::info('Request method: ' . $request->method());

        try {
            $notification = $this->parseMidtransNotification($request);

            // Validasi signature
            if (!$this->validateSignature($notification)) {
                Log::warning('Invalid signature key', ['order_id' => $notification->order_id]);
                return response()->json(['status' => 'invalid_signature'], 403);
            }

            $orderId = $notification->order_id ?? null;
            $status = $notification->transaction_status ?? null;
            $fraud = $notification->fraud_status ?? null;
            $gross = $notification->gross_amount ?? 0;

            if (!$orderId) {
                Log::error('Callback missing order_id');
                return response()->json(['status' => 'missing_order_id'], 400);
            }

            Log::info('Processing callback', compact('orderId', 'status', 'fraud', 'gross'));

            $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();

            if (!$pembayaran) {
                Log::error('Pembayaran tidak ditemukan untuk order_id: ' . $orderId);
                return response()->json(['status' => 'not_found'], 404);
            }

            $booking = $pembayaran->booking;

            DB::transaction(function () use ($pembayaran, $booking, $status, $fraud, $gross, $notification, $orderId) {
                Log::info("Handling transaction status: {$status} for order {$orderId}");

                switch ($status) {
                    case 'capture':
                        if ($fraud === 'challenge') {
                            $pembayaran->update([
                                'status_pembayaran' => 'menunggu_verifikasi',
                                'data_pembayaran' => json_encode($notification),
                            ]);
                        } else {
                            $this->prosesPembayaranSukses($pembayaran, $booking, $gross, $notification);
                        }
                        break;

                    case 'settlement':
                        $this->prosesPembayaranSukses($pembayaran, $booking, $gross, $notification);
                        break;

                    case 'pending':
                        $pembayaran->update([
                            'status_pembayaran' => 'menunggu',
                            'data_pembayaran' => json_encode($notification),
                        ]);
                        break;

                    case 'deny':
                    case 'cancel':
                    case 'expire':
                        $pembayaran->update([
                            'status_pembayaran' => 'gagal',
                            'data_pembayaran' => json_encode($notification),
                        ]);
                        break;

                    default:
                        Log::warning('Unknown transaction status: ' . $status);
                }
            });

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Callback error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }

        return redirect()->route('transaksi.nota', ['id' => $pembayaran->id]);
    }

    // ======================= PEMROSESAN PEMBAYARAN SUKSES ==========================

    private function prosesPembayaranSukses($pembayaran, $booking, $jumlah, $notification)
    {
        Log::info('=== PEMBAYARAN SUKSES ===', [
            'pembayaran_id' => $pembayaran->id,
            'booking_id' => $booking->id,
        ]);

        $pembayaran->update([
            'status_pembayaran' => 'sukses',
            'jumlah_dibayar' => $jumlah,
            'midtrans_transaction_id' => $notification->transaction_id ?? 'MID-' . time(),
            'dibayar_pada' => now(),
            'data_pembayaran' => json_encode($notification),
        ]);

        switch ($pembayaran->jenis_pembayaran) {
            case 'dp':
                $booking->update([
                    'status_pembayaran' => 'dp_dibayar',
                    'jumlah_dp' => $jumlah,
                    'sisa_pembayaran' => $booking->total_pembayaran - $jumlah,
                    'total_dibayar' => $jumlah,
                ]);
                break;

            case 'pelunasan':
            case 'bayar_penuh':
                $booking->update([
                    'status_pembayaran' => 'lunas',
                    'total_dibayar' => $booking->total_dibayar + $jumlah,
                    'sisa_pembayaran' => 0,
                ]);
                break;

            case 'denda':
                Log::info('Denda dibayar, tidak mengubah status booking.');
                break;
        }
    }

    public function sukses($idPembayaran)
    {
        try {
            // Ambil data pembayaran dari database
            $pembayaran = Pembayaran::findOrFail($idPembayaran);

            // Jika status belum sukses, kita bisa panggil API Midtrans buat update status-nya
            if ($pembayaran->status_pembayaran !== 'sukses') {
                $status = \Midtrans\Transaction::status($pembayaran->order_id);

                // Update status di database
                if ($status->transaction_status === 'settlement' || $status->transaction_status === 'capture') {
                    $pembayaran->status_pembayaran = 'sukses';
                    $pembayaran->save();
                } elseif ($status->transaction_status === 'pending') {
                    $pembayaran->status_pembayaran = 'menunggu';
                    $pembayaran->save();
                } elseif ($status->transaction_status === 'expire' || $status->transaction_status === 'cancel') {
                    $pembayaran->status_pembayaran = 'gagal';
                    $pembayaran->save();
                }
            }

            // Ambil relasi ke data booking atau user jika ada
            $booking = $pembayaran->booking ?? null;
            $user = auth()->user();

            // Tampilkan halaman sukses
            return view('pembayaran.sukses', compact('pembayaran', 'booking', 'user'));
        } catch (\Exception $e) {
            \Log::error('Error di PembayaranController@sukses: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Terjadi kesalahan saat memuat status pembayaran.');
        }
    }

    // pembayaran pending
    public function pending($idPembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($idPembayaran);

        return view('pembayaran.pending', [
            'title' => 'Pembayaran Tertunda',
            'pembayaran' => $pembayaran
        ]);
    }


    // ======================= HELPER METHOD ==========================

    private function parseMidtransNotification(Request $request)
    {
        $raw = $request->getContent();
        if ($raw) {
            $data = json_decode($raw);
            if ($data) return $data;
        }

        if ($request->isMethod('post')) {
            return (object) $request->all();
        }

        return null;
    }

    private function validateSignature($notif)
    {
        if (!isset($notif->signature_key) || !isset($notif->order_id) || !isset($notif->status_code) || !isset($notif->gross_amount)) {
            return false;
        }

        $serverKey = config('midtrans.server_key');
        $expected = hash('sha512', $notif->order_id . $notif->status_code . $notif->gross_amount . $serverKey);
        return hash_equals($expected, $notif->signature_key);
    }

    private function buatParameterMidtrans(Pembayaran $pembayaran, Booking $booking, $jumlah)
    {
        $namaItem = match ($pembayaran->jenis_pembayaran) {
            'dp' => 'DP Rental ' . $booking->car->merk . ' ' . $booking->car->model,
            'pelunasan' => 'Pelunasan Rental ' . $booking->car->merk . ' ' . $booking->car->model,
            'bayar_penuh' => 'Pembayaran Penuh Rental ' . $booking->car->merk . ' ' . $booking->car->model,
            'denda' => 'Denda Keterlambatan Rental',
            default => 'Pembayaran Rental',
        };

        return [
            'transaction_details' => [
                'order_id' => $pembayaran->midtrans_order_id,
                'gross_amount' => $jumlah,
            ],
            'customer_details' => [
                'first_name' => $booking->nama_penyewa,
                'email' => $booking->user->email,
                'phone' => $booking->no_telp,
            ],
            'item_details' => [
                [
                    'id' => $booking->mobil_id,
                    'price' => $jumlah,
                    'quantity' => 1,
                    'name' => $namaItem,
                ],
            ],
        ];
    }

    private function hitungJumlah(Booking $booking, $jenis)
    {
        return match ($jenis) {
            'dp' => $booking->jumlah_dp,
            'pelunasan' => $booking->sisa_pembayaran,
            'bayar_penuh' => $booking->total_pembayaran,
            'denda' => $booking->denda_terlambat,
            default => 0,
        };
    }
}
