<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi')->unique()->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('nama_penyewa');
            $table->string('no_telp');
            $table->text('alamat')->nullable();
            $table->string('nama_supir')->nullable();
            $table->string('telp_supir')->nullable();
            $table->string('tujuan');
            $table->date('mulai_tgl');
            $table->time('mulai_pkl')->nullable();
            $table->date('sel_tgl');
            $table->date('actual_sel_tgl')->nullable();
            $table->time('sel_pkl')->nullable();
            $table->integer('lama_hari');
            $table->integer('hari_terlambat')->default(0);
            $table->decimal('biaya_harian', 10, 2);
            $table->decimal('total_pembayaran', 12, 2)->default(0)->change();
            $table->decimal('denda_terlambat', 12, 2)->default(0);
            $table->enum('tipe_pembayaran', ['dp', 'bayar_penuh']);
            $table->string('bentuk_jaminan')->nullable();
            $table->string('posisi_bbm')->nullable();
            $table->string('file_identitas')->nullable();
            $table->string('file_jaminan')->nullable();
            $table->string('file_stnk_motor')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->text('keterangan_terlambat')->nullable();
            $table->enum('status_mobil', ['normal', 'terlambat', 'rusak', 'hilang'])->default('normal');
            $table->decimal('jumlah_dp', 12, 2)->default(0)->change();
            $table->decimal('sisa_pembayaran', 12, 2)->default(0)->change();
            $table->decimal('total_dibayar', 12, 2)->default(0)->change();
            $table->enum('status_pembayaran', ['menunggu', 'dp_dibayar', 'lunas', 'tertunggak'])->default('menunggu')->change();
            $table->string('midtrans_order_id')->nullable();
            $table->timestamp('tanggal_jatuh_tempo_pembayaran')->nullable();
            $table->timestamp('expired_at')->nullable()->after('status');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled', 'expired'])->default('pending')->change();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
