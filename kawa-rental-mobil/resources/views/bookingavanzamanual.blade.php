<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental Mobil Indramayu</title>
  <link rel="stylesheet" href="{{ asset('css/booking.css') }}" />
  <!-- poppins -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <!-- Montserrat -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600,700&display=swap" rel="stylesheet">
  <!-- Lato -->
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <header>
    <a href="#" class="logo">
      <img src="{{ asset('img/logo-kawa.png')}}" alt="logo kawa rental mobil" />
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

    <!-- banner Section -->
    <section class="hero" aria-label="Rental mobil cepat dan aman">
        <img src="{{asset('img/kawa-banner.png')}}" alt="banner kawa rental mobil" />
    </section>

    <!-- mobil Section -->
    <main>
        <section class="product-detail" aria-label="Detail mobil Suzuki Ertiga">
            <div class="car-image">
                <img src="{{asset('img/Hiace.png')}}" alt="Mobil Suzuki Ertiga berwarna putih" />
            </div>
            <form class="car-info" aria-labelledby="carTitle">
                <h2 id="carTitle">HIACE</h2>

                <div class="meta-icons" aria-label="Spesifikasi utama mobil">
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" fill="none" stroke-width="2"></circle>
                            <circle cx="12" cy="12" r="4" fill="none" stroke-width="2"></circle>
                        </svg> Matic</span>
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M8 7h8M8 12h8M8 17h8" fill="none" stroke-width="2" stroke-linecap="round" />
                        </svg> 2022</span>
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M4 7h16M4 17h16" fill="none" stroke-width="2" stroke-linecap="round" />
                        </svg> Kapasitas 12 orang</span>
                </div>

                <div class="price-section" aria-live="polite" aria-atomic="true">
                    Harga <br>
                    <strong id="priceDisplay">Konsultasikan dengan Admin</strong> 
                </div>

                <button type="submit" class="booking-btn">Konsultasi Sekarang</button>
            </form>
        </section>
    </main>

    <!-- Bagian Tab -->
    <div class="bungkus-tab">
        <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'deskripsi')">Deskripsi</button>
            <button class="tab-button" onclick="openTab(event, 'fasilitas')">Fasilitas</button>
            <button class="tab-button" onclick="openTab(event, 'syarat')">Syarat & Ketentuan</button>
        </div>

        <!-- Isi Konten Tab -->
        <div id="deskripsi" class="tab-content" style="display: block;">
            <p>
        <strong>Toyota Hiace</strong> merupakan van komersial dan pariwisata yang tangguh dan sangat
        mengutamakan kenyamanan serta kapasitas penumpang yang besar.
    </p>
    <div>
        Berikut keunggulan unit kami:
    </div>

    <div style="margin-top: 10px;">
        <strong>1. Desain Eksterior & Dimensi</strong>
        <ul>
            <li><strong>Tampilan Modern:</strong> Terutama untuk varian Hiace Premio, desainnya kini lebih modern dan elegan dengan konsep semi-bonnet (mesin berada di depan, bukan di bawah jok depan), memberikan tampilan yang menyerupai MPV premium dan meningkatkan keamanan.</li>
            <li><strong>Dimensi Besar:</strong> Hiace memiliki dimensi yang sangat besar, menjadikannya ideal untuk perjalanan rombongan.</li>
            <li><strong>Hiace Premio:</strong> Panjang 5.915 mm, Lebar 2.018 mm, Tinggi 2.280 mm.</li>
            <li><strong>Pintu Geser (Sliding Door):</strong> Memudahkan akses keluar masuk penumpang, terutama di tempat parkir yang sempit.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>2. Kenyamanan Interior & Kapasitas</strong>
        <ul>
            <li><strong>Kabin Luas dan Premium:</strong> Kabin Hiace didesain sangat luas, memberikan ruang kaki yang lega untuk semua penumpang. Varian Premio seringkali hadir dengan interior yang lebih mewah.</li>
            <li><strong>Kapasitas Penumpang:</strong> Hiace Premio memiliki kapasitas 12 hingga 14 kursi, dengan konfigurasi yang lebih berfokus pada kenyamanan tiap individu.</li>
            <li><strong>Fitur Kenyamanan:</strong> Dilengkapi dengan sistem pendingin udara (AC) yang kuat dan merata hingga ke belakang (Double Blower), serta kursi yang dapat direbahkan (reclining seat) untuk perjalanan jauh yang lebih nyaman.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>3. Performa Mesin & Transmisi</strong>
        <ul>
            <li><strong>Mesin Diesel Bertenaga:</strong> Toyota Hiace ditenagai oleh mesin diesel yang tangguh dan efisien.</li>
            <li><strong>Hiace Premio:</strong> Menggunakan Super GD Engine - VNT Turbo (Seri 1GD-FTV) berkapasitas 2.755 cc (2.8L).</li>
            <li><strong>Performa Optimal:</strong> Mesin ini mampu menghasilkan torsi dan tenaga yang besar, sangat mumpuni untuk membawa beban penuh (penumpang dan barang) dan melalui berbagai kondisi jalan.</li>
            <li><strong>Transmisi:</strong> Tersedia dalam pilihan manual (biasanya 6 percepatan) atau otomatis (tergantung varian tahun).</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>4. Fitur Keselamatan (Safety)</strong><br>
        Hiace dilengkapi dengan fitur keselamatan modern untuk memastikan keamanan perjalanan:
        <ul>
            <li><strong>Dual SRS Airbags</strong> (untuk pengemudi dan penumpang depan).</li>
            <li><strong>Anti-lock Braking System (ABS)</strong> dan Brake Assist (BA) untuk pengereman yang optimal.</li>
            <li><strong>Vehicle Stability Control (VSC)</strong> yang membantu menjaga kestabilan mobil saat menikung.</li>
            <li><strong>Hill-Start Assist (HSA)</strong> yang mencegah mobil mundur saat berada di tanjakan.</li>
            <li><strong>Sabuk Pengaman (Seatbelt)</strong> dengan pretensioner untuk semua kursi.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        Hiace sangat ideal untuk disewa sebagai kendaraan:
        <ul>
            <li>Wisata Rombongan</li>
            <li>Layanan antar-jemput bisnis atau bandara</li>
            <li>Perjalanan keluarga besar</li>
        </ul>
    </div>
</div>

        <div id="fasilitas" class="tab-content">
            <ul>
                <li>AC otomatis dan ventilasi rear AC</li>
                <li>Radio/Tape/CD/MP3 Android</li>
                <li>Charger</li>
            </ul>
        </div>

        <div id="syarat" class="tab-content">
            <h3 style="margin-bottom: 5px;">Syarat & Ketentuan Sewa</h3>
            <p style="margin-top: 0; margin-bottom: 10px;">Berikut adalah poin-poin kesepakatan antara <strong>Pihak Pertama (Kawa Car Rent)</strong> dan <strong>Pihak Kedua (Penyewa)</strong>:</p>
            
            <ul style="padding-left: 20px; margin-top: 0; margin-bottom: 0;">
                <li style="margin-bottom: 5px;"><strong>Perpanjangan Waktu (Overtime):</strong> Wajib dikonfirmasi minimal <strong>6 (enam)</strong> Jam sebelum masa sewa berakhir.</li>
                <li style="margin-bottom: 5px;"><strong>Penyalahgunaan Kendaraan:</strong> Segala bentuk penyalahgunaan kendaraan diluar tanggung jawab Pihak Pertama (Kawa Car Rent).</li>
                <li style="margin-bottom: 5px;"><strong>Tanggung Jawab Kerusakan/Kehilangan:</strong> Segala resiko kerusakan, kecelakaan, dan kehilangan kendaraan adalah <strong>tanggung jawab</strong> Pihak Kedua (Penyewa).</li>
                <li style="margin-bottom: 5px;"><strong>Tilang Elektronik (E-Tilang):</strong> Apabila terkena E-Tilang, Pihak Kedua wajib membayar denda e-Tilang jika Pihak Pertama menerima data/surat tilang dari Kepolisian.</li>
                <li style="margin-bottom: 5px;"><strong>Persetujuan:</strong> Penyewa telah membaca dan menyetujui seluruh kesepakatan yang tertulis di atas.</li>
            </ul>
        </div>
    </div>


    <div class="section-container">
        <div class="lainnya">
            <h3>Lihat juga unit lainnya</h3>
        </div>

        <!-- Cars Listing -->
            <!-- Mobilio Manual -->
            <article class="car-card" aria-label="Mobilio Manual, harga 400 ribu per hari">
                <img src="{{asset('img/mobilio.PNG')}}" alt="Mobilio Manual" />
                <h3>Mobilio Manual</h3>
                <div class="price">Rp 400.000 / hari</div>
                <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Manual</span></div>
                </div>
                <button type="button" aria-label="Sewa Mobilio Manual">Sewa mobil &gt;&gt;</button>
            </article>

            <!-- Brio Matic -->
            <article class="car-card" aria-label="Brio Matic, harga 400 ribu per hari">
                <img src="{{asset('img/BrioMatic.PNG')}}" alt="Brio Matic" />
                <h3>Brio Matic</h3>
                <div class="price">Rp 400.000 / hari</div>
                <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Matic</span></div>
                </div>
                <button type="button" aria-label="Sewa Brio Matic">Sewa mobil &gt;&gt;</button>
            </article>

            <!-- Brio Manual -->
            <article class="car-card" aria-label="Brio Manual, harga 350 ribu per hari">
                <img src="{{asset('img/Brio.PNG')}}" alt="Brio Manual" />
                <h3>Brio Manual</h3>
                <div class="price">Rp 350.000 / hari</div>
                <div class="details">
                <div><span>Sistem</span><span>Lepas Kunci</span></div>
                <div><span>Tipe</span><span>Manual</span></div>
                </div>
                <button type="button" aria-label="Sewa Brio Manual">Sewa mobil &gt;&gt;</button>
            </article>


        <a href="/DaftarMobil"></a><button class="btn-load-more" type="button" aria-label="Selengkapnya">Selengkapnya &gt;&gt;&gt;</button></a>
    </div>

            <script>
        function openTab(evt, tabName) {
        // Sembunyikan semua tab-content
        var tabcontent = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Hapus class "active" dari semua tombol
        var tabbuttons = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tabbuttons.length; i++) {
            tabbuttons[i].classList.remove("active");
        }

        // Tampilkan tab yang dipilih
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");
        }
        </script>

    <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-col">
        <a href="#" class="footer-logo" aria-label="Rental Mobil Indramayu">
          <img src="/kawa-rental-mobil/public/img/logo-kawa-stroke2.png" alt="logo kawa rental mobil" />
        </a>
        <small>©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by <a href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer" style="color:#00b894;">www.polindra.ac.id</a></small>
      </div>
      <div class="footer-col">
        <h4>Media Sosial</h4>
        <div class="social-icons" role="navigation" aria-label="Media sosial">
          <a href="#"><img src="/kawa-rental-mobil/public/img/instagram-icon.png" alt="Instagram" style="width:24px"></a>
          <a href="#"><img src="/kawa-rental-mobil/public/img/fb.png" alt="Facebook" style="width:24px"></a>
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