<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GpsController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari ESP32
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Simpan ke database
        DB::table('locations')->insert([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success']);
    }
}
