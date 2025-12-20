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
                <div class="action-buttons">
                    <a href="{{ route('pesanan.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ url('/nota/' . $booking->id) }}" class="btn-print" target="_blank">
                        <i class="fas fa-print me-2"></i>Cetak Nota
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Bar -->
        <div class="status-bar mb-4">
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

        <!-- Main Content Grid -->
        <div class="detail-grid">
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
                                <p class="info-label">Lokasi Pengambilan</p>
                                <p class="info-value">{{ $booking->lokasi_ambil ?? 'Belum ditentukan' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Waktu Pengambilan</p>
                                <p class="info-value">{{ $booking->waktu_ambil ?? 'Belum ditentukan' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Catatan</p>
                                <p class="info-value">{{ $booking->catatan ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Car & Renter Information -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <h3 class="detail-card-title">
                        <i class="fas fa-car me-2"></i>Informasi Mobil
                    </h3>
                </div>
                <div class="detail-card-body">
                    <div class="car-display">
                        <div class="car-image">
                            @if ($booking->car && $booking->car->gambar)
                                <img src="{{ asset($booking->car->gambar) }}"
                                    alt="{{ $booking->car->merk }} {{ $booking->car->model }}"
                                    onerror="this.src='{{ asset('img/default-car.jpg') }}'">
                            @else
                                <img src="{{ asset('img/default-car.jpg') }}" alt="Mobil">
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
                                    {{ $booking->car->bbm }}
                                </span>
                                <span class="car-spec">
                                    <i class="fas fa-users"></i>
                                    {{ $booking->car->kapasitas }} orang
                                </span>
                            </div>
                            <div class="car-price">
                                <span class="price-label">Harga per hari:</span>
                                <span class="price-value">Rp
                                    {{ number_format($booking->car->harga_per_hari, 0, ',', '.') }}</span>
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
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="info-content">
                                <p class="info-label">Nomor SIM</p>
                                <p class="info-value">{{ $booking->no_sim ?? 'Belum diisi' }}</p>
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
                    $deadlineLabel = null;
                    $deadlineAt = null;

                    if (
                        $booking->totalDibayar() == 0 &&
                        $booking->status !== 'expired' &&
                        !is_null($booking->expired_at)
                    ) {
                        $deadlineLabel = $booking->requiresDp() ? 'Batas Pembayaran DP' : 'Batas Pembayaran Penuh';
                        $deadlineAt = $booking->expired_at;
                    } else {
                        $pendingPel = $booking->pembayaran
                            ->where('jenis_pembayaran', 'pelunasan')
                            ->whereNotIn('status_pembayaran', ['sukses', 'gagal', 'kadaluarsa'])
                            ->sortByDesc('id')
                            ->first();
                        if ($pendingPel && $pendingPel->tanggal_jatuh_tempo) {
                            $deadlineLabel = 'Batas Pelunasan';
                            $deadlineAt = $pendingPel->tanggal_jatuh_tempo;
                        }
                    }
                @endphp

                @if ($deadlineAt)
                    <div class="countdown-alert">
                        <div class="countdown-header">
                            <i class="fas fa-clock me-2"></i>
                            <span class="countdown-title">{{ $deadlineLabel }}</span>
                        </div>
                        <div class="countdown-content">
                            <div class="countdown-timer" id="countdown"></div>
                            <div class="countdown-date">
                                <i class="far fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($deadlineAt)->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="payment-summary">
                    <div class="payment-item">
                        <span class="payment-label">Total Pembayaran</span>
                        <span class="payment-value total">Rp
                            {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Sudah Dibayar</span>
                        <span class="payment-value paid">Rp
                            {{ number_format($booking->totalDibayar(), 0, ',', '.') }}</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Sisa Pembayaran</span>
                        <span class="payment-value remaining">Rp
                            {{ number_format($booking->sisaBayar(), 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Progress -->
                <div class="payment-progress">
                    <div class="progress-header">
                        <span>Progress Pembayaran</span>
                        {{-- <span>{{ $booking->persentasePembayaran() ?? 0 }}%</span> --}}
                    </div>
                    <div class="progress-bar">
                        {{-- <div class="progress-fill" style="width: {{ $booking->persentasePembayaran() ?? 0 }}%"></div> --}}
                    </div>
                </div>

                <!-- Payment Action Buttons -->
                @if ($booking->status !== 'expired' && $booking->status_pembayaran !== 'lunas')
                    <div class="payment-actions" id="aksi-pembayaran-wrapper">
                        @if ($booking->requiresDp())
                            @if ($booking->totalDibayar() == 0)
                                <button id="pay-dp" class="btn-payment dp">
                                    <i class="fas fa-money-bill-wave me-2"></i>Bayar DP (30%)
                                </button>
                                <button id="pay-full" class="btn-payment full">
                                    <i class="fas fa-check-circle me-2"></i>Bayar Penuh
                                </button>
                            @elseif($booking->sisaBayar() > 0)
                                <button id="pay-pelunasan" class="btn-payment pelunasan">
                                    <i class="fas fa-credit-card me-2"></i>Bayar Sisa (Online)
                                </button>

                                @if (method_exists($booking, 'canPelunasanOffline') && $booking->canPelunasanOffline())
                                    <button id="pay-pelunasan-offline" class="btn-payment offline">
                                        <i class="fas fa-hand-holding-usd me-2"></i>Bayar Sisa (Offline)
                                    </button>
                                    <div class="offline-note">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Pembayaran offline akan dikonfirmasi admin saat pengambilan mobil
                                    </div>
                                @else
                                    <div class="alert alert-danger mt-3">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Batas waktu pelunasan offline telah lewat. Hubungi admin jika ada kendala.
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($booking->totalDibayar() == 0)
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
                                    @elseif($p->status_pembayaran == 'pending')
                                        <i class="fas fa-clock warning"></i>
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

        /* Status Bar */
        .status-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
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

        .car-image {
            width: 140px;
            height: 100px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            flex-shrink: 0;
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .countdown-timer {
            font-size: 24px;
            font-weight: 800;
            color: #dc3545;
            font-family: 'Courier New', monospace;
        }

        .countdown-date {
            font-size: 14px;
            color: #856404;
            display: flex;
            align-items: center;
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

        /* Payment Progress */
        .payment-progress {
            margin-bottom: 24px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .progress-header span {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .progress-header span:last-child {
            color: var(--primary);
        }

        .progress-bar {
            height: 8px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-hover));
            border-radius: 4px;
            transition: width 0.3s ease;
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
        }

        .btn-payment.full {
            background: var(--success);
            color: white;
        }

        .btn-payment.full:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-payment.pelunasan {
            background: var(--primary);
            color: white;
        }

        .btn-payment.pelunasan:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
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
        .payment-date {
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

        .payment-status.status-pending {
            color: var(--warning);
            font-weight: 600;
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
        }

        .alert-danger {
            background: var(--danger-light);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        /* Responsive */
        @media (max-width: 768px) {
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

            .status-bar {
                grid-template-columns: repeat(2, 1fr);
            }

            .car-display {
                flex-direction: column;
                text-align: center;
            }

            .car-image {
                width: 100%;
                height: 160px;
            }

            .car-specs {
                justify-content: center;
            }

            .payment-actions {
                flex-direction: column;
            }

            .btn-payment {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .status-bar {
                grid-template-columns: 1fr;
            }

            .countdown-content {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookingId = {{ $booking->id }};
            const csrf = '{{ csrf_token() }}';

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
                                onSuccess: () => location.reload(),
                                onPending: () => location.reload(),
                                onError: () => Swal.fire('Error', 'Transaksi gagal.', 'error')
                            });
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal mendapatkan snap token', 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        togglePayButtons(false);
                        Swal.fire('Error', 'Request pembayaran gagal.', 'error');
                    });
            }

            function togglePayButtons(dis) {
                ['pay-dp', 'pay-pelunasan', 'pay-full', 'pay-pelunasan-offline'].forEach(id => {
                    const el = document.getElementById(id);
                    if (!el) return;
                    el.disabled = dis;
                });
            }

            // Event listeners
            const btnDp = document.getElementById('pay-dp');
            if (btnDp) btnDp.addEventListener('click', () => createSnap('dp'));

            const btnPel = document.getElementById('pay-pelunasan');
            if (btnPel) btnPel.addEventListener('click', () => createSnap('pelunasan'));

            const btnFull = document.getElementById('pay-full');
            if (btnFull) btnFull.addEventListener('click', () => createSnap('bayar_penuh'));

            // Offline payment
            const btnPelOff = document.getElementById('pay-pelunasan-offline');
            if (btnPelOff) {
                btnPelOff.addEventListener('click', () => {
                    Swal.fire({
                        title: 'Ajukan Pembayaran Offline',
                        html: 'Kamu akan mendaftarkan permintaan pelunasan secara offline. Admin akan mengonfirmasi setelah pembayaran di tempat.<br><br>Lanjutkan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, daftar',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#A62F19'
                    }).then(result => {
                        if (!result.isConfirmed) return;

                        btnPelOff.disabled = true;

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
                                btnPelOff.disabled = false;
                                if (res.success) {
                                    Swal.fire('Terdaftar', res.message ||
                                            'Permintaan bayar offline berhasil dikirim.',
                                            'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Gagal', res.message ||
                                        'Gagal mendaftar bayar offline.', 'error');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                btnPelOff.disabled = false;
                                Swal.fire('Error', 'Request gagal.', 'error');
                            });
                    });
                });
            }

            // Countdown Timer
            const deadlineAt = "{{ isset($deadlineAt) ? $deadlineAt : '' }}";
            if (deadlineAt) {
                const countdownEl = document.getElementById("countdown");
                if (countdownEl) {
                    const endTime = new Date(deadlineAt).getTime();
                    const interval = setInterval(() => {
                        const now = new Date().getTime();
                        const diff = endTime - now;
                        if (diff <= 0) {
                            clearInterval(interval);
                            location.reload();
                            return;
                        }
                        const hours = Math.floor(diff / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                        countdownEl.innerText =
                            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }, 1000);
                }
            }
        });
    </script>
@endsection
