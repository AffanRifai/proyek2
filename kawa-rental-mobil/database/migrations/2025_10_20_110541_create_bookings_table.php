<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
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
            $table->time('sel_pkl')->nullable();
            $table->integer('lama_hari');
            $table->decimal('biaya_harian', 10, 2);
            $table->decimal('total_pembayaran', 12, 2);
            $table->string('bentuk_jaminan')->nullable();
            $table->string('posisi_bbm')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_sim')->nullable();
            $table->string('file_stnk_motor')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
