<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'semua');
        $jenis = $request->get('jenis', 'semua');

        $query = Pembayaran::with('booking.car', 'booking.user')
            ->latest();

        // Filter berdasarkan status
        if ($status !== 'semua') {
            $query->where('status_pembayaran', $status);
        }

        // Filter berdasarkan jenis pembayaran
        if ($jenis !== 'semua') {
            $query->where('jenis_pembayaran', $jenis);
        }

        $pembayaran = $query->paginate(15);

        $statistik = $this->hitungStatistik();

        return view('admin.pembayaran.index', compact('pembayaran', 'statistik', 'status', 'jenis'));
    }

    public function detail($id)
    {
        $pembayaran = Pembayaran::with('booking.car', 'booking.user')->findOrFail($id);
        return view('admin.pembayaran.detail', compact('pembayaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $pembayaran = Pembayaran::with('booking')->findOrFail($id);

        DB::transaction(function () use ($pembayaran, $request) {
            // Update pembayaran
            $pembayaran->update([
                'status_pembayaran' => 'sukses',
                'jumlah_dibayar' => $pembayaran->jumlah,
                'dibayar_pada' => now(),
                'catatan_admin' => $request->catatan_admin
            ]);

            // Update booking
            $booking = $pembayaran->booking;
            switch ($pembayaran->jenis_pembayaran) {
                case 'pelunasan':
                    $booking->update([
                        'status_pembayaran' => 'lunas',
                        'sisa_pembayaran' => 0,
                        'total_dibayar' => $booking->total_dibayar + $pembayaran->jumlah
                    ]);
                    break;

                case 'denda':
                    // Untuk denda, hanya update status pembayaran
                    break;
            }
        });

        return redirect()->route('admin.pembayaran.detail', $id)
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status_pembayaran' => 'gagal',
            'catatan_admin' => $request->alasan_penolakan
        ]);

        return redirect()->route('admin.pembayaran.detail', $id)
            ->with('success', 'Pembayaran berhasil ditolak.');
    }

    private function hitungStatistik()
    {
        return [
            'total' => Pembayaran::count(),
            'menunggu' => Pembayaran::menunggu()->count(),
            'sukses' => Pembayaran::sukses()->count(),
            'gagal' => Pembayaran::gagal()->count(),
            'menunggu_verifikasi' => Pembayaran::where('status_pembayaran', 'menunggu_verifikasi')->count(),

            'total_jumlah' => Pembayaran::sukses()->sum('jumlah_dibayar'),
            'dp' => Pembayaran::where('jenis_pembayaran', 'dp')->sukses()->count(),
            'pelunasan' => Pembayaran::where('jenis_pembayaran', 'pelunasan')->sukses()->count(),
            'denda' => Pembayaran::where('jenis_pembayaran', 'denda')->sukses()->count(),
        ];
    }
}
