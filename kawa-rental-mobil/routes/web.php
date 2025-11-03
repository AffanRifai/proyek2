<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Models\Verification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show'])->name('verification.show')->middleware('auth');
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
Route::get('/bookingmobiliomanual', fn () => view('bookingmobiliomanual'));
Route::get('/bookingbriomatic', fn () => view('bookingbriomatic'));
Route::get('/bookingbriomanual', fn () => view('bookingbriomanual'));
Route::get('/bookingavanzamanual', fn () => view('bookingavanzamanual'));
Route::get('/bookingavanzaautomatic', fn () => view('bookingavanzaautomatic'));

Route::get('/TentangKami', fn () => view('TentangKami'));

Route::get('/AdminManajemenBooking', fn () => view('AdminManajemenBooking'));

Route::get('/AdminDashboardMobil', fn () => view('AdminDashboardMobil'));
Route::get('/AdminDetailMobil', fn () => view('AdminDetailMobil'));
Route::get('/AdminLaporanStatis', fn () => view('AdminLaporanStatis'));
Route::get('/AdminManajemenMobil', fn () => view('AdminManajemenMobil'));
Route::get('/AdminManajemenBookingMobil', fn () => view('AdminManajemenBookingMobil'));
Route::get('/AdminTrackLocation', fn () => view('AdminTrackLocation'));
