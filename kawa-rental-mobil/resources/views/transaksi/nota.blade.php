<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi #{{ $pembayaran->booking->id_transaksi }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #dc2626;
            --primary-light: #ef4444;
            --primary-dark: #b91c1c;
            --secondary: #6b7280;
            --secondary-light: #9ca3af;
            --secondary-dark: #4b5563;
            --success: #059669;
            --dark: #1e293b;
            --gray-dark: #374151;
            --gray: #6b7280;
            --gray-light: #f3f4f6;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            margin: 0;
            padding: 20px;
            color: var(--dark);
            line-height: 1.5;
            min-height: 100vh;
        }

        .receipt-container {
            max-width: 500px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .receipt-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
            color: var(--dark);
            padding: 25px;
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid var(--primary);
        }

        /* Corak Background Header */
        .receipt-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(220, 38, 38, 0.05);
            border-radius: 50%;
            z-index: 1;
        }

        .receipt-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(107, 114, 128, 0.05);
            border-radius: 50%;
            z-index: 1;
        }

        .header-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(220, 38, 38, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(107, 114, 128, 0.03) 0%, transparent 50%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            flex-wrap: nowrap;
        }

        .logo-section {
            margin-left: auto;
            text-align: right;
            flex-shrink: 0;

        }

        .logo-section {
            margin-left: auto;
            text-align: right;
            flex-shrink: 0;
            align-self: flex-start;
            margin-top: -10px;
        }


        .logo-container img {
            width: 80px;
            object-fit: contain;
            border-radius: 6px;
        }


        .header-info {
            flex: 1;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--success);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .receipt-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
            color: var(--dark);
        }

        .receipt-subtitle {
            font-size: 14px;
            color: var(--secondary);
            margin-bottom: 15px;
            font-weight: 500;
        }

        .company-info {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 12px;
            color: var(--gray);
            line-height: 1.4;
        }

        .info-item i {
            font-size: 12px;
            color: var(--primary);
            margin-top: 2px;
            flex-shrink: 0;
        }

        .info-text {
            flex: 1;
            color: var(--gray-dark);
        }

        .receipt-body {
            padding: 30px;
            position: relative;
        }

        .receipt-body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .transaction-info {
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 14px;
            color: var(--gray);
            font-weight: 500;
            flex: 1;
        }

        .info-value {
            font-size: 14px;
            color: var(--dark);
            font-weight: 600;
            text-align: right;
            flex: 1;
        }

        .info-value.amount {
            font-size: 16px;
            color: var(--success);
        }

        .divider {
            height: 1px;
            background: var(--gray-light);
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 5px;
            background: var(--primary);
            border-radius: 2px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--gray-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
            font-size: 14px;
        }

        .car-details {
            background: var(--gray-light);
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid var(--primary);
        }

        .car-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .car-label {
            font-size: 14px;
            color: var(--gray);
        }

        .car-value {
            font-size: 14px;
            color: var(--dark);
            font-weight: 500;
        }

        .verification-section {
            text-align: center;
            margin: 25px 0;
            padding: 25px;
            background: var(--gray-light);
            border-radius: 12px;
            border: 2px dashed var(--primary-light);
        }

        .verification-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .verification-subtitle {
            font-size: 13px;
            color: var(--gray);
            margin-bottom: 20px;
        }

        .qrcode {
            display: inline-block;
            padding: 15px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .action-section {
            display: flex;
            justify-content: center;
            margin: 25px 0 15px;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 14px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            font-size: 14px;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }

        .receipt-footer {
            text-align: center;
            padding: 25px;
            border-top: 1px solid var(--gray-light);
            color: var(--gray);
            font-size: 12px;
            background: var(--gray-light);
        }

        .receipt-footer p {
            margin-bottom: 5px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            body {
                padding: 15px 10px;
            }

            .receipt-container {
                border-radius: 12px;
            }

            .receipt-header {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .logo-section {
                align-self: center;
            }

            .receipt-body {
                padding: 25px 20px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .info-value {
                text-align: left;
            }

            .car-info {
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 400px) {
            .receipt-header {
                padding: 15px;
            }

            .receipt-body {
                padding: 20px 15px;
            }

            .status-badge {
                font-size: 12px;
                padding: 6px 16px;
            }

            .receipt-title {
                font-size: 20px;
            }

            .company-info {
                font-size: 11px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .receipt-container {
                box-shadow: none;
                max-width: 100%;
                margin: 0;
            }

            .btn-download {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="header-pattern"></div>
            <div class="header-content">

                <div class="header-info">
                    <h1 class="receipt-title">Nota Pembayaran</h1>
                    <p class="receipt-subtitle">Kawa Rental Mobil - Indramayu</p>

                    <div class="company-info">
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-text">
                                Pasar Mambo, JL. Jendral Ahmad Yani, Lemahabang, Kec. Indramayu, Kab. Indramayu, Jawa
                                Barat
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div class="info-text">0823-1583-6060</div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div class="info-text">prasetyoluckyindra@gmail.com</div>
                        </div>
                    </div>
                </div>
                <div class="logo-section">
                    <div class="logo-container">
                        <img src="{{ asset('img/logo-nota.png') }}" alt="Kawa Rental Logo">
                    </div>
                </div>
            </div>
        </div>

        <div class="receipt-body">
            <!-- Informasi Transaksi -->
            <div class="transaction-info">
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">{{ ucfirst($pembayaran->status_pembayaran) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nomor Referensi</span>
                    <span class="info-value">{{ $pembayaran->booking->id_transaksi }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Transaksi</span>
                    <span
                        class="info-value">{{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('d-m-Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Waktu Transaksi</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('H:i:s') }}
                        WIB</span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Informasi Penyewa -->
            <div class="section-title">
                <i class="fas fa-user"></i>
                Informasi Penyewa
            </div>
            <div class="transaction-info">
                <div class="info-row">
                    <span class="info-label">Nama Penyewa</span>
                    <span class="info-value">{{ $pembayaran->booking->nama_penyewa }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No. Telepon</span>
                    <span class="info-value">{{ $pembayaran->booking->no_telp }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat</span>
                    <span class="info-value">{{ $pembayaran->booking->alamat ?? 'Alamat tidak tersedia' }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Informasi Mobil -->
            <div class="section-title">
                <i class="fas fa-car"></i>
                Informasi Mobil
            </div>
            <div class="car-details">
                <div class="car-info">
                    <span class="car-label">Mobil</span>
                    <span class="car-value">{{ $pembayaran->booking->car->merk }}
                        {{ $pembayaran->booking->car->model }}</span>
                </div>
                <div class="car-info">
                    <span class="car-label">No. Polisi</span>
                    <span class="car-value">{{ $pembayaran->booking->car->no_polisi }}</span>
                </div>
                <div class="car-info">
                    <span class="car-label">Lama Sewa</span>
                    <span class="car-value">{{ $pembayaran->booking->lama_hari }} hari</span>
                </div>
                <div class="car-info">
                    <span class="car-label">Periode</span>
                    <span class="car-value">
                        {{ \Carbon\Carbon::parse($pembayaran->booking->mulai_tgl)->format('d-m-Y') }} s/d
                        {{ \Carbon\Carbon::parse($pembayaran->booking->sel_tgl)->format('d-m-Y') }}
                    </span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Rincian Pembayaran -->
            <div class="section-title">
                <i class="fas fa-receipt"></i>
                Rincian Pembayaran
            </div>
            <div class="transaction-info">
                <div class="info-row">
                    <span class="info-label">Biaya Sewa</span>
                    <span
                        class="info-value">Rp{{ number_format($pembayaran->booking->total_pembayaran, 0, ',', '.') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Biaya Admin</span>
                    <span class="info-value">Rp{{ number_format(6500, 0, ',', '.') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Total Dibayar</span>
                    <span
                        class="info-value amount">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Informasi Pembayaran -->
            <div class="section-title">
                <i class="fas fa-credit-card"></i>
                Metode Pembayaran
            </div>
            <div class="transaction-info">
                <div class="info-row">
                    <span class="info-label">Jenis</span>
                    <span class="info-value">{{ strtoupper($pembayaran->jenis_pembayaran) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Metode</span>
                    <span class="info-value">{{ ucfirst($pembayaran->metode_pembayaran) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Saluran</span>
                    <span class="info-value">{{ ucfirst($pembayaran->saluran_pembayaran) }}</span>
                </div>
            </div>

            <!-- Verifikasi QR Code -->
            <div class="verification-section">
                <div class="verification-title">Verifikasi Transaksi</div>
                <div class="verification-subtitle">Scan kode QR untuk verifikasi keaslian transaksi ini</div>
                <div class="qrcode">
                    {{ $qrcode }}
                </div>
            </div>

            <!-- Tombol Download -->
            <div class="action-section">
                <a href="{{ route('transaksi.nota.pdf', $pembayaran->id) }}" class="btn-download">
                    <i class="fas fa-download"></i>
                    Unduh Nota (PDF)
                </a>
            </div>
        </div>

        <div class="receipt-footer">
            <p>Terima kasih telah menggunakan layanan Kawa Rental Mobil</p>
            <p>Nota ini sah dan diterbitkan secara elektronik oleh sistem</p>
            <p>Hubungi customer service untuk bantuan lebih lanjut</p>
        </div>
    </div>
</body>

</html>
