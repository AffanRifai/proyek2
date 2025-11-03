<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Field untuk keterlambatan
            $table->integer('hari_terlambat')->default(0)->after('lama_hari');
            $table->decimal('denda_terlambat', 12, 2)->default(0)->after('total_pembayaran');
            $table->date('actual_sel_tgl')->nullable()->after('sel_tgl'); // Tanggal actual pengembalian
            $table->text('keterangan_terlambat')->nullable()->after('catatan_admin');
            $table->enum('status_mobil', ['normal', 'terlambat', 'rusak', 'hilang'])->default('normal')->after('status');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'hari_terlambat',
                'denda_terlambat', 
                'actual_sel_tgl',
                'keterangan_terlambat',
                'status_mobil'
            ]);
        });
    }
};