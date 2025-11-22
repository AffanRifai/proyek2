<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('expired_at')->nullable()->after('status'); // Waktu expire (1 jam dari booking dibuat)
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled', 'expired'])->default('pending')->change(); // Tambah 'expired'
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('expired_at');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])->default('pending')->change(); // Kembali ke asli
        });
    }
};
