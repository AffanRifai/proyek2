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
        <li><a href="#kontak">Kontak</a></li>
        <li><a href="#tentang">Tentang</a></li>
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

  <!-- Welcome Section -->
  <section class="welcome" id="tentang" aria-label="Selamat datang">
    <h2>SELAMAT DATANG</h2>
    <div class="welcome-content">
      <div class="welcome-left">
        <img src="{{ asset('/img/desain mobil.png')}}" alt="Berbagai mobil rental" />
      </div>
      <div class="welcome-right">
        <p><strong>Jasa Rental / Sewa Mobil Harian Terdekat di Indramayu (Dengan Sopir / Lepas Kunci)</strong></p>
        <p>Rental Mobil Indramayu merupakan perusahaan yang bergerak dalam bidang layanan jasa rental mobil terbaik dan terkemuka di Indramayu. Kami menyewakan beragam pilihan armada berkualitas dengan harga yang terjangkau, baik untuk sewa mobil lepas kunci ataupun dengan sopir (driver).</p>
        <p>Tim kami terdiri dari tenaga profesional berpengalaman yang siap memberikan layanan sewa mobil berkualitas dengan harga kompetitif. Dengan tim yang ramah dan responsif, kami akan memastikan Anda memperoleh pengalaman perjalanan yang nyaman, aman, dan memuaskan.</p>
      </div>
    </div>
  </section>

<!-- SECTION KONTAK KAMI DENGAN INSTAGRAM (FULL LAYAR) -->
<section id="kontak" style="width:100%;background:linear-gradient(180deg,#fff,#fafafa);padding:70px 0;">
  <div style="max-width:1300px;margin:auto;padding:0 30px;">
    <h2 style="text-align:center;font-size:2.2rem;color:#A62F19;margin-bottom:50px;font-weight:700;">
      Kontak & Sosial Media Kami
    </h2>

    <div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:stretch;gap:40px;">

      <!-- Kolom Kiri: Info Kontak -->
      <div style="
        flex:1 1 40%;
        min-width:340px;
        background:#fff;
        padding:30px 35px;
        border-radius:20px;
        box-shadow:0 4px 25px rgba(0,0,0,0.08);
        border:1px solid #eee;
        position:relative;
      ">
        <h3 style="font-size:1.6rem;color:#A62F19;text-align:center;margin-bottom:20px;font-weight:700;">
          Hubungi Kami
        </h3>
        <div style="border-top:2px solid #A62F19;width:60px;margin:0 auto 25px auto;"></div>

        <div style="line-height:1.8;color:#333;font-size:1.05rem;">
          <p><strong>🕓 Jam Operasional:</strong><br>Setiap Hari, <span style="color:#555;">07.00 – 22.00 WIB</span></p>
          <hr style="border:none;border-top:1px dashed #ddd;margin:10px 0;">
          <p><strong>📧 Email:</strong><br>
            <a href="mailto:prasetyoluckyindra@gmail.com" style="color:#A62F19;text-decoration:none;">
              prasetyoluckyindra@gmail.com
            </a>
          </p>
          <hr style="border:none;border-top:1px dashed #ddd;margin:10px 0;">
          <p><strong>📱 Telepon / WhatsApp:</strong><br>
            <a href="https://wa.me/6282315836060" style="color:#333;text-decoration:none;">
              +62 823-1583-6060
            </a>
          </p>

          <!-- Tombol WhatsApp -->
          <a href="https://wa.me/6282315836060" target="_blank"
            style="
              display:inline-flex;
              align-items:center;
              justify-content:center;
              gap:10px;
              margin:18px 0;
              background:#25D366;
              color:#fff;
              padding:13px 26px;
              border-radius:12px;
              text-decoration:none;
              font-weight:600;
              font-size:1rem;
              transition:all 0.3s ease;
              box-shadow:0 3px 10px rgba(37,211,102,0.3);
            "
            onmouseover="this.style.background='#1EBE5B';this.style.transform='translateY(-3px)';this.style.boxShadow='0 6px 14px rgba(37,211,102,0.4)'"
            onmouseout="this.style.background='#25D366';this.style.transform='translateY(0)';this.style.boxShadow='0 3px 10px rgba(37,211,102,0.3)'"
          >
            💬 Hubungi via WhatsApp
          </a>

          <hr style="border:none;border-top:1px dashed #ddd;margin:10px 0;">
          <p><strong>📍 Alamat:</strong><br>
            <span style="color:#555;">Jl. Raya Lohbener No.08, Lohbener, Kec. Indramayu, Jawa Barat 45252</span>
          </p>
        </div>
      </div>

      <!-- Kolom Kanan: Instagram -->
      <div style="
        flex:1 1 55%;
        min-width:380px;
        background:#fff;
        padding:25px;
        border-radius:20px;
        box-shadow:0 4px 25px rgba(0,0,0,0.08);
        border:1px solid #eee;
        text-align:center;
      ">
        <h3 style="margin-bottom:20px;font-size:1.4rem;font-weight:700;">
          <img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram"
            style="width:28px;vertical-align:middle;margin-right:8px;">
          <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank"
             style="color:#A62F19;text-decoration:none;">
            @kawarentalmobilindramayu
          </a>
        </h3>

        <div style="width:100%;display:flex;justify-content:center;">
          <iframe
            src="https://www.instagram.com/kawarentalmobilindramayu/embed"
            width="100%" height="680"
            style="border:none;overflow:hidden;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.15);max-width:800px;"
            scrolling="no"
            frameborder="0"
            allowfullscreen="true"
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
          </iframe>
        </div>

        <!-- Tombol bawah -->
        <div style="margin-top:25px;display:flex;justify-content:center;gap:18px;">
          <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank" style="text-decoration:none;">
            <button
              style="
                background:#333;
                color:#fff;
                border:none;
                padding:12px 24px;
                border-radius:10px;
                cursor:pointer;
                font-size:1rem;
                font-weight:500;
                transition:all 0.3s ease;
                box-shadow:0 3px 8px rgba(0,0,0,0.2);
              "
              onmouseover="this.style.background='#555'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 5px 12px rgba(0,0,0,0.3)'"
              onmouseout="this.style.background='#333'; this.style.transform='scale(1)'; this.style.boxShadow='0 3px 8px rgba(0,0,0,0.2)'"
            >
              Lihat Lebih Detail
            </button>
          </a>

          <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank"
            style="
              display:inline-flex;
              align-items:center;
              background:#2D9CDB;
              color:#fff;
              padding:12px 24px;
              border-radius:10px;
              text-decoration:none;
              font-weight:500;
              font-size:1rem;
              transition:all 0.3s ease;
              box-shadow:0 3px 8px rgba(0,0,0,0.2);
            "
            onmouseover="this.style.background='#1B7FCA'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 5px 12px rgba(0,0,0,0.3)'"
            onmouseout="this.style.background='#2D9CDB'; this.style.transform='scale(1)'; this.style.boxShadow='0 3px 8px rgba(0,0,0,0.2)'"
          >
            <img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram" style="width:20px;margin-right:8px;">
            Follow on Instagram
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- SECTION GOOGLE MAPS -->
<section class="maps" id="maps">
  <div class="container">
    <h2>Lokasi Kami</h2>
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.5863694125546!2d108.32435097355598!3d-6.330794161941888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9ca923dd847%3A0xbf99f1269728baa3!2sKAWA%20Rental%20Mobil%20Indramayu!5e1!3m2!1sid!2sid!4v1760671679708!5m2!1sid!2sid"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
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
          <img src="{{ asset('img/logo-kawa-stroke2.png')}}" alt="logo kawa rental mobil" />
        </a>
        <small>©2025 KAWA Rental Mobil Indramayu All Rights Reserved. Published by
          <a href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer" style="color:#00b894;">www.polindra.ac.id</a>
        </small>
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
          <div>+62 812 3456 7890</div>
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
