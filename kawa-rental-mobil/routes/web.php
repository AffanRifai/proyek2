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
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\StatusPembayaranController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\LaporanStatistik;
use App\Http\Controllers\AdminCarController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/gps', function () {
    return view('gps');
});

Route::get('/tracking', function () {
    return view('tracking.index');
})->name('tracking.index');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/laporan-bulanan', [LaporanStatistik::class, 'index'])
        ->name('admin.laporan.bulanan');
});

use App\Models\Car;

Route::get('/', function () {
    // Pass a small selection of available cars to the landing page (if any)
    $cars = Car::where('status', 'tersedia')->latest('id')->take(6)->get();
    return view('landingpage', compact('cars'));
})->name('home');

// Route for laporan statistik: use controller so view gets required variables
Route::get('/laporan_stat', [LaporanStatistik::class, 'index'])
    ->middleware(['auth'])
    ->name('laporan.stat');

Route::get('/AdminDashboardMobil', function () {
    return view('AdminDashboardMobil');
})->name('admindashboardmobil');

Route::get('DetailMobil', function () {
    return view('AdminDetailMobil');
})->name('detail');

Route::get('/laporan', function () {
    return view('AdminLaporanStatis');
});

Route::get('/manajemenmobil', function () {
    return view('AdminManajemenMobil');
})->name('adminmanajemenmobil');
Route::get('/manajemenbookingmobil', function () {
    return view('AdminManajemenBookingMobil');
});
Route::get('/manajemenbookingmobil', function () {
    return view('AdminManajemenBookingMobil');
});
Route::get('/manajemenbookingmobil', function () {
    return view('AdminManajemenBookingMobil');
});

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);



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
use App\Models\Pembayaran;

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


Route::get('/DaftarMobil', fn() => view('DaftarMobil'));

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

Route::post('/pembayaran/offline', [PembayaranController::class, 'offline'])->name('pembayaran.offline');


// ✅ PERBAIKAN: SATU KELOMPOK ROUTE ADMIN YANG BERSIH
Route::middleware(['auth', 'check_role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

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

// Status Pembayaran Routes
Route::get('/status-pembayaran/{idPembayaran}', [StatusPembayaranController::class, 'show'])->name('status.pembayaran');
Route::get('/api/status-pembayaran/{idPembayaran}', [StatusPembayaranController::class, 'apiShow']);

// Callback Midtrans (Harus public - TANPA middleware)


// Routes Pembayaran
// ✅ ROUTES PEMBAYARAN YANG BENAR
Route::middleware(['auth'])->group(function () {
    // Halaman pembayaran butuh auth
    Route::get('/pembayaran/{idBooking}/{jenis}', [PembayaranController::class, 'buat'])->name('pembayaran.buat');
    Route::post('/pembayaran/{idBooking}/online', [PembayaranController::class, 'prosesOnline'])->name('pembayaran.proses.online');
    Route::post('/pembayaran/{idBooking}/offline', [PembayaranController::class, 'prosesOffline'])->name('pembayaran.proses.offline');
    Route::post('/pembayaran/{idPembayaran}/upload-bukti', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.upload.bukti');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

// ✅ STATUS PEMBAYARAN - TANPA AUTH (DI LUAR MIDDLEWARE GROUP)
// Temporary fix - ganti route name
Route::get('/payment-pending/{idPembayaran}', [PembayaranController::class, 'pending'])->name('payment.pending');
Route::get('/payment-success/{idPembayaran}', [PembayaranController::class, 'sukses'])->name('payment.sukses');
Route::get('/payment-failed/{idPembayaran}', [PembayaranController::class, 'gagal'])->name('payment.gagal');

// Routes Admin untuk Manajemen Pembayaran
Route::middleware(['auth', 'check_role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}', [AdminPembayaranController::class, 'detail'])->name('pembayaran.detail');
    Route::post('/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    Route::post('/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');
});

// ✅ CALLBACK MIDTRANS - HARUS PUBLIC (tanpa middleware)
Route::post('/pembayaran/midtrans/callback', [PembayaranController::class, 'handleCallback'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
    ->name('pembayaran.midtrans.callback');


// Admin Payment Management Routes
Route::middleware(['auth', 'check_role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Payment Management
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [AdminPaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{id}/sync', [AdminPaymentController::class, 'manualSync'])->name('payments.sync');
    Route::post('/payments/{id}/update-status', [AdminPaymentController::class, 'updateStatus'])->name('payments.update-status');
    Route::post('/payments/bulk-action', [AdminPaymentController::class, 'bulkAction'])->name('payments.bulk-action');
    Route::delete('/payments/{id}', [AdminPaymentController::class, 'destroy'])->name('payments.destroy'); // ✅ ADD THIS
});

use App\Http\Controllers\TransaksiController;

// ✅ Gunakan hanya salah satu dari dua ini
Route::get('/transaksi/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'showNota'])->name('transaksi.showNota');

Route::get('/transaksi/nota/{id}/download', [TransaksiController::class, 'downloadNota'])->name('transaksi.downloadNota');
Route::get('/transaksi/nota/{id}/download-gambar', [TransaksiController::class, 'downloadNotaGambar'])->name('transaksi.downloadNotaGambar');
Route::get('/transaksi/{id}/nota-pdf', [TransaksiController::class, 'downloadNotaPDF'])->name('transaksi.nota.pdf');


use App\Http\Controllers\PesananController;

Route::middleware(['auth'])->group(function () {
    Route::get('/pesanan-saya', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan-saya/{id}', [PesananController::class, 'show'])->name('pesanan.show');

    // Aksi untuk batalkan (AJAX post)
    Route::post('/pesanan-saya/{id}/cancel', [PesananController::class, 'cancel'])->name('pesanan.cancel');

    // Pembayaran / Midtrans
    // Route::post('/pembayaran/create-snap', [PembayaranController::class, 'createSnapToken'])->name('pembayaran.create_snap');
    Route::post('/pembayaran/create-snap', [PembayaranController::class, 'createSnap'])
        ->name('pembayaran.create_snap');
    Route::post('/pembayaran/webhook', [PembayaranController::class, 'notification']); // midtrans server-to-server
});


// Routes untuk Customer melihat booking mereka
Route::middleware(['auth'])->group(function () {
    // ... routes lainnya ...

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/bookings/saya', [BookingController::class, 'bookingsSaya'])->name('bookings.saya');
});


// Di routes/web.php
Route::get('/sync-payment/{paymentId}', function ($paymentId) {
    try {
        \Artisan::call('payment:sync', ['paymentId' => $paymentId]);

        $output = \Artisan::output();
        \Log::info("Manual sync for payment {$paymentId}: " . $output);

        return response()->json([
            'success' => true,
            'message' => 'Sync completed',
            'output' => $output
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Sync all pending payments
Route::get('/sync-all-payments', function () {
    try {
        \Artisan::call('payment:sync', ['--all' => true]);

        $output = \Artisan::output();

        return response()->json([
            'success' => true,
            'message' => 'All payments synced',
            'output' => $output
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// ============================================================
// TAMBAHAN: ROUTES CRUD MOBIL ADMIN (TANPA MENGHAPUS ROUTE LAMA)
// ============================================================
Route::middleware(['auth', 'check_role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/mobil', [AdminCarController::class, 'index'])->name('mobil.index');
        Route::get('/mobil/create', [AdminCarController::class, 'create'])->name('mobil.create');
        Route::post('/mobil/store', [AdminCarController::class, 'store'])->name('mobil.store');
        Route::get('/mobil/{id}/edit', [AdminCarController::class, 'edit'])->name('mobil.edit');
        Route::put('/mobil/{id}', [AdminCarController::class, 'update'])->name('mobil.update');
        Route::delete('/mobil/{id}', [AdminCarController::class, 'destroy'])->name('mobil.destroy');
    });
