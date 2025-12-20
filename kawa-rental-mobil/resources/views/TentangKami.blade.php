@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/tentang-kami.css') }}">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Optimasi AOS -->
    <style>
        /* Optimasi performa AOS */
        [data-aos] {
            transition-duration: 600ms !important;
            transition-timing-function: ease-out !important;
        }

        /* Animasi lebih cepat di mobile */
        @media (max-width: 768px) {
            [data-aos] {
                transition-duration: 500ms !important;
            }
        }
    </style>
@endpush

@section('title', 'Tentang Kami - KAWA Rental Mobil Indramayu')

@section('content')

    <!-- Tentang Kami - Modern Section -->
    <section class="about-section" id="tentang" data-aos="fade-up" data-aos-duration="600" data-aos-offset="50"
        data-aos-once="false">
        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100" data-aos-offset="30" data-aos-once="false">
                <span class="section-subtitle" data-aos="fade-right" data-aos-delay="150" data-aos-offset="30"
                    data-aos-once="false">Tentang Perusahaan</span>
                <h2 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-offset="30"
                    data-aos-once="false">SELAMAT DATANG DI KAWA RENTAL MOBIL</h2>
                <div class="divider" data-aos="zoom-in" data-aos-delay="250" data-aos-offset="30" data-aos-once="false">
                    <div class="divider-line"></div>
                    <div class="divider-icon"><i class="fas fa-car"></i></div>
                    <div class="divider-line"></div>
                </div>
            </div>

            <div class="about-grid">
                <div class="about-image" data-aos="fade-right" data-aos-delay="300" data-aos-offset="60"
                    data-aos-once="false">
                    <div class="image-frame" data-aos="zoom-in" data-aos-delay="350" data-aos-offset="60"
                        data-aos-once="false">
                        <img src="{{ asset('img/desain mobil.png') }}" alt="Armada Rental Mobil KAWA" class="img-fluid">
                    </div>
                </div>

                <div class="about-content" data-aos="fade-left" data-aos-delay="400" data-aos-offset="60"
                    data-aos-once="false">
                    <h3 data-aos="fade-up" data-aos-delay="450" data-aos-offset="50" data-aos-once="false">Jasa Rental Mobil
                        Terbaik di Indramayu</h3>
                    <p class="lead-text" data-aos="fade-up" data-aos-delay="500" data-aos-offset="50" data-aos-once="false">
                        Kami menyediakan layanan sewa mobil harian dengan armada berkualitas, baik dengan
                        sopir profesional maupun lepas kunci.</p>

                    <div class="features-grid">
                        <div class="feature-item" data-aos="zoom-in" data-aos-delay="550" data-aos-offset="70"
                            data-aos-once="false">
                            <div class="feature-icon" data-aos="flip-left" data-aos-delay="600" data-aos-offset="70"
                                data-aos-once="false">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-text">
                                <h4 data-aos="fade-up" data-aos-delay="650" data-aos-offset="60" data-aos-once="false">
                                    Terpercaya</h4>
                                <p data-aos="fade-up" data-aos-delay="700" data-aos-offset="60" data-aos-once="false">
                                    Layanan terjamin dengan pengalaman lebih dari 10 tahun</p>
                            </div>
                        </div>

                        <div class="feature-item" data-aos="zoom-in" data-aos-delay="750" data-aos-offset="70"
                            data-aos-once="false">
                            <div class="feature-icon" data-aos="flip-left" data-aos-delay="800" data-aos-offset="70"
                                data-aos-once="false">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="feature-text">
                                <h4 data-aos="fade-up" data-aos-delay="850" data-aos-offset="60" data-aos-once="false">
                                    Armada Lengkap</h4>
                                <p data-aos="fade-up" data-aos-delay="900" data-aos-offset="60" data-aos-once="false">
                                    Berbagai pilihan mobil dari ekonomi hingga keluarga</p>
                            </div>
                        </div>

                        <div class="feature-item" data-aos="zoom-in" data-aos-delay="950" data-aos-offset="70"
                            data-aos-once="false">
                            <div class="feature-icon" data-aos="flip-left" data-aos-delay="1000" data-aos-offset="70"
                                data-aos-once="false">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-text">
                                <h4 data-aos="fade-up" data-aos-delay="1050" data-aos-offset="60" data-aos-once="false">
                                    24/7 Support</h4>
                                <p data-aos="fade-up" data-aos-delay="1100" data-aos-offset="60" data-aos-once="false">
                                    Tim profesional siap melayani kapan saja</p>
                            </div>
                        </div>

                        <div class="feature-item" data-aos="zoom-in" data-aos-delay="1150" data-aos-offset="70"
                            data-aos-once="false">
                            <div class="feature-icon" data-aos="flip-left" data-aos-delay="1200" data-aos-offset="70"
                                data-aos-once="false">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="feature-text">
                                <h4 data-aos="fade-up" data-aos-delay="1250" data-aos-offset="60" data-aos-once="false">
                                    Harga Terjangkau</h4>
                                <p data-aos="fade-up" data-aos-delay="1300" data-aos-offset="60" data-aos-once="false">
                                    Tarif kompetitif dengan kualitas terbaik</p>
                            </div>
                        </div>
                    </div>

                    <div class="cta-buttons" data-aos="fade-up" data-aos-delay="1350" data-aos-offset="50"
                        data-aos-once="false">
                        <a href="tel:+6282315836060" class="btn-call" data-aos="zoom-in" data-aos-delay="1400"
                            data-aos-offset="50" data-aos-once="false">
                            <i class="fas fa-phone"></i> Telepon Sekarang
                        </a>
                        <a href="#kontak" class="btn-more" data-aos="zoom-in" data-aos-delay="1450"
                            data-aos-offset="50" data-aos-once="false">
                            <i class="fas fa-info-circle"></i> Informasi Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak & Sosial Media - Modern Design -->
    <section class="contact-section" id="kontak" data-aos="fade-up" data-aos-duration="600" data-aos-offset="50"
        data-aos-once="false">
        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100" data-aos-offset="30"
                data-aos-once="false">
                <span class="section-subtitle" data-aos="fade-right" data-aos-delay="150" data-aos-offset="30"
                    data-aos-once="false">Hubungi Kami</span>
                <h2 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-offset="30"
                    data-aos-once="false">TERHUBUNG DENGAN KAWA RENTAL</h2>
                <div class="divider" data-aos="zoom-in" data-aos-delay="250" data-aos-offset="30"
                    data-aos-once="false">
                    <div class="divider-line"></div>
                    <div class="divider-icon"><i class="fas fa-comments"></i></div>
                    <div class="divider-line"></div>
                </div>
                <p class="section-description" data-aos="fade-up" data-aos-delay="300" data-aos-offset="30"
                    data-aos-once="false">Kami siap membantu kebutuhan transportasi Anda. Hubungi kami melalui berbagai
                    channel yang tersedia.</p>
            </div>

            <div class="contact-grid">
                <!-- Contact Info Card -->
                <div class="contact-card" data-aos="fade-right" data-aos-delay="350" data-aos-offset="60"
                    data-aos-once="false">

                    <div class="contact-info">
                        <div class="info-item" data-aos="fade-up" data-aos-delay="400" data-aos-offset="60"
                            data-aos-once="false">
                            <div class="info-icon" data-aos="flip-left" data-aos-delay="450" data-aos-offset="60"
                                data-aos-once="false">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h4 data-aos="fade-up" data-aos-delay="500" data-aos-offset="50" data-aos-once="false">
                                    Jam Operasional</h4>
                                <p data-aos="fade-up" data-aos-delay="550" data-aos-offset="50" data-aos-once="false">
                                    Setiap Hari, 07.00 – 22.00 WIB</p>
                            </div>
                        </div>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="600" data-aos-offset="60"
                            data-aos-once="false">
                            <div class="info-icon" data-aos="flip-left" data-aos-delay="650" data-aos-offset="60"
                                data-aos-once="false">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h4 data-aos="fade-up" data-aos-delay="700" data-aos-offset="50" data-aos-once="false">
                                    Email</h4>
                                <a href="mailto:prasetyoluckyindra@gmail.com" data-aos="fade-up" data-aos-delay="750"
                                    data-aos-offset="50" data-aos-once="false">prasetyoluckyindra@gmail.com</a>
                            </div>
                        </div>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="800" data-aos-offset="60"
                            data-aos-once="false">
                            <div class="info-icon" data-aos="flip-left" data-aos-delay="850" data-aos-offset="60"
                                data-aos-once="false">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="info-content">
                                <h4 data-aos="fade-up" data-aos-delay="900" data-aos-offset="50" data-aos-once="false">
                                    Telepon / WhatsApp</h4>
                                <a href="https://wa.me/6282315836060" target="_blank" data-aos="fade-up"
                                    data-aos-delay="950" data-aos-offset="50" data-aos-once="false">+62 823-1583-6060</a>
                            </div>
                        </div>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="1000" data-aos-offset="60"
                            data-aos-once="false">
                            <div class="info-icon" data-aos="flip-left" data-aos-delay="1050" data-aos-offset="60"
                                data-aos-once="false">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h4 data-aos="fade-up" data-aos-delay="1100" data-aos-offset="50" data-aos-once="false">
                                    Alamat Kantor</h4>
                                <p data-aos="fade-up" data-aos-delay="1150" data-aos-offset="50" data-aos-once="false">
                                    Jl. Raya Lohbener No.08, Lohbener, Indramayu, Jawa Barat 45252</p>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/6282315836060" target="_blank" class="whatsapp-btn" data-aos="zoom-in"
                        data-aos-delay="1200" data-aos-offset="50" data-aos-once="false">
                        <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                    </a>
                </div>

                <!-- Instagram Card with Profile Preview -->
                <div class="instagram-card" data-aos="fade-left" data-aos-delay="1250" data-aos-offset="60"
                    data-aos-once="false">

                    <!-- Embedded Instagram Feed (Fallback/Alternative) -->
                    <div class="instagram-embed-container" data-aos="zoom-in" data-aos-delay="1300" data-aos-offset="60"
                        data-aos-once="false">
                        <div class="embed-header" data-aos="fade-up" data-aos-delay="1350" data-aos-offset="50"
                            data-aos-once="false">
                            <h5 data-aos="fade-up" data-aos-delay="1400" data-aos-offset="50" data-aos-once="false">
                                Instagram Kami</h5>
                            <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank" class="see-all"
                                data-aos="fade-up" data-aos-delay="1450" data-aos-offset="50" data-aos-once="false">
                                Kunjungi <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="embed-content" data-aos="fade-up" data-aos-delay="1500" data-aos-offset="50"
                            data-aos-once="false">
                            <div class="instagram-embed" data-aos="zoom-in" data-aos-delay="1550" data-aos-offset="50"
                                data-aos-once="false">
                                <iframe src="https://www.instagram.com/kawarentalmobilindramayu/embed" frameborder="0"
                                    scrolling="no" allowtransparency="true" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Maps - Modern Design -->
    <section class="location-section" id="lokasi" data-aos="fade-up" data-aos-duration="600" data-aos-offset="50"
        data-aos-once="false">
        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100" data-aos-offset="30"
                data-aos-once="false">
                <span class="section-subtitle" data-aos="fade-right" data-aos-delay="150" data-aos-offset="30"
                    data-aos-once="false">Lokasi Kami</span>
                <h2 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-offset="30"
                    data-aos-once="false">KUNJUNGI KANTOR KAMI</h2>
                <div class="divider" data-aos="zoom-in" data-aos-delay="250" data-aos-offset="30"
                    data-aos-once="false">
                    <div class="divider-line"></div>
                    <div class="divider-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="divider-line"></div>
                </div>
            </div>

            <div class="location-content">
                <div class="location-info" data-aos="fade-right" data-aos-delay="300" data-aos-offset="60"
                    data-aos-once="false">
                    <div class="info-card" data-aos="zoom-in" data-aos-delay="350" data-aos-offset="60"
                        data-aos-once="false">
                        <h3 data-aos="fade-up" data-aos-delay="400" data-aos-offset="50" data-aos-once="false"><i
                                class="fas fa-directions"></i> Petunjuk Arah</h3>
                        <p data-aos="fade-up" data-aos-delay="450" data-aos-offset="50" data-aos-once="false">Kantor
                            kami mudah diakses dari pusat kota Indramayu. Tersedia area parkir yang luas untuk
                            kenyamanan Anda.</p>
                        <div class="location-details">
                            <p data-aos="fade-up" data-aos-delay="500" data-aos-offset="50" data-aos-once="false"><i
                                    class="fas fa-car"></i> <strong>Akses Jalan:</strong> Jalan utama, mudah ditemukan</p>
                            <p data-aos="fade-up" data-aos-delay="550" data-aos-offset="50" data-aos-once="false"><i
                                    class="fas fa-parking"></i> <strong>Parkir:</strong> Tersedia area parkir luas</p>
                            <p data-aos="fade-up" data-aos-delay="600" data-aos-offset="50" data-aos-once="false"><i
                                    class="fas fa-clock"></i> <strong>Buka:</strong> Setiap hari 07.00-22.00 WIB</p>
                        </div>
                        <a href="https://maps.google.com/?q=KAWA+Rental+Mobil+Indramayu" target="_blank"
                            class="direction-btn" data-aos="zoom-in" data-aos-delay="650" data-aos-offset="50"
                            data-aos-once="false">
                            <i class="fas fa-route"></i> Dapatkan Petunjuk Arah
                        </a>
                    </div>
                </div>

                <div class="location-map" data-aos="fade-left" data-aos-delay="700" data-aos-offset="60"
                    data-aos-once="false">
                    <div class="map-container" data-aos="zoom-in" data-aos-delay="750" data-aos-offset="60"
                        data-aos-once="false">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.5863694125546!2d108.32435097355598!3d-6.330794161941888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9ca923dd847%3A0xbf99f1269728baa3!2sKAWA%20Rental%20Mobil%20Indramayu!5e1!3m2!1sid!2sid!4v1760671679708!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section" data-aos="fade-up" data-aos-duration="600" data-aos-offset="50"
        data-aos-once="false">
        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100" data-aos-offset="30"
                data-aos-once="false">
                <span class="section-subtitle" data-aos="fade-right" data-aos-delay="150" data-aos-offset="30"
                    data-aos-once="false">Testimoni Pelanggan</span>
                <h2 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-offset="30"
                    data-aos-once="false">KATA MEREKA TENTANG KAMI</h2>
                <div class="divider" data-aos="zoom-in" data-aos-delay="250" data-aos-offset="30"
                    data-aos-once="false">
                    <div class="divider-line"></div>
                    <div class="divider-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-line"></div>
                </div>
            </div>

            <div class="testimonial-grid">
                <div class="testimonial-card" data-aos="fade-right" data-aos-delay="300" data-aos-offset="60"
                    data-aos-once="false">
                    <div class="testimonial-content" data-aos="fade-up" data-aos-delay="350" data-aos-offset="50"
                        data-aos-once="false">
                        <p data-aos="fade-up" data-aos-delay="400" data-aos-offset="50" data-aos-once="false">"Pelayanan
                            sangat memuaskan, mobil bersih dan sopirnya ramah. Recommended untuk rental di
                            Indramayu!"</p>
                    </div>
                    <div class="testimonial-author" data-aos="fade-up" data-aos-delay="450" data-aos-offset="50"
                        data-aos-once="false">
                        <div class="author-info">
                            <h4 data-aos="fade-up" data-aos-delay="500" data-aos-offset="50" data-aos-once="false">Budi
                                Santoso</h4>
                            <span data-aos="fade-up" data-aos-delay="550" data-aos-offset="50"
                                data-aos-once="false">Pelanggan Regular</span>
                        </div>
                        <div class="rating" data-aos="zoom-in" data-aos-delay="600" data-aos-offset="50"
                            data-aos-once="false">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-left" data-aos-delay="650" data-aos-offset="60"
                    data-aos-once="false">
                    <div class="testimonial-content" data-aos="fade-up" data-aos-delay="700" data-aos-offset="50"
                        data-aos-once="false">
                        <p data-aos="fade-up" data-aos-delay="750" data-aos-offset="50" data-aos-once="false">"Harga
                            kompetitif, armada lengkap, dan proses sewa yang mudah. Sudah beberapa kali sewa untuk
                            keperluan keluarga."</p>
                    </div>
                    <div class="testimonial-author" data-aos="fade-up" data-aos-delay="800" data-aos-offset="50"
                        data-aos-once="false">
                        <div class="author-info">
                            <h4 data-aos="fade-up" data-aos-delay="850" data-aos-offset="50" data-aos-once="false">Sari
                                Dewi</h4>
                            <span data-aos="fade-up" data-aos-delay="900" data-aos-offset="50"
                                data-aos-once="false">Pelanggan Keluarga</span>
                        </div>
                        <div class="rating" data-aos="zoom-in" data-aos-delay="950" data-aos-offset="50"
                            data-aos-once="false">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS dengan konfigurasi optimal
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

                // Offset yang optimal - tidak terlalu cepat, tidak terlalu lambat
                offset: 50, // Seimbang - muncul saat scroll 50px

                // Delay tetap seperti sebelumnya
                delay: 0,

                // Duration yang optimal
                duration: 600, // Lebih smooth

                easing: 'ease-out', // Lebih smooth
                once: false,
                mirror: true,

                // Anchor placement yang optimal
                anchorPlacement: 'top-center', // Trigger saat elemen di tengah atas viewport
            });

            // Refresh yang optimal
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    AOS.refresh();
                }, 100);
            });

            // Refresh saat halaman selesai load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    AOS.refresh();
                }, 300);
            });
        });
    </script>
@endsection
