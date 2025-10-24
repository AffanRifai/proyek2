// database/migrations/xxxx_update_bookings_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdentitasTabelBooking extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['merk', 'model']);
            $table->renameColumn('file_ktp', 'file_identitas');
            $table->renameColumn('file_sim', 'file_jaminan');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('merk')->nullable();
            $table->string('model')->nullable();
            $table->renameColumn('file_identitas', 'file_ktp');
            $table->renameColumn('file_jaminan', 'file_sim');
        });
    }
}