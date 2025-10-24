<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Migration
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('catatan_admin')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('catatan_admin');
        });
    }
};
