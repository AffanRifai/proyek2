<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanStatistik extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan & tahun
        $bulan = $request->bulan ?? Carbon::now()->month;
        $tahun = $request->tahun ?? Carbon::now()->year;

        /* ===============================================
            1. PENDAPATAN BULAN INI
        ================================================ */
        $pendapatan = DB::table('pembayaran')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('status_pembayaran', 'success')
            ->sum('jumlah_dibayar');

        /* ===============================================
            2. JUMLAH TRANSAKSI BULAN INI
        ================================================ */
        $jumlah_transaksi = DB::table('bookings')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->count();

        /* ===============================================
            3. REKAP TABEL (untuk Blade: $laporan)
        ================================================ */
        $rekap = DB::table('bookings')
            ->select(
                'status_mobil',
                DB::raw('COUNT(id) as transaksi'),
                DB::raw('COUNT(id) as unit'),
                DB::raw('SUM(lama_hari) as hari'),
                DB::raw('AVG(lama_hari) as rata'),
                DB::raw('SUM(biaya_harian * lama_hari) as pendapatan')
            )
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('status_mobil')
            ->get();

        $laporan = [];
        foreach ($rekap as $r) {
            $laporan[] = [
                'jenis' => $r->status_mobil,
                'unit' => $r->unit,
                'transaksi' => $r->transaksi,
                'hari' => $r->hari,
                'rata' => round($r->rata, 1),
                'pendapatan' => $r->pendapatan
            ];
        }

        /* ===============================================
            4. PIE CHART
        ================================================ */
        $pieData = DB::table('bookings')
            ->select('status_mobil', DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('status_mobil')
            ->pluck('total', 'status_mobil');

        $pie = [
            $pieData['SUV'] ?? 0,
            $pieData['Sedan'] ?? 0,
            $pieData['Hybrid'] ?? 0,
            $pieData['Pickup'] ?? 0,
        ];

        /* ===============================================
            5. LINE CHART
        ================================================ */
        $bulan_list = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        // Dummy data contoh (karena belum ada struktur pasti)
        $chart_suv = array_fill(0,12,0);
        $chart_sedan = array_fill(0,12,0);
        $chart_hybrid = array_fill(0,12,0);
        $chart_pickup = array_fill(0,12,0);

        return view('admin.laporanstatistik.laporan_statistik', compact(
            'pendapatan',
            'jumlah_transaksi',
            'laporan',
            'pie',
            'chart_suv',
            'chart_sedan',
            'chart_hybrid',
            'chart_pickup',
            'bulan_list'
        ));
    }
}
