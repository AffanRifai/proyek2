<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Booking;
use Illuminate\Http\Request;

class StatusPembayaranController extends Controller
{
    public function show($idPembayaran)
    {
        try {
            $pembayaran = Pembayaran::with('booking.car')->findOrFail($idPembayaran);
            
            $data = [
                'pembayaran_id' => $pembayaran->id,
                'jenis_pembayaran' => $pembayaran->jenis_pembayaran,
                'status_pembayaran_table' => $pembayaran->status_pembayaran,
                'jumlah' => $pembayaran->jumlah,
                'jumlah_dibayar' => $pembayaran->jumlah_dibayar,
                'booking_id' => $pembayaran->booking_id,
                'id_transaksi' => $pembayaran->booking->id_transaksi,
                'status_pembayaran_booking' => $pembayaran->booking->status_pembayaran,
                'total_pembayaran' => $pembayaran->booking->total_pembayaran,
                'total_dibayar' => $pembayaran->booking->total_dibayar,
                'sisa_pembayaran' => $pembayaran->booking->sisa_pembayaran,
                'jumlah_dp' => $pembayaran->booking->jumlah_dp,
                'mobil' => $pembayaran->booking->car->merk . ' ' . $pembayaran->booking->car->model,
                'customer' => $pembayaran->booking->nama_penyewa
            ];

            return view('status.pembayaran', compact('data', 'pembayaran'));

        } catch (\Exception $e) {
            abort(404, 'Data pembayaran tidak ditemukan');
        }
    }

    public function apiShow($idPembayaran)
    {
        try {
            $pembayaran = Pembayaran::with('booking.car')->findOrFail($idPembayaran);
            
            $data = [
                'pembayaran_id' => $pembayaran->id,
                'jenis_pembayaran' => $pembayaran->jenis_pembayaran,
                'status_pembayaran_table' => $pembayaran->status_pembayaran,
                'jumlah' => $pembayaran->jumlah,
                'jumlah_dibayar' => $pembayaran->jumlah_dibayar,
                'booking_id' => $pembayaran->booking_id,
                'id_transaksi' => $pembayaran->booking->id_transaksi,
                'status_pembayaran_booking' => $pembayaran->booking->status_pembayaran,
                'total_pembayaran' => $pembayaran->booking->total_pembayaran,
                'total_dibayar' => $pembayaran->booking->total_dibayar,
                'sisa_pembayaran' => $pembayaran->booking->sisa_pembayaran,
                'jumlah_dp' => $pembayaran->booking->jumlah_dp,
                'mobil' => $pembayaran->booking->car->merk . ' ' . $pembayaran->booking->car->model,
                'customer' => $pembayaran->booking->nama_penyewa,
                'timestamp' => now()->toDateTimeString()
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }
    }
}