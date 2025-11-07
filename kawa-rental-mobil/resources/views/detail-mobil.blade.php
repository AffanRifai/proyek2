@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
@endpush

@section('content')
    <!-- Status Alert -->
    @if ($car->status != 'tersedia')
        <div class="status-alert {{ $car->status }}">
            <strong>Perhatian:</strong> Mobil saat ini
            @if ($car->status == 'disewa')
            @else
                dalam perawatan
            @endif
        </div>
    @endif

    <!-- mobil Section -->
    <main>
        <section class="product-detail" aria-label="Detail mobil {{ $car->merk }} {{ $car->model }}">
            <div class="car-image">
                <img src="{{ asset($car->gambar) }}" alt="{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}"
                    onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />
            </div>

            <div class="car-info" aria-labelledby="carTitle">
                <h1 id="carTitle">{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}</h1>


                <!-- Status Badge -->
                <div class="status-badge {{ $car->status }}">
                    {{ ucfirst($car->status) }}
                </div>

                <div class="meta-icons" aria-label="Spesifikasi utama mobil">
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M12 2L3 7v10l9 5 9-5V7l-9-5z" fill="none" stroke-width="2" />
                        </svg>
                        {{ ucfirst($car->transmisi ?? 'Manual') }}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M17 8h1a4 4 0 110 8h-1M3 8h10v8H3z" fill="none" stroke-width="2" />
                        </svg>
                        {{ $car->tahun }}
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path d="M17 8h1a4 4 0 110 8h-1M3 8h10v8H3z" fill="none" stroke-width="2" />
                        </svg>
                        {{ $car->kapasitas_penumpang }} Penumpang
                    </span>
                    <span>
                        <svg viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" fill="none" stroke-width="2" />
                        </svg>
                        {{ $car->warna ?? 'Various' }}
                    </span>
                </div>

                <!-- Additional Specifications -->
                <div class="specifications">
                    <h3>Spesifikasi Teknis</h3>
                    <div class="spec-grid">
                        <div><strong>No. Polisi:</strong> {{ $car->no_polisi }}</div>
                        <div><strong>No. Rangka:</strong> {{ $car->no_rangka ?? '-' }}</div>
                        <div><strong>No. Mesin:</strong> {{ $car->no_mesin ?? '-' }}</div>
                        <div><strong>STNK Atas Nama:</strong> {{ $car->stnk_atas_nama ?? '-' }}</div>
                    </div>
                </div>

                <div class="price-section" aria-live="polite" aria-atomic="true">
                    <span class="price-label">Harga Sewa</span><br>
                    <strong id="priceDisplay" class="price-amount">
                        Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}
                    </strong>
                    <span class="price-period">/ hari</span>
                </div>

                @if ($car->status == 'tersedia')
                    <a href="{{ route('form.booking', $car->id) }}" class="rent-button">
                        Sewa Sekarang
                    </a>
                @else
                    <button class="rent-button disabled" disabled>
                        @if ($car->status == 'disewa')
                            Sedang Disewa
                        @else
                            Dalam Perawatan
                        @endif
                    </button>
                    <p class="availability-notice">
                        Silakan hubungi kami untuk informasi ketersediaan lebih lanjut.
                    </p>
                @endif

                <!-- Quick Contact -->
                <div class="quick-contact">
                    <p>Butuh bantuan? Hubungi kami:</p>
                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20{{ $car->merk }}%20{{ $car->model }}"
                        class="whatsapp-contact" target="_blank">
                        <img src="{{ asset('img/whatsapp.png') }}" alt="WhatsApp" style="width: 20px; margin-right: 8px;">
                        Chat via WhatsApp
                    </a>
                </div>
            </div>
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
        <div id="deskripsi" class="tab-content active">
            <div style="white-space: pre-line;">{{ $car->deskripsi }}</div>
        </div>

        <div id="fasilitas" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->fasilitas ?? 'Informasi fasilitas tidak tersedia.' }}</div>
        </div>

        <div id="syarat" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->syarat ?? 'Syarat dan ketentuan tidak tersedia.' }}</div>
        </div>

        <div id="kebijakan" class="tab-content">
            <div style="white-space: pre-line;">{{ $car->kebijakan ?? 'Kebijakan tidak tersedia.' }}</div>
        </div>
    </div>

    <!-- Related Cars -->
    <div class="section-container">
        <div class="lainnya">
            <h3>Mobil Lainnya</h3>
        </div>

        <!-- Cars Listing -->
        <section class="cars-container" aria-label="Daftar mobil lainnya">
            @php
                $relatedCars = \App\Models\Car::where('id', '!=', $car->id)
                    ->where('status', 'tersedia')
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            @endphp

            @foreach ($relatedCars as $relatedCar)
                <article class="car-card" aria-label="{{ $relatedCar->merk }} {{ $relatedCar->model }}">
                    <img src="{{ asset($relatedCar->gambar) }}" alt="{{ $relatedCar->merk }} {{ $relatedCar->model }}"
                        onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />
                    <h3>{{ $relatedCar->merk }} {{ $relatedCar->model }}</h3>
                    <div class="price">Rp{{ number_format($relatedCar->biaya_harian, 0, ',', '.') }}/hari</div>
                    <div class="details">
                        <div><span>Transmisi</span><span>{{ ucfirst($relatedCar->transmisi) }}</span></div>
                        <div><span>Kapasitas</span><span>{{ $relatedCar->kapasitas_penumpang }} Penumpang</span></div>
                    </div>
                    <a href="{{ route('detail.mobil', $relatedCar->id) }}">
                        <button type="button" aria-label="Sewa {{ $relatedCar->merk }} {{ $relatedCar->model }}">
                            Sewa mobil &gt;&gt;
                        </button>
                    </a>
                </article>
            @endforeach
        </section>

        <a href="/DaftarMobil" class="btn-load-more">
            Lihat Semua Mobil &gt;&gt;&gt;
        </a>
    </div>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/6281234567890" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" />
    </a>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        // Fungsi untuk membuka tab
        function openTab(tabName, clickedButton) {
            // Hilangkan semua konten aktif
            tabContents.forEach(tab => tab.classList.remove('active'));
            // Hilangkan semua tombol aktif
            tabButtons.forEach(btn => btn.classList.remove('active'));

            // Tampilkan tab yang dipilih
            const selectedTab = document.getElementById(tabName);
            if (selectedTab) {
                selectedTab.classList.add('active');
            }

            // Tandai tombol aktif
            clickedButton.classList.add('active');
        }

        // Event listener untuk setiap tombol
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tabName = this.getAttribute('onclick')
                    ? this.getAttribute('onclick').match(/'([^']+)'/)[1]
                    : this.dataset.tab;
                openTab(tabName, this);
            });
        });

        // Set tab awal (Deskripsi) aktif saat halaman dimuat
        if (tabContents.length > 0) {
            tabContents.forEach(tab => tab.classList.remove('active'));
            const defaultTab = document.getElementById('deskripsi');
            const defaultButton = document.querySelector(".tab-button:first-child");

            if (defaultTab) defaultTab.classList.add('active');
            if (defaultButton) defaultButton.classList.add('active');
        }
    });
</script>


@endsection
