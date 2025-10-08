<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Models\Verification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/DaftarMobil', fn () => view('DaftarMobil'));

Route::group(['middleware' => ['auth', 'check_role:customer']], function () {
    Route::get('/verify', [VerificationController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'check_role:customer', 'check_status']], function () {
    Route::get('/landingpage', fn () => view('landingpage'));
});
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    // Route::get('/manajemen', [AdminController::class, 'manajemen']);
    // Route::get('/tambah_mobil', [AdminController::class, 'tambah_mobil']);
    // Route::post('/tambah_mobil', [AdminController::class, 'store_mobil']);
    // Route::get('/edit_mobil/{id}', [AdminController::class, 'edit_mobil']);
    // Route::post('/update_mobil/{id}', [AdminController::class, 'update_mobil']);
    // Route::get('/delete_mobil/{id}', [AdminController::class, 'delete_mobil']);
});
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/booking', fn () => view('booking'));

Route::get('/bookinghiace', fn () => view('bookinghiace'));