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
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminBookingController;

Route::get('/', function () {
    return view('landingpage');
})->name('home');

Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

Route::get('/cek-tabel', function () {
    $columns = DB::select('DESCRIBE bookings');
    return response()->json($columns);
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

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});

Route::get('/daftar-mobil', [CarController::class, 'daftar'])->name('daftar.mobil');
Route::get('/detail-mobil/{id}', [CarController::class, 'detail'])->name('detail.mobil');
Route::get('/form-booking/{id}', [BookingController::class, 'create'])->name('form.booking');
Route::post('/form-booking', [BookingController::class, 'store'])->name('booking.store');

// Di routes/web.php tambahkan:
Route::post('/booking/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.check-availability');


Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/booking', fn() => view('booking'));
Route::get('/form', fn() => view('formrental'));

Route::get('/bookinghiace', fn() => view('bookinghiace'));
Route::get('/bookingmobiliomanual', fn() => view('bookingmobiliomanual'));
Route::get('/bookingbriomatic', fn() => view('bookingbriomatic'));
Route::get('/bookingbriomanual', fn() => view('bookingbriomanual'));
Route::get('/bookingavanzamanual', fn() => view('bookingavanzamanual'));
Route::get('/bookingavanzaautomatic', fn() => view('bookingavanzaautomatic'));

Route::get('/TentangKami', fn() => view('TentangKami'));

Route::get('/AdminManajemenBooking', fn() => view('AdminManajemenBooking'));

// ✅ PERBAIKAN: SATU KELOMPOK ROUTE ADMIN YANG BERSIH
Route::middleware(['auth', 'check_role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Bookings Management - MANUAL PROCESS
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('bookings.show');

    // ✅ ROUTES PENGEMBALIAN MANUAL (TANPA AUTO-COMPLETE)
    Route::get('/bookings/{id}/pengembalian', [AdminBookingController::class, 'showFormPengembalian'])
        ->name('bookings.pengembalian');
    Route::post('/bookings/{id}/pengembalian', [AdminBookingController::class, 'prosesPengembalian'])
        ->name('bookings.proses-pengembalian');

    // Booking Actions
    Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{id}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{id}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
    Route::delete('/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // File View & Download
    Route::get('/bookings/{id}/file/{type}', [AdminBookingController::class, 'viewFile'])->name('bookings.view-file');
    Route::get('/bookings/{id}/download/{type}', [AdminBookingController::class, 'downloadFile'])->name('bookings.download-file');
});
