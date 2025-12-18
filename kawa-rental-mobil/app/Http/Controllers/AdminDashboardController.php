<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\Pembayaran;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ===== MOBIL =====
        $totalMobil     = Car::count();
        $mobilTersedia  = Car::where('status', 'tersedia')->count();

        // ===== BOOKING =====
        $totalBooking   = Booking::count();
        $bookingPending = Booking::where('status', 'pending')->count();

        // ===== PENDAPATAN =====
        $pendapatanBulanIni = Pembayaran::where('status_pembayaran', 'sukses')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah');

        // ⬅️ PENTING: view ADMIN (BUKAN admin.dashboard)
        return view('admin', compact(
            'totalMobil',
            'mobilTersedia',
            'totalBooking',
            'bookingPending',
            'pendapatanBulanIni'
        ));
    }
}
