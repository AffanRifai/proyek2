<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanStatistik extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? Carbon::now()->month;
        $tahun = $request->tahun ?? Carbon::now()->year;

        /* ==========================================================
            1. PENDAPATAN BULAN INI
            - pakai dibayar_pada
            - jika dibayar_pada NULL → pakai created_at
        ========================================================== */
        $pendapatan = DB::table('pembayaran')
            ->where(function ($q) use ($bulan, $tahun) {
                $q->whereMonth('dibayar_pada', $bulan)
                  ->whereYear('dibayar_pada', $tahun);
            })
            ->orWhere(function ($q) use ($bulan, $tahun) {
                $q->whereNull('dibayar_pada')
                  ->whereMonth('created_at', $bulan)
                  ->whereYear('created_at', $tahun);
            })
            ->where('status_pembayaran', 'sukses')
            ->sum('jumlah_dibayar');

        /* ==========================================================
            2. JUMLAH TRANSAKSI BULAN INI
            - pakai bookings.mulai_tgl (tanggal sewa)
        ========================================================== */
        $jumlah_transaksi = DB::table('bookings')
            ->whereMonth('mulai_tgl', $bulan)
            ->whereYear('mulai_tgl', $tahun)
            ->count();

        /* ==========================================================
            3. REKAP TABEL BULANAN
        ========================================================== */
        $rekap = DB::table('bookings')
            ->join('cars', 'bookings.car_id', '=', 'cars.id')
            ->leftJoin('pembayaran', 'pembayaran.booking_id', '=', 'bookings.id')
            ->select(
                'cars.model AS jenis',
                DB::raw('COUNT(bookings.id) AS transaksi'),
                DB::raw('COUNT(bookings.id) AS unit'),
                DB::raw('SUM(bookings.lama_hari) AS total_hari'),
                DB::raw('AVG(bookings.lama_hari) AS rata_hari'),
                DB::raw('SUM(pembayaran.jumlah_dibayar) AS pendapatan')
            )
            ->whereMonth('bookings.mulai_tgl', $bulan)
            ->whereYear('bookings.mulai_tgl', $tahun)
            ->groupBy('cars.model')
            ->get();

        $laporan = [];
        foreach ($rekap as $r) {
            $laporan[] = [
                'jenis' => $r->jenis,
                'unit' => $r->unit,
                'transaksi' => $r->transaksi,
                'hari' => $r->total_hari,
                'rata' => round($r->rata_hari, 1),
                'pendapatan' => $r->pendapatan ?? 0
            ];
        }

        /* ==========================================================
            4. PIE CHART
        ========================================================== */
        $pie_query = DB::table('bookings')
            ->join('cars', 'bookings.car_id', '=', 'cars.id')
            ->select('cars.model', DB::raw('COUNT(*) AS total'))
            ->groupBy('cars.model')
            ->pluck('total', 'cars.model');

        $pie = array_values($pie_query->toArray());

        /* ==========================================================
            5. LINE CHART (12 bulan – per model)
        ========================================================== */
        $bulan_list = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        $chart_raw = DB::table('bookings')
            ->join('cars', 'bookings.car_id', '=', 'cars.id')
            ->select(
                DB::raw('MONTH(bookings.mulai_tgl) AS bulan'),
                'cars.model',
                DB::raw('COUNT(*) AS total')
            )
            ->groupBy('bulan', 'cars.model')
            ->get();

        $models = DB::table('cars')->pluck('model')->toArray();

        $chart = [];
        foreach ($models as $m) {
            $chart[$m] = array_fill(0, 12, 0);
        }

        foreach ($chart_raw as $row) {
            $index = $row->bulan - 1;
            $chart[$row->model][$index] = $row->total;
        }

        return view('admin.laporan_stat.laporan_stat', [
            'pendapatan' => $pendapatan,
            'jumlah_transaksi' => $jumlah_transaksi,
            'laporan' => $laporan,
            'pie' => $pie,
            'chart' => $chart,
            'models' => $models,
            'bulan_list' => $bulan_list
        ]);
    }
}
