<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'booking_id',
        'jenis_pembayaran',
        'metode_pembayaran',
        'saluran_pembayaran',
        'jumlah',
        'jumlah_dibayar',
        'confirmed_by',
        'confirmed_at',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'status_pembayaran',
        'bukti_pembayaran',
        'data_pembayaran',
        'catatan_admin',
        'dibayar_pada',
        'tanggal_jatuh_tempo'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'jumlah_dibayar' => 'decimal:2',
        'dibayar_pada' => 'datetime',
        'confirmed_at' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'data_pembayaran' => 'array'
    ];

    // Relasi ke Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scope untuk status pembayaran
    public function scopeMenunggu($query)
    {
        return $query->where('status_pembayaran', 'menunggu');
    }

    public function scopeSukses($query)
    {
        return $query->where('status_pembayaran', 'sukses');
    }

    public function scopeGagal($query)
    {
        return $query->where('status_pembayaran', 'gagal');
    }

    // Accessor untuk badge status
    public function getBadgeStatusPembayaranAttribute()
    {
        $badges = [
            'menunggu' => 'bg-yellow-100 text-yellow-800',
            'sukses' => 'bg-green-100 text-green-800',
            'gagal' => 'bg-red-100 text-red-800',
            'kadaluarsa' => 'bg-gray-100 text-gray-800',
            'menunggu_verifikasi' => 'bg-blue-100 text-blue-800'
        ];

        return $badges[$this->status_pembayaran] ?? 'bg-gray-100 text-gray-800';
    }

    // Cek apakah pembayaran sudah lunas
    public function getSudahLunasAttribute()
    {
        return $this->status_pembayaran === 'sukses';
    }

    // Cek apakah pembayaran online
    public function getPembayaranOnlineAttribute()
    {
        return $this->saluran_pembayaran === 'online';
    }
}
