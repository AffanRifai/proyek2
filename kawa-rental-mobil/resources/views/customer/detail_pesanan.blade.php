@extends('layout.app')

@section('title', 'Detail Pesanan - KAWA Rental Mobil')

@section('content')
    <div class="container my-5">
        <!-- Header -->
        <div class="page-header mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">Detail Pesanan</h1>
                    <p class="page-subtitle">ID Transaksi: {{ $booking->id_transaksi }}</p>
                </div>
                {{-- <div class="action-buttons">
                    <a href="{{ route('pesanan.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ url('/nota/' . $booking->id) }}" class="btn-print" target="_blank">
                        <i class="fas fa-print me-2"></i>Cetak Nota
                    </a>
                </div> --}}
            </div>
        </div>

        <!-- Status Bar -->
        <div class="status-bar-wrapper">
            <div class="status-bar">
                <div class="status-card">
                    <div class="status-icon order">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="status-info">
                        <p class="status-label">Status Pesanan</p>
                        <div class="status-value status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon payment">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="status-info">
                        <p class="status-label">Status Pembayaran</p>
                        <div class="status-value payment-{{ $booking->status_pembayaran }}">
                            {{ ucfirst($booking->status_pembayaran) }}
                        </div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon car">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="status-info">
                        <p class="status-label">Mobil</p>
                        <div class="status-value">{{ $booking->car->merk }} {{ $booking->car->model }}</div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-icon total">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="status-info">
                        <p class="status-label">Total</p>
                        <div class="status-value">Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <!-- Mobile Compact Status -->
            <div class="mobile-status-bar">
                <div class="mobile-status-header">
                    <div class="mobile-status-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h4>Status Pesanan</h4>
                    <button class="mobile-status-toggle" id="mobileStatusToggle">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="mobile-status-content" id="mobileStatusContent">
                    <div class="mobile-status-grid">
                        <div class="mobile-status-item">
                            <div class="mobile-status-icon-small">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="mobile-status-info">
                                <p class="mobile-status-label">Status Pesanan</p>
                                <p class="mobile-status-value status-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </p>
                            </div>
                        </div>
                        <div class="mobile-status-item">
                            <div class="mobile-status-icon-small">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="mobile-status-info">
                                <p class="mobile-status-label">Status Pembayaran</p>
                                <p class="mobile-status-value payment-{{ $booking->status_pembayaran }}">
                                    {{ ucfirst($booking->status_pembayaran) }}
                                </p>
                            </div>
                        </div>
                        <div class="mobile-status-item">
                            <div class="mobile-status-icon-small">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="mobile-status-info">
                                <p class="mobile-status-label">Mobil</p>
                                <p class="mobile-status-value">{{ $booking->car->merk }} {{ $booking->car->model }}</p>
                            </div>
                        </div>
                        <div class="mobile-status-item">
                            <div class="mobile-status-icon-small">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="mobile-status-info">
                                <p class="mobile-status-label">Total</p>
                                <p class="mobile-status-value">Rp
                                    {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="detail-grid">
            <!-- Right Column: Car & Renter Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <h3 class="detail-card-title">
                        <i class="fas fa-car me-2"></i>Informasi Mobil
                    </h3>
                </div>
                <div class="detail-card-body">
                    <div class="car-display">
                        <div class="car-image-wrapper">
                            @if ($booking->car && $booking->car->gambar)
                                <img src="{{ asset($booking->car->gambar) }}"
                                    alt="{{ $booking->car->merk }} {{ $booking->car->model }}"
                                    class="car-image-responsive" onerror="this.src='{{ asset('img/default-car.jpg') }}'">
                            @else
                                <img src="{{ asset('img/default-car.jpg') }}" alt="Mobil"
                                    class="car-image-responsive">
                            @endif
                        </div>
                        <div class="car-details">
                            <h4 class="car-name">{{ $booking->car->merk }} {{ $booking->car->model }}</h4>
                            <div class="car-specs">
                                <span class="car-spec">
                                    <i class="fas fa-id-card"></i>
                                    {{ $booking->car->no_polisi }}
                                </span>
                                <span class="car-spec">
                                    <i class="fas fa-cog"></i>
                                    {{ $booking->car->transmisi == 'manual' ? 'Manual' : 'Automatic' }}
                                </span>
                                <span class="car-spec">
                                    <i class="fas fa-gas-pump"></i>
                                    {{ $booking->car->tahun }}
                                </span>
                                <span class="car-spec">
                                    <i class="fas fa-users"></i>
                                    {{ $booking->car->warna }}
                                </span>
                            </div>
                            <div class="car-price">
                                <span class="price-label">Harga per hari:</span>
                                <span class="price-value">Rp
                                    {{ number_format($booking->car->biaya_harian, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-card-header mt-4">
                    <h3 class="detail-card-title">
                        <i class="fas fa-user me-2"></i>Informasi Penyewa
                    </h3>
                </div>
                <div class="detail-card-body">
                    <div class="renter-info">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Nama Lengkap</p>
                                <p class="info-value">{{ $booking->nama_penyewa }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Nomor Telepon</p>
                                <p class="info-value">{{ $booking->no_telp }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Email</p>
                                <p class="info-value">{{ $booking->user->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Alamat</p>
                                <p class="info-value">{{ $booking->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Left Column: Rental Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <h3 class="detail-card-title">
                        <i class="fas fa-calendar-alt me-2"></i>Detail Sewa
                    </h3>
                </div>
                <div class="detail-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Tanggal Mulai</p>
                                <p class="info-value">{{ \Carbon\Carbon::parse($booking->mulai_tgl)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Tanggal Selesai</p>
                                <p class="info-value">{{ \Carbon\Carbon::parse($booking->sel_tgl)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Durasi Sewa</p>
                                <p class="info-value">{{ $booking->lama_hari }} hari</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Tujuan</p>
                                <p class="info-value">{{ $booking->tujuan ?? 'Belum ditentukan' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Harga Mobil per Hari</p>
                                <p class="info-value">Rp {{ number_format($booking->car->biaya_harian, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Total Biaya</p>
                                <p class="info-value">Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="detail-card payment-info-section">
            <div class="detail-card-header">
                <h3 class="detail-card-title">
                    <i class="fas fa-wallet me-2"></i>Informasi Pembayaran
                </h3>
            </div>
            <div class="detail-card-body">
                @php
                    // Debug: Tampilkan semua informasi pembayaran
                    $allPayments = $booking->pembayaran;

                    // Cari pembayaran DP yang sukses
                    $dpPayment = $allPayments->where('jenis_pembayaran', 'dp')->first();
                    $dpPaid = $dpPayment && in_array($dpPayment->status_pembayaran, ['sukses', 'settlement']);

                    // Cari pembayaran pelunasan yang pending
                    $pelunasanPending = $allPayments
                        ->where('jenis_pembayaran', 'pelunasan')
                        ->whereIn('status_pembayaran', ['menunggu', 'pending', 'menunggu_verifikasi'])
                        ->sortByDesc('created_at')
                        ->first();

                    // Cari pembayaran pelunasan offline yang pending
                    $pelunasanOfflinePending = $allPayments
                        ->where('jenis_pembayaran', 'pelunasan')
                        ->where('metode_pembayaran', 'cash')
                        ->whereIn('status_pembayaran', ['menunggu_verifikasi', 'pending'])
                        ->first();

                    // Total sudah dibayar dan sisa
                    $totalDibayar = $booking->totalDibayar();
                    $sisaBayar = $booking->sisaBayar();
                    $requiresDp = $booking->requiresDp();

                    // Tentukan apakah menampilkan countdown
                    $deadlineLabel = null;
                    $deadlineAt = null;
                    $showCountdown = false;

                    // Logika utama untuk countdown
                    // CASE 1: Belum ada pembayaran sama sekali - deadline DP/Full
                    if ($totalDibayar == 0 && $booking->expired_at) {
                        $deadlineLabel = $requiresDp ? 'Batas Pembayaran DP' : 'Batas Pembayaran Penuh';
                        $deadlineAt = $booking->expired_at;
                        $showCountdown = true;
                    }
                    // CASE 2: Sudah bayar DP, belum bayar pelunasan - deadline pelunasan
                    elseif ($dpPaid && $sisaBayar > 0) {
                        // Priority 1: Cari pelunasan pending yang dibuat otomatis
                        if ($pelunasanPending && $pelunasanPending->tanggal_jatuh_tempo) {
                            $deadlineLabel = 'Batas Pelunasan';
                            $deadlineAt = $pelunasanPending->tanggal_jatuh_tempo;
                            $showCountdown = true;
                        }
                        // Priority 2: Cek pelunasan offline pending
                        elseif ($pelunasanOfflinePending && $pelunasanOfflinePending->tanggal_jatuh_tempo) {
                            $deadlineLabel = 'Batas Pelunasan (Offline)';
                            $deadlineAt = $pelunasanOfflinePending->tanggal_jatuh_tempo;
                            $showCountdown = true;
                        }
                        // Priority 3: Fallback - gunakan expired_at booking + 2 hari
                        elseif ($booking->expired_at) {
                            $deadlineLabel = 'Batas Pelunasan';
                            $deadlineAt = \Carbon\Carbon::parse($booking->expired_at)->addDays(2);
                            $showCountdown = true;
                        }
                    }
                    // CASE 3: Bayar penuh pending - deadline pembayaran penuh
                    else {
                        $fullPending = $allPayments
                            ->where('jenis_pembayaran', 'bayar_penuh')
                            ->whereIn('status_pembayaran', ['menunggu', 'pending'])
                            ->first();

                        if ($fullPending && $fullPending->tanggal_jatuh_tempo) {
                            $deadlineLabel = 'Batas Pembayaran Penuh';
                            $deadlineAt = $fullPending->tanggal_jatuh_tempo;
                            $showCountdown = true;
                        }
                    }

                    // Final debug info untuk JavaScript
                    $debugInfo = json_encode([
                        'show_countdown' => $showCountdown,
                        'deadline_label' => $deadlineLabel,
                        'deadline_at' => $deadlineAt,
                        'dp_paid' => $dpPaid,
                        'sisa_bayar' => $sisaBayar,
                        'requires_dp' => $requiresDp,
                        'total_dibayar' => $totalDibayar,
                        'pelunasan_pending' => $pelunasanPending ? true : false,
                        'pelunasan_id' => $pelunasanPending ? $pelunasanPending->id : null,
                        'pelunasan_deadline' => $pelunasanPending ? $pelunasanPending->tanggal_jatuh_tempo : null,
                    ]);

                @endphp

                @if ($showCountdown && $deadlineAt)
                    <div class="countdown-alert">
                        <div class="countdown-header">
                            <i class="fas fa-clock me-2"></i>
                            <span class="countdown-title">{{ $deadlineLabel }}</span>
                        </div>
                        <div class="countdown-content">
                            <div class="countdown-timer-wrapper">
                                <div class="countdown-timer" id="countdown">
                                    <div class="countdown-part">
                                        <span class="countdown-value" id="days">0</span>
                                        <span class="countdown-label">hari</span>
                                    </div>
                                    <div class="countdown-separator">:</div>
                                    <div class="countdown-part">
                                        <span class="countdown-value" id="hours">00</span>
                                        <span class="countdown-label">jam</span>
                                    </div>
                                    <div class="countdown-separator">:</div>
                                    <div class="countdown-part">
                                        <span class="countdown-value" id="minutes">00</span>
                                        <span class="countdown-label">menit</span>
                                    </div>
                                    <div class="countdown-separator">:</div>
                                    <div class="countdown-part">
                                        <span class="countdown-value" id="seconds">00</span>
                                        <span class="countdown-label">detik</span>
                                    </div>
                                </div>
                                <div class="countdown-date">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($deadlineAt)->format('d M Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Debug Section - Hanya tampil jika countdown tidak muncul -->
                {{-- @if (!$showCountdown)
                    <div>

                        <div style="font-size: 12px; font-family: monospace;">
                            <strong>Booking ID:</strong> {{ $booking->id }}<br>
                            <strong>Status Pembayaran:</strong> {{ $booking->status_pembayaran }}<br>
                            <strong>Total Dibayar:</strong> Rp {{ number_format($totalDibayar, 0, ',', '.') }}<br>
                            <strong>Sisa Bayar:</strong> Rp {{ number_format($sisaBayar, 0, ',', '.') }}<br>
                            <strong>DP Paid:</strong> {{ $dpPaid ? 'YA' : 'TIDAK' }}<br>
                            <strong>Requires DP:</strong> {{ $requiresDp ? 'YA' : 'TIDAK' }}<br>
                            <strong>Pelunasan Pending:</strong>
                            {{ $pelunasanPending ? 'YA (ID: ' . $pelunasanPending->id . ')' : 'TIDAK' }}<br>
                            <strong>Show Countdown:</strong> {{ $showCountdown ? 'YA' : 'TIDAK' }}<br>
                            <strong>Deadline Label:</strong> {{ $deadlineLabel ?? 'NULL' }}<br>
                            <strong>Deadline At:</strong> {{ $deadlineAt ?? 'NULL' }}<br>
                            <strong>Booking Expired At:</strong> {{ $booking->expired_at ?? 'NULL' }}
                        </div>
                    </div>
                @endif --}}

                <div class="payment-summary">
                    <div class="payment-item">
                        <span class="payment-label">Total Pembayaran</span>
                        <span class="payment-value total">Rp
                            {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Sudah Dibayar</span>
                        <span class="payment-value paid">Rp
                            {{ number_format($totalDibayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Sisa Pembayaran</span>
                        <span class="payment-value remaining">Rp
                            {{ number_format($sisaBayar, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Action Buttons -->
                @if ($booking->status !== 'expired' && $booking->status_pembayaran !== 'lunas')
                    <div class="payment-actions" id="aksi-pembayaran-wrapper">
                        @if ($requiresDp)
                            @if ($totalDibayar == 0)
                                <button id="pay-dp" class="btn-payment dp">
                                    <i class="fas fa-money-bill-wave me-2"></i>Bayar DP (30%)
                                </button>
                                <button id="pay-full" class="btn-payment full">
                                    <i class="fas fa-check-circle me-2"></i>Bayar Penuh
                                </button>
                            @elseif($sisaBayar > 0)
                                <!-- Tombol untuk bayar pelunasan -->
                                @if (!$pelunasanPending || !in_array($pelunasanPending->status_pembayaran, ['sukses', 'settlement']))
                                    <button id="pay-pelunasan" class="btn-payment pelunasan">
                                        <i class="fas fa-credit-card me-2"></i>Bayar Sisa (Online)
                                    </button>
                                @endif

                                @if (method_exists($booking, 'canPelunasanOffline') && $booking->canPelunasanOffline())
                                    <button id="pay-pelunasan-offline" class="btn-payment offline">
                                        <i class="fas fa-hand-holding-usd me-2"></i>Bayar Sisa (Offline)
                                    </button>
                                    <div class="offline-note">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Pembayaran offline akan dikonfirmasi admin saat pengambilan mobil
                                    </div>
                                @elseif($dpPaid && $sisaBayar > 0)
                                    <div class="alert alert-danger mt-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Batas waktu pelunasan offline telah lewat. Hubungi admin jika ada kendala.
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($totalDibayar == 0)
                                <button id="pay-full" class="btn-payment full">
                                    <i class="fas fa-check-circle me-2"></i>Bayar Penuh
                                </button>
                            @endif
                        @endif
                    </div>
                @elseif($booking->status === 'expired')
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Pembayaran gagal karena melewati batas waktu.
                    </div>
                @else
                    <div class="payment-complete">
                        <i class="fas fa-check-circle"></i>
                        <span>Pembayaran sudah lunas</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Payment History -->
        <div class="detail-card">
            <div class="detail-card-header">
                <h3 class="detail-card-title">
                    <i class="fas fa-history me-2"></i>Riwayat Pembayaran
                </h3>
            </div>
            <div class="detail-card-body">
                @if ($booking->pembayaran->count() > 0)
                    <div class="payment-history">
                        @foreach ($booking->pembayaran as $p)
                            <div class="payment-history-item">
                                <div class="payment-history-icon">
                                    @if ($p->status_pembayaran == 'sukses')
                                        <i class="fas fa-check-circle success"></i>
                                    @elseif(in_array($p->status_pembayaran, ['menunggu', 'pending']))
                                        <i class="fas fa-clock warning"></i>
                                    @elseif($p->status_pembayaran == 'menunggu_verifikasi')
                                        <i class="fas fa-hourglass-half info"></i>
                                    @else
                                        <i class="fas fa-times-circle danger"></i>
                                    @endif
                                </div>
                                <div class="payment-history-content">
                                    <div class="payment-history-header">
                                        <h5 class="payment-type">{{ ucfirst($p->jenis_pembayaran) }}</h5>
                                        <span class="payment-amount">Rp
                                            {{ number_format($p->jumlah, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="payment-history-details">
                                        <span class="payment-method">
                                            <i class="fas fa-credit-card me-1"></i>
                                            {{ ucfirst($p->metode_pembayaran) }}
                                        </span>
                                        <span class="payment-status status-{{ $p->status_pembayaran }}">
                                            {{ ucfirst($p->status_pembayaran) }}
                                        </span>
                                        <span class="payment-date">
                                            <i class="far fa-calendar me-1"></i>
                                            @if ($p->dibayar_pada)
                                                {{ \Carbon\Carbon::parse($p->dibayar_pada)->format('d M Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                        @if ($p->tanggal_jatuh_tempo)
                                            <span class="payment-deadline">
                                                <i class="far fa-clock me-1"></i>
                                                Jatuh tempo:
                                                {{ \Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->format('d M Y H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-history">
                        <i class="fas fa-receipt"></i>
                        <p>Belum ada riwayat pembayaran</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <style>
        :root {
            --primary: #A62F19;
            --primary-hover: #8c2915;
            --primary-light: rgba(166, 47, 25, 0.1);
            --secondary: #6c757d;
            --light: #f8f9fa;
            --lighter: #f9f9f9;
            --border: #eaeaea;
            --shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.12);
            --radius: 12px;
            --radius-sm: 8px;
            --success: #28a745;
            --success-light: rgba(40, 167, 69, 0.1);
            --warning: #ffc107;
            --warning-light: rgba(255, 193, 7, 0.1);
            --danger: #dc3545;
            --danger-light: rgba(220, 53, 69, 0.1);
            --info: #17a2b8;
            --info-light: rgba(23, 162, 184, 0.1);
        }

        /* Base */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .page-subtitle {
            font-size: 15px;
            color: var(--secondary);
            margin: 0;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .btn-back {
            padding: 10px 20px;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: #333;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: var(--light);
            border-color: #ddd;
        }

        .btn-print {
            padding: 10px 20px;
            background: var(--primary);
            border: 1px solid var(--primary);
            border-radius: var(--radius-sm);
            color: white;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-print:hover {
            background: var(--primary-hover);
        }

        /* Status Bar Wrapper */
        .status-bar-wrapper {
            margin-bottom: 32px;
        }

        /* Status Bar Desktop */
        .status-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .status-card {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s ease;
        }

        .status-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .status-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .status-icon.order {
            background: var(--primary-light);
            color: var(--primary);
        }

        .status-icon.payment {
            background: var(--success-light);
            color: var(--success);
        }

        .status-icon.car {
            background: var(--info-light);
            color: var(--info);
        }

        .status-icon.total {
            background: var(--warning-light);
            color: var(--warning);
        }

        .status-info {
            flex: 1;
        }

        .status-label {
            font-size: 13px;
            color: var(--secondary);
            margin-bottom: 4px;
        }

        .status-value {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .status-pending {
            color: var(--warning);
        }

        .status-approved {
            color: var(--success);
        }

        .status-active {
            color: var(--info);
        }

        .status-cancelled {
            color: var(--danger);
        }

        .payment-lunas {
            color: var(--success);
        }

        .payment-menunggu {
            color: var(--warning);
        }

        .payment-dp_dibayar {
            color: var(--info);
        }

        /* Mobile Status Bar */
        .mobile-status-bar {
            display: none;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .mobile-status-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: var(--lighter);
            border-bottom: 1px solid var(--border);
            cursor: pointer;
        }

        .mobile-status-header h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-status-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 16px;
        }

        .mobile-status-toggle {
            background: none;
            border: none;
            color: var(--secondary);
            font-size: 14px;
            cursor: pointer;
            padding: 4px;
            transition: transform 0.3s ease;
        }

        .mobile-status-toggle.active {
            transform: rotate(180deg);
        }

        .mobile-status-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-status-content.active {
            max-height: 500px;
        }

        .mobile-status-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 16px;
        }

        .mobile-status-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: var(--lighter);
            border-radius: var(--radius-sm);
        }

        .mobile-status-icon-small {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .mobile-status-item:nth-child(1) .mobile-status-icon-small {
            background: var(--primary-light);
            color: var(--primary);
        }

        .mobile-status-item:nth-child(2) .mobile-status-icon-small {
            background: var(--success-light);
            color: var(--success);
        }

        .mobile-status-item:nth-child(3) .mobile-status-icon-small {
            background: var(--info-light);
            color: var(--info);
        }

        .mobile-status-item:nth-child(4) .mobile-status-icon-small {
            background: var(--warning-light);
            color: var(--warning);
        }

        .mobile-status-info {
            flex: 1;
            min-width: 0;
        }

        .mobile-status-label {
            font-size: 11px;
            color: var(--secondary);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mobile-status-value {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a1a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Detail Card */
        .detail-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .detail-card-header {
            padding: 20px;
            background: var(--lighter);
            border-bottom: 1px solid var(--border);
        }

        .detail-card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .detail-card-body {
            padding: 24px;
        }

        /* Info Grid */
        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 14px;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 13px;
            color: var(--secondary);
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        /* Car Display */
        .car-display {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .car-image-wrapper {
            flex-shrink: 0;
            width: 140px;
            height: 100px;
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .car-image-responsive {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .car-image-responsive:hover {
            transform: scale(1.05);
        }

        .car-details {
            flex: 1;
        }

        .car-name {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .car-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 12px;
        }

        .car-spec {
            font-size: 13px;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 4px;
            background: var(--light);
            padding: 4px 10px;
            border-radius: 20px;
        }

        .car-price {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: var(--success-light);
            border-radius: var(--radius-sm);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .price-label {
            font-size: 13px;
            color: var(--success);
            font-weight: 500;
        }

        .price-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--success);
        }

        /* Renter Info */
        .renter-info {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Payment Info Section */
        .payment-info-section {
            margin-bottom: 24px;
        }

        .countdown-alert {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
            border: 1px solid #ffeaa7;
            border-radius: var(--radius-sm);
            padding: 20px;
            margin-bottom: 24px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 193, 7, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
            }
        }

        .countdown-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .countdown-title {
            font-size: 16px;
            font-weight: 600;
            color: #856404;
        }

        .countdown-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        /* Countdown Timer Styling */
        .countdown-timer-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .countdown-timer {
            display: flex;
            align-items: center;
            gap: 4px;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
        }

        .countdown-part {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 50px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 4px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .countdown-part:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .countdown-value {
            font-size: 20px;
            font-weight: 800;
            color: #dc3545;
            line-height: 1;
        }

        .countdown-label {
            font-size: 11px;
            color: #856404;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        .countdown-separator {
            font-size: 18px;
            font-weight: 700;
            color: #856404;
            padding: 0 2px;
        }

        .countdown-date {
            font-size: 14px;
            color: #856404;
            display: flex;
            align-items: center;
        }

        /* Debug Info */
        .debug-info {
            background: #e3f2fd;
            border: 1px solid #90caf9;
            border-radius: var(--radius-sm);
            padding: 15px;
            margin-bottom: 20px;
        }

        .debug-info h6 {
            color: #1565c0;
            margin-top: 0;
        }

        /* Payment Summary */
        .payment-summary {
            background: var(--lighter);
            border-radius: var(--radius-sm);
            padding: 20px;
            margin-bottom: 24px;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .payment-item:last-child {
            border-bottom: none;
        }

        .payment-label {
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .payment-value {
            font-size: 16px;
            font-weight: 700;
        }

        .payment-value.total {
            color: var(--primary);
        }

        .payment-value.paid {
            color: var(--success);
        }

        .payment-value.remaining {
            color: var(--warning);
        }

        /* Payment Actions */
        .payment-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-payment {
            padding: 14px 24px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            min-width: 180px;
        }

        .btn-payment.dp {
            background: var(--warning);
            color: #333;
        }

        .btn-payment.dp:hover {
            background: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }

        .btn-payment.full {
            background: var(--success);
            color: white;
        }

        .btn-payment.full:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .btn-payment.pelunasan {
            background: var(--primary);
            color: white;
        }

        .btn-payment.pelunasan:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(166, 47, 25, 0.3);
        }

        .btn-payment.offline {
            background: white;
            color: #333;
            border: 1px solid var(--border);
        }

        .btn-payment.offline:hover {
            background: var(--light);
            border-color: #ddd;
            transform: translateY(-2px);
        }

        .offline-note {
            width: 100%;
            padding: 12px;
            background: var(--info-light);
            border: 1px solid rgba(23, 162, 184, 0.2);
            border-radius: var(--radius-sm);
            font-size: 13px;
            color: var(--info);
            display: flex;
            align-items: center;
            margin-top: 8px;
        }

        /* Payment Complete */
        .payment-complete {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 32px;
            background: var(--success-light);
            border: 1px solid rgba(40, 167, 69, 0.2);
            border-radius: var(--radius);
            color: var(--success);
            font-size: 18px;
            font-weight: 600;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-complete i {
            font-size: 32px;
        }

        /* Payment History */
        .payment-history {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .payment-history-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px;
            background: var(--lighter);
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
        }

        .payment-history-item:hover {
            background: var(--light);
            transform: translateY(-1px);
        }

        .payment-history-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .payment-history-icon .success {
            color: var(--success);
        }

        .payment-history-icon .warning {
            color: var(--warning);
        }

        .payment-history-icon .info {
            color: var(--info);
        }

        .payment-history-icon .danger {
            color: var(--danger);
        }

        .payment-history-content {
            flex: 1;
        }

        .payment-history-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .payment-type {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        .payment-amount {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .payment-history-details {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .payment-method,
        .payment-status,
        .payment-date,
        .payment-deadline {
            font-size: 13px;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .payment-status.status-sukses {
            color: var(--success);
            font-weight: 600;
        }

        .payment-status.status-menunggu,
        .payment-status.status-pending {
            color: var(--warning);
            font-weight: 600;
        }

        .payment-status.status-menunggu_verifikasi {
            color: var(--info);
            font-weight: 600;
        }

        .payment-deadline {
            color: #856404;
            background: #fff3cd;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #ffeaa7;
        }

        .empty-history {
            text-align: center;
            padding: 40px 20px;
            color: var(--secondary);
        }

        .empty-history i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        .empty-history p {
            font-size: 16px;
            margin: 0;
        }

        /* Alert */
        .alert {
            padding: 16px;
            border-radius: var(--radius-sm);
            margin-top: 16px;
            display: flex;
            align-items: center;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-danger {
            background: var(--danger-light);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        .alert-info {
            background: var(--info-light);
            border: 1px solid rgba(23, 162, 184, 0.2);
            color: var(--info);
        }

        /* Responsive */
        @media (max-width: 768px) {

            /* Hide desktop status bar, show mobile version */
            .status-bar {
                display: none;
            }

            .mobile-status-bar {
                display: block;
            }

            /* Mobile status grid adjustment */
            .mobile-status-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .mobile-status-item {
                padding: 10px;
            }

            /* Car display mobile optimization */
            .car-display {
                flex-direction: column;
                text-align: center;
            }

            .car-image-wrapper {
                width: 100%;
                height: 180px;
                margin-bottom: 16px;
            }

            .car-image-responsive {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .car-specs {
                justify-content: center;
            }

            /* Responsive countdown */
            .countdown-timer {
                gap: 2px;
            }

            .countdown-part {
                min-width: 45px;
                padding: 6px 3px;
            }

            .countdown-value {
                font-size: 18px;
            }

            .countdown-label {
                font-size: 10px;
            }

            .countdown-separator {
                font-size: 16px;
            }

            /* Page header mobile */
            .page-title {
                font-size: 24px;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-back,
            .btn-print {
                width: 100%;
                justify-content: center;
            }

            /* Payment actions mobile */
            .payment-actions {
                flex-direction: column;
            }

            .btn-payment {
                width: 100%;
                justify-content: center;
                min-width: unset;
            }

            /* Container and card adjustments */
            .container {
                padding: 0 12px;
            }

            .detail-card-body {
                padding: 16px;
            }

            .info-item {
                flex-wrap: wrap;
            }

            /* Payment history mobile */
            .payment-history-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .payment-history-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }

        @media (max-width: 576px) {
            .countdown-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .countdown-part {
                min-width: 40px;
                padding: 5px 2px;
            }

            .countdown-value {
                font-size: 16px;
            }

            .countdown-label {
                font-size: 9px;
            }

            /* Car image mobile optimization */
            .car-image-wrapper {
                height: 160px;
            }
        }

        @media (max-width: 375px) {
            .countdown-part {
                min-width: 35px;
                padding: 4px 1px;
            }

            .countdown-value {
                font-size: 14px;
            }

            .countdown-label {
                font-size: 8px;
            }

            /* Car image mobile optimization */
            .car-image-wrapper {
                height: 140px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingId = {{ $booking->id }};
            const csrf = '{{ csrf_token() }}';
            const debugInfo = {!! $debugInfo !!};

            console.log('=== DETAIL PESANAN LOADED ===');
            console.log('Booking ID:', bookingId);
            console.log('Debug Info:', debugInfo);

            // Mobile status toggle
            const mobileStatusToggle = document.getElementById('mobileStatusToggle');
            const mobileStatusContent = document.getElementById('mobileStatusContent');

            if (mobileStatusToggle && mobileStatusContent) {
                mobileStatusToggle.addEventListener('click', function() {
                    mobileStatusContent.classList.toggle('active');
                    mobileStatusToggle.classList.toggle('active');
                });

                // Auto open on mobile
                if (window.innerWidth <= 768) {
                    mobileStatusContent.classList.add('active');
                    mobileStatusToggle.classList.add('active');
                }
            }

            // Initialize Countdown Timer
            function initializeCountdown() {
                const showCountdown = debugInfo.show_countdown;
                const deadlineAt = debugInfo.deadline_at;

                console.log('Initializing Countdown:', {
                    showCountdown,
                    deadlineAt
                });

                if (showCountdown && deadlineAt) {
                    console.log('=== COUNTDOWN TIMER ACTIVE ===');

                    const countdownEl = document.getElementById("countdown");
                    if (countdownEl) {
                        const endTime = new Date(deadlineAt).getTime();

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const diff = endTime - now;

                            if (diff <= 0) {
                                console.log('=== COUNTDOWN EXPIRED ===');
                                // Format expired
                                document.getElementById("days").textContent = "0";
                                document.getElementById("hours").textContent = "00";
                                document.getElementById("minutes").textContent = "00";
                                document.getElementById("seconds").textContent = "00";

                                // Show alert and reload
                                Swal.fire({
                                    title: 'Waktu Habis!',
                                    text: 'Waktu pembayaran telah habis. Status akan diperbarui.',
                                    icon: 'warning',
                                    confirmButtonColor: '#A62F19',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                                return;
                            }

                            // Calculate days, hours, minutes, seconds
                            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                            // Update display
                            document.getElementById("days").textContent = days.toString();
                            document.getElementById("hours").textContent = hours.toString().padStart(2, '0');
                            document.getElementById("minutes").textContent = minutes.toString().padStart(2, '0');
                            document.getElementById("seconds").textContent = seconds.toString().padStart(2, '0');

                            // Visual warning for low time
                            const countdownParts = document.querySelectorAll('.countdown-part');

                            // Reset colors
                            countdownParts.forEach(part => {
                                part.style.background = 'rgba(255, 255, 255, 0.9)';
                                part.style.border = 'none';
                            });

                            // Warning jika sisa waktu kurang dari 1 jam
                            if (diff < 3600000) {
                                console.log('WARNING: Less than 1 hour remaining');
                                countdownParts.forEach(part => {
                                    part.style.background = 'rgba(255, 193, 7, 0.2)';
                                    part.style.border = '1px solid #ffc107';
                                });
                            }

                            // Danger jika sisa waktu kurang dari 10 menit
                            if (diff < 600000) {
                                console.log('DANGER: Less than 10 minutes remaining');
                                countdownParts.forEach(part => {
                                    part.style.background = 'rgba(220, 53, 69, 0.2)';
                                    part.style.border = '1px solid #dc3545';
                                });
                            }
                        }

                        // Initial update
                        updateCountdown();

                        // Update every second
                        const interval = setInterval(updateCountdown, 1000);

                        // Store interval for cleanup
                        window.countdownInterval = interval;

                        console.log('Countdown timer started successfully');
                    } else {
                        console.error('ERROR: Countdown element not found in DOM');
                    }
                } else {
                    console.log('Countdown not initialized. Reason:', {
                        showCountdown: showCountdown,
                        deadlineAt: !!deadlineAt,
                        message: !showCountdown ? 'showCountdown is false' : 'deadlineAt is empty'
                    });
                }
            }

            // Initialize countdown on load
            initializeCountdown();

            // Payment Functions
            function createSnap(jenis) {
                togglePayButtons(true);

                fetch("{{ route('pembayaran.create_snap') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            booking_id: bookingId,
                            jenis_pembayaran: jenis
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        togglePayButtons(false);

                        if (res.snap_token) {
                            snap.pay(res.snap_token, {
                                onSuccess: function(result) {
                                    console.log('Payment Success:', result);
                                    // Simpan data pembayaran
                                    localStorage.setItem('last_payment_type', jenis);
                                    localStorage.setItem('last_payment_time', new Date().getTime());
                                    localStorage.setItem('booking_id', bookingId);

                                    // Tampilkan konfirmasi
                                    Swal.fire({
                                        title: 'Pembayaran Berhasil!',
                                        html: 'Transaksi Anda berhasil diproses.<br></strong>',
                                        icon: 'success',
                                        confirmButtonColor: '#A62F19',
                                        confirmButtonText: 'Refresh Halaman'
                                    }).then(() => {
                                        // Force refresh
                                        window.location.reload();
                                    });
                                },
                                onPending: function(result) {
                                    console.log('Payment Pending:', result);
                                    Swal.fire({
                                        title: 'Menunggu Pembayaran',
                                        text: 'Silakan selesaikan pembayaran Anda. Kami akan memeriksa status secara otomatis.',
                                        icon: 'info',
                                        confirmButtonColor: '#A62F19',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Start checking payment status
                                        checkPaymentStatus();
                                    });
                                },
                                onError: function(result) {
                                    console.error('Payment Error:', result);
                                    Swal.fire('Error', 'Transaksi gagal: ' + (result
                                        .status_message || 'Unknown error'), 'error');
                                },
                                onClose: function() {
                                    console.log('Payment popup closed');
                                }
                            });
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal mendapatkan snap token', 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Fetch Error:', err);
                        togglePayButtons(false);
                        Swal.fire('Error', 'Request pembayaran gagal: ' + err.message, 'error');
                    });
            }

            // Fungsi untuk cek status pembayaran
            function checkPaymentStatus() {
                console.log('Checking payment status for booking:', bookingId);

                fetch(`/pembayaran/check-status/${bookingId}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log('Payment Status Response:', data);

                        if (data.status === 'sukses' || data.status === 'settlement') {
                            // Pembayaran berhasil
                            Swal.fire({
                                title: 'Pembayaran Dikonfirmasi!',
                                html: 'Pembayaran Anda telah dikonfirmasi.<br></strong>',
                                icon: 'success',
                                confirmButtonColor: '#A62F19',
                                confirmButtonText: 'Refresh Sekarang'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else if (data.status === 'menunggu' || data.status === 'pending') {
                            // Masih pending, cek lagi setelah 5 detik
                            setTimeout(checkPaymentStatus, 5000);
                        } else if (data.status === 'gagal' || data.status === 'expire') {
                            Swal.fire('Pembayaran Gagal', 'Status pembayaran: ' + data.status, 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Error checking payment status:', err);
                        // Retry after 10 seconds on error
                        setTimeout(checkPaymentStatus, 10000);
                    });
            }

            function togglePayButtons(dis) {
                ['pay-dp', 'pay-pelunasan', 'pay-full', 'pay-pelunasan-offline'].forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.disabled = dis;
                    el.innerHTML = dis ?
                        '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...' :
                        el.getAttribute('data-original-text') || el.innerHTML;

                    // Save original text
                    if (!el.getAttribute('data-original-text')) {
                        el.setAttribute('data-original-text', el.innerHTML);
                    }
                });
            }

            // Event listeners for payment buttons
            const btnDp = document.getElementById('pay-dp');
            if (btnDp) {
                btnDp.addEventListener('click', () => {
                    console.log('DP Payment clicked');
                    createSnap('dp');
                });
            }

            const btnPel = document.getElementById('pay-pelunasan');
            if (btnPel) {
                btnPel.addEventListener('click', () => {
                    console.log('Pelunasan Payment clicked');
                    createSnap('pelunasan');
                });
            }

            const btnFull = document.getElementById('pay-full');
            if (btnFull) {
                btnFull.addEventListener('click', () => {
                    console.log('Full Payment clicked');
                    createSnap('bayar_penuh');
                });
            }

            // Offline payment
            const btnPelOff = document.getElementById('pay-pelunasan-offline');
            if (btnPelOff) {
                btnPelOff.addEventListener('click', () => {
                    Swal.fire({
                        title: 'Ajukan Pembayaran Offline',
                        html: 'Kamu akan mendaftarkan permintaan pelunasan secara offline. Admin akan mengonfirmasi setelah pembayaran di tempat.<br><br><strong>Countdown pelunasan akan aktif setelah permintaan dikirim.</strong><br><br>Lanjutkan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, daftar',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#A62F19'
                    }).then(result => {
                        if (!result.isConfirmed) return;

                        btnPelOff.disabled = true;
                        btnPelOff.innerHTML =
                            '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';

                        fetch("{{ route('pembayaran.offline') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    booking_id: bookingId,
                                    jenis: 'pelunasan_offline'
                                })
                            })
                            .then(r => r.json())
                            .then(res => {
                                console.log('Offline payment response:', res);

                                if (res.success) {
                                    Swal.fire('Terdaftar!',
                                        'Permintaan bayar offline berhasil dikirim. ',
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal', res.message ||
                                        'Gagal mendaftar bayar offline.', 'error');
                                    btnPelOff.disabled = false;
                                    btnPelOff.innerHTML = btnPelOff.getAttribute(
                                        'data-original-text') || 'Bayar Sisa (Offline)';
                                }
                            })
                            .catch(err => {
                                console.error('Offline payment error:', err);
                                btnPelOff.disabled = false;
                                btnPelOff.innerHTML = btnPelOff.getAttribute(
                                    'data-original-text') || 'Bayar Sisa (Offline)';
                                Swal.fire('Error', 'Request gagal: ' + err.message, 'error');
                            });
                    });
                });
            }

            // Check for recent payment from localStorage
            const lastPaymentType = localStorage.getItem('last_payment_type');
            const lastPaymentTime = localStorage.getItem('last_payment_time');
            const lastBookingId = localStorage.getItem('booking_id');

            if (lastPaymentType && lastPaymentTime && lastBookingId == bookingId) {
                const timeDiff = new Date().getTime() - parseInt(lastPaymentTime);

                // Jika pembayaran terjadi dalam 5 menit terakhir
                if (timeDiff < 300000) {
                    console.log('Recent payment detected:', {
                        type: lastPaymentType,
                        timeDiff: timeDiff,
                        bookingId: lastBookingId
                    });

                    // Tampilkan loading dan auto-refresh
                    Swal.fire({
                        title: 'Memuat Data Terbaru',
                       
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Refresh setelah 3 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                }

                // Clear localStorage setelah digunakan
                localStorage.removeItem('last_payment_type');
                localStorage.removeItem('last_payment_time');
                localStorage.removeItem('booking_id');
            }

            // Auto refresh jika ada countdown aktif
            if (debugInfo.show_countdown && debugInfo.deadline_at) {
                // Refresh setiap 1 menit untuk update countdown
                setInterval(() => {
                    if (!document.hidden) {
                        console.log('Auto-refresh for countdown update');
                        window.location.reload();
                    }
                }, 60000); // 1 menit
            }

            // Window resize handler untuk mobile status
            window.addEventListener('resize', function() {
                if (mobileStatusContent && mobileStatusToggle) {
                    if (window.innerWidth <= 768) {
                        mobileStatusContent.classList.add('active');
                        mobileStatusToggle.classList.add('active');
                    } else {
                        mobileStatusContent.classList.remove('active');
                        mobileStatusToggle.classList.remove('active');
                    }
                }
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', function() {
                if (window.countdownInterval) {
                    clearInterval(window.countdownInterval);
                }
            });
        });
    </script>
@endsection
