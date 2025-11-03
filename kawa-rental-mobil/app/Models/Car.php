<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return !$this->bookings()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('mulai_tgl', [$startDate, $endDate])
                    ->orWhereBetween('sel_tgl', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('mulai_tgl', '<=', $startDate)
                            ->where('sel_tgl', '>=', $endDate);
                    });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }

    // (opsional) cast untuk biaya jadi numeric
    protected $casts = [
        'biaya_harian' => 'decimal:2',
    ];
}
