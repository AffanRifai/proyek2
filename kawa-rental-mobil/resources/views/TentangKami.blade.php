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
  <!-- Navbar -->
  <header>
    <a href="#" class="logo">
      <img src="{{ asset('img/logo-kawa.png')}}" alt="logo kawa rental mobil" />
    </a>
    <nav>
      <ul>
        <li><a href="/landingpage">Beranda</a></li>
        <li><a href="/DaftarMobil">Daftar Mobil</a></li>
        <li><a href="/TentangKami" class="active">Tentang Kami</a></li>
        <li><a href="/login"><button class="login-btn" aria-label="Login">Login</button></a></li>
      </ul>
    </nav>
  </header>

  <!-- Tentang Kami -->
  <section class="tentang-kami" aria-label="Profil Perusahaan">
    <div class="container">
      <h2>Tentang Kami</h2>
      <div class="profil">
        <div class="profil-text">
          <p><strong>KAWA Rental Mobil Indramayu</strong> adalah perusahaan penyedia jasa sewa mobil terbaik di wilayah Indramayu dan sekitarnya. Kami melayani berbagai kebutuhan transportasi — mulai dari perjalanan dinas, wisata keluarga, hingga acara pernikahan.</p>
          <p>Dengan armada kendaraan yang selalu terawat, layanan profesional, dan harga transparan, kami berkomitmen memberikan kenyamanan dan keamanan maksimal untuk setiap pelanggan.</p>
          <p>Kami juga menyediakan layanan <strong>lepas kunci</strong> maupun <strong>dengan sopir berpengalaman</strong> yang siap menemani perjalanan Anda kapan saja.</p>
        </div>
        <div class="profil-img">
          <img src="{{ asset('img/desain mobil.png') }}" alt="Profil perusahaan" />
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak Kami -->
  <section class="kontak-kami" aria-label="Kontak Kami">
    <div class="container">
      <h2>Kontak Kami</h2>
      <div class="kontak-content">
        <div class="kontak-info">
          <p><strong>Alamat:</strong><br>Jl. Raya Lohbener No.08, Lohbener, Indramayu, Jawa Barat 45252</p>
          <p><strong>Telepon:</strong><br>+62 812-3456-7890</p>
          <p><strong>Email:</strong><br>info@kawarental.com</p>
          <p><strong>Jam Operasional:</strong><br>Setiap Hari, 07.00 – 21.00 WIB</p>
          <a href="https://wa.me/6281234567890" class="btn" target="_blank">Hubungi via WhatsApp</a>
        </div>
        <div class="kontak-img">
          <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="Logo Kawa Rental" />
        </div>
      </div>
    </div>
  </section>

  <!-- Google Maps -->
  <section class="maps" aria-label="Lokasi Kami">
    <div class="container">
      <h2>Lokasi Kami</h2>
      <div class="map-container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.712799979792!2d108.27996967499962!3d-6.396635963612836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edfe98dbabec3%3A0x9efc3e91c630a38b!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
          width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>
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
          <img src="{{ asset('img/logo-kawa-stroke2.png')}} alt="logo kawa rental mobil" />
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
