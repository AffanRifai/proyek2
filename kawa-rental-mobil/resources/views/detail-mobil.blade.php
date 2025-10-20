<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil - {{ $car->merk }} {{ $car->model }}</title>
    <link rel="stylesheet" href="{{ asset('css/detail-mobil.css') }}">
</head>
<body>
    <a href="{{ route('daftar.mobil') }}">← Kembali</a>

    <div class="detail-container">
        <img src="{{ asset('storage/mobil/' . $car->gambar) }}" alt="{{ $car->merk }}">
        <h2>{{ $car->merk }} {{ $car->model }}</h2>
        <p><strong>Tahun:</strong> {{ $car->tahun }}</p>
        <p><strong>Warna:</strong> {{ $car->warna }}</p>
        <p><strong>Harga per Hari:</strong> Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}</p>
        <p><strong>Deskripsi:</strong> {{ $car->deskripsi }}</p>
        <p><strong>Fasilitas:</strong> {{ $car->fasilitas }}</p>
        <p><strong>Syarat:</strong> {{ $car->syarat }}</p>
        <p><strong>Kebijakan:</strong> {{ $car->kebijakan }}</p>

        <a href="{{ route('form.booking', $car->id) }}" class="btn-booking">Sewa Sekarang</a>
        
    </div>
</body>
</html>
