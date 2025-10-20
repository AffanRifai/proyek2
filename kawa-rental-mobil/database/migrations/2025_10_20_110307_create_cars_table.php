<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('model');
            $table->string('warna')->nullable();
            $table->string('tahun')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_polisi')->unique();
            $table->string('stnk_atas_nama')->nullable();
            $table->decimal('biaya_harian', 10, 2);
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'disewa', 'perawatan'])->default('tersedia');
            $table->text('deskripsi')->nullable();
            $table->text('fasilitas')->nullable();
            $table->text('syarat')->nullable();
            $table->text('kebijakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
