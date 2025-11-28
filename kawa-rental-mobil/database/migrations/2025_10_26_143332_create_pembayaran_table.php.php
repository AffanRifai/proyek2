<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->enum('jenis_pembayaran', ['dp', 'pelunasan', 'bayar_penuh', 'denda']);
            $table->enum('metode_pembayaran', ['midtrans', 'transfer', 'cash', 'qris'])->default('midtrans');
            $table->enum('saluran_pembayaran', ['online', 'offline'])->default('online');
            $table->decimal('jumlah', 12, 2);
            $table->decimal('jumlah_dibayar', 12, 2)->default(0);
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->enum('status_pembayaran', ['menunggu', 'sukses', 'gagal', 'kadaluarsa', 'menunggu_verifikasi'])->default('menunggu');
            $table->text('bukti_pembayaran')->nullable();
            $table->text('data_pembayaran')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamp('dibayar_pada')->nullable();
            $table->timestamp('tanggal_jatuh_tempo')->nullable();
            $table->index(['booking_id', 'status_pembayaran']);
            $table->unique('midtrans_order_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
