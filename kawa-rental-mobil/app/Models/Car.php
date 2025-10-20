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

    // (opsional) cast untuk biaya jadi numeric
    protected $casts = [
        'biaya_harian' => 'decimal:2',
    ];
}
