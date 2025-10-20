@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@section('content')
    <!-- Banner Section -->
    <section class="banner" aria-label="Rental mobil cepat dan aman">
        <img src="{{ asset('img/kawa-banner.png') }}" alt="banner kawa rental mobil" />
    </section>

    <!-- Welcome Section -->
    <section class="welcome" aria-label="Selamat datang">
        <h2>SELAMAT DATANG</h2>
        <div class="welcome-content">
            <div class="welcome-left">
                <img src="{{ asset('/img/desain mobil.png') }}" alt="Berbagai mobil rental" />
            </div>
            <div class="welcome-right">
                <p><strong>Jasa Rental / Sewa Mobil Harian Terdekat di Indramayu (Dengan Sopir / Lepas Kunci)</strong>
                </p>
                <p>Rental Mobil Indramayu merupakan perusahaan yang bergerak dalam bidang layanan jasa rental mobil
                    terbaik dan terkemuka di Indramayu. Kami menyewakan beragam pilihan armada berkualitas dengan harga
                    yang terjangkau, baik untuk sewa mobil lepas kunci ataupun dengan sopir (driver).</p>
                <p>Tim kami terdiri dari tenaga profesional berpengalaman yang siap memberikan layanan sewa mobil
                    berkualitas dengan harga kompetitif. Dengan tim yang ramah dan responsif, kami akan memastikan Anda
                    memperoleh pengalaman perjalanan yang nyaman, aman, dan memuaskan.</p>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan -->
    <section class="fitur-unggulan" aria-label="Keunggulan layanan">
        <div class="fitur-list">
            <div class="fitur-item">
                <span class="fitur-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#A62F19"
                        viewBox="0 0 640 640">
                        <path
                            d="M147 170.7L117.2 256L240.1 256L240.1 160L162.2 160C155.4 160 149.3 164.3 147.1 170.7zM48.6 257.9L86.5 149.6C97.8 117.5 128.1 96 162.1 96L360 96C385.2 96 408.9 107.9 424 128L520.2 256.3C587.1 260.5 640 316.1 640 384L640 400C640 435.3 611.3 464 576 464L559.6 464C555.6 508.9 517.9 544 472 544C426.1 544 388.4 508.9 384.4 464L239.7 464C235.7 508.9 198 544 152.1 544C106.2 544 68.5 508.9 64.5 464L64.1 464C28.8 464 .1 435.3 .1 400L.1 320C.1 289.9 20.8 264.7 48.7 257.9zM440 256L372.8 166.4C369.8 162.4 365 160 360 160L288 160L288 256L440 256zM152 496C174.1 496 192 478.1 192 456C192 433.9 174.1 416 152 416C129.9 416 112 433.9 112 456C112 478.1 129.9 496 152 496zM512 456C512 433.9 494.1 416 472 416C449.9 416 432 433.9 432 456C432 478.1 449.9 496 472 496C494.1 496 512 478.1 512 456z" />
                    </svg>
                </span>
                <h3>Armada Terbaru</h3>
                <p>Mobil selalu dalam kondisi.</p>
                <p>prima dan bersih.</p>
            </div>
            <div class="fitur-item">
                <span class="fitur-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#A62F19"
                        class="bi bi-person-check-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                </span>
                <h3>Driver Berpengalaman</h3>
                <p>Supir ramah, profesional</p>
                <p>dan berpengalaman</p>
            </div>
            <div class="fitur-item">
                <span class="fitur-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#A62F19"
                        class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                        <path
                            d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                        <path
                            d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                    </svg>
                </span>
                <h3>Harga Transparan</h3>
                <p>Tanpa biaya tersembunyi</p>
                <p>harga jelas di awal</p>
            </div>
        </div>
    </section>


    <!-- mobil -->
    <section class="hero">
        <!-- Bagian kiri -->
        <div class="hero-left">
            <!-- Logo Perusahaan -->
            <div class="logo-bawah">
                <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="Logo Perusahaan">
            </div>

            <div class="hero-text">
                <h2>KAWA Rental</h2>
                <h2>Indramayu</h2>
                <p>Jasa Rental Mobil Indramayu Terdekat</p>
                <p class="website">kawarental.com</p>
            </div>
        </div>

        <!-- Bagian mobil -->
        <div class="hero-center">
            <img src="{{ asset('/img/new-avanza.png') }}" alt="Mobil Rocky">
        </div>

        <!-- Bagian kanan -->
        <div class="hero-right">
            <h1>RENTAL</h1>
            <h4>Mobil terpopuler Indramayu</h4>
            <p>Booking sekarang juga dan dapatkan harga spesial untuk Anda!</p>
            <a href="/DaftarMobil" class="btn">LIHAT MOBIL</a>
        </div>
    </section>

    <!-- Cars Listing -->
    <section class="cars-container" aria-label="Daftar mobil tersedia">

        <article class="car-card" aria-label="Mobil Mobilio Manual">
            <img src="{{ asset('img/mobilio.png') }}" alt="Mobilio Manual" />
            <h3>Mobilio Manual</h3>
            <div class="price">Harga 400.000 / hari</div>
            <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Manual</span></div>
            </div>
            <a href="/bookingmobiliomanual"><button type="button" aria-label="Sewa Mobilio Manual">Sewa mobil
                    &gt;&gt;</button></a>
        </article>

        <article class="car-card" aria-label="Mobil Brio Matic">
            <img src="{{ asset('img/briomatic.png') }}" alt="Mobil Brio Matic" />
            <h3>Brio Matic</h3>
            <div class="price">Harga 400.000 / hari</div>
            <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Matic</span></div>
            </div>
            <a href="/bookingbriomatic"><button type="button" aria-label="Sewa mobil Brio Matic">Sewa mobil
                    &gt;&gt;</button></a>
        </article>

        <article class="car-card" aria-label="Mobil Brio Manual">
            <img src="{{ asset('img/Brio.png') }}" alt="Mobil Brio Manual" />
            <h3>Brio Manual</h3>
            <div class="price">Harga 350.000 / hari</div>
            <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Manual</span></div>
            </div>
            <a href="/bookingavanzaautomatic"><button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil
                    &gt;&gt;</button></a>
        </article>

    </section>

    <a href="/DaftarMobil"><button class="btn-load-more" type="button" aria-label="Selengkapnya">Selengkapnya
            &gt;&gt;&gt;</button></a>
    </div>


    <!-- Testimoni -->
    <h2>Testimoni pelanggan Kami</h2>

    <section class="testimoni" aria-label="Testimoni pelanggan">
        <div class="testimoni-foto-list">
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 1" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 2" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 3" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 4" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 5" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 6" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 7" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 8" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 9" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 10" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 11" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 12" />
        </div>
    </section>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/62812345678910" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="{{ asset('/img/whatsapp.png') }}" alt="WhatsApp" />
    </a>
@endsection
