@extends('layout.app')

@section('title', 'Nota Transaksi #{{ $pembayaran->booking->id_transaksi }}')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/nota.css') }}">
@endpush

@section('content')
    <div class="form-header">
        <nav>
            <a href="#" class="back-link">&larr; Kembali ke Home</a>
        </nav>
    </div>
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
                    <span class="info-value">{{ \Carbon\Carbon::parse($pembayaran->dibayar_pada)->format('d-m-Y') }}</span>
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
                    <span class="info-value amount">Rp{{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</span>
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

    <div class="action-section">
        <a href="{{ route('home') }}" class="btn-landingpage">
            Kembali ke Home
        </a>
    </div>
@endsection
