<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental Mobil Indramayu</title>
  <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}" />
  <!-- poppins -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <!-- Montserrat -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600,700&display=swap" rel="stylesheet">
  <!-- Lato -->
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Header Navbar -->
  <header>
    <a href="index.php" class="logo">
      <img src="../../public/img/logo-kawa.png" alt="logo kawa rental mobil" />
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
        <li><button class="login-btn" aria-label="Login">login</button></li>
      </ul>
    </nav>
  </header>
    <img src="../../public/img/header.jpg" alt="banner mobil" />
  

  <!-- Tentang Kami -->
  <section class="about" aria-label="Tentang Kami">
    <h2>TENTANG KAMI</h2>
    <div class="about-content">
      <div class="about-left">
        <img src="../../public/img/mobil-depan.png" alt="Armada mobil rental" />
      </div>
      <div class="about-right">
        <p><strong>Jasa rental / sewa Mobil Harian Terdekat di Indramayu (Dengan Sopir / Lepas Kunci)</strong></p>
        <p>Rental Mobil Indramayu merupakan perusahaan yang bergerak dalam bidang layanan jasa rental mobil terbaik dan terkemuka di Indramayu. Kami menyewakan beragam pilihan armada berkualitas dengan harga yang terjangkau, baik untuk sewa mobil lepas kunci ataupun dengan sopir (driver).</p>
        <p>Tim kami terdiri dari tenaga profesional berpengalaman yang siap memberikan layanan sewa mobil berkualitas dengan harga kompetitif. Dengan tim yang ramah dan responsif, kami akan memastikan Anda memperoleh pengalaman perjalanan yang nyaman, aman, dan memuaskan.</p>
      </div>
    </div>
  </section>

  <!-- Accordion Info -->
  <section class="company-info">
    <div class="accordion">
      <button class="accordion-btn">Profil Perusahaan <span>+</span></button>
      <div class="accordion-content">
        <p>Kami hadir untuk menyediakan layanan transportasi terbaik dengan armada mobil terlengkap di Indramayu.</p>
      </div>

      <button class="accordion-btn">Sejarah <span>+</span></button>
      <div class="accordion-content">
        <p>Sejak berdiri, Rental Mobil Indramayu telah dipercaya masyarakat untuk kebutuhan transportasi pribadi maupun bisnis.</p>
      </div>

      <button class="accordion-btn">Visi & Misi <span>+</span></button>
      <div class="accordion-content">
        <p><strong>Visi:</strong> Menjadi penyedia jasa rental mobil terbaik di Jawa Barat.</p>
        <p><strong>Misi:</strong> Memberikan layanan cepat, aman, dan nyaman kepada pelanggan.</p>
      </div>

      <button class="accordion-btn">Sosial Media <span>+</span></button>
      <div class="accordion-content">
        <p>Ikuti kami di Instagram, Facebook, dan TikTok untuk informasi terbaru.</p>
      </div>
    </div>
  </section>

    <!-- Lokasi -->
  <section class="location" aria-label="Lokasi Kami">
    <h2>Lokasi Kami</h2>
    <div class="map">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7600000000002!2d108.32217!3d-6.57514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ed57b1f0f4e0b%3A0x11b8f0937d7a6144!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1695123456789!5m2!1sid!2sid" 
        height="300" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
    </div>
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