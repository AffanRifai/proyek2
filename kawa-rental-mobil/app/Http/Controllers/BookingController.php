<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'nama_penyewa' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tujuan' => 'required|string',
            'mulai_tgl' => 'required|date',
            'sel_tgl' => 'required|date|after_or_equal:mulai_tgl',
            'bentuk_jaminan' => 'required|string|max:255',
            'posisi_bbm' => 'required|string',
            'file_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sim' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_stnk_motor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $car = Car::findOrFail($request->car_id);

        // ✅ Cek apakah mobil tersedia di tanggal yang dipilih
        $adaBooking = Booking::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('mulai_tgl', [$request->mulai_tgl, $request->sel_tgl])
                    ->orWhereBetween('sel_tgl', [$request->mulai_tgl, $request->sel_tgl])
                    ->orWhere(function ($query2) use ($request) {
                        $query2->where('mulai_tgl', '<=', $request->mulai_tgl)
                            ->where('sel_tgl', '>=', $request->sel_tgl);
                    });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($adaBooking) {
            return back()->with('error', 'Mobil ini sudah dibooking di tanggal tersebut.');
        }

        // ✅ Hitung lama sewa & total
        $mulai = Carbon::parse($request->mulai_tgl);
        $selesai = Carbon::parse($request->sel_tgl);
        $lama_hari = $mulai->diffInDays($selesai) + 1;
        $total = $lama_hari * $car->biaya_harian;

        // ✅ Upload file ke storage
        $ktpPath = $request->file('file_ktp')->store('uploads/ktp', 'public');
        $simPath = $request->file('file_sim')->store('uploads/sim', 'public');
        $stnkPath = $request->file('file_stnk_motor')
            ? $request->file('file_stnk_motor')->store('uploads/stnk', 'public')
            : null;

        // ✅ Simpan ke database
        Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'nama_penyewa' => $request->nama_penyewa,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'nama_supir' => $request->nama_supir,
            'telp_supir' => $request->telp_supir,
            'tujuan' => $request->tujuan,
            'mulai_tgl' => $request->mulai_tgl,
            'mulai_pkl' => $request->mulai_pkl,
            'sel_tgl' => $request->sel_tgl,
            'sel_pkl' => $request->sel_pkl,
            'lama_hari' => $lama_hari,
            'biaya_harian' => $car->biaya_harian,
            'total_pembayaran' => $total,
            'bentuk_jaminan' => $request->bentuk_jaminan,
            'posisi_bbm' => $request->posisi_bbm,
            'file_ktp' => $ktpPath,
            'file_sim' => $simPath,
            'file_stnk_motor' => $stnkPath,
            'status' => 'pending',
        ]);

        return redirect()->route('/')->with('success', 'Booking berhasil dikirim! Menunggu konfirmasi admin.');
    }

    public function create($id)
    {
        // ambil data mobil berdasarkan id
        $car = Car::findOrFail($id);

        // kirim ke view form booking
        return view('form-booking', compact('car'));
    }
}
