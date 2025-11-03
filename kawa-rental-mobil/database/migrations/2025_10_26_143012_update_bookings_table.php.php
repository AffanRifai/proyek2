<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['menunggu', 'dp_dibayar', 'lunas', 'tertunggak'])->default('menunggu')->after('tipe_pembayaran');
            $table->decimal('jumlah_dp', 12, 2)->default(0)->after('status_pembayaran');
            $table->decimal('sisa_pembayaran', 12, 2)->default(0)->after('jumlah_dp');
            $table->decimal('total_dibayar', 12, 2)->default(0)->after('sisa_pembayaran');
            $table->string('midtrans_order_id')->nullable()->after('total_dibayar');
            $table->timestamp('tanggal_jatuh_tempo_pembayaran')->nullable()->after('midtrans_order_id');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'status_pembayaran',
                'jumlah_dp', 
                'sisa_pembayaran',
                'total_dibayar',
                'midtrans_order_id',
                'tanggal_jatuh_tempo_pembayaran'
            ]);
        });
    }
};