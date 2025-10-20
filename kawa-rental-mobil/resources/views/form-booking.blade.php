<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Form Booking Mobil - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ asset('css/formrental.css') }}">
</head>
<body>
    <div class="container">
        <h1>Formulir Booking Mobil</h1>

        {{-- Tampilkan pesan sukses atau error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Form Booking --}}
        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Hidden input untuk ID mobil --}}
            <input type="hidden" name="car_id" value="{{ $car->id }}">

            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" id="nama_penyewa" value="{{ old('nama_penyewa', Auth::user()->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="no_telp">Nomor Telepon</label>
                <input type="text" name="no_telp" id="no_telp" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label for="nama_supir">Nama Supir (opsional)</label>
                <input type="text" name="nama_supir" id="nama_supir" value="{{ old('nama_supir') }}">
            </div>

            <div class="form-group">
                <label for="telp_supir">No. Telepon Supir (opsional)</label>
                <input type="text" name="telp_supir" id="telp_supir" value="{{ old('telp_supir') }}">
            </div>

            <div class="form-group">
                <label for="tujuan">Tujuan Sewa</label>
                <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}" required>
            </div>

            <div class="form-group">
                <label for="mulai_tgl">Tanggal Mulai</label>
                <input type="date" name="mulai_tgl" id="mulai_tgl" required>
            </div>

            <div class="form-group">
                <label for="mulai_pkl">Jam Mulai (opsional)</label>
                <input type="time" name="mulai_pkl" id="mulai_pkl">
            </div>

            <div class="form-group">
                <label for="sel_tgl">Tanggal Selesai</label>
                <input type="date" name="sel_tgl" id="sel_tgl" required>
            </div>

            <div class="form-group">
                <label for="sel_pkl">Jam Selesai (opsional)</label>
                <input type="time" name="sel_pkl" id="sel_pkl">
            </div>

            <div class="form-group">
                <label for="lama_hari">Lama Sewa (hari)</label>
                <input type="number" name="lama_hari" id="lama_hari" readonly>
            </div>

            <div class="form-group">
                <label for="biaya_harian">Biaya per Hari (Rp)</label>
                <input type="text" name="biaya_harian" id="biaya_harian" value="{{ $car->biaya_harian }}" readonly>
            </div>

            <div class="form-group">
                <label for="total_pembayaran">Total Pembayaran (Rp)</label>
                <input type="text" name="total_pembayaran" id="total_pembayaran" readonly>
            </div>

            <div class="form-group">
                <label for="bentuk_jaminan">Bentuk Jaminan</label>
                <input type="text" name="bentuk_jaminan" id="bentuk_jaminan" required>
            </div>

            <div class="form-group">
                <label for="posisi_bbm">Posisi BBM Awal</label>
                <select name="posisi_bbm" id="posisi_bbm" required>
                    <option value="">-- Pilih Posisi BBM --</option>
                    <option value="penuh">Penuh</option>
                    <option value="setengah">Setengah</option>
                    <option value="sedikit">Sedikit</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file_ktp">Upload KTP</label>
                <input type="file" name="file_ktp" id="file_ktp" accept="image/*,application/pdf" required>
            </div>

            <div class="form-group">
                <label for="file_sim">Upload SIM</label>
                <input type="file" name="file_sim" id="file_sim" accept="image/*,application/pdf" required>
            </div>

            <div class="form-group">
                <label for="file_stnk_motor">Upload STNK Motor (opsional)</label>
                <input type="file" name="file_stnk_motor" id="file_stnk_motor" accept="image/*,application/pdf">
            </div>

            <button type="submit" class="btn-submit">Kirim Booking</button>
        </form>
    </div>

    <script>
        // Auto hitung lama sewa dan total harga
        document.addEventListener('input', function () {
            const mulai = new Date(document.getElementById('mulai_tgl').value);
            const selesai = new Date(document.getElementById('sel_tgl').value);
            const biaya = parseFloat(document.getElementById('biaya_harian').value);

            if (!isNaN(mulai) && !isNaN(selesai)) {
                const diff = (selesai - mulai) / (1000 * 60 * 60 * 24);
                if (diff >= 0) {
                    document.getElementById('lama_hari').value = diff + 1;
                    document.getElementById('total_pembayaran').value = (diff + 1) * biaya;
                }
            }
        });
    </script>
</body>
</html>
