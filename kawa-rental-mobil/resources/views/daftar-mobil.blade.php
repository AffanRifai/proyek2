<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Mobil - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}" />
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
        <a href="#" class="logo">
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
                <li><a href="/login"><button class="login-btn" aria-label="Login">Login</button></a></li>
            </ul>
        </nav>
    </header>

    <!-- Banner Section -->
    <section class="banner" aria-label="Rental mobil cepat dan aman">
        <img src="{{ asset('img/kawa-banner.png') }}" alt="banner kawa rental mobil" />
    </section>

    <h1 style="align-items: center; justify-content: center; margin: 30px 0px 20px 20px; text-align: center;">Daftar
        Mobil</h1>

    <!-- Cars Listing -->
    <section class="cars-container" aria-label="Daftar mobil tersedia" id="daftar-mobil">

        <!-- Mobilio Manual -->
        @foreach ($cars as $car)
            <article class="car-card" aria-label="Mobilio Manual, harga 400 ribu per hari">
                <img src="{{ asset($car->gambar) }}" alt="{{ $car->merk }}" />
                <h3>{{ $car->merk }} {{ $car->model }}</h3>
                <div class="price">Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}/hari</div>
                <div class="details">
                    <div><span>Sistem</span><span>Lepas Kunci</span></div>
                    <div><span>Tipe</span><span>Manual</span></div>
                </div>
                <a href="{{ route('detail.mobil', $car->id) }}"><button type="button"
                        aria-label="Sewa Mobilio Manual">Sewa mobil
                        &gt;&gt;</button></a>
            </article>
        @endforeach
    </section>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/62812345678910" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="/kawa-rental-mobil/public/img/wa.png" alt="WhatsApp" />
    </a>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <a href="#" class="footer-logo" aria-label="Rental Mobil Indramayu">
                    <img src="/kawa-rental-mobil/public/img/logo-kawa-stroke2.png" alt="logo kawa rental mobil" />
                </a>
                <small>©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by <a
                        href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer"
                        style="color:#00b894;">www.polindra.ac.id</a></small>
            </div>
            <div class="footer-col">
                <h4>Media Sosial</h4>
                <div class="social-icons" role="navigation" aria-label="Media sosial">
                    <a href="#"><img src="/kawa-rental-mobil/public/img/instagram-icon.png" alt="Instagram"
                            style="width:24px"></a>
                    <a href="#"><img src="/kawa-rental-mobil/public/img/fb.png" alt="Facebook"
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
