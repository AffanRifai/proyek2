<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'nama_penyewa',
        'no_telp',
        'alamat',
        'nama_supir',
        'telp_supir',
        'tujuan',
        'mulai_tgl',
        'mulai_pkl',
        'sel_tgl',
        'sel_pkl',
        'lama_hari',
        'biaya_harian',
        'total_pembayaran',
        'bentuk_jaminan',
        'posisi_bbm',
        'file_ktp',
        'file_sim',
        'file_stnk_motor',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
