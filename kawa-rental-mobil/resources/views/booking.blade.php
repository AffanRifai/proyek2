<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Rental Mobil Indramayu</title>
    <link rel="stylesheet" href="/kawa-rental-mobil/public/css/booking.css">
</head>

<body>
    <!-- Header Navbar -->
    <header>
        <a href="#" class="logo">
            <img src="/kawa-rental-mobil/public/img/logo-kawa.png" alt="logo kawa rental mobil" />
        </a>
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Daftar Mobil</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">Tentang</a></li>
                <li class="search-container">
                    <input type="search" placeholder="Search" aria-label="Cari" />
                </li>
                <li><button class="login-btn" aria-label="Login">Login</button></li>
            </ul>
        </nav>
    </header>

    <!-- banner Section -->
    <section class="hero" aria-label="Rental mobil cepat dan aman">
        <img src="/kawa-rental-mobil/public/img/kawa-banner.png" alt="banner kawa rental mobil" />
    </section>

    <!-- mobil Section -->
    <main>
        <section class="product-detail" aria-label="Detail mobil Suzuki Ertiga">
            <div class="car-image">
                <img src="/kawa-rental-mobil/public/img/pajero.png" alt="Mobil Suzuki Ertiga berwarna putih" />
            </div>
            <form class="car-info" aria-labelledby="carTitle">
                <h2 id="carTitle">SUZUKI ERTIGA</h2>

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
                        </svg> Kapasitas 6 orang</span>
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
        </div>

        <!-- Isi Konten Tab -->
        <div id="deskripsi" class="tab-content" style="display: block;">
            <p>Suzuki Ertiga 2022 Up adalah MPV praktis dan efisien, cocok untuk keluarga dan rombongan dengan fitur modern dan interior lapang.</p>
        </div>

        <div id="fasilitas" class="tab-content">
            <ul>
                <li>AC otomatis dan ventilasi rear AC</li>
                <li>Sistem infotainment layar sentuh 8 inch dengan Bluetooth dan USB</li>
                <li>Airbag ganda dan ABS dengan EBD</li>
                <li>Parkir sensor belakang dan Hill Hold Control</li>
                <li>Remote keyless entry dan lampu depan LED</li>
            </ul>
        </div>

        <div id="syarat" class="tab-content">
            <ul>
                <li>Usia peminjam minimal 21 tahun</li>
                <li>Menyertakan KTP dan SIM yang masih berlaku</li>
                <li>Membayar uang muka sebelum peminjaman</li>
                <li>Mobil wajib dikembalikan sesuai tanggal dan waktu yang disepakati</li>
                <li>Tanggung jawab atas kerusakan selama masa peminjaman ditanggung penyewa</li>
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
                <img src="/kawa-rental-mobil/public/img/pajero.png" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

            <article class="car-card" aria-label="Mobil Pick Up, harga 350 ribu per hari">
                <img src="/kawa-rental-mobil/public/img/pajero.png" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

            <article class="car-card" aria-label="Mobil Pick Up, harga 350 ribu per hari">
                <img src="/kawa-rental-mobil/public/img/pajero.png" alt="Mobil Pick Up" />
                <h3>Pajero nih boss</h3>
                <div class="price">Harga 350k / hari</div>
                <div class="details">
                    <div><span>Supir dalam kota</span><span>200k</span></div>
                    <div><span>Supir luar kota</span><span>250k</span></div>
                </div>
                <button type="button" aria-label="Sewa mobil Pick Up">Sewa mobil &gt;&gt;</button>
            </article>

        </section>

        <button class="btn-load-more" type="button" aria-label="Selengkapnya">Selengkapnya &gt;&gt;&gt;</button>
    </div>
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <a href="#" class="footer-logo" aria-label="Rental Mobil Indramayu">
                    <img src="/kawa-rental-mobil/public/img/logo-kawa.png" alt="logo kawa rental mobil" />
                </a>
                <small>©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by <a href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer" style="color:#00b894;">www.polindra.ac.id</a></small>
            </div>

            <div class="footer-col">
                <h4>Media Sosial</h4>
                <div class="social-icons" role="navigation" aria-label="Media sosial">
                    <a href="">

                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>kontak</h4>
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


<!-- script untuk tab -->
<script>
    function openTab(evt, tabName) {
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.style.display = 'none');
        const buttons = document.querySelectorAll('.tabs button');
        buttons.forEach(btn => btn.classList.remove('active'));
        document.getElementById(tabName).style.display = 'block';
        evt.currentTarget.classList.add('active');
    }

    // Sembunyikan semua tab-content kecuali yang pertama saat halaman load
    document.addEventListener("DOMContentLoaded", function() {
        var tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(function(tab, idx) {
            tab.style.display = (idx === 0) ? 'block' : 'none';
        });
    });
</script>

</body>

</html>