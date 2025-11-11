<?php

namespace App\Http\Controllers;

use App\Helpers\MidtransHelper;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Notification;
use Illuminate\Support\Str;


class PembayaranController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }

    private function initializeMidtrans()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function createSnap(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'jenis_pembayaran' => 'required|string', // dp / pelunasan / bayar_penuh
        ]);

        $booking = Booking::with('pembayaran')->findOrFail($request->booking_id);

        // pastikan user sedang melakukan pada bookingnya sendiri (jika route auth)
        // (jika route di middleware auth, bisa juga check here)
        // if (auth()->id() !== $booking->user_id) abort(403);

        // putuskan jumlah yang harus dibayar berdasarkan jenis_pembayaran
        $jenis = $request->jenis_pembayaran;

        if ($jenis === 'dp') {
            // hitung dp: asumsikan jumlah_dp column is dp amount OR definisikan dp = 30% jika belum tersedia
            $jumlah = $booking->jumlah_dp > 0 ? (float)$booking->jumlah_dp : round($booking->total_pembayaran * 0.30, 2);
        } elseif ($jenis === 'pelunasan') {
            // pelunasan = sisa
            $jumlah = $booking->sisaBayar();
            if ($jumlah <= 0) {
                return response()->json(['message' => 'Tidak ada sisa pembayaran'], 422);
            }
        } elseif ($jenis === 'bayar_penuh') {
            $jumlah = (float)$booking->total_pembayaran;
        } else {
            return response()->json(['message' => 'Jenis pembayaran tidak valid'], 422);
        }

        // buat unique order id
        $orderId = 'KAWA-' . Str::upper(Str::random(8)) . '-' . $booking->id;

        // simpan record pembayaran prelim (status menunggu)
        $pembayaran = Pembayaran::create([
            'booking_id' => $booking->id,
            'jenis_pembayaran' => $jenis,
            'metode_pembayaran' => 'midtrans',
            'saluran_pembayaran' => 'online',
            'jumlah' => $jumlah,
            'jumlah_dibayar' => 0,
            'midtrans_order_id' => $orderId,
            'status_pembayaran' => 'menunggu',
        ]);

        // prepare payload untuk midtrans snap
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (float)$jumlah,
            ],
            'customer_details' => [
                'first_name' => $booking->nama_penyewa ?? 'Customer',
                'email' => $booking->booking_user_email ?? null, // kalau ada di booking, atau ambil dari user
                'phone' => $booking->no_telp,
            ],
            'item_details' => [
                [
                    'id' => $booking->id,
                    'price' => (float)$jumlah,
                    'quantity' => 1,
                    'name' => 'Pembayaran ' . $jenis . ' - ' . $booking->id_transaksi,
                ],
            ],
            // 'expiry' => [ 'start_time' => ..., 'unit' => 'minutes', 'duration' => 60 ], // optional
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'pembayaran_id' => $pembayaran->id,
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            Log::error('MIDTRANS ERROR: ' . $e->getMessage());
            return response()->json([
                'message' => 'Gagal membuat transaksi midtrans: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }

        try {
            \Log::info('Creating snap for booking ' . $booking->id);
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            \Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal membuat transaksi midtrans: ' . $e->getMessage()], 500);
        }
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

    // Notification / webhook endpoint dari midtrans
    public function notification(Request $request)
    {
        // midtrans notification signature handled by library
        try {
            $notif = new Notification();

            $transactionStatus = $notif->transaction_status;
            $orderId = $notif->order_id; // ini harus unik yang kita set
            $fraudStatus = $notif->fraud_status ?? null;
            $paymentType = $notif->payment_type ?? null;
            $transactionId = $notif->transaction_id ?? null;
            $grossAmount = $notif->gross_amount ?? null;

            // cari pembayaran berdasarkan midtrans_order_id
            $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();

            if (!$pembayaran) {
                return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
            }

            // update berdasarkan status midtrans
            DB::beginTransaction();
            try {
                if ($transactionStatus == 'capture') {
                    if ($paymentType == 'credit_card') {
                        if ($fraudStatus == 'challenge') {
                            $pembayaran->status_pembayaran = 'menunggu_verifikasi';
                        } else {
                            $pembayaran->status_pembayaran = 'sukses';
                            $pembayaran->jumlah_dibayar = $pembayaran->jumlah;
                            $pembayaran->dibayar_pada = now();
                        }
                    }
                } elseif ($transactionStatus == 'settlement') {
                    $pembayaran->status_pembayaran = 'sukses';
                    $pembayaran->jumlah_dibayar = $pembayaran->jumlah;
                    $pembayaran->dibayar_pada = now();
                } elseif ($transactionStatus == 'pending') {
                    $pembayaran->status_pembayaran = 'menunggu';
                } elseif ($transactionStatus == 'deny') {
                    $pembayaran->status_pembayaran = 'gagal';
                } elseif ($transactionStatus == 'expire') {
                    $pembayaran->status_pembayaran = 'kadaluarsa';
                } elseif ($transactionStatus == 'cancel') {
                    $pembayaran->status_pembayaran = 'gagal';
                }

                $pembayaran->midtrans_transaction_id = $transactionId;
                $pembayaran->data_pembayaran = json_encode($notif);
                $pembayaran->save();

                // Jika pembayaran sukses, update booking: total_dibayar, status_pembayaran, midtrans_order_id, dll
                if ($pembayaran->status_pembayaran == 'sukses') {
                    $booking = $pembayaran->booking()->first();

                    // update total_dibayar di booking
                    $booking->total_dibayar = (float)$booking->total_dibayar + (float)$pembayaran->jumlah;
                    // set sisa_pembayaran
                    $booking->sisa_pembayaran = max(0, (float)$booking->total_pembayaran - (float)$booking->total_dibayar);

                    // update status_pembayaran: jika masih ada sisa -> dp_dibayar, jika lunas -> lunas
                    if ($booking->sisa_pembayaran > 0 && $booking->requiresDp()) {
                        $booking->status_pembayaran = 'dp_dibayar';
                    } elseif ($booking->sisa_pembayaran <= 0) {
                        $booking->status_pembayaran = 'lunas';
                    }

                    // simpan midtrans_order_id di booking sebagai referensi (opsional)
                    $booking->midtrans_order_id = $orderId;
                    $booking->save();
                }

                DB::commit();
                return response()->json(['message' => 'ok'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'error update: ' . $e->getMessage()], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'invalid notification: ' . $e->getMessage()], 500);
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
            Log::error('Error di PembayaranController@sukses: ' . $e->getMessage());
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
