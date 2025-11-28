<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        $latestLocation = DB::table('locations')
            ->orderBy('id', 'desc')
            ->first();

        return view('map', compact('latestLocation'));
    }
}
