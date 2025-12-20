@extends('layout.app')

@section('title', 'Pesanan Saya - KAWA Rental Mobil')

@section('content')
    <div class="container my-4">
        <div class="page-header">
            <h1 class="page-title">Pesanan Saya</h1>
            <p class="page-subtitle">Kelola dan lacak semua pesanan rental mobil Anda</p>
        </div>

        @if ($bookings->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Belum ada pesanan</h3>
                <p class="text-muted">Mulai sewa mobil impian Anda sekarang!</p>
                <a href="{{ route('cars.index') }}" class="btn-primary">
                    <i class="fas fa-car me-2"></i>Sewa Mobil
                </a>
            </div>
        @else
            <div class="pesanan-list">
                @foreach ($bookings as $b)
                    <div class="pesanan-card">
                        <!-- Status dan Tanggal di Header -->
                        <div class="card-header">
                            <div class="status-badge status-{{ $b->status }}">
                                @if ($b->status == 'approved')
                                    <i class="fas fa-check-circle me-1"></i>
                                @elseif($b->status == 'pending')
                                    <i class="fas fa-clock me-1"></i>
                                @elseif($b->status == 'cancelled')
                                    <i class="fas fa-times-circle me-1"></i>
                                @elseif($b->status == 'active')
                                    <i class="fas fa-car me-1"></i>
                                @endif
                                {{ ucfirst($b->status) }}
                            </div>
                            <div class="order-date">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($b->created_at)->format('d M Y') }}
                            </div>
                        </div>

                        <!-- ID Transaksi -->
                        <div class="transaksi-id">
                            <div class="transaksi-content">
                                <div class="value-group">
                                    <span class="label">ID Transaksi</span>
                                    <span class="value">{{ $b->id_transaksi }}</span>
                                    <button class="btn-copy" data-text="{{ $b->id_transaksi }}">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Mobil -->
                        <div class="car-section">
                            <div class="car-image">
                                @if ($b->car && $b->car->gambar)
                                    <img src="{{ asset($b->car->gambar) }}" alt="{{ $b->car->merk }} {{ $b->car->model }}"
                                        onerror="this.src='{{ asset('img/default-car.jpg') }}'">
                                @else
                                    <img src="{{ asset('img/default-car.jpg') }}" alt="Mobil">
                                @endif
                            </div>
                            <div class="car-info">
                                <h3 class="car-name">{{ $b->car->merk ?? 'Mobil' }} {{ $b->car->model ?? '' }}</h3>
                                <div class="rental-dates">
                                    <i class="far fa-calendar me-2"></i>
                                    {{ \Carbon\Carbon::parse($b->mulai_tgl)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($b->sel_tgl)->format('d M Y') }}
                                </div>
                                <div class="rental-duration">
                                    <i class="far fa-clock me-2"></i>
                                    {{ $b->lama_hari }} hari
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Pembayaran -->
                        <div class="payment-section">
                            <div class="payment-status-row">
                                <span class="status-label">Status Pembayaran:</span>
                                <span class="payment-badge status-{{ $b->status_pembayaran }}">
                                    @if ($b->status_pembayaran == 'lunas')
                                        <i class="fas fa-check-circle me-1"></i>
                                    @elseif($b->status_pembayaran == 'menunggu')
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                    @endif
                                    {{ ucfirst($b->status_pembayaran) }}
                                </span>
                            </div>

                            <div class="payment-details">
                                <div class="detail-row">
                                    <span class="detail-label">Total</span>
                                    <span class="detail-value total-amount">Rp
                                        {{ number_format($b->total_pembayaran, 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Dibayar</span>
                                    <span class="detail-value text-success">Rp
                                        {{ number_format($b->totalDibayar(), 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Sisa</span>
                                    <span class="detail-value text-warning">Rp
                                        {{ number_format($b->sisaBayar(), 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="action-section">
                            <div class="action-buttons">
                                <a href="{{ route('pesanan.show', $b->id) }}" class="btn-action btn-view">
                                    <i class="fas fa-eye me-2"></i>
                                    Lihat Detail
                                </a>

                                @if ($b->isCancelable())
                                    <button class="btn-action btn-cancel" data-id="{{ $b->id }}">
                                        <i class="fas fa-times me-2"></i>
                                        Batalkan
                                    </button>
                                @endif

                                @if ($b->status_pembayaran == 'menunggu' || $b->sisaBayar() > 0)
                                    <button class="btn-action btn-pay" data-booking-id="{{ $b->id }}"
                                        data-total-pembayaran="{{ $b->total_pembayaran }}"
                                        data-total-dibayar="{{ $b->totalDibayar() }}"
                                        data-sisa-bayar="{{ $b->sisaBayar() }}"
                                        data-car-name="{{ $b->car ? $b->car->merk . ' ' . $b->car->model : 'Mobil' }}"
                                        data-status-pembayaran="{{ $b->status_pembayaran }}"
                                        data-requires-dp="{{ $b->requiresDp() ? 'true' : 'false' }}">
                                        <i class="fas fa-credit-card me-2"></i>
                                        {{ $b->status_pembayaran == 'menunggu' ? 'Bayar' : 'Lunasi' }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pesanan-pagination">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Pembayaran -->
    <div id="paymentModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembayaran</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="payment-info">
                    <div class="info-item">
                        <span class="info-label">Mobil:</span>
                        <span class="info-value" id="modal-car-name"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total:</span>
                        <span class="info-value amount" id="modal-total-pembayaran"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Dibayar:</span>
                        <span class="info-value" id="modal-total-dibayar"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Sisa:</span>
                        <span class="info-value" id="modal-sisa-bayar"></span>
                    </div>
                </div>

                <div class="payment-options">
                    <div class="option-group" id="dp-option" style="display: none;">
                        <h6>Bayar DP (30%)</h6>
                        <div class="option-card selected" data-type="dp">
                            <div class="option-content">
                                <div class="option-title">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Bayar DP
                                </div>
                                <div class="option-amount" id="dp-amount"></div>
                            </div>
                        </div>
                    </div>

                    <div class="option-group" id="full-option" style="display: none;">
                        <h6>Bayar Penuh</h6>
                        <div class="option-card selected" data-type="bayar_penuh">
                            <div class="option-content">
                                <div class="option-title">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Bayar Penuh
                                </div>
                                <div class="option-amount" id="full-amount"></div>
                            </div>
                        </div>
                    </div>

                    <div class="option-group" id="pelunasan-option" style="display: none;">
                        <h6>Pelunasan</h6>
                        <div class="option-card selected" data-type="pelunasan">
                            <div class="option-content">
                                <div class="option-title">
                                    <i class="fas fa-wallet me-2"></i>
                                    Bayar Sisa
                                </div>
                                <div class="option-amount" id="pelunasan-amount"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran - Hanya untuk Pelunasan -->
                <div class="payment-methods" id="payment-methods-section" style="display: none;">
                    <h6>Metode Pembayaran</h6>
                    <div class="methods-grid">
                        <div class="method-card selected" data-method="online">
                            <i class="fas fa-credit-card"></i>
                            <span>Online</span>
                        </div>
                        <div class="method-card" data-method="offline">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Offline</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary modal-cancel">Batal</button>
                <button type="button" class="btn-primary" id="confirm-payment">
                    Lanjutkan Pembayaran
                </button>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <p>Memproses...</p>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <style>
        /* Reset & Variables */
        :root {
            --primary: #A62F19;
            --primary-hover: #8c2915;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --border: #eaeaea;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            --radius: 12px;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
        }

        /* Base Styles */
        .container {
            max-width: 100%;
            padding: 0 16px;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 24px;
            text-align: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 6px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--secondary);
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-top: 40px;
        }

        .empty-icon {
            font-size: 48px;
            color: var(--primary);
            margin-bottom: 16px;
            opacity: 0.7;
        }

        .empty-state h3 {
            color: #333;
            margin-bottom: 8px;
            font-size: 18px;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Pesanan List */
        .pesanan-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }

        /* Pesanan Card */
        .pesanan-card {
            width: 45%;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 0;
            overflow: hidden;
        }




        /* Card Header */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: var(--light);
            border-bottom: 1px solid var(--border);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-approved {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        .status-cancelled {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .status-active {
            background: rgba(13, 202, 240, 0.1);
            color: var(--info);
            border: 1px solid rgba(13, 202, 240, 0.2);
        }

        .order-date {
            font-size: 12px;
            color: var(--secondary);
            display: flex;
            align-items: center;
        }

        /* ID Transaksi */
        .transaksi-id {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        .transaksi-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .transaksi-id .label {
            font-size: 11px;
            color: var(--secondary);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .value-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .transaksi-id .value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            font-family: 'Courier New', monospace;
        }

        .btn-copy {
            padding: 6px 10px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 4px;
            color: var(--secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-copy:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary);
        }

        /* Car Section */
        .car-section {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid var(--border);
        }

        .car-image {
            width: 80px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .car-info {
            flex: 1;
        }

        .car-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .rental-dates,
        .rental-duration {
            font-size: 13px;
            color: var(--secondary);
            display: flex;
            align-items: center;
            margin-bottom: 4px;
        }

        /* Payment Section */
        .payment-section {
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }

        .payment-status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .status-label {
            font-size: 13px;
            color: var(--secondary);
            font-weight: 500;
        }

        .payment-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-lunas {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .status-menunggu {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        .payment-details {
            background: var(--light);
            border-radius: 8px;
            padding: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
        }

        .detail-row:not(:last-child) {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-label {
            font-size: 13px;
            color: var(--secondary);
        }

        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .total-amount {
            font-size: 16px;
            color: var(--primary);
            font-weight: 700;
        }

        .text-success {
            color: var(--success);
        }

        .text-warning {
            color: var(--warning);
        }

        /* Action Section */
        .action-section {
            padding: 16px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-action {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
        }

        .btn-view {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-view:hover {
            background: var(--primary);
            color: white;
        }

        .btn-cancel {
            background: white;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .btn-cancel:hover {
            background: var(--danger);
            color: white;
        }

        .btn-pay {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .btn-pay:hover {
            background: var(--primary-hover);
        }

        /* Buttons */
        .btn-primary {
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        /* Pagination */
        .pesanan-pagination {
            margin-top: 32px;
            padding: 16px 0;
        }

        .pesanan-pagination nav {
            display: flex;
            justify-content: center;
        }

        .pesanan-pagination .pagination {
            display: flex;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        .pesanan-pagination .page-link {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 13px;
            font-weight: 500;
            background: white;
        }

        .pesanan-pagination .active .page-link {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 16px;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--secondary);
            cursor: pointer;
            line-height: 1;
            transition: color 0.3s ease;
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .modal-body {
            padding: 16px;
        }

        .modal-body .payment-info {
            background: var(--light);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .modal-body .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modal-body .info-item:last-child {
            border-bottom: none;
        }

        .modal-body .info-label {
            font-size: 14px;
            color: var(--secondary);
            font-weight: 500;
        }

        .modal-body .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .modal-body .info-value.amount {
            color: var(--primary);
            font-size: 16px;
        }

        /* Payment Options in Modal */
        .modal-body .payment-options {
            margin-bottom: 20px;
        }

        .modal-body .option-group {
            margin-bottom: 16px;
        }

        .modal-body .option-group h6 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            padding-left: 8px;
            border-left: 3px solid var(--primary);
        }

        .modal-body .option-card {
            background: white;
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-body .option-card:hover {
            border-color: var(--primary);
        }

        .modal-body .option-card.selected {
            border-color: var(--primary);
            background: rgba(166, 47, 25, 0.05);
        }

        .modal-body .option-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-body .option-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
        }

        .modal-body .option-amount {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        /* Payment Methods in Modal */
        .modal-body .payment-methods {
            margin-bottom: 20px;
        }

        .modal-body .payment-methods h6 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            padding-left: 8px;
            border-left: 3px solid var(--primary);
        }

        .modal-body .methods-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .modal-body .method-card {
            background: white;
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .modal-body .method-card:hover {
            border-color: var(--primary);
        }

        .modal-body .method-card.selected {
            border-color: var(--primary);
            background: rgba(166, 47, 25, 0.05);
        }

        .modal-body .method-card i {
            font-size: 20px;
            color: var(--primary);
        }

        .modal-body .method-card span {
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 16px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .modal-footer .btn-secondary {
            background: white;
            color: var(--secondary);
            border: 1px solid var(--border);
        }

        .modal-footer .btn-secondary:hover {
            background: var(--light);
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1100;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 16px;
        }

        .loading-overlay p {
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pesanan-card {
                width: 100%;
            }
        }

        @media (max-width: 360px) {
            .car-section {
                flex-direction: column;
                text-align: center;
            }

            .car-image {
                width: 100%;
                height: 120px;
            }

            .action-buttons {
                gap: 8px;
            }

            .btn-action {
                padding: 10px 14px;
                font-size: 13px;
            }

            .modal-body .methods-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 768px) {
            .container {
                padding: 0 24px;
            }

            .page-title {
                font-size: 28px;
            }

            .pesanan-list {
                gap: 20px;
            }

            .car-image {
                width: 100px;
                height: 70px;
            }

            .car-name {
                font-size: 17px;
            }

            .modal-content {
                max-width: 450px;
            }
        }

        @media (min-width: 992px) {
            .action-buttons {
                flex-direction: row;
            }

            .btn-action {
                flex: 1;
                min-width: 140px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global variables
            let currentBookingId = null;
            let selectedPaymentType = null;
            let selectedMethod = 'online';
            const csrf = '{{ csrf_token() }}';

            // DOM Elements
            const modal = document.getElementById('paymentModal');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const modalCloseBtn = document.querySelector('.modal-close');
            const modalCancelBtn = document.querySelector('.modal-cancel');
            const confirmBtn = document.getElementById('confirm-payment');
            const payButtons = document.querySelectorAll('.btn-pay');
            const paymentMethodsSection = document.getElementById('payment-methods-section');

            // Copy transaction ID functionality
            document.querySelectorAll('.btn-copy').forEach(btn => {
                btn.addEventListener('click', function() {
                    const text = this.dataset.text;
                    navigator.clipboard.writeText(text)
                        .then(() => {
                            const originalHTML = this.innerHTML;
                            this.innerHTML = '<i class="fas fa-check me-2"></i>Disalin';
                            this.style.background = 'var(--primary)';
                            this.style.color = 'white';
                            this.style.borderColor = 'var(--primary)';

                            setTimeout(() => {
                                this.innerHTML = originalHTML;
                                this.style.background = '';
                                this.style.color = '';
                                this.style.borderColor = '';
                            }, 2000);
                        })
                        .catch(err => {
                            console.error('Failed to copy: ', err);
                            showNotification('Gagal menyalin ID transaksi', 'error');
                        });
                });
            });

            // Pay button click handler
            payButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    currentBookingId = this.dataset.bookingId;
                    const totalPembayaran = parseInt(this.dataset.totalPembayaran);
                    const totalDibayar = parseInt(this.dataset.totalDibayar);
                    const sisaBayar = parseInt(this.dataset.sisaBayar);
                    const carName = this.dataset.carName;
                    const statusPembayaran = this.dataset.statusPembayaran;
                    const requiresDp = this.dataset.requiresDp === 'true';

                    // Reset modal state
                    selectedMethod = 'online';
                    paymentMethodsSection.style.display = 'none';

                    // Update modal content
                    document.getElementById('modal-car-name').textContent = carName;
                    document.getElementById('modal-total-pembayaran').textContent = formatCurrency(
                        totalPembayaran);
                    document.getElementById('modal-total-dibayar').textContent = formatCurrency(
                        totalDibayar);
                    document.getElementById('modal-sisa-bayar').textContent = formatCurrency(
                        sisaBayar);

                    // Show/hide payment options based on payment status
                    const dpOption = document.getElementById('dp-option');
                    const fullOption = document.getElementById('full-option');
                    const pelunasanOption = document.getElementById('pelunasan-option');

                    dpOption.style.display = 'none';
                    fullOption.style.display = 'none';
                    pelunasanOption.style.display = 'none';

                    // Calculate amounts
                    const dpAmount = Math.round(totalPembayaran * 0.3);
                    document.getElementById('dp-amount').textContent = formatCurrency(dpAmount);
                    document.getElementById('full-amount').textContent = formatCurrency(
                        totalPembayaran);
                    document.getElementById('pelunasan-amount').textContent = formatCurrency(
                        sisaBayar);

                    // Show appropriate options
                    if (statusPembayaran === 'menunggu') {
                        if (requiresDp && totalDibayar === 0) {
                            dpOption.style.display = 'block';
                            fullOption.style.display = 'block';
                            selectedPaymentType = 'dp';
                            selectOption('dp');
                        } else if (!requiresDp && totalDibayar === 0) {
                            fullOption.style.display = 'block';
                            selectedPaymentType = 'bayar_penuh';
                            selectOption('bayar_penuh');
                        }
                    } else if (sisaBayar > 0) {
                        pelunasanOption.style.display = 'block';
                        selectedPaymentType = 'pelunasan';
                        selectOption('pelunasan');
                        // Show payment methods only for pelunasan
                        paymentMethodsSection.style.display = 'block';
                        selectMethod('online'); // Default to online
                    }

                    // Show modal
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });

            // Payment option selection
            document.querySelectorAll('.option-card').forEach(card => {
                card.addEventListener('click', function() {
                    selectedPaymentType = this.dataset.type;
                    selectOption(selectedPaymentType);

                    // Show/hide payment methods based on selected type
                    if (selectedPaymentType === 'pelunasan') {
                        paymentMethodsSection.style.display = 'block';
                    } else {
                        paymentMethodsSection.style.display = 'none';
                        selectedMethod = 'online'; // Force online for DP and Full
                    }
                });
            });

            // Payment method selection
            document.querySelectorAll('.method-card').forEach(method => {
                method.addEventListener('click', function() {
                    selectedMethod = this.dataset.method;
                    selectMethod(selectedMethod);
                });
            });

            // Confirm payment
            confirmBtn.addEventListener('click', function() {
                if (!currentBookingId || !selectedPaymentType) {
                    showNotification('Silakan pilih opsi pembayaran', 'error');
                    return;
                }

                // Determine which payment function to call
                if (selectedPaymentType === 'pelunasan' && selectedMethod === 'offline') {
                    processOfflinePayment();
                } else {
                    processOnlinePayment();
                }
            });

            // Modal close handlers
            modalCloseBtn.addEventListener('click', closeModal);
            modalCancelBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });

            // Cancel order functionality
            const cancelButtons = document.querySelectorAll('.btn-cancel');
            cancelButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;

                    const id = this.dataset.id;
                    const card = this.closest('.pesanan-card');
                    const originalText = this.innerHTML;

                    // Show loading state
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    this.disabled = true;

                    fetch(`{{ url('/pesanan-saya') }}/${id}/cancel`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(async res => {
                            const data = await res.json();
                            if (!res.ok) throw new Error(data.message ||
                                'Gagal membatalkan pesanan');
                            return data;
                        })
                        .then(data => {
                            showNotification(data.message || 'Pesanan berhasil dibatalkan',
                                'success');

                            // Update UI
                            const statusBadge = card.querySelector('.status-badge');
                            const paymentBadge = card.querySelector('.payment-badge');

                            statusBadge.className = 'status-badge status-cancelled';
                            statusBadge.innerHTML =
                                '<i class="fas fa-times-circle me-1"></i>Dibatalkan';

                            if (paymentBadge) {
                                paymentBadge.className = 'payment-badge status-cancelled';
                                paymentBadge.innerHTML =
                                    '<i class="fas fa-times-circle me-1"></i>Dibatalkan';
                            }

                            // Remove cancel button
                            this.remove();

                            // Remove pay button if exists
                            const payBtn = card.querySelector('.btn-pay');
                            if (payBtn) payBtn.remove();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification(error.message || 'Gagal membatalkan pesanan',
                                'error');
                            this.innerHTML = originalText;
                            this.disabled = false;
                        });
                });
            });

            // Helper functions
            function formatCurrency(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID');
            }

            function selectOption(type) {
                document.querySelectorAll('.option-card').forEach(card => {
                    card.classList.remove('selected');
                });
                const selectedCard = document.querySelector(`.option-card[data-type="${type}"]`);
                if (selectedCard) {
                    selectedCard.classList.add('selected');
                }
            }

            function selectMethod(method) {
                document.querySelectorAll('.method-card').forEach(card => {
                    card.classList.remove('selected');
                });
                document.querySelector(`.method-card[data-method="${method}"]`).classList.add('selected');
            }

            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            function showLoading(show) {
                loadingOverlay.style.display = show ? 'flex' : 'none';
            }

            async function processOnlinePayment() {
                showLoading(true);

                try {
                    const response = await fetch("{{ route('pembayaran.create_snap') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            booking_id: currentBookingId,
                            jenis_pembayaran: selectedPaymentType
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal memproses pembayaran');
                    }

                    if (data.snap_token) {
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                showLoading(false);
                                closeModal();
                                showNotification('Pembayaran berhasil!', 'success');
                                setTimeout(() => location.reload(), 2000);
                            },
                            onPending: function(result) {
                                showLoading(false);
                                closeModal();
                                showNotification('Pembayaran sedang diproses', 'info');
                                setTimeout(() => location.reload(), 2000);
                            },
                            onError: function(result) {
                                showLoading(false);
                                showNotification('Transaksi gagal', 'error');
                            },
                            onClose: function() {
                                showLoading(false);
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Gagal mendapatkan token pembayaran');
                    }
                } catch (error) {
                    showLoading(false);
                    console.error('Payment error:', error);
                    showNotification(error.message || 'Gagal memproses pembayaran', 'error');
                }
            }

            async function processOfflinePayment() {
                Swal.fire({
                    title: 'Konfirmasi Pembayaran Offline',
                    html: `Anda akan mengajukan <strong>pelunasan offline</strong>.<br><br>
                      Admin akan mengonfirmasi pembayaran saat pengambilan mobil.<br><br>
                      Lanjutkan?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Ajukan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#A62F19'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        showLoading(true);

                        try {
                            const response = await fetch("{{ route('pembayaran.offline') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrf,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    booking_id: currentBookingId,
                                    jenis: 'pelunasan_offline'
                                })
                            });

                            const data = await response.json();
                            showLoading(false);

                            if (data.success) {
                                closeModal();
                                showNotification(data.message ||
                                    'Permintaan pembayaran offline berhasil diajukan', 'success'
                                );
                                setTimeout(() => location.reload(), 2000);
                            } else {
                                throw new Error(data.message ||
                                    'Gagal mengajukan pembayaran offline');
                            }
                        } catch (error) {
                            showLoading(false);
                            console.error('Offline payment error:', error);
                            showNotification(error.message || 'Gagal mengajukan pembayaran offline',
                                'error');
                        }
                    }
                });
            }

            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            `;

                notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                background: ${type === 'success' ? 'rgba(40, 167, 69, 0.9)' :
                            type === 'error' ? 'rgba(220, 53, 69, 0.9)' :
                            type === 'info' ? 'rgba(23, 162, 184, 0.9)' : 'rgba(255, 193, 7, 0.9)'};
                color: white;
                border-radius: 6px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 9999;
                display: flex;
                align-items: center;
                animation: slideIn 0.3s ease;
                max-width: 300px;
                font-size: 14px;
                font-weight: 500;
            `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }

            // Add CSS for animations
            const style = document.createElement('style');
            style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
            document.head.appendChild(style);
        });
    </script>
@endsection
