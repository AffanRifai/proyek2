<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambah default value untuk field yang required
            $table->decimal('total_pembayaran', 12, 2)->default(0)->change();
            $table->decimal('jumlah_dp', 12, 2)->default(0)->change();
            $table->decimal('sisa_pembayaran', 12, 2)->default(0)->change();
            $table->decimal('total_dibayar', 12, 2)->default(0)->change();
            $table->enum('status_pembayaran', ['menunggu', 'dp_dibayar', 'lunas', 'tertunggak'])->default('menunggu')->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Revert changes jika perlu
            $table->decimal('total_pembayaran', 12, 2)->default(null)->change();
            $table->decimal('jumlah_dp', 12, 2)->default(null)->change();
            $table->decimal('sisa_pembayaran', 12, 2)->default(null)->change();
            $table->decimal('total_dibayar', 12, 2)->default(null)->change();
            $table->enum('status_pembayaran', ['menunggu', 'dp_dibayar', 'lunas', 'tertunggak'])->default(null)->change();
        });
    }
};
