@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">
@endpush


@section('title', 'Tentang Kami - KAWA Rental Mobil Indramayu')

@section('content')
<!-- Banner -->
<section class="banner">
  <img src="{{ asset('img/kawa-banner.png') }}" alt="KAWA Rental Mobil Indramayu" class="img-fluid w-100">
</section>

<!-- Tentang Kami -->
<section class="welcome" id="tentang">
  <div class="container">
    <h2>SELAMAT DATANG</h2>
    <div class="welcome-content">
      <div class="welcome-left">
        <img src="{{ asset('img/desain mobil.png') }}" alt="Berbagai mobil rental">
      </div>
      <div class="welcome-right">
        <p><strong>Jasa Rental / Sewa Mobil Harian Terdekat di Indramayu (Dengan Sopir / Lepas Kunci)</strong></p>
        <p>Rental Mobil Indramayu merupakan perusahaan yang bergerak dalam bidang layanan jasa rental mobil terbaik dan terkemuka di Indramayu. Kami menyewakan beragam pilihan armada berkualitas dengan harga yang terjangkau, baik untuk sewa mobil lepas kunci ataupun dengan sopir (driver).</p>
        <p>Tim kami terdiri dari tenaga profesional berpengalaman yang siap memberikan layanan sewa mobil berkualitas dengan harga kompetitif. Dengan tim yang ramah dan responsif, kami akan memastikan Anda memperoleh pengalaman perjalanan yang nyaman, aman, dan memuaskan.</p>
      </div>
    </div>
  </div>
</section>


<!-- KONTAK & SOSIAL MEDIA -->
<section id="kontak">
  <div class="container">
    <h2>Hubungi Kami</h2>

    <!-- Card Hubungi Kami -->
    <div class="card card-kontak">
      <h3>Hubungi Kami</h3>
      <div class="divider"></div>
      <p><strong>🕓 Jam Operasional:</strong><br>Setiap Hari, 07.00 – 22.00 WIB</p>
      <hr>
      <p><strong>📧 Email:</strong><br>
        <a href="mailto:prasetyoluckyindra@gmail.com">prasetyoluckyindra@gmail.com</a>
      </p>
      <hr>
      <p><strong>📱 Telepon / WhatsApp:</strong><br>
        <a href="https://wa.me/6282315836060" target="_blank">+62 823-1583-6060</a>
      </p>
      <a href="https://wa.me/6282315836060" target="_blank" class="btn-wa">💬 Hubungi via WhatsApp</a>
      <hr>
      <p><strong>📍 Alamat:</strong><br>Jl. Raya Lohbener No.08, Lohbener, Indramayu, Jawa Barat 45252</p>
    </div>

    <!-- Card Instagram -->
    <div class="card card-ig">
      <h3>
        <img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram" class="ig-icon">
        <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank">@kawarentalmobilindramayu</a>
      </h3>

      <div class="embed-container">
        <iframe src="https://www.instagram.com/kawarentalmobilindramayu/embed"
          frameborder="0" scrolling="no" allowtransparency="true"></iframe>
      </div>

      <div class="btn-group">
        <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank" class="btn-detail">Lihat Lebih Detail</a>
        <a href="https://www.instagram.com/kawarentalmobilindramayu" target="_blank" class="btn-follow">
          <img src="{{ asset('img/instagram-icon.png') }}" alt="IG"> Follow on Instagram
        </a>
      </div>
    </div>
  </div>
</section>



     

<!-- Google Maps -->
<section id="lokasi" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4" style="color:#A62F19;">Lokasi Kami</h2>
    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.5863694125546!2d108.32435097355598!3d-6.330794161941888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9ca923dd847%3A0xbf99f1269728baa3!2sKAWA%20Rental%20Mobil%20Indramayu!5e1!3m2!1sid!2sid!4v1760671679708!5m2!1sid!2sid"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</section>
@endsection
