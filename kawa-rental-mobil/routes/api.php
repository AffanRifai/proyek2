<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GpsController;
use Illuminate\Support\Facades\Route;

Route::post('/send-location', [GpsController::class, 'store']);
