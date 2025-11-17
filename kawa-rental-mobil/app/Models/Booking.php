<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        'catatan_admin',
        'hari_terlambat',
        'denda_terlambat',
        'actual_sel_tgl',
        'keterangan_terlambat',
        'status_mobil',
        'status_pembayaran',
        'jumlah_dp',
        'sisa_pembayaran',
        'total_dibayar',
        'midtrans_order_id',
        'tanggal_jatuh_tempo_pembayaran',
        'expired_at',
    ];

    protected $casts = [
        'mulai_tgl' => 'date',
        'sel_tgl' => 'date',
        'biaya_harian' => 'decimal:2',
        'total_pembayaran' => 'decimal:2',
        'actual_sel_tgl' => 'date',
        'denda_terlambat' => 'decimal:2',
        'jumlah_dp' => 'decimal:2',
        'sisa_pembayaran' => 'decimal:2',
        'total_dibayar' => 'decimal:2',
        'tanggal_jatuh_tempo_pembayaran' => 'datetime',
        'expired_at' => 'datetime',
    ];

    protected $dates = [
        'mulai_tgl',
        'sel_tgl',
        'actual_sel_tgl',
        'tanggal_jatuh_tempo_pembayaran',
        'expired_at',
        'created_at',
        'updated_at',
    ];

    public function car()
    {
        return $this->belongsTo(\App\Models\Car::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Accessor untuk mudah mendapatkan id_transaksi
    public function getTransactionIdAttribute()
    {
        return $this->id_transaksi;
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(\App\Models\Pembayaran::class, 'booking_id');
    }

    // total sudah dibayar (mengakumulasi total_dibayar atau dari pembayaran)
    public function totalDibayar()
    {
        // Jika kamu menyimpan total_dibayar di kolom, pakai itu; fallback ke relasi pembayaran
        if ($this->total_dibayar && $this->total_dibayar > 0) return (float) $this->total_dibayar;

        return (float) $this->pembayaran()->whereIn('status_pembayaran', ['sukses'])->sum('jumlah');
    }

    public function sisaBayar()
    {
        $sisa = (float)$this->total_pembayaran - $this->totalDibayar();
        return $sisa > 0 ? $sisa : 0.00;
    }

    public function requiresDp()
    {
        // asumsi: tipe_pembayaran 'dp' berarti ada DP
        return $this->tipe_pembayaran === 'dp';
    }

    public function isCancelable()
    {
        // hanya bisa dibatalkan jika status pending
        return $this->status === 'pending';
    }

    /**
     * Scope untuk filter booking yang belum dibayar dalam 24 jam.
     */
    public function scopeExpiredUnpaid($query)
    {
        return $query->where('status', 'pending')
            ->where('status_pembayaran', 'menunggu')
            ->whereNotNull('created_at')
            ->where('created_at', '<', now()->subDay());
    }



    // Method untuk pembayaran DP
    public function bayarDp($jumlah)
    {
        $this->update([
            'jumlah_dp' => $jumlah,
            'sisa_pembayaran' => $this->total_pembayaran - $jumlah,
            'status_pembayaran' => 'dp_dibayar'
        ]);
    }

    // Method untuk pelunasan
    public function lunasi($jumlah)
    {
        $this->update([
            'sisa_pembayaran' => 0,
            'total_dibayar' => $this->total_dibayar + $jumlah,
            'status_pembayaran' => 'lunas'
        ]);
    }

    // Cek apakah sudah bayar DP
    public function getSudahBayarDpAttribute()
    {
        return $this->status_pembayaran === 'dp_dibayar';
    }

    // Cek apakah sudah lunas
    public function getSudahLunasAttribute()
    {
        return $this->status_pembayaran === 'lunas';
    }

    // Cek apakah punya tunggakan
    public function getPunyaTunggakanAttribute()
    {
        return $this->sisa_pembayaran > 0 && $this->status_pembayaran === 'dp_dibayar';
    }

    // Accessor untuk badge status pembayaran
    public function getBadgeStatusPembayaranAttribute()
    {
        $badges = [
            'menunggu' => 'bg-yellow-100 text-yellow-800',
            'dp_dibayar' => 'bg-blue-100 text-blue-800',
            'lunas' => 'bg-green-100 text-green-800',
            'tertunggak' => 'bg-red-100 text-red-800'
        ];

        return $badges[$this->status_pembayaran] ?? 'bg-gray-100 text-gray-800';
    }

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

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Scope untuk booking yang sudah lewat tanggal selesai (hanya informasi)
    public function scopeExpired($query)
    {
        return $query->where('status', 'approved')
            ->where('sel_tgl', '<', Carbon::today());
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

    // ✅ METHOD BARU: Hitung saran hari terlambat (hanya referensi untuk admin)
    public function calculateSuggestedHariTerlambat($actualSelTgl = null)
    {
        if (!$actualSelTgl) {
            return 0;
        }

        $selTgl = Carbon::parse($this->sel_tgl);
        $actualSelTgl = Carbon::parse($actualSelTgl);

        // Keterlambatan hanya jika actual_sel_tgl > sel_tgl
        if ($actualSelTgl->lte($selTgl)) {
            return 0;
        }

        // Hitung selisih hari
        return $selTgl->diffInDays($actualSelTgl, false);
    }

    // ✅ METHOD BARU: Hitung saran denda (150% per hari) - hanya referensi
    public function calculateSuggestedDenda($actualSelTgl = null)
    {
        $hariTerlambat = $this->calculateSuggestedHariTerlambat($actualSelTgl);
        return $hariTerlambat * ($this->biaya_harian * 1.5);
    }

    // ✅ METHOD BARU: Proses pengembalian manual dengan denda flexible
    public function prosesPengembalianManual($actualSelTgl, $hariTerlambat, $dendaTerlambat, $catatan = null)
    {
        DB::transaction(function () use ($actualSelTgl, $hariTerlambat, $dendaTerlambat, $catatan) {

            // Tentukan status mobil berdasarkan ada/tidak denda
            $statusMobil = $hariTerlambat > 0 ? 'terlambat' : 'normal';

            // Generate keterangan otomatis
            $keterangan = $this->generateKeterangan($hariTerlambat, $dendaTerlambat, $catatan);

            $this->update([
                'status' => 'completed',
                'actual_sel_tgl' => Carbon::parse($actualSelTgl),
                'hari_terlambat' => $hariTerlambat,
                'denda_terlambat' => $dendaTerlambat,
                'status_mobil' => $statusMobil,
                'keterangan_terlambat' => $keterangan
            ]);

            // Kembalikan mobil ke status tersedia
            if ($this->car) {
                $this->car->update(['status' => 'tersedia']);
            }

            Log::info("Pengembalian manual diproses: {$this->id_transaksi}", [
                'tanggal_pengembalian' => $actualSelTgl,
                'hari_terlambat' => $hariTerlambat,
                'denda_terlambat' => $dendaTerlambat,
                'admin' => auth()->user()->name,
                'catatan' => $catatan
            ]);
        });
    }

    // ✅ Generate keterangan otomatis
    private function generateKeterangan($hariTerlambat, $dendaTerlambat, $catatan = null)
    {
        $keterangan = "Mobil dikembalikan " . ($hariTerlambat > 0 ? "terlambat {$hariTerlambat} hari" : "tepat waktu");

        if ($dendaTerlambat > 0) {
            $keterangan .= ". Denda: Rp " . number_format($dendaTerlambat, 0, ',', '.');
        }

        if ($catatan) {
            $keterangan .= " | Catatan: {$catatan}";
        }

        return $keterangan;
    }

    // ✅ GET TOTAL PEMBAYARAN + DENDA
    public function getTotalPembayaranWithDendaAttribute()
    {
        return $this->total_pembayaran + $this->denda_terlambat;
    }

    // ✅ CEK APAKAH ADA DENDA
    public function getAdaDendaAttribute()
    {
        return $this->denda_terlambat > 0;
    }

    // ✅ ACCESSOR UNTUK STATUS MOBIL BADGE
    public function getStatusMobilBadgeAttribute()
    {
        $badges = [
            'normal' => 'bg-green-100 text-green-800',
            'terlambat' => 'bg-orange-100 text-orange-800',
            'rusak' => 'bg-red-100 text-red-800',
            'hilang' => 'bg-purple-100 text-purple-800'
        ];

        return $badges[$this->status_mobil] ?? 'bg-gray-100 text-gray-800';
    }

    // ✅ CEK APAKAH SUDAH TERLAMBAT (berdasarkan status_mobil)
    public function getIsMobilTerlambatAttribute()
    {
        return $this->status_mobil === 'terlambat';
    }

    // Method untuk cek apakah booking sudah expired (hanya informasi)
    public function isExpired()
    {
        // return $this->status === 'approved' &&
        //     Carbon::parse($this->sel_tgl)->lt(Carbon::today());

        return $this->status === 'expired' || ($this->expired_at && now()->isAfter($this->expired_at));
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

    // Method untuk cancel booking (dari status approved)
    public function cancel($alasan = null)
    {
        if ($this->status !== 'approved') {
            throw new \Exception('Hanya booking dengan status approved yang bisa dibatalkan.');
        }

        $this->update([
            'status' => 'cancelled',
            'catatan_admin' => $alasan
        ]);

        // Kembalikan status mobil menjadi tersedia
        if ($this->car) {
            $this->car->update(['status' => 'tersedia']);
        }

        return $this;
    }

    // Method untuk complete booking (tanpa denda - untuk pengembalian tepat waktu)
    public function complete()
    {
        // Safety check - hanya bisa complete booking yang approved
        if ($this->status !== 'approved') {
            throw new \Exception('Hanya booking dengan status approved yang bisa diselesaikan.');
        }

        $this->update([
            'status' => 'completed',
            'actual_sel_tgl' => now(),
            'keterangan_terlambat' => 'Mobil dikembalikan tepat waktu.'
        ]);

        // Update status mobil menjadi tersedia kembali
        if ($this->car) {
            $this->car->update(['status' => 'tersedia']);
        }

        return $this;
    }

    // ✅ METHOD BARU: Cek apakah booking sedang berjalan (dalam rentang tanggal)
    public function getIsSedangDisewaAttribute()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->mulai_tgl)->lte(Carbon::today()) &&
            Carbon::parse($this->sel_tgl)->gte(Carbon::today());
    }

    // ✅ METHOD BARU: Cek apakah booking akan datang (accessor)
    public function getIsUpcomingAttribute()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->mulai_tgl)->gt(Carbon::today());
    }

    // ✅ METHOD BARU: Cek apakah booking sudah terlambat (melewati sel_tgl)
    public function getIsTerlambatAttribute()
    {
        return $this->status === 'approved' &&
            Carbon::parse($this->sel_tgl)->lt(Carbon::today());
    }

    // ✅ METHOD BARU: Keterangan status real-time
    public function getKeteranganStatusAttribute()
    {
        if ($this->status === 'completed') {
            return 'Selesai';
        } elseif ($this->status === 'cancelled') {
            return 'Dibatalkan';
        } elseif ($this->status === 'rejected') {
            return 'Ditolak';
        } elseif ($this->status === 'pending') {
            return 'Menunggu Konfirmasi';
        } elseif ($this->is_sedang_disewa) {
            return 'Sedang Disewa/Berjalan';
        } elseif ($this->is_terlambat) {
            return 'Terlambat';
        } elseif ($this->is_upcoming) {
            return 'Akan Datang';
        }

        return 'Tidak Diketahui';
    }

    // ✅ METHOD BARU: Status utama yang harus ditampilkan
    public function getStatusUtamaAttribute()
    {
        // Prioritas: Completed/Cancelled/Rejected → Sedang Disewa → Terlambat → Pending/Approved
        if ($this->status === 'completed') {
            return ['text' => 'Selesai', 'color' => 'blue', 'icon' => '✅'];
        } elseif ($this->status === 'cancelled') {
            return ['text' => 'Dibatalkan', 'color' => 'gray', 'icon' => '❌'];
        } elseif ($this->status === 'rejected') {
            return ['text' => 'Ditolak', 'color' => 'red', 'icon' => '🚫'];
        } elseif ($this->is_sedang_disewa) {
            return ['text' => 'Sedang Disewa/Berjalan', 'color' => 'green', 'icon' => '🚗'];
        } elseif ($this->is_terlambat) {
            return ['text' => 'Terlambat', 'color' => 'red', 'icon' => '⚠️'];
        } elseif ($this->is_upcoming) {
            return ['text' => 'Akan Datang', 'color' => 'blue', 'icon' => '📅'];
        } elseif ($this->status === 'approved') {
            return ['text' => 'Disetujui', 'color' => 'green', 'icon' => '✅'];
        } elseif ($this->status === 'pending') {
            return ['text' => 'Menunggu Konfirmasi', 'color' => 'yellow', 'icon' => '⏳'];
        }

        return ['text' => 'Tidak Diketahui', 'color' => 'gray', 'icon' => '❓'];
    }

    // ✅ METHOD BARU: Badge color berdasarkan status
    public function getStatusUtamaBadgeAttribute()
    {
        $colors = [
            'green' => 'bg-green-100 text-green-800',
            'red' => 'bg-red-100 text-red-800',
            'yellow' => 'bg-yellow-100 text-yellow-800',
            'blue' => 'bg-blue-100 text-blue-800',
            'gray' => 'bg-gray-100 text-gray-800'
        ];

        return $colors[$this->status_utama['color']] ?? 'bg-gray-100 text-gray-800';
    }

    // ✅ METHOD BARU: Tombol pengembalian hanya aktif jika terlambat
    public function getTombolPengembalianAktifAttribute()
    {
        return $this->status === 'approved' && $this->is_terlambat;
    }

    // Cek apakah booking bisa di-approve
    public function canBeApproved()
    {
        return $this->status === 'pending' && $this->car->status === 'tersedia';
    }

    // Cek apakah booking bisa di-cancel
    public function canBeCancelled()
    {
        return $this->status === 'approved';
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

    // === AUTO CANCEL CHECK ===
    public function checkAutoCancel()
    {
        try {
            // jika status akhir, skip
            if (in_array($this->status, ['expired', 'cancelled', 'rejected', 'completed'])) {
                Log::info("checkAutoCancel: booking {$this->id} already terminal status {$this->status}");
                return false;
            }

            // jika booking sudah memiliki status_pembayaran selain 'menunggu' (mis. dp_dibayar, lunas), skip
            if ($this->status_pembayaran && $this->status_pembayaran !== 'menunggu') {
                Log::info("checkAutoCancel: booking {$this->id} status_pembayaran={$this->status_pembayaran}, skipping auto-cancel");
                return false;
            }

            // jika sudah ada pembayaran sukses, skip
            $hasSuccess = $this->pembayaran()->where('status_pembayaran', 'sukses')->exists();
            if ($hasSuccess) {
                Log::info("checkAutoCancel: booking {$this->id} has successful pembayaran, skipping auto-cancel");
                return false;
            }

            // jika ada pembayaran pending online, atau ada pembayaran offline yang terdaftar (menunggu_verifikasi),
            // skip auto-cancel supaya admin bisa konfirmasi/offline flow berjalan.
            $hasPendingOnline = $this->pembayaran()
                ->where('saluran_pembayaran', 'online')
                ->whereIn('status_pembayaran', ['menunggu', 'menunggu_verifikasi'])
                ->exists();

            $hasPendingOffline = $this->pembayaran()
                ->where('saluran_pembayaran', 'offline')
                ->whereIn('status_pembayaran', ['menunggu', 'menunggu_verifikasi'])
                ->exists();

            if ($hasPendingOnline || $hasPendingOffline) {
                Log::info("checkAutoCancel: booking {$this->id} has pending pembayaran (online/offline), skipping auto-cancel");
                return false;
            }

            // determine cutoff: prefer expired_at, else created_at + 3600s
            if ($this->expired_at) {
                $cutoff = $this->expired_at;
            } elseif ($this->created_at) {
                $cutoff = $this->created_at->copy()->addSeconds(3600); // jangan mutasi created_at
            } else {
                Log::info("checkAutoCancel: booking {$this->id} has no cutoff/expired_at");
                return false;
            }

            if (now()->gte($cutoff)) {
                DB::transaction(function () {
                    // update booking
                    $this->update([
                        'status' => 'expired',
                        'status_pembayaran' => 'tertunggak',
                        'catatan_admin' => 'Booking dibatalkan otomatis karena melewati batas waktu pembayaran.',
                    ]);

                    // kembalikan mobil jika terkait
                    if ($this->car) {
                        try {
                            $this->car->update(['status' => 'tersedia']);
                        } catch (\Exception $e) {
                            Log::warning("checkAutoCancel: failed to update car status for booking {$this->id}: " . $e->getMessage());
                        }
                    }
                });

                Log::info("Booking {$this->id} auto-cancelled and marked tertunggak.");
                return true;
            }

            // belum waktunya
            return false;
        } catch (\Exception $e) {
            Log::error("Auto cancel error booking {$this->id}: " . $e->getMessage());
            return false;
        }
    }

    // Scope untuk booking yang belum expired
    public function scopeNotExpired($query)
    {
        return $query->where('status', '!=', 'expired')->where(function ($q) {
            $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
        });
    }

    public function pelunasanDeadline()
    {
        if (!$this->mulai_tgl) return null;
        return \Carbon\Carbon::parse($this->mulai_tgl)->endOfDay();
    }

    public function canPelunasanOffline()
    {
        if ($this->status === 'expired') return false;
        if ($this->sisaBayar() <= 0) return false;
        if ($this->status_pembayaran === 'lunas') return false;

        $deadline = $this->pelunasanDeadline();
        if ($deadline) {
            return now()->lessThanOrEqualTo($deadline);
        }

        // fallback: jika tidak ada mulai_tgl, kita izinkan selama booking belum expired
        return true;
    }
}
