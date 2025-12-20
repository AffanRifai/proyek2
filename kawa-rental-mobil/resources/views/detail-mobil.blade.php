@extends('layout.app')

@section('title', 'Detail Mobil - KAWA Rental Mobil')

@push('styles')
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')
    <div class="car-detail-page">
        <!-- Status Banner -->
        @if ($car->status != 'tersedia')
            <div class="status-banner {{ $car->status }}" data-aos="fade-down" data-aos-duration="500" data-aos-once="false">
                <div class="container">
                    <div class="status-content">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        <span class="status-text">
                            @if ($car->status == 'disewa')
                                Mobil sedang disewa. Tersedia mulai tanggal {{ date('d M Y', strtotime('+3 days')) }}
                            @else
                                Mobil sedang dalam perawatan. Hubungi kami untuk informasi ketersediaan
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb" data-aos="fade-right" data-aos-delay="100" data-aos-once="false">
                <a href="">Beranda</a>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M9 18l6-6-6-6" />
                </svg>
                <a href="">Armada</a>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M9 18l6-6-6-6" />
                </svg>
                <span class="current">{{ $car->merk }} {{ $car->model }}</span>
            </nav>

            <div class="car-detail-grid">
                <!-- Image Section -->
                <div class="image-section" data-aos="fade-right" data-aos-delay="200" data-aos-once="false">
                    <div class="main-image-container">
                        <img src="{{ asset($car->gambar) }}"
                            alt="{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}" id="mainCarImage"
                            class="car-image" onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'">

                        <!-- Status Badge on Image -->
                        @if ($car->status == 'tersedia')
                            <div class="availability-badge available" data-aos="zoom-in" data-aos-delay="300" data-aos-once="false">
                                <span class="dot"></span>
                                Tersedia
                            </div>
                        @else
                            <div class="availability-badge unavailable" data-aos="zoom-in" data-aos-delay="300" data-aos-once="false">
                                <span class="dot"></span>
                                {{ ucfirst($car->status) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Info Section -->
                <div class="info-section">
                    <!-- Car Header - Mobile Optimized -->
                    <div class="car-header" data-aos="fade-up" data-aos-delay="150" data-aos-once="false">
                        <h1 class="car-title">{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}</h1>
                    </div>

                    <!-- Modern Pricing Card -->
                    <div class="modern-pricing-card" data-aos="fade-up" data-aos-delay="250" data-aos-once="false">
                        <div class="price-top">
                            <div class="price-info">
                                <div class="price-label">Harga Sewa Harian</div>
                                <div class="price-amount">
                                    <span class="currency">Rp</span>
                                    <span class="number">{{ number_format($car->biaya_harian, 0, ',', '.') }}</span>
                                    <div class="price-period">/ hari</div>
                                </div>
                            </div>

                            @if ($car->status == 'tersedia')
                                <a href="{{ route('form.booking', $car->id) }}" class="rent-btn" data-aos="zoom-in" data-aos-delay="350" data-aos-once="false">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M9 10l4 4 6-6" />
                                        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Sewa Sekarang
                                </a>
                            @else
                                <button class="rent-btn disabled" disabled data-aos="zoom-in" data-aos-delay="350" data-aos-once="false">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @if ($car->status == 'disewa')
                                        Sedang Disewa
                                    @else
                                        Dalam Perawatan
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Mobile Optimized Specifications -->
                    <div class="mobile-specs" data-aos="fade-up" data-aos-delay="300" data-aos-once="false">
                        <div class="spec-row">
                            <div class="spec-item" data-aos="fade-right" data-aos-delay="400" data-aos-once="false">
                                <div class="spec-label">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L3 7v10l9 5 9-5V7l-9-5z" />
                                    </svg>
                                    Transmisi
                                </div>
                                <div class="spec-value">{{ ucfirst($car->transmisi ?? 'Manual') }}</div>
                            </div>
                            <div class="spec-item" data-aos="fade-left" data-aos-delay="450" data-aos-once="false">
                                <div class="spec-label">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                    Warna
                                </div>
                                <div class="spec-value">
                                    <span class="color-chip" style="background-color: {{ $car->warna ?? '#333' }}"></span>
                                    {{ $car->warna ?? 'Various' }}
                                </div>
                            </div>
                        </div>
                        <div class="spec-row">
                            <div class="spec-item" data-aos="fade-right" data-aos-delay="500" data-aos-once="false">
                                <div class="spec-label">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg>
                                    Kapasitas
                                </div>
                                <div class="spec-value">{{ $car->kapasitas_penumpang }} Penumpang</div>
                            </div>
                            <div class="spec-item" data-aos="fade-left" data-aos-delay="550" data-aos-once="false">
                                <div class="spec-label">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                    </svg>
                                    No. Polisi
                                </div>
                                <div class="spec-value">{{ $car->no_polisi }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Specifications (Hidden on Mobile) -->
                    <div class="desktop-specs" data-aos="fade-up" data-aos-delay="350" data-aos-once="false">
                        <div class="specifications-grid">
                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="400" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M17 8h1a4 4 0 110 8h-1M3 8h10v8H3z" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Tahun</div>
                                    <div class="spec-value">{{ $car->tahun }}</div>
                                </div>
                            </div>

                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="450" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Kapasitas</div>
                                    <div class="spec-value">{{ $car->kapasitas_penumpang }} Penumpang</div>
                                </div>
                            </div>

                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="500" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L3 7v10l9 5 9-5V7l-9-5z" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Transmisi</div>
                                    <div class="spec-value">{{ ucfirst($car->transmisi ?? 'Manual') }}</div>
                                </div>
                            </div>

                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="550" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Warna</div>
                                    <div class="spec-value">
                                        <span class="color-chip"
                                            style="background-color: {{ $car->warna ?? '#333' }}"></span>
                                        {{ $car->warna ?? 'Various' }}
                                    </div>
                                </div>
                            </div>

                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="600" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">No. Polisi</div>
                                    <div class="spec-value">{{ $car->no_polisi }}</div>
                                </div>
                            </div>

                            <div class="spec-item" data-aos="zoom-in" data-aos-delay="650" data-aos-once="false">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Kondisi</div>
                                    <div class="spec-value">Siap Pakai</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions - Mobile Optimized -->
                    <div class="quick-actions" data-aos="fade-up" data-aos-delay="400" data-aos-once="false">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20{{ $car->merk }}%20{{ $car->model }}%20{{ $car->tahun }}%20di%20KAWA%20Rental"
                            class="whatsapp-action" target="_blank" data-aos="zoom-in" data-aos-delay="500" data-aos-once="false">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="#25D366">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.173.198-.297.298-.496.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411" />
                            </svg>
                            Tanya via WhatsApp
                        </a>

                        <button class="share-action" onclick="shareCar()" data-aos="zoom-in" data-aos-delay="550" data-aos-once="false">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="18" cy="5" r="3" />
                                <circle cx="6" cy="12" r="3" />
                                <circle cx="18" cy="19" r="3" />
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tab Section -->
            <div class="tab-section" data-aos="fade-up" data-aos-delay="450" data-aos-once="false">
                <div class="tab-header" data-aos="fade-up" data-aos-delay="500" data-aos-once="false">
                    <button class="tab-btn active" data-tab="description" data-aos="fade-right" data-aos-delay="550" data-aos-once="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                        Deskripsi
                    </button>
                    <button class="tab-btn" data-tab="features" data-aos="fade-right" data-aos-delay="600" data-aos-once="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="20 12 20 22 4 22 4 12" />
                            <rect x="2" y="7" width="20" height="5" />
                            <line x1="12" y1="22" x2="12" y2="7" />
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                        </svg>
                        Fasilitas
                    </button>
                    <button class="tab-btn" data-tab="terms" data-aos="fade-left" data-aos-delay="650" data-aos-once="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                        Syarat & Ketentuan
                    </button>
                    <button class="tab-btn" data-tab="policy" data-aos="fade-left" data-aos-delay="700" data-aos-once="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        Kebijakan
                    </button>
                </div>

                <div class="tab-content">
                    <div id="description" class="tab-pane active" data-aos="fade-up" data-aos-delay="750" data-aos-once="false">
                        <div class="content-box">
                            <h3>Deskripsi Mobil</h3>
                            <div class="content-text">{{ $car->deskripsi }}</div>
                        </div>
                    </div>

                    <div id="features" class="tab-pane" data-aos="fade-up" data-aos-delay="750" data-aos-once="false">
                        <div class="content-box">
                            <h3>Fasilitas & Fitur</h3>
                            <div class="content-text">{{ $car->fasilitas ?? 'Informasi fasilitas tidak tersedia.' }}</div>
                        </div>
                    </div>

                    <div id="terms" class="tab-pane" data-aos="fade-up" data-aos-delay="750" data-aos-once="false">
                        <div class="content-box">
                            <h3>Syarat & Ketentuan</h3>
                            <div class="content-text">{{ $car->syarat ?? 'Syarat dan ketentuan tidak tersedia.' }}</div>
                        </div>
                    </div>

                    <div id="policy" class="tab-pane" data-aos="fade-up" data-aos-delay="750" data-aos-once="false">
                        <div class="content-box">
                            <h3>Kebijakan Sewa</h3>
                            <div class="content-text">{{ $car->kebijakan ?? 'Kebijakan tidak tersedia.' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- WhatsApp Float Button -->
        <a href="https://wa.me/6281234567890" class="wa-float" target="_blank" aria-label="Chat WhatsApp" data-aos="zoom-in" data-aos-delay="800" data-aos-once="false" data-aos-anchor-placement="top-center">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="#25D366">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.173.198-.297.298-.496.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.304-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411" />
            </svg>
        </a>
    </div>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        /* Modern Car Detail Page Styles */
        :root {
            --primary-color: #A62F19;
            --primary-dark: #8a2715;
            --primary-light: #f8e8e6;
            --secondary-color: #2c649d;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --text-lighter: #999;
            --bg-light: #f8f9fa;
            --border-color: #eaeaea;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.16);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --transition: all 0.3s ease;
        }

        .car-detail-page {
            background: #ffffff;
            min-height: 100vh;
            padding-bottom: 48px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Status Banner */
        .status-banner {
            padding: 12px 0;
            background: var(--warning-color);
            color: white;
            position: relative;
        }

        .status-banner.disewa {
            background: var(--danger-color);
        }

        .status-content {
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
        }

        .status-text {
            font-weight: 500;
            font-size: 14px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 0;
            color: var(--text-light);
            font-size: 14px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary-color);
        }

        .breadcrumb .current {
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Grid Layout */
        .car-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        @media (max-width: 968px) {
            .car-detail-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }

        /* Image Section */
        .image-section {
            position: relative;
        }

        .main-image-container {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .car-image {
            width: 100%;
            height: auto;
            border-radius: var(--radius-lg);
            display: block;
        }

        .availability-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: var(--shadow-sm);
        }

        .availability-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success-color);
        }

        .availability-badge.available .dot {
            background: var(--success-color);
        }

        .availability-badge.unavailable .dot {
            background: var(--danger-color);
        }

        /* Info Section */
        .info-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .car-header {
            margin-bottom: 8px;
        }

        .car-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        /* Modern Pricing Card */
        .modern-pricing-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            margin-top: 8px;
        }

        .price-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 16px;
        }

        .price-info {
            flex: 1;
        }

        .price-label {
            font-size: 13px;
            color: var(--text-lighter);
            font-weight: 500;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .price-amount {
            display: flex;
            align-items: baseline;
            gap: 2px;
            margin-bottom: 2px;
        }

        .currency {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .number {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
        }

        .price-period {
            font-size: 13px;
            color: var(--text-light);
            font-weight: 500;
        }

        .rent-btn {
            padding: 12px 24px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            white-space: nowrap;
            min-width: 140px;
        }

        .rent-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .rent-btn.disabled {
            background: var(--text-lighter);
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .price-features {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--text-light);
        }

        .feature svg {
            color: var(--success-color);
        }

        /* Mobile Optimized Specifications */
        .mobile-specs {
            display: none;
        }

        .mobile-specs .spec-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .mobile-specs .spec-item {
            background: var(--bg-light);
            border-radius: var(--radius-sm);
            padding: 12px;
        }

        .mobile-specs .spec-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-lighter);
            margin-bottom: 4px;
        }

        .mobile-specs .spec-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .color-chip {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
            border: 1px solid var(--border-color);
        }

        /* Desktop Specifications */
        .desktop-specs {
            display: block;
        }

        .specifications-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: white;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .spec-item:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .spec-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            border-radius: var(--radius-sm);
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .spec-content {
            flex: 1;
        }

        .spec-label {
            font-size: 11px;
            color: var(--text-lighter);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .spec-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .whatsapp-action,
        .share-action {
            flex: 1;
            padding: 12px;
            border: 1px solid var(--border-color);
            background: white;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-dark);
        }

        .whatsapp-action:hover {
            background: #25D366;
            color: white;
            border-color: #25D366;
        }

        .share-action:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Tab Section */
        .tab-section {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-top: 32px;
        }

        .tab-header {
            display: flex;
            background: var(--bg-light);
            border-bottom: 1px solid var(--border-color);
            overflow-x: auto;
            scrollbar-width: none;
        }

        .tab-header::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            flex: 1;
            padding: 18px;
            border: none;
            background: none;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
        }

        .tab-btn:hover {
            color: var(--primary-color);
            background: rgba(166, 47, 25, 0.05);
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background: white;
        }

        .tab-content {
            padding: 0;
        }

        .tab-pane {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-pane.active {
            display: block;
        }

        .content-box {
            padding: 24px;
        }

        .content-box h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .content-text {
            line-height: 1.7;
            color: var(--text-dark);
            font-size: 15px;
            white-space: pre-line;
        }

        /* WhatsApp Float */
        .wa-float {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 1000;
        }

        .wa-float:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-lg), 0 0 20px rgba(37, 211, 102, 0.3);
        }

        /* Animations */
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

        /* Responsive Design - Mobile Optimization */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }

            .car-title {
                font-size: 24px;
                margin-bottom: 8px;
            }

            /* Mobile: Hide desktop specs, show mobile specs */
            .desktop-specs {
                display: none;
            }

            .mobile-specs {
                display: block;
            }

            /* Mobile: Stack pricing card */
            .price-top {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .rent-btn {
                width: 100%;
                min-width: auto;
                padding: 14px;
            }

            .number {
                font-size: 24px;
            }

            /* Mobile: Adjust quick actions */
            .quick-actions {
                flex-direction: column;
                gap: 10px;
            }

            .whatsapp-action,
            .share-action {
                padding: 14px;
                font-size: 15px;
            }

            .tab-header {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                padding: 12px;
                background: white;
                border-bottom: 1px solid var(--border-color);
            }

            /* Mobile: Adjust tabs */
            .tab-header {
                padding: 12px 8px;
            }

            .content-box {
                padding: 20px;
            }

            .content-box h3 {
                font-size: 18px;
            }

            /* Mobile: Adjust pricing card */
            .modern-pricing-card {
                padding: 16px;
                margin-top: 0;
            }

            /* Mobile: Adjust grid gap */
            .car-detail-grid {
                gap: 24px;
            }

            /* Mobile: Make image section more compact */
            .image-section {
                margin-bottom: 0;
            }

            .car-image {
                max-height: 300px;
                object-fit: cover;
            }

            /* Mobile: Adjust specs layout */
            .mobile-specs .spec-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .car-title {
                font-size: 22px;
            }

            .number {
                font-size: 22px;
            }

            .currency {
                font-size: 14px;
            }

            .price-label {
                font-size: 12px;
            }

            .rent-btn {
                font-size: 14px;
                padding: 12px;
            }

            .content-box {
                padding: 16px;
            }

            .wa-float {
                bottom: 20px;
                right: 20px;
                width: 52px;
                height: 52px;
            }
        }

        /* Perbaikan khusus untuk tab buttons di mobile */
        @media (max-width: 768px) {
            .tab-header {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                padding: 12px;
                background: white;
                border-bottom: 1px solid var(--border-color);
            }

            .tab-btn {
                padding: 14px 10px;
                font-size: 14px;
                border-radius: var(--radius-sm);
                border: 1px solid var(--border-color);
                background: var(--bg-light);
                transition: all 0.2s ease;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 6px;
            }

            .tab-btn.active {
                background: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
                box-shadow: 0 2px 8px rgba(166, 47, 25, 0.2);
            }

            .tab-btn:hover:not(.active) {
                background: rgba(166, 47, 25, 0.05);
            }

            .tab-btn svg {
                width: 18px;
                height: 18px;
            }
        }

        /* Untuk layar yang sangat kecil */
        @media (max-width: 480px) {
            .tab-header {
                gap: 6px;
                padding: 10px;
            }

            .tab-btn {
                padding: 12px 6px;
                font-size: 13px;
                gap: 4px;
            }

            .tab-btn svg {
                width: 16px;
                height: 16px;
            }
        }
    </style>

    <script>
        // Inisialisasi AOS dengan animasi berulang
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                // Global settings:
                disable: false,
                startEvent: 'DOMContentLoaded',
                initClassName: 'aos-init',
                animatedClassName: 'aos-animate',
                useClassNames: false,
                disableMutationObserver: false,
                debounceDelay: 50,
                throttleDelay: 99,

                // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
                offset: 120, // offset (in px) from the original trigger point
                delay: 0, // values from 0 to 3000, with step 50ms
                duration: 800, // values from 0 to 3000, with step 50ms
                easing: 'ease', // default easing for AOS animations
                once: false, // CHANGED: animation will happen every time you scroll
                mirror: true, // CHANGED: elements will animate out while scrolling past them
                anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
            });

            // Refresh AOS saat halaman di-scroll untuk memastikan animasi berulang
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    AOS.refresh();
                }, 150);
            });

            // Tab Switching
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const tabId = this.dataset.tab;

                    // Remove active class from all buttons and panes
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabPanes.forEach(p => p.classList.remove('active'));

                    // Add active class to clicked button and corresponding pane
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });

        function shareCar() {
            const shareData = {
                title: '{{ $car->merk }} {{ $car->model }} - KAWA Rental Mobil',
                text: 'Lihat mobil {{ $car->merk }} {{ $car->model }} {{ $car->tahun }} di KAWA Rental Mobil!',
                url: window.location.href
            };

            if (navigator.share) {
                navigator.share(shareData)
                    .then(() => console.log('Berhasil membagikan'))
                    .catch(err => console.log('Error sharing:', err));
            } else {
                // Fallback: copy URL to clipboard
                navigator.clipboard.writeText(window.location.href)
                    .then(() => alert('Link berhasil disalin ke clipboard!'))
                    .catch(err => console.log('Error copying:', err));
            }
        }
    </script>
@endsection
