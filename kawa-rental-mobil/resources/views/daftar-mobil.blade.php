@extends('layout.app')

@section('title', 'Daftarmobil - KAWA Rental Mobil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/daftar-mobil.css') }}" />

@endpush

@section('content')
    <!-- Banner Section -->
    <section class="banner" aria-label="Rental mobil cepat dan aman">
        <img src="{{ asset('img/kawa-banner.png') }}" alt="banner kawa rental mobil" />
    </section>

    <!-- Page Title -->
    <h1 class="page-title">Daftar Mobil</h1>

    <!-- Cars Listing -->
    <section class="cars-container" aria-label="Daftar mobil tersedia" id="daftar-mobil">

        @if (isset($cars) && $cars->count() > 0)

            @foreach ($cars as $index => $car)
                <article class="car-card" data-merk="{{ strtolower($car->merk) }}"
                    data-transmisi="{{ strtolower($car->transmisi) }}" data-harga="{{ $car->biaya_harian }}"
                    aria-label="{{ $car->merk }} {{ $car->model }}, harga {{ number_format($car->biaya_harian, 0, ',', '.') }} per hari">

                    <!-- Status Badge -->
                    <div class="status-badge {{ $car->status }}">
                        {{ ucfirst($car->status) }}
                    </div>

                    <img src="{{ asset($car->gambar) }}"
                        alt="{{ $car->merk }} {{ $car->model }} {{ $car->tahun }}"
                        onerror="this.src='{{ asset('img/car-placeholder.jpg') }}'" />

                    <h3>{{ $car->merk }} {{ $car->model }}</h3>

                    <div class="price">Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}/hari</div>

                    <div class="details">
                        <div><span>Transmisi</span><span>{{ ucfirst($car->transmisi) }}</span></div>
                        <div><span>Kapasitas</span><span>{{ $car->kapasitas_penumpang }} Penumpang</span></div>
                        <div><span>Tahun</span><span>{{ $car->tahun }}</span></div>
                        <div><span>Warna</span><span>{{ $car->warna ?? 'Various' }}</span></div>
                    </div>

                    <a href="{{ route('detail.mobil', $car->id) }}">
                        <button type="button" aria-label="Sewa {{ $car->merk }} {{ $car->model }}">
                            Sewa Sekarang &gt;&gt;
                        </button>
                    </a>
                </article>
            @endforeach
        @elseif(isset($cars) && $cars->count() == 0)
            <div class="no-cars" data-aos="fade-up" data-aos-once="false">
                <p>Tidak ada mobil tersedia saat ini.</p>
            </div>
        @else
            <div class="no-cars" data-aos="fade-up" data-aos-once="false">
                <p>Daftar mobil belum tersedia di halaman ini.</p>
            </div>
        @endif
    </section>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/62812345678910" class="wa-float" target="_blank" aria-label="Chat WhatsApp">
        <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" />
    </a>

    <!-- JavaScript untuk Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterMerk = document.getElementById('filterMerk');
            const filterTransmisi = document.getElementById('filterTransmisi');
            const filterHarga = document.getElementById('filterHarga');
            const resetFilter = document.getElementById('resetFilter');
            const carCards = document.querySelectorAll('.car-card');

            function filterCars() {
                const searchTerm = searchInput.value.toLowerCase();
                const merkValue = filterMerk.value.toLowerCase();
                const transmisiValue = filterTransmisi.value.toLowerCase();
                const hargaValue = filterHarga.value;

                carCards.forEach(card => {
                    const merk = card.dataset.merk;
                    const transmisi = card.dataset.transmisi;
                    const harga = parseInt(card.dataset.harga);
                    const title = card.querySelector('h3').textContent.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesMerk = !merkValue || merk === merkValue;
                    const matchesTransmisi = !transmisiValue || transmisi.includes(transmisiValue);
                    const matchesHarga = !hargaValue || checkPriceRange(harga, hargaValue);

                    if (matchesSearch && matchesMerk && matchesTransmisi && matchesHarga) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            function checkPriceRange(price, range) {
                const [min, max] = range.split('-').map(Number);
                return price >= min && price <= max;
            }

            // Event listeners
            searchInput.addEventListener('input', filterCars);
            filterMerk.addEventListener('change', filterCars);
            filterTransmisi.addEventListener('change', filterCars);
            filterHarga.addEventListener('change', filterCars);

            resetFilter.addEventListener('click', function() {
                searchInput.value = '';
                filterMerk.value = '';
                filterTransmisi.value = '';
                filterHarga.value = '';
                filterCars();
            });
        });
    </script>
@endsection
