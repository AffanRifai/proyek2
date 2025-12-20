<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GpsController;
use Illuminate\Support\Facades\Route;

Route::post('/send-location', [GpsController::class, 'store']);


use App\Http\Controllers\SearchController;

Route::middleware('api')->group(function () {
    Route::get('/search/mobil', [SearchController::class, 'searchMobil']);
    Route::get('/search/artikel', [SearchController::class, 'searchArtikel']);
    Route::get('/search/all', [SearchController::class, 'searchAll']);
});
