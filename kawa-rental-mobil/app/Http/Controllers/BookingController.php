<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function create($id)
    {
        $car = Car::findOrFail($id);
        return view('form-booking', compact('car'));
    }

    public function store(Request $request)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'nama_penyewa' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'nama_supir' => 'nullable|string|max:255',
            'telp_supir' => 'nullable|string|max:20',
            'tujuan' => 'required|string|max:255',
            'mulai_tgl' => 'required|date|after_or_equal:today',
            'mulai_pkl' => 'required|date_format:H:i',
            'sel_tgl' => 'required|date|after_or_equal:mulai_tgl',
            'sel_pkl' => 'required|date_format:H:i',
            'lama_hari' => 'required|integer|min:1',
            'bentuk_jaminan' => 'required|in:sim,stnk_motor,kk,kartu_pelajar,lain',
            'posisi_bbm' => 'required|string|max:100',
            'tipe_pembayaran' => 'required|in:dp,bayar_penuh',
            'file_identitas' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_jaminan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_stnk_motor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $car = Car::findOrFail($request->car_id);

        // ✅ Cek ketersediaan mobil
        if (!$car->isAvailable($request->mulai_tgl, $request->sel_tgl)) {
            return back()
                ->withInput()
                ->with('error', 'Mobil tidak tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.');
        }

        // ✅ Hitung total pembayaran
        $lama_hari = (int) $request->lama_hari;
        $total_base = $lama_hari * $car->biaya_harian;
        $total_pembayaran = $total_base;

        if ($request->tipe_pembayaran == 'dp') {
            $total_pembayaran = $total_base * 0.2; // 20% down payment
        }

        $total_pembayaran = round($total_pembayaran);

        // ✅ Upload file
        $uploadFile = function ($file, $folder) {
            if (!$file) return null;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension;
            return $file->storeAs($folder, $filename, 'public');
        };

        // Inisialisasi path variables
        $identitasPath = null;
        $jaminanPath = null;
        $stnkPath = null;

        try {
            // Upload file identitas
            $identitasPath = $uploadFile($request->file('file_identitas'), 'uploads/identitas');
            $jaminanPath = $uploadFile($request->file('file_jaminan'), 'uploads/jaminan');

            // Upload STNK motor hanya jika dipilih sebagai jaminan dan file ada
            if ($request->bentuk_jaminan == 'stnk_motor' && $request->hasFile('file_stnk_motor')) {
                $stnkPath = $uploadFile($request->file('file_stnk_motor'), 'uploads/stnk');
            }

            // ✅ Simpan booking
            $booking = Booking::create([
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
                'total_pembayaran' => $total_pembayaran,
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'bentuk_jaminan' => $request->bentuk_jaminan,
                'posisi_bbm' => $request->posisi_bbm,
                'file_identitas' => $identitasPath,
                'file_jaminan' => $jaminanPath,
                'file_stnk_motor' => $stnkPath,
                'status' => 'pending',
            ]);

            return redirect('/landingpage')
                ->with('success', 'Booking berhasil dikirim! ID Transaksi: ' . $booking->id_transaksi . '. Menunggu konfirmasi admin.');
        } catch (\Exception $e) {
            // ✅ FIX: Rollback file uploads jika gagal - HAPUS NULL VALUES
            $filesToDelete = array_filter([$identitasPath, $jaminanPath, $stnkPath]);

            if (!empty($filesToDelete)) {
                Storage::disk('public')->delete($filesToDelete);
            }

            \Log::error('Booking Error: ' . $e->getMessage());
            \Log::error('Booking Error Trace: ' . $e->getTraceAsString());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    // ✅ Add method to check availability via AJAX
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'mulai_tgl' => 'required|date',
            'sel_tgl' => 'required|date|after_or_equal:mulai_tgl',
        ]);

        $car = Car::findOrFail($request->car_id);
        $isAvailable = $car->isAvailable($request->mulai_tgl, $request->sel_tgl);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable
                ? 'Mobil tersedia untuk tanggal yang dipilih'
                : 'Mobil tidak tersedia untuk tanggal yang dipilih'
        ]);
    }
}
