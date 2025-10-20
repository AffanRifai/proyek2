<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mobil - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ asset('css/daftar-mobil.css') }}">
</head>
<body>
    <h1>Daftar Mobil</h1>

    <div class="mobil-container">
        @foreach ($cars as $car)
            <div class="mobil-card">
                <img src="{{ asset('storage/mobil/' . $car->gambar) }}" alt="{{ $car->merk }}">
                <h3>{{ $car->merk }} {{ $car->model }}</h3>
                <p>Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}/hari</p>
                <a href="{{ route('detail.mobil', $car->id) }}">Lihat Detail</a>
            </div>
        @endforeach
    </div>
</body>
</html>
