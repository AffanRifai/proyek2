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
        <section class="product-detail" aria-label="Detail mobil Mobilio Manual">
            <div class="car-image">
                <img src="{{asset('img/mobilio.png')}}" alt="Mobil Mobilio Manual Hitam" />
            </div>
            <form class="car-info" aria-labelledby="carTitle">
                <h2 id="carTitle">Mobilio Manual</h2>

                <div class="meta-icons" aria-label="Spesifikasi utama mobil">
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" fill="none" stroke-width="2"></circle>
                            <circle cx="12" cy="12" r="4" fill="none" stroke-width="2"></circle>
                        </svg> Manual</span>
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M8 7h8M8 12h8M8 17h8" fill="none" stroke-width="2" stroke-linecap="round" />
                        </svg> 2017</span>
                    <span><svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M4 7h16M4 17h16" fill="none" stroke-width="2" stroke-linecap="round" />
                        </svg> Kapasitas 7 orang</span>
                </div>

                <div class="price-section" aria-live="polite" aria-atomic="true">
                    Harga <br>
                    <strong id="priceDisplay">Rp. 400.000</strong> / hari
                </div>

                <button type="submit" class="book-btn">Booking Now</button>
            </form>
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
        <div id="deskripsi" class="tab-content" style="display: block;">
    <p>
        <strong>Honda Mobilio</strong> merupakan <strong>Low MPV</strong> yang lincah dan irit bahan bakar, dirancang untuk memberikan kenyamanan dan kepraktisan maksimal bagi keluarga serta kebutuhan sehari-hari.
    </p>
    <div>
        Berikut keunggulan unit kami:
    </div>

    <div style="margin-top: 10px;">
        <strong>1. Desain Eksterior & Dimensi</strong>
        <ul>
            <li><strong>Tampilan Modern dan Dinamis:</strong> Mobilio memiliki desain yang sporty dan modern, dengan garis bodi yang aerodinamis. Desain lampu depan (headlamp) yang tajam dan gril berlapis krom (pada beberapa varian) memberikan kesan elegan di kelasnya.</li>
            <li><strong>Dimensi Kompak:</strong> Sebagai Low MPV, Mobilio menawarkan dimensi yang ideal untuk bermanuver di jalan perkotaan yang padat.
                <ul>
                    <li>Panjang: Sekitar 4.386 mm</li>
                    <li>Lebar: Sekitar 1.683 mm</li>
                    <li>Tinggi: Sekitar 1.603 mm</li>
                </ul>
            </li>
            <li><strong>Ground Clearance Tinggi:</strong> Dengan jarak ke tanah yang cukup tinggi, Mobilio lebih percaya diri melintasi jalan bergelombang atau genangan air.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>2. Kenyamanan Interior & Kapasitas</strong>
        <ul>
            <li><strong>Kabin Fleksibel 7 Penumpang:</strong> Mobilio didesain untuk menampung <strong>tujuh penumpang</strong> (7-seater) dengan konfigurasi kursi 2-3-2.</li>
            <li><strong>Akses Mudah ke Baris Ketiga:</strong> Kursi baris kedua dapat dilipat dengan mudah (One-Touch Tumble) untuk memberikan akses yang praktis.</li>
            <li><strong>AC Double Blower:</strong> Dilengkapi dengan sistem pendingin udara <strong>Double Blower</strong> yang memastikan pendinginan merata hingga ke belakang.</li>
            <li><strong>Bagasi Luas:</strong> Ketika kursi baris ketiga dilipat, Mobilio menawarkan ruang bagasi yang sangat luas dan fleksibel, mampu menampung banyak barang bawaan.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>3. Performa Mesin & Transmisi</strong>
        <ul>
            <li><strong>Mesin Irit dan Bertenaga (i-VTEC):</strong> Ditenagai mesin bensin 4-silinder <strong>1.5L SOHC i-VTEC</strong> yang terkenal efisien dan menghasilkan tenaga responsif.
                <ul>
                    <li>Kapasitas: 1.496 cc.</li>
                    <li>Tenaga Maksimal: Sekitar 118 PS, salah satu yang terbesar di kelasnya.</li>
                </ul>
            </li>
            <li><strong>Transmisi Manual yang Responsif:</strong> Unit dengan <strong>transmisi manual (biasanya 5 percepatan)</strong> memberikan pengemudi kontrol penuh atas akselerasi dan *engine braking*, ideal untuk pengalaman berkendara yang *sporty* dan efisien saat melintasi rute menanjak.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        <strong>4. Fitur Keselamatan (Safety)</strong><br>
        Mobilio dilengkapi dengan fitur keselamatan standar untuk melindungi penumpang:
        <ul>
            <li><strong>Dual SRS Airbags</strong> (untuk pengemudi dan penumpang depan).</li>
            <li><strong>Anti-lock Braking System (ABS)</strong> dan <strong>Electronic Brake-force Distribution (EBD)</strong> untuk memastikan pengereman yang aman dan optimal, terutama dalam kondisi darurat.</li>
            <li><strong>Struktur Rangka G-CON + ACE™:</strong> Struktur bodi yang dirancang untuk meredam energi benturan saat terjadi tabrakan.</li>
            <li><strong>ISOFIX dan Tether:</strong> Tersedia fitur pengait kursi anak untuk keselamatan balita.</li>
        </ul>
    </div>

    <div style="margin-top: 10px;">
        Honda Mobilio Manual sangat ideal untuk disewa sebagai kendaraan:
        <ul>
            <li><strong>Kendaraan Harian Keluarga:</strong> Irit dan praktis untuk mengantar anak sekolah atau berbelanja.</li>
            <li><strong>Perjalanan Luar Kota Ringan:</strong> Mesin 1.5L yang bertenaga menjamin performa yang andal.</li>
            <li><strong>Liburan Keluarga Kecil/Menengah:</strong> Kapasitas 7-seater memberikan fleksibilitas tanpa perlu kendaraan yang terlalu besar.</li>
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

        <div id="kebijakan" class="tab-content">
            <h3 style="margin-bottom: 5px;">Kebijakan (Detail Perjanjian)</h3>
            <p style="margin-top: 0; margin-bottom: 10px;">Berikut adalah poin-poin detail dari Surat Perjanjian Sewa antara <strong>Pihak Pertama (Kawa Car Rent)</strong> dan <strong>Pihak Kedua (Penyewa)</strong>:</p>

            <ul style="padding-left: 10px; margin-top: 0; margin-bottom: 0;">
            <li style="margin-bottom: 5px;"><strong>PASAL 1 (Tanggung Jawab Pihak Pertama):</strong> Pihak Pertama tidak bertanggung jawab atas segala tindakan/perbuatan atau akibat yang ditimbulkan oleh Pihak Kedua sehubungan dengan kendaraan tersebut.</li>
            <li style="margin-bottom: 5px;"><strong>PASAL 2 (Pemindahan Kendaraan):</strong> Pihak Kedua tidak diperkenankan memindahkan atau menyerahkan kendaraan tersebut kepada orang lain.</li>
            <li style="margin-bottom: 5px;"><strong>PASAL 3 (Pengambilan Kendaraan Sepihak):</strong> Pihak Pertama berhak mengambil kembali kendaraan secara sepihak sebelum masa sewa berakhir jika kendaraan dianggap tidak terawat, digunakan untuk tindakan melawan hukum, atau dipindahtangankan kepada pihak lain.</li>
            <li style="margin-bottom: 5px;"><strong>PASAL 4 (Risiko & Perbaikan):</strong> Apabila terjadi musibah atau kelalaian Pihak Kedua yang menyebabkan kecelakaan, kehilangan, kerusakan, pergantian suku cadang, atau perlengkapan kendaraan, Pihak Kedua bertanggung jawab menanggung segala risikonya. Perbaikan atau perawatan harus atas persetujuan Pihak Pertama.</li>
            <li style="margin-bottom: 5px;"><strong>PASAL 5 (Tilang Elektronik):</strong> Apabila terkena E-Tilang, Pihak Kedua wajib membayar denda e-Tilang jika Pihak Pertama menerima data/surat tilang dari Kepolisian.</li>
            <li style="margin-bottom: 5px;"><strong>PASAL 6 (Penyelesaian Masalah):</strong> Kedua belah pihak sepakat memilih penyelesaian di Kantor Panitera Pengadilan Negeri Kelas 1 Indramayu jika terjadi masalah yang berhubungan dengan Surat Perjanjian.</li>
            </ul>
        </div>
    </div>


    <div class="section-container">
        <div class="lainnya">
            <h3>Lihat juga unit lainnya</h3>
        </div>

        <!-- Cars Listing -->
        <section class="cars-container" aria-label="Daftar mobil tersedia">

            <article class="car-card" aria-label="Mobil Pick Up, harga 350 ribu per hari">
                <img src="{{asset('img/pajero.png')}}" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

            <article class="car-card" aria-label="Mobil Pick Up, harga 350 ribu per hari">
                <img src="{{asset('img/pajero.png')}}" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

            <article class="car-card" aria-label="Mobil Pick Up, harga 350 ribu per hari">
                <img src="{{asset('img/pajero.png')}}" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

        </section>

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
