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
    <img src="{{ asset('img/kawa-banner.png')}}" alt="banner kawa rental mobil" />
  </section>

  <!-- Cars Listing -->
<section class="cars-container" aria-label="Daftar mobil tersedia" id="daftar-mobil">

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

  <!-- New Avanza MT -->
  <article class="car-card" aria-label="New Avanza MT, harga 400 ribu per hari">
    <img src="{{asset('img/AvanzaMT.PNG')}}" alt="New Avanza MT" />
    <h3>New Avanza MT</h3>
    <div class="price">Rp 400.000 / hari</div>
    <div class="details">
      <div><span>Sistem</span><span>Lepas Kunci</span></div>
      <div><span>Tipe</span><span>Manual </span></div>
    </div>
    <button type="button" aria-label="Sewa New Avanza MT">Sewa mobil &gt;&gt;</button>
  </article>

  <!-- New Avanza AT -->
  <article class="car-card" aria-label="New Avanza AT, harga 500 ribu per hari">
    <img src="{{asset('img/AvanzaAT.PNG')}}" alt="New Avanza AT" />
    <h3>New Avanza AT</h3>
    <div class="price">Rp 500.000 / hari</div>
    <div class="details">
      <div><span>Sistem</span><span>Lepas Kunci</span></div>
      <div><span>Tipe</span><span>Automatic </span></div>
      
    </div>
    <button type="button" aria-label="Sewa New Avanza AT">Sewa mobil &gt;&gt;</button>
  </article>

  <!-- Hiace -->
  <article class="car-card" aria-label="Hiace dengan driver">
    <img src="{{asset('img/Hiace.PNG')}}" alt="Hiace" />
    <h3>Hiace</h3>
    <div class="price">Menyesuaikan</div>
    <div class="details">
      <div><span>Sistem</span><span>Dengan Driver</span></div>
      <div><span>Tipe</span><span>Minibus</span></div>
    </div>
    <button type="button" aria-label="Sewa Hiace">Sewa mobil &gt;&gt;</button>
  </article>

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