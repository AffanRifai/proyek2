<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function daftar()
    {
        $cars = Car::all();
        return view('daftar-mobil', compact('cars'));
    }

    public function detail($id)
    {
        $car = Car::findOrFail($id);
        return view('detail-mobil', compact('car'));
    }
}
