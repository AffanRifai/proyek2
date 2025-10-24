<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
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
        'tipe_pembayaran',
        'bentuk_jaminan',
        'posisi_bbm',
        'file_identitas',
        'file_jaminan',
        'file_stnk_motor',
        'status',
        'catatan_admin'
    ];

    protected $casts = [
        'mulai_tgl' => 'date',
        'sel_tgl' => 'date',
        'biaya_harian' => 'decimal:2',
        'total_pembayaran' => 'decimal:2',
    ];

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Boot method untuk generate id_transaksi otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->id_transaksi)) {
                $booking->id_transaksi = static::generateUniqueTransactionId();
            }
        });
    }

    // Method untuk generate ID Transaksi
    public static function generateUniqueTransactionId()
    {
        $prefix = 'TRX';
        $date = now()->format('Ymd');

        do {
            $random = mt_rand(1000, 9999);
            $id_transaksi = $prefix . $date . $random;
        } while (static::where('id_transaksi', $id_transaksi)->exists());

        return $id_transaksi;
    }

    // Method untuk mencari booking berdasarkan id_transaksi
    public static function findByTransactionId($id_transaksi)
    {
        return static::where('id_transaksi', $id_transaksi)->first();
    }

    // Method untuk approve booking
    public function approve()
    {
        $this->update(['status' => 'approved']);

        // Update status mobil menjadi disewa
        if ($this->car) {
            $this->car->update(['status' => 'disewa']);
        }

        return $this;
    }

    // Method untuk reject booking
    public function reject($alasan = null)
    {
        $this->update([
            'status' => 'rejected',
            'catatan_admin' => $alasan
        ]);

        return $this;
    }

    // Method untuk complete booking
    public function complete()
    {
        $this->update(['status' => 'completed']);

        // Update status mobil menjadi tersedia kembali
        if ($this->car) {
            $this->car->update(['status' => 'tersedia']);
        }

        return $this;
    }

    // Cek apakah booking bisa di-approve
    public function canBeApproved()
    {
        return $this->status === 'pending' && $this->car->status === 'tersedia';
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-gray-100 text-gray-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Method untuk auto-complete booking yang sudah selesai
    public static function autoCompleteExpiredBookings()
    {
        $expiredBookings = static::where('status', 'approved')
            ->where('sel_tgl', '<', Carbon::today())
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->complete();
        }

        return $expiredBookings->count();
    }

    // Method untuk cek apakah booking sudah expired
    public function isExpired()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->sel_tgl)->lt(Carbon::today());
    }

    // Method untuk cek apakah booking sedang berjalan
    public function isActive()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->mulai_tgl)->lte(Carbon::today()) &&
            Carbon::parse($this->sel_tgl)->gte(Carbon::today());
    }

    // Method untuk cek apakah booking akan datang
    public function isUpcoming()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->mulai_tgl)->gt(Carbon::today());
    }

    // Relationship
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk mudah mendapatkan id_transaksi
    public function getTransactionIdAttribute()
    {
        return $this->id_transaksi;
    }
}
