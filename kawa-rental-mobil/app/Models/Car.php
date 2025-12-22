<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use Carbon\Carbon;

class Car extends Model
{
    use HasFactory;

    // nama tabel otomatis 'cars' jadi tidak perlu protected $table
    protected $fillable = [
        'merk',
        'model',
        'warna',
        'tahun',
        'transmisi',
        'kapasitas_penumpang',
        'no_rangka',
        'no_mesin',
        'no_polisi',
        'stnk_atas_nama',
        'biaya_harian',
        'gambar',
        'status',
        'deskripsi',
        'fasilitas',
        'syarat',
        'kebijakan'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable($startDate, $endDate)
    {
        // Konversi ke Carbon untuk perbandingan yang tepat
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $today = Carbon::today();

        return !$this->bookings()
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('mulai_tgl', [$start, $end])
                    ->orWhereBetween('sel_tgl', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('mulai_tgl', '<=', $start)
                            ->where('sel_tgl', '>=', $end);
                    });
            })
            ->whereIn('status', ['approved'])
            // ✅ TAMBAHAN: Jangan blokir jika booking sudah selesai (sel_tgl sudah lewat)
            ->where(function ($query) use ($today) {
                $query->where('sel_tgl', '>=', $today)
                    ->orWhereNull('sel_tgl');
            })
            ->exists();
    }

    public function updateStatusBasedOnBookings()
    {
        // Cari booking aktif untuk mobil ini
        $activeBooking = $this->bookings()
            ->where('status', 'approved')
            ->where(function ($query) {
                $query->where('mulai_tgl', '<=', Carbon::today())
                    ->where('sel_tgl', '>=', Carbon::today());
            })
            ->first();

        if ($activeBooking) {
            // Ada booking yang sedang berjalan, status jadi 'disewa'
            $this->update(['status' => 'disewa']);
        } else {
            // Cek apakah ada booking yang akan datang
            $upcomingBooking = $this->bookings()
                ->where('status', 'approved')
                ->where('mulai_tgl', '>', Carbon::today())
                ->exists();

            if ($upcomingBooking) {
                // Ada booking yang akan datang, tapi mobil masih tersedia untuk periode lain
                // Status tetap 'tersedia' karena belum disewa sekarang
                $this->update(['status' => 'tersedia']);
            } else {
                // Tidak ada booking aktif atau akan datang, status 'tersedia'
                $this->update(['status' => 'tersedia']);
            }
        }
    }

    // (opsional) cast untuk biaya jadi numeric
    protected $casts = [
        'biaya_harian' => 'decimal:2',
    ];
}
