@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/landingpage.css') }}">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Banner Section -->
    <section class="banner" aria-label="Rental mobil cepat dan aman" data-aos="fade-up" data-aos-duration="800"
        data-aos-once="false">
        <img src="{{ asset('img/kawa-banner.png') }}" alt="banner kawa rental mobil" />
    </section>

    <!-- Welcome Section -->
    <section class="welcome" aria-label="Selamat datang" data-aos="fade-up" data-aos-duration="1000" data-aos-once="false">
        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-once="false">SELAMAT DATANG</h2>
        <div class="welcome-content">
            <div class="welcome-left" data-aos="fade-right" data-aos-delay="300" data-aos-once="false">
                <img src="{{ asset('/img/desain mobil.png') }}" alt="Berbagai mobil rental" />
            </div>
            <div class="welcome-right" data-aos="fade-left" data-aos-delay="400" data-aos-once="false">
                <strong>Jasa Rental / Sewa Mobil Harian Terdekat di Indramayu (Dengan Sopir / Lepas Kunci)</strong>
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
    <section class="fitur-unggulan" aria-label="Keunggulan layanan" data-aos="fade-up" data-aos-duration="1000"
        data-aos-once="false">
        <div class="fitur-list">
            <div class="fitur-item" data-aos="zoom-in" data-aos-delay="200" data-aos-once="false">
                <span class="fitur-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#A62F19"
                        viewBox="0 0 640 640">
                        <path
                            d="M147 170.7L117.2 256L240.1 256L240.1 160L162.2 160C155.4 160 149.3 164.3 147.1 170.7zM48.6 257.9L86.5 149.6C97.8 117.5 128.1 96 162.1 96L360 96C385.2 96 408.9 107.9 424 128L520.2 256.3C587.1 260.5 640 316.1 640 384L640 400C640 435.3 611.3 464 576 464L559.6 464C555.6 508.9 517.9 544 472 544C426.1 544 388.4 508.9 384.4 464L239.7 464C235.7 508.9 198 544 152.1 544C106.2 544 68.5 508.9 64.5 464L64.1 464C28.8 464 .1 435.3 .1 400L.1 320C.1 289.9 20.8 264.7 48.7 257.9z" />
                    </svg>
                </span>
                <h3>Armada Terbaru</h3>
                <p>Mobil selalu dalam kondisi.</p>
                <p>prima dan bersih.</p>
            </div>
            <div class="fitur-item" data-aos="zoom-in" data-aos-delay="300" data-aos-once="false">
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
            <div class="fitur-item" data-aos="zoom-in" data-aos-delay="400" data-aos-once="false">
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
    <section class="hero" data-aos="fade-up" data-aos-duration="1000" data-aos-once="false">
        <!-- Bagian kiri -->
        <div class="hero-left" data-aos="fade-right" data-aos-delay="200" data-aos-once="false">
            <!-- Logo Perusahaan -->
            <div class="logo-bawah">
                <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="Logo Perusahaan">
            </div>

            <div class="hero-text">
                <h2>KAWA Rental Indramayu</h2>
                {{-- <h2>Indramayu</h2> --}}
                <p>Jasa Rental Mobil Indramayu Terdekat</p>
                <p class="website">kawarental.com</p>
            </div>
        </div>

        <!-- Bagian mobil -->
        <div class="hero-center" data-aos="zoom-in" data-aos-delay="300" data-aos-once="false">
            <img src="{{ asset('/img/new-avanza.png') }}" alt="Mobil Rocky">
        </div>

        <!-- Bagian kanan -->
        <div class="hero-right" data-aos="fade-left" data-aos-delay="400" data-aos-once="false">
            <h1>RENTAL</h1>
            <h4>Mobil terpopuler Indramayu</h4>
            <p>Booking sekarang juga dan dapatkan harga spesial untuk Anda!</p>
            <a href="/daftar-mobil" class="btn">LIHAT MOBIL</a>
        </div>
    </section>

    <!-- Cars Listing -->
    <section class="cars-container" aria-label="Daftar mobil tersedia" id="daftar-mobil" data-aos="fade-up"
        data-aos-duration="1000" data-aos-once="false">
        <div class="section-header">
            <h2 data-aos="fade-up" data-aos-delay="100" data-aos-once="false">KATALOG MOBIL</h2>
            <div class="slider-nav-indicators" data-aos="fade-up" data-aos-delay="200" data-aos-once="false">
                <button class="custom-prev-btn" aria-label="Previous slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="slide-counter">
                    <span class="current-slide">1</span> / <span class="total-slides">5</span>
                </div>
                <button class="custom-next-btn" aria-label="Next slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        @if (isset($cars) && $cars->count() > 0)
            @php
                $cars = \App\Models\Car::inRandomOrder()->take(3)->get();
            @endphp

            @foreach ($cars as $index => $car)
                <article class="car-card" data-merk="{{ strtolower($car->merk) }}"
                    data-transmisi="{{ strtolower($car->transmisi) }}" data-harga="{{ $car->biaya_harian }}"
                    aria-label="{{ $car->merk }} {{ $car->model }}, harga {{ number_format($car->biaya_harian, 0, ',', '.') }} per hari"
                    data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 + 300 }}" data-aos-once="false">

                    <!-- Status Badge -->
                    <div class="status-badge {{ $car->status }}">
                        {{ ucfirst($car->status) }}
                    </div>

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

                    <a href="{{ route('detail.mobil', $car->id) }}">
                        <button type="button" aria-label="Sewa {{ $car->merk }} {{ $car->model }}">
                            Sewa Sekarang &gt;&gt;
                        </button>
                    </a>
                </article>
            @endforeach
        @elseif(isset($cars) && $cars->count() == 0)
            <div class="no-cars" data-aos="fade-up" data-aos-once="false">
                <p>Tidak ada mobil tersedia saat ini.</p>
            </div>
        @else
            <div class="no-cars" data-aos="fade-up" data-aos-once="false">
                <p>Daftar mobil belum tersedia di halaman ini.</p>
            </div>
        @endif
    </section>

    <a href="/daftar-mobil" data-aos="fade-up" data-aos-delay="500" data-aos-once="false">
        <button class="btn-load-more" type="button" aria-label="Selengkapnya">LIhat Mobil
            Selengkapnya
            &gt;&gt;&gt;</button>
    </a>


    <!-- Testimoni -->

    <section class="testimoni" aria-label="Testimoni pelanggan" data-aos="fade-up" data-aos-duration="1000"
        data-aos-once="false">
        <h2 data-aos="fade-up" data-aos-delay="200" data-aos-once="false">Testimoni pelanggan Kami</h2>
        <div class="testimoni-foto-list">
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 1" data-aos="zoom-in" data-aos-delay="300"
                data-aos-once="false" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 2" data-aos="zoom-in" data-aos-delay="350"
                data-aos-once="false" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 3" data-aos="zoom-in" data-aos-delay="400"
                data-aos-once="false" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 4" data-aos="zoom-in" data-aos-delay="450"
                data-aos-once="false" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 5" data-aos="zoom-in" data-aos-delay="500"
                data-aos-once="false" />
            <img src="{{ asset('img/pelanggan1.jpg') }}" alt="Pelanggan 6" data-aos="zoom-in" data-aos-delay="550"
                data-aos-once="false" />

        </div>
    </section>


    <!-- SWIPER JS UNTUK 3D COVERFLOW EFFECT HANYA DI MOBILE -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

            // Rest of your existing script for swiper...
            const carsContainer = document.querySelector('.cars-container');
            if (!carsContainer) return;

            // Hanya jalankan di mobile
            if (window.innerWidth <= 768) {
                initModernSwiper();
            }

            // Handle resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    if (window.innerWidth <= 768 && !carsContainer.classList.contains(
                            'swiper-initialized')) {
                        initModernSwiper();
                    } else if (window.innerWidth > 768 && carsContainer.classList.contains(
                            'swiper-initialized')) {
                        window.location.reload();
                    }
                }, 300);
            });

            function initModernSwiper() {
                const carCards = carsContainer.querySelectorAll('.car-card');
                if (carCards.length === 0) return;

                // Update slide counter
                const currentSlideEl = document.querySelector('.current-slide');
                const totalSlidesEl = document.querySelector('.total-slides');
                if (totalSlidesEl) {
                    totalSlidesEl.textContent = carCards.length;
                }

                // Buat struktur swiper
                const sectionHeader = carsContainer.querySelector('.section-header');
                const swiperHTML = `
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    ${Array.from(carCards).map((card, index) => `
                                    <div class="swiper-slide" data-index="${index + 1}">
                                        ${card.outerHTML}
                                    </div>
                                `).join('')}
                </div>
                <!-- Modern pagination -->
                <div class="swiper-pagination"></div>
                <!-- Auto-play progress bar -->
                <div class="swiper-autoplay-progress">
                    <div class="swiper-autoplay-progress-bar"></div>
                </div>
            </div>
        `;

                // Simpan header
                const headerHTML = sectionHeader ? sectionHeader.outerHTML : '';

                // Clear container
                carsContainer.innerHTML = '';

                // Tambah kembali header
                if (sectionHeader) {
                    carsContainer.insertAdjacentHTML('beforeend', headerHTML);
                }

                // Tambah swiper
                carsContainer.insertAdjacentHTML('beforeend', swiperHTML);

                // Add swiper class
                carsContainer.classList.add('swiper-initialized');

                // Initialize Swiper dengan efek modern
                const swiper = new Swiper('.swiper-container', {
                    // Efek coverflow modern
                    effect: 'coverflow',
                    grabCursor: true,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    initialSlide: Math.floor(carCards.length / 2),
                    spaceBetween: 10,

                    // Modern coverflow settings
                    coverflowEffect: {
                        rotate: 0,
                        stretch: -80,
                        depth: 100,
                        modifier: 1.5,
                        slideShadows: false,
                    },

                    // Auto play dengan progress bar
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    // Pagination modern
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: false,
                        renderBullet: function(index, className) {
                            return `<span class="${className}"></span>`;
                        },
                    },

                    // Speed dan easing
                    speed: 600,
                    followFinger: true,
                    resistanceRatio: 0.7,

                    // Loop
                    loop: carCards.length > 2,

                    // Breakpoints untuk responsif
                    breakpoints: {
                        320: {
                            coverflowEffect: {
                                rotate: 0,
                                stretch: -100,
                                depth: 80,
                                modifier: 1.5,
                            },
                            spaceBetween: 5,
                        },
                        480: {
                            coverflowEffect: {
                                rotate: 0,
                                stretch: -80,
                                depth: 100,
                                modifier: 1.5,
                            },
                            spaceBetween: 10,
                        },
                        768: {
                            coverflowEffect: {
                                rotate: 0,
                                stretch: -60,
                                depth: 120,
                                modifier: 1.5,
                            },
                            spaceBetween: 15,
                        }
                    },

                    // Event listeners untuk efek modern
                    on: {
                        init: function() {
                            this.el.classList.add('swiper-initialized');
                            updateSlideCounter(this);
                            startProgressBar(this);
                        },
                        slideChange: function() {
                            updateSlideCounter(this);
                            updateActiveSlideEffect(this);
                        },
                        autoplayTimeLeft: function(swiper, time, progress) {
                            const progressBar = document.querySelector('.swiper-autoplay-progress-bar');
                            if (progressBar) {
                                progressBar.style.width = `${progress * 100}%`;
                            }
                        },
                        touchStart: function() {
                            // Pause autoplay saat interaksi
                            swiper.autoplay.stop();
                            document.querySelector('.swiper-autoplay-progress')?.classList.add(
                                'paused');
                        },
                        touchEnd: function() {
                            // Resume setelah 3 detik
                            setTimeout(() => {
                                swiper.autoplay.start();
                                document.querySelector('.swiper-autoplay-progress')?.classList
                                    .remove('paused');
                            }, 3000);
                        }
                    }
                });

                // Fungsi update slide counter
                function updateSlideCounter(swiperInstance) {
                    const currentSlideEl = document.querySelector('.current-slide');
                    if (currentSlideEl) {
                        const realIndex = swiperInstance.realIndex + 1;
                        currentSlideEl.textContent = realIndex;
                    }
                }

                // Fungsi update efek slide aktif
                function updateActiveSlideEffect(swiperInstance) {
                    const slides = swiperInstance.slides;
                    const activeIndex = swiperInstance.activeIndex;

                    slides.forEach((slide, index) => {
                        // Reset semua slide
                        slide.style.zIndex = 10;
                        slide.style.transitionDelay = '0s';

                        // Set slide aktif
                        if (index === activeIndex) {
                            slide.style.zIndex = 20;
                            slide.style.transitionDelay = '0.1s';
                        }
                        // Slide sebelumnya dan berikutnya
                        else if (index === activeIndex - 1 || index === activeIndex + 1) {
                            slide.style.zIndex = 15;
                            slide.style.transitionDelay = '0.05s';
                        }
                    });
                }

                // Fungsi progress bar autoplay
                function startProgressBar(swiperInstance) {
                    const progressBar = document.querySelector('.swiper-autoplay-progress-bar');
                    if (progressBar && swiperInstance.autoplay.running) {
                        progressBar.style.width = '100%';
                        progressBar.style.transition = `width ${swiperInstance.params.autoplay.delay}ms linear`;
                        setTimeout(() => {
                            progressBar.style.width = '0%';
                        }, 100);
                    }
                }

                // Custom button controls
                const prevBtn = document.querySelector('.custom-prev-btn');
                const nextBtn = document.querySelector('.custom-next-btn');

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        swiper.slidePrev();
                        // Reset progress bar
                        startProgressBar(swiper);
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        swiper.slideNext();
                        // Reset progress bar
                        startProgressBar(swiper);
                    });
                }

                // Update initial state
                updateSlideCounter(swiper);
                updateActiveSlideEffect(swiper);
                startProgressBar(swiper);
            }
        });
    </script>
@endsection
