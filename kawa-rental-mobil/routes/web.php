<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Models\Verification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('landingpage');
});
Route::get('/landingpage', function () {
    return view('landingpage');
});


Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth-google-callback', [GoogleController::class, 'callback']);


Route::get('/DaftarMobil', fn() => view('DaftarMobil'));

// route verifikasi akun
Route::group(['middleware' => ['auth', 'check_role:customer']], function () {
    Route::get('/verify', [VerificationController::class, 'index']);
    Route::post('/verify', [VerificationController::class, 'store']);
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show'])->name('verification.show')->middleware('auth');
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
});

// rooute halaman profile
Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

// route edit profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

// Menampilkan form "Lupa Password"
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

// Mengirim link reset ke email
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

// Menampilkan form reset password (setelah klik link di email)
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// Mengupdate password baru
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

// route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// route landing page setelah login
Route::group(['middleware' => ['auth', 'check_role:customer', 'check_status']], function () {
    Route::get('/landingpage', fn() => view('landingpage'));
});

// route halaman admin
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    // Route::get('/manajemen', [AdminController::class, 'manajemen']);
    // Route::get('/tambah_mobil', [AdminController::class, 'tambah_mobil']);
    // Route::post('/tambah_mobil', [AdminController::class, 'store_mobil']);
    // Route::get('/edit_mobil/{id}', [AdminController::class, 'edit_mobil']);
    // Route::post('/update_mobil/{id}', [AdminController::class, 'update_mobil']);
    // Route::get('/delete_mobil/{id}', [AdminController::class, 'delete_mobil']);
});

use App\Http\Controllers\BookingController;

Route::middleware(['auth'])->group(function () {
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});


use App\Http\Controllers\CarController;


Route::get('/daftar-mobil', [CarController::class, 'daftar'])->name('daftar.mobil');
Route::get('/detail-mobil/{id}', [CarController::class, 'detail'])->name('detail.mobil');
Route::get('/form-booking/{id}', [BookingController::class, 'create'])->name('form.booking');
Route::post('/form-booking', [BookingController::class, 'store'])->name('booking.store');








Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/booking', fn() => view('booking'));
Route::get('/form', fn() => view('formrental'));

Route::get('/bookinghiace', fn() => view('bookinghiace'));
Route::get('/bookingmobiliomanual', fn() => view('bookingmobiliomanual'));
Route::get('/bookingbriomatic', fn() => view('bookingbriomatic'));
Route::get('/bookingbriomanual', fn() => view('bookingbriomanual'));
Route::get('/bookingavanzamanual', fn() => view('bookingavanzamanual'));
Route::get('/bookingavanzaautomatic', fn() => view('bookingavanzaautomatic'));

Route::get('/TentangKami', fn () => view('TentangKami'));

Route::get('/AdminManajemenBooking', fn () => view('AdminManajemenBooking'));