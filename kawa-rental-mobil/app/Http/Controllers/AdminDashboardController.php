<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        /* =====================
         * MOBIL
         * ===================== */
        $totalMobil    = Car::count();
        $mobilTersedia = Car::where('status', 'tersedia')->count();

        /* =====================
         * BOOKING
         * ===================== */
        $totalBooking   = Booking::count();
        $bookingPending = Booking::where('status', 'pending')->count();

        /* =====================
         * PENDAPATAN BULAN INI
         * ===================== */
        $pendapatanBulanIni = Pembayaran::where('status_pembayaran', 'sukses')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');

        /* =====================
         * GRAFIK BOOKING 7 HARI
         * ===================== */
        $booking7Hari = Booking::select(
        DB::raw('mulai_tgl as tanggal'),
        DB::raw('COUNT(*) as total')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->limit(7)
            ->get();

        /* =====================
         * GRAFIK PENDAPATAN MINGGUAN
         * ===================== */
      $pendapatanMingguan = Pembayaran::select(
        DB::raw('DATE(tanggal_pelunasan) as tanggal'),
        DB::raw('SUM(jumlah) as total')
            )
            ->where('status_pelunasan', 'sukses')
            ->whereNotNull('tanggal_pelunasan')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->limit(7)
            ->get();


        /* =====================
         * KIRIM KE VIEW
         * ===================== */
        return view('admin', compact(
            'totalMobil',
            'mobilTersedia',
            'totalBooking',
            'bookingPending',
            'pendapatanBulanIni',
            'booking7Hari',
            'pendapatanMingguan'
        ));
    }
}
