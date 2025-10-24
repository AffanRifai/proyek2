<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Mobil - {{ $car->merk }} {{ $car->model }} {{ $car->tahun }} - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}" />
    <!-- poppins -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <!-- Montserrat -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600,700&display=swap" rel="stylesheet">
    <!-- Lato -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <header>
        <a href="/" class="logo">
            <img src="{{ asset('img/logo-kawa.png') }}" alt="logo kawa rental mobil" />
        </a>
        <nav>
            <ul>
                <li><a href="/landingpage">Beranda</a></li>
                <li><a href="/DaftarMobil">Daftar Mobil</a></li>
                <li><a href="/TentangKami">Kontak</a></li>
                <li><a href="/TentangKami">Tentang</a></li>
                <li class="search-container">
                    <input type="search" placeholder="Search" aria-label="Cari" />
                </li>
                <li>
                    @auth
                        <a href="/dashboard"><button class="login-btn" aria-label="Dashboard">Dashboard</button></a>
                    @else
                        <a href="/login"><button class="login-btn" aria-label="Login">Login</button></a>
                    @endauth
                </li>
            </ul>
        </nav>
    </header>

    <!-- Status Alert -->
    @if($car->status != 'tersedia')
        <div class="status-alert {{ $car->status }}">
            <strong>Perhatian:</strong> Mobil saat ini 
            @if($car->status == 'disewa')
                sedang disewa
            @else
                dalam perawatan
            @endif
        </div>
    @endif

    <!-- mobil Section -->
    <main>
        <section class="product-detail" aria-label="Detail mobil {{ $car->merk }} {{ $car->model }}">
            <div class="car-image">
                <img src="{{ asset($car->gambar) }}" 
                     alt="{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}"
                     onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />
            </div>
            
            <div class="car-info" aria-labelledby="carTitle">
                <h1 id="carTitle">{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}</h1>

                <!-- Status Badge -->
                <div class="status-badge {{ $car->status }}">
                    {{ ucfirst($car->status) }}
                </div>

                <div class="meta-icons" aria-label="Spesifikasi utama mobil">
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M12 2L3 7v10l9 5 9-5V7l-9-5z" fill="none" stroke-width="2"/>
                        </svg>
                        {{ ucfirst($car->transmisi ?? 'Manual') }}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M17 8h1a4 4 0 110 8h-1M3 8h10v8H3z" fill="none" stroke-width="2"/>
                        </svg>
                        {{ $car->tahun }}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M17 8h1a4 4 0 110 8h-1M3 8h10v8H3z" fill="none" stroke-width="2"/>
                        </svg>
                        {{ $car->kapasitas_penumpang }} Penumpang
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" fill="none" stroke-width="2"/>
                        </svg>
                        {{ $car->warna ?? 'Various' }}
                    </span>
                </div>

                <!-- Additional Specifications -->
                <div class="specifications">
                    <h3>Spesifikasi Teknis</h3>
                    <div class="spec-grid">
                        <div><strong>No. Polisi:</strong> {{ $car->no_polisi }}</div>
                        <div><strong>No. Rangka:</strong> {{ $car->no_rangka ?? '-' }}</div>
                        <div><strong>No. Mesin:</strong> {{ $car->no_mesin ?? '-' }}</div>
                        <div><strong>STNK Atas Nama:</strong> {{ $car->stnk_atas_nama ?? '-' }}</div>
                    </div>
                </div>

                <div class="price-section" aria-live="polite" aria-atomic="true">
                    <span class="price-label">Harga Sewa</span><br>
                    <strong id="priceDisplay" class="price-amount">
                        Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}
                    </strong> 
                    <span class="price-period">/ hari</span>
                </div>

                @if($car->status == 'tersedia')
                    <a href="{{ route('form.booking', $car->id) }}" class="rent-button">
                        Sewa Sekarang
                    </a>
                @else
                    <button class="rent-button disabled" disabled>
                        @if($car->status == 'disewa')
                            Sedang Disewa
                        @else
                            Dalam Perawatan
                        @endif
                    </button>
                    <p class="availability-notice">
                        Silakan hubungi kami untuk informasi ketersediaan lebih lanjut.
                    </p>
                @endif

                <!-- Quick Contact -->
                <div class="quick-contact">
                    <p>Butuh bantuan? Hubungi kami:</p>
                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20{{ $car->merk }}%20{{ $car->model }}" 
                       class="whatsapp-contact" target="_blank">
                        <img src="{{ asset('img/whatsapp.png') }}" alt="WhatsApp" style="width: 20px; margin-right: 8px;">
                        Chat via WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Bagian Tab -->
    <div class="bungkus-tab">
        <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'deskripsi')">Deskripsi</button>
            <button class="tab-button" onclick="openTab(event, 'fasilitas')">Fasilitas</button>
            <button class="tab-button" onclick="openTab(event, 'syarat')">Syarat & Ketentuan</button>
            <button class="tab-button" onclick="openTab(event, 'kebijakan')">Kebijakan</button>
        </div>

        <!-- Isi Konten Tab -->
        <div id="deskripsi" class="tab-content active">
            <div style="white-space: pre-line;">{{ $car->deskripsi}}</div>
        </div>

        <div id="fasilitas" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->fasilitas ?? 'Informasi fasilitas tidak tersedia.' }}</div>
        </div>

        <div id="syarat" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->syarat ?? 'Syarat dan ketentuan tidak tersedia.' }}</div>
        </div>

        <div id="kebijakan" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->kebijakan ?? 'Kebijakan tidak tersedia.' }}</div>
        </div>
    </div>

    <!-- Related Cars -->
    <div class="section-container">
        <div class="lainnya">
            <h3>Mobil Lainnya</h3>
        </div>

        <!-- Cars Listing -->
        <section class="cars-container" aria-label="Daftar mobil lainnya">
            @php
                $relatedCars = \App\Models\Car::where('id', '!=', $car->id)
                    ->where('status', 'tersedia')
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            @endphp

            @foreach($relatedCars as $relatedCar)
                <article class="car-card" aria-label="{{ $relatedCar->merk }} {{ $relatedCar->model }}">
                    <img src="{{ asset($relatedCar->gambar) }}" 
                         alt="{{ $relatedCar->merk }} {{ $relatedCar->model }}"
                         onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />
                    <h3>{{ $relatedCar->merk }} {{ $relatedCar->model }}</h3>
                    <div class="price">Rp{{ number_format($relatedCar->biaya_harian, 0, ',', '.') }}/hari</div>
                    <div class="details">
                        <div><span>Transmisi</span><span>{{ ucfirst($relatedCar->transmisi)}}</span></div>
                        <div><span>Kapasitas</span><span>{{ $relatedCar->kapasitas_penumpang }} Penumpang</span></div>
                    </div>
                    <a href="{{ route('detail.mobil', $relatedCar->id) }}">
                        <button type="button" aria-label="Sewa {{ $relatedCar->merk }} {{ $relatedCar->model }}">
                            Sewa mobil &gt;&gt;
                        </button>
                    </a>
                </article>
            @endforeach
        </section>

        <a href="/DaftarMobil" class="btn-load-more">
            Lihat Semua Mobil &gt;&gt;&gt;
        </a>
    </div>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/6281234567890" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" />
    </a>

    <script>
        function openTab(evt, tabName) {
            // Sembunyikan semua tab-content
            var tabcontent = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove('active');
            }

            // Hapus class "active" dari semua tombol
            var tabbuttons = document.getElementsByClassName("tab-button");
            for (var i = 0; i < tabbuttons.length; i++) {
                tabbuttons[i].classList.remove("active");
            }

            // Tampilkan tab yang dipilih
            document.getElementById(tabName).classList.add('active');
            evt.currentTarget.classList.add("active");
        }

        function changeMainImage(src) {
            document.querySelector('.car-image img').src = src;
        }

        // Initialize first tab as active
        document.addEventListener('DOMContentLoaded', function() {
            openTab(event, 'deskripsi');
        });
    </script>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <a href="/" class="footer-logo" aria-label="Rental Mobil Indramayu">
                    <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="logo kawa rental mobil" />
                </a>
                <small>©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by <a
                        href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer"
                        style="color:#00b894;">www.polindra.ac.id</a></small>
            </div>
            <div class="footer-col">
                <h4>Media Sosial</h4>
                <div class="social-icons" role="navigation" aria-label="Media sosial">
                    <a href="#"><img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram"
                            style="width:24px"></a>
                    <a href="#"><img src="{{ asset('img/fb.png') }}" alt="Facebook"
                            style="width:24px"></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <div class="contact-info">
                    <div>+62 1234 5678 910</div>
                    <div>+62 1234 5678 910</div>
                    <div>+62 1234 5678 910</div>
                </div>
            </div>
            <div class="footer-col">
                <h4>Alamat</h4>
                <address>
                    Jl. Raya Lohbener No.08,<br />
                    Lohbener, Kec. Indramayu,<br />
                    Kabupaten Indramayu, Jawa Barat 45252
                </address>
            </div>
        </div>
    </footer>
</body>

</html>