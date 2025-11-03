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

Route::get('/transaksi/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
Route::get('/transaksi/nota/{id}/download', [TransaksiController::class, 'downloadNota'])->name('transaksi.downloadNota');
Route::get('/transaksi/nota/{id}/download-gambar', [TransaksiController::class, 'downloadNotaGambar'])->name('transaksi.downloadNotaGambar');
Route::get('/transaksi/{id}/nota/gambar', [TransaksiController::class, 'downloadNotaGambar'])
    ->name('transaksi.downloadNota');

Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'showNota'])->name('transaksi.nota');
Route::get('/transaksi/{id}/nota-pdf', [TransaksiController::class, 'downloadNotaPDF'])->name('transaksi.nota.pdf');




// routes/web.php - tambahkan route test
Route::get('/test-midtrans', function () {
    try {
        // Test koneksi Midtrans
        if (class_exists('Midtrans\Config')) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;

            return response()->json([
                'status' => 'success',
                'message' => 'Midtrans berhasil di-load',
                'client_key' => config('midtrans.client_key')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Class Midtrans tidak ditemukan'
            ], 500);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Routes untuk Customer melihat booking mereka
Route::middleware(['auth'])->group(function () {
    // ... routes lainnya ...

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/bookings/saya', [BookingController::class, 'bookingsSaya'])->name('bookings.saya');
});

// Route untuk test callback - HAPUS JIKA SUDAH PRODUCTION
Route::get('/test-callback/{pembayaranId}', function ($pembayaranId) {
    $pembayaran = \App\Models\Pembayaran::find($pembayaranId);

    if (!$pembayaran) {
        return response()->json(['error' => 'Pembayaran tidak ditemukan'], 404);
    }

    // Simulasikan callback settlement dari Midtrans
    $mockData = [
        'order_id' => $pembayaran->midtrans_order_id,
        'transaction_status' => 'settlement',
        'fraud_status' => 'accept',
        'gross_amount' => (string) $pembayaran->jumlah,
        'transaction_id' => 'TEST-' . time(),
        'payment_type' => 'bank_transfer',
        'va_numbers' => [['bank' => 'bca', 'va_number' => '1234567890']]
    ];

    \Log::info('Testing callback with data:', $mockData);

    // Panggil callback handler dengan GET request
    $request = new \Illuminate\Http\Request();
    $request->replace($mockData);

    $controller = new \App\Http\Controllers\PembayaranController();
    return $controller->handleCallback($request);
});

// Route debugging - temporary
Route::get('/debug-routes', function () {
    $routes = Route::getRoutes();

    $paymentRoutes = [];
    foreach ($routes as $route) {
        if (str_contains($route->uri(), 'pembayaran')) {
            $paymentRoutes[] = [
                'method' => $route->methods()[0],
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName()
            ];
        }
    }

    return response()->json($paymentRoutes);
});

// Fallback route untuk testing
Route::get('/test-pending/{id}', function ($id) {
    try {
        $pembayaran = \App\Models\Pembayaran::with('booking')->findOrFail($id);
        return view('pembayaran.pending', compact('pembayaran'));
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Debug route untuk testing
Route::get('/debug-pending/{id}', function ($id) {
    return "Debug Pending Route - ID: " . $id;
});

// Test semua route pembayaran
Route::get('/test-all-payment-routes', function () {
    $tests = [
        '/pembayaran/pending/9',
        '/pembayaran/sukses/9',
        '/pembayaran/gagal/9',
        '/test-pending/8',
        '/debug-pending/8'
    ];

    $results = [];
    foreach ($tests as $test) {
        try {
            $response = app()->handle(Request::create($test));
            $results[$test] = [
                'status' => $response->getStatusCode(),
                'success' => $response->getStatusCode() === 200
            ];
        } catch (\Exception $e) {
            $results[$test] = [
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ];
        }
    }

    return response()->json($results);
});


// Test endpoint untuk Midtrans webhook
Route::post('/test-webhook', function (Request $request) {
    \Log::info('=== TEST WEBHOOK RECEIVED ===');
    \Log::info('Headers:', $request->headers->all());
    \Log::info('Body:', $request->all());
    \Log::info('Raw:', ['content' => $request->getContent()]);

    return response()->json([
        'status' => 'success',
        'message' => 'Webhook received',
        'received_at' => now()->toDateTimeString()
    ]);
});

Route::get('/test-ngrok', function () {
    $configs = [
        'app_url' => config('app.url'),
        'midtrans_merchant_id' => config('midtrans.merchant_id'),
        'midtrans_client_key' => config('midtrans.client_key'),
        'midtrans_callback_url' => config('midtrans.callback_url'),
        'midtrans_is_production' => config('midtrans.is_production'),
        'all_midtrans_config' => config('midtrans'),
    ];

    \Log::info('Ngrok Test Accessed', $configs);

    return response()->json([
        'status' => 'success',
        'message' => 'Ngrok is working!',
        'config_check' => [
            'app_url_configured' => !empty(config('app.url')),
            'midtrans_loaded' => class_exists('Midtrans\Config'),
            'callback_url_set' => !empty(config('midtrans.callback_url')),
        ],
        'app_url' => config('app.url'),
        'midtrans_callback' => config('midtrans.callback_url'),
        'server_time' => now()->toDateTimeString(),
        'debug_info' => $configs
    ]);
});

// Di routes/web.php
Route::get('/callback-monitor', function () {
    $logs = [];
    $logFile = storage_path('logs/laravel.log');

    if (file_exists($logFile)) {
        $content = file_get_contents($logFile);
        // Ambil log terkait callback
        preg_match_all('/.*MIDTRANS CALLBACK.*/i', $content, $matches);
        $logs = array_slice($matches[0], -10); // 10 log terakhir
    }

    return view('callback-monitor', compact('logs'));
});

// Di routes/web.php
Route::get('/test-payment-flow/{bookingId}/{jenis}', function ($bookingId, $jenis) {
    try {
        $booking = \App\Models\Booking::findOrFail($bookingId);
        $controller = new \App\Http\Controllers\PembayaranController();

        // Simulasikan request
        $request = new \Illuminate\Http\Request();
        $request->replace(['jenis' => $jenis]);

        // Panggil prosesOnline
        return $controller->prosesOnline($request, $bookingId);
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});


// Di routes/web.php
Route::get('/payment-monitor', function () {
    $recentPayments = \App\Models\Pembayaran::with('booking')
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

    $stats = [
        'total' => \App\Models\Pembayaran::count(),
        'success' => \App\Models\Pembayaran::where('status_pembayaran', 'sukses')->count(),
        'pending' => \App\Models\Pembayaran::where('status_pembayaran', 'menunggu')->count(),
        'failed' => \App\Models\Pembayaran::where('status_pembayaran', 'gagal')->count(),
    ];

    return view('payment-monitor', compact('recentPayments', 'stats'));
});


// Test script untuk pembayaran otomatis
Route::get('/auto-test-payment/{jenis}', function ($jenis) {
    try {
        // Cari booking yang cocok
        $booking = \App\Models\Booking::where('tipe_pembayaran', $jenis == 'dp' ? 'dp' : 'bayar_penuh')
            ->where('status_pembayaran', 'menunggu')
            ->first();

        if (!$booking) {
            // Buat booking test otomatis
            $car = \App\Models\Car::where('status', 'tersedia')->first();

            $booking = \App\Models\Booking::create([
                'id_transaksi' => 'AUTO-TEST-' . time(),
                'user_id' => 1, // Ganti dengan user ID yang valid
                'car_id' => $car->id,
                'nama_penyewa' => 'Auto Test Customer',
                'no_telp' => '081234567890',
                'alamat' => 'Auto Test Address',
                'tujuan' => 'Surabaya',
                'mulai_tgl' => now(),
                'sel_tgl' => now()->addDays(3),
                'lama_hari' => 3,
                'biaya_harian' => $car->biaya_harian,
                'total_pembayaran' => $car->biaya_harian * 3,
                'tipe_pembayaran' => $jenis == 'dp' ? 'dp' : 'bayar_penuh',
                'bentuk_jaminan' => 'sim',
                'posisi_bbm' => 'full',
                'status' => 'pending',
                'status_pembayaran' => 'menunggu',
                'jumlah_dp' => $jenis == 'dp' ? ($car->biaya_harian * 3) * 0.2 : 0,
                'sisa_pembayaran' => $jenis == 'dp' ? ($car->biaya_harian * 3) * 0.8 : 0,
            ]);
        }

        // Redirect ke halaman pembayaran
        return redirect()->route('pembayaran.buat', [
            'idBooking' => $booking->id,
            'jenis' => $jenis
        ]);
    } catch (\Exception $e) {
        return "Error creating test: " . $e->getMessage();
    }
});

// Di routes/web.php
Route::get('/test-callback-accessible', function () {
    \Log::info('🔍 TEST: Callback accessibility check');

    return response()->json([
        'status' => 'success',
        'message' => 'Callback URL is accessible',
        'callback_url' => url('/pembayaran/midtrans/callback'),
        'required_method' => 'POST',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// Test POST request ke callback URL
Route::post('/test-callback-post', function () {
    \Log::info('✅ TEST: Callback POST request received', request()->all());

    return response()->json([
        'status' => 'success',
        'message' => 'POST callback working!',
        'data_received' => request()->all(),
        'headers' => request()->headers->all()
    ]);
});

// Di routes/web.php
Route::get('/simulate-midtrans-callback/{pembayaranId}', function ($pembayaranId) {
    try {
        $pembayaran = \App\Models\Pembayaran::findOrFail($pembayaranId);

        // Data simulasi dari Midtrans
        $simulatedData = [
            'order_id' => $pembayaran->midtrans_order_id,
            'transaction_status' => 'settlement',
            'fraud_status' => 'accept',
            'gross_amount' => (string) $pembayaran->jumlah,
            'transaction_id' => 'SIM-' . time(),
            'payment_type' => 'bank_transfer',
            'va_numbers' => [['bank' => 'bca', 'va_number' => '1234567890']],
            'status_code' => '200',
            'signature_key' => 'simulated_signature'
        ];

        \Log::info('🧪 SIMULATING MIDTRANS CALLBACK', $simulatedData);

        // Panggil callback handler
        $request = new \Illuminate\Http\Request();
        $request->replace($simulatedData);

        $controller = new \App\Http\Controllers\PembayaranController();
        $response = $controller->handleCallback($request);

        \Log::info('SIMULATION RESULT', ['response' => $response->getContent()]);

        return response()->json([
            'simulation_data' => $simulatedData,
            'response' => $response->getContent(),
            'pembayaran_after' => \App\Models\Pembayaran::find($pembayaranId)
        ]);
    } catch (\Exception $e) {
        \Log::error('Simulation error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/view-logs', function () {
    $logFile = storage_path('logs/laravel.log');

    if (!file_exists($logFile)) {
        return "Log file not found";
    }

    $logs = file_get_contents($logFile);
    $lines = explode("\n", $logs);
    $recentLines = array_slice($lines, -50); // 50 lines terakhir

    return "<pre>" . implode("\n", $recentLines) . "</pre>";
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

// Di routes/web.php
// Ganti route advanced-payment-monitor dengan error handling
Route::get('/advanced-payment-monitor', function () {
    try {
        $recentPayments = \App\Models\Pembayaran::with(['booking', 'booking.car'])
            ->orderBy('created_at', 'desc')
            ->limit(25)
            ->get();

        $syncStats = [
            'pending' => \App\Models\Pembayaran::where('status_pembayaran', 'menunggu')->count(),
            'success' => \App\Models\Pembayaran::where('status_pembayaran', 'sukses')->count(),
            'failed' => \App\Models\Pembayaran::where('status_pembayaran', 'gagal')->count(),
            'total' => \App\Models\Pembayaran::count(),
        ];

        // Last sync info
        $logFile = storage_path('logs/payment-sync.log');
        $lastSync = file_exists($logFile) ? date('Y-m-d H:i:s', filemtime($logFile)) : 'Never';

        return view('advanced-payment-monitor', compact('recentPayments', 'syncStats', 'lastSync'));
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'View not ready',
            'message' => 'Advanced payment monitor view is being created',
            'alternative_url' => '/payment-monitor'
        ], 500);
    }
});
