<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking Mobil</title>
    <link rel="stylesheet" href="{{ asset('css/form-booking.css') }}">
</head>

<body>

    <div class="form-container">
        <h2>Formulir Sewa Mobil</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">

            <div class="car-info">
                <h3>{{ $car->merk }} {{ $car->model }}</h3>
                <p>Harga per hari: <strong>Rp{{ number_format($car->biaya_harian, 0, ',', '.') }}</strong></p>
            </div>

            <label>Nama Penyewa</label>
            <input type="text" name="nama_penyewa" required>

            <label>No. Telepon</label>
            <input type="text" name="no_telp" required>

            <label>Alamat</label>
            <textarea name="alamat" required></textarea>

            <label>Tujuan</label>
            <input type="text" name="tujuan" required>

            <label>Tanggal Mulai</label>
            <input type="date" name="mulai_tgl" required>

            <label>Tanggal Selesai</label>
            <input type="date" name="sel_tgl" required>

            <label>Bentuk Jaminan</label>
            <input type="text" name="bentuk_jaminan" placeholder="Contoh: KTP" required>

            <label>Posisi BBM</label>
            <select name="posisi_bbm" required>
                <option value="">Pilih...</option>
                <option value="Full">Full</option>
                <option value="Setengah">Setengah</option>
                <option value="Kosong">Kosong</option>
            </select>

            <label>Upload KTP</label>
            <input type="file" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf" required>

            <label>Upload SIM</label>
            <input type="file" name="file_sim" accept=".jpg,.jpeg,.png,.pdf" required>

            <label>Upload STNK Motor (opsional)</label>
            <input type="file" name="file_stnk_motor" accept=".jpg,.jpeg,.png,.pdf">

            <div class="payment-buttons">
                <button type="button" name="tipe_pembayaran" value="dp" class="btn-dp">Bayar DP (50%)</button>
                <button type="button" name="tipe_pembayaran" value="penuh" class="btn-full">Bayar Penuh</button>
            </div>
        </form>
    </div>

</body>

</html>
