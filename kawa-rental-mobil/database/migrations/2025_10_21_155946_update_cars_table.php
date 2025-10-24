<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('status');
            $table->text('fasilitas')->nullable()->after('deskripsi');
            $table->text('syarat')->nullable()->after('fasilitas');
            $table->text('kebijakan')->nullable()->after('syarat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
        });
    }
};
