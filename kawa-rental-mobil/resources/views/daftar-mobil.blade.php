<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Mobil - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ secure_asset('css/landingpage.css') }}" />
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
                <li><a href="/DaftarMobil" class="active">Daftar Mobil</a></li>
                <li><a href="/TentangKami">Kontak</a></li>
                <li><a href="/TentangKami">Tentang</a></li>
                <li class="search-container">
                    <input type="search" placeholder="Search" aria-label="Cari" id="searchInput" />
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

    <!-- Banner Section -->
    <section class="banner" aria-label="Rental mobil cepat dan aman">
        <img src="{{ asset('img/kawa-banner.png') }}" alt="banner kawa rental mobil" />
    </section>

    <!-- Page Title -->
    <h1 class="page-title">Daftar Mobil</h1>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="filter-container">
            <div class="filter-field">
                <label for="filterMerk" class="filter-label">Merk</label>
                <select id="filterMerk" class="filter-select">
                    <option value="">Semua Merk</option>
                    @foreach ($cars->pluck('merk')->unique() as $merk)
                        <option value="{{ $merk }}">{{ $merk }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-field">
                <label for="filterTransmisi" class="filter-label">Transmisi</label>
                <select id="filterTransmisi" class="filter-select">
                    <option value="">Semua Transmisi</option>
                    <option value="manual">Manual</option>
                    <option value="automatic">Automatic</option>
                </select>
            </div>

            <div class="filter-field">
                <label for="filterHarga" class="filter-label">Harga</label>
                <select id="filterHarga" class="filter-select">
                    <option value="">Semua Harga</option>
                    <option value="0-300000">≤ Rp 300.000</option>
                    <option value="300001-500000">Rp 300.000 - 500.000</option>
                    <option value="500001-999999999">≥ Rp 500.000</option>
                </select>
            </div>

            <button id="resetFilter" type="button" class="reset-btn" aria-label="Reset filter">Reset Filter</button>
        </div>
    </section>

    <!-- Cars Listing -->
    <section class="cars-container" aria-label="Daftar mobil tersedia" id="daftar-mobil">
        @if ($cars->count() > 0)
            @foreach ($cars as $car)
                {{-- @if ($car->status == 'tersedia') --}}
                    <article class="car-card" data-merk="{{ strtolower($car->merk) }}"
                        data-transmisi="{{ strtolower($car->transmisi) }}" data-harga="{{ $car->biaya_harian }}"
                        aria-label="{{ $car->merk }} {{ $car->model }}, harga {{ number_format($car->biaya_harian, 0, ',', '.') }} per hari">

                        <!-- Status Badge -->


                        <img src="{{ asset($car->gambar) }}"
                            alt="{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}"
                            onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />

                        <h3>{{ $car->merk }} {{ $car->model }}</h3>

                        <div class="price">Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}/hari</div>

                        <div class="details">
                            <div><span>Transmisi</span><span>{{ ucfirst($car->transmisi) }}</span></div>
                            <div><span>Kapasitas</span><span>{{ $car->kapasitas_penumpang }} Penumpang</span></div>
                            <div><span>Tahun</span><span>{{ $car->tahun }}</span></div>
                            <div><span>Warna</span><span>{{ $car->warna ?? 'Various' }}</span></div>
                        </div>

                        <div class="status-badge {{ $car->status }}">
                            {{ ucfirst($car->status) }}
                        </div>

                        <a href="{{ route('detail.mobil', $car->id) }}">
                            <button type="button" aria-label="Sewa {{ $car->merk }} {{ $car->model }}">
                                Sewa Sekarang &gt;&gt;
                            </button>
                        </a>
                    </article>
                {{-- @endif --}}
            @endforeach
        @else
            <div class="no-cars">
                <p>Tidak ada mobil tersedia saat ini.</p>
            </div>
        @endif
    </section>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/62812345678910" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" />
    </a>

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
                    <a href="#"><img src="{{ asset('img/fb.png') }}" alt="Facebook" style="width:24px"></a>
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

    <!-- JavaScript untuk Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterMerk = document.getElementById('filterMerk');
            const filterTransmisi = document.getElementById('filterTransmisi');
            const filterHarga = document.getElementById('filterHarga');
            const resetFilter = document.getElementById('resetFilter');
            const carCards = document.querySelectorAll('.car-card');

            function filterCars() {
                const searchTerm = searchInput.value.toLowerCase();
                const merkValue = filterMerk.value.toLowerCase();
                const transmisiValue = filterTransmisi.value.toLowerCase();
                const hargaValue = filterHarga.value;

                carCards.forEach(card => {
                    const merk = card.dataset.merk;
                    const transmisi = card.dataset.transmisi;
                    const harga = parseInt(card.dataset.harga);
                    const title = card.querySelector('h3').textContent.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesMerk = !merkValue || merk === merkValue;
                    const matchesTransmisi = !transmisiValue || transmisi.includes(transmisiValue);
                    const matchesHarga = !hargaValue || checkPriceRange(harga, hargaValue);

                    if (matchesSearch && matchesMerk && matchesTransmisi && matchesHarga) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            function checkPriceRange(price, range) {
                const [min, max] = range.split('-').map(Number);
                return price >= min && price <= max;
            }

            // Event listeners
            searchInput.addEventListener('input', filterCars);
            filterMerk.addEventListener('change', filterCars);
            filterTransmisi.addEventListener('change', filterCars);
            filterHarga.addEventListener('change', filterCars);

            resetFilter.addEventListener('click', function() {
                searchInput.value = '';
                filterMerk.value = '';
                filterTransmisi.value = '';
                filterHarga.value = '';
                filterCars();
            });
        });
    </script>
</body>

</html>
