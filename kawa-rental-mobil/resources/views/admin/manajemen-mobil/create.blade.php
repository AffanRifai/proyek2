@extends('layout.master')

@section('admin_content')
<div class="content-wrapper p-4">

    <h3 class="mb-4">Tambah Mobil</h3>

    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            
            <div class="col-md-6">

                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" name="merk" class="form-control">
                </div>

                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="model" class="form-control">
                </div>

                <div class="form-group">
                    <label>Warna</label>
                    <input type="text" name="warna" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" name="tahun" class="form-control">
                </div>

                <div class="form-group">
                    <label>Transmisi</label>
                    <select name="transmisi" class="form-control">
                        <option value="manual">Manual</option>
                        <option value="matic">Matic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kapasitas Penumpang</label>
                    <input type="number" name="kapasitas_penumpang" class="form-control">
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>Biaya Harian</label>
                    <input type="number" name="biaya_harian" class="form-control">
                </div>

                <div class="form-group">
                    <label>Foto Mobil</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Rangka</label>
                    <input type="text" name="no_rangka" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Mesin</label>
                    <input type="text" name="no_mesin" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Polisi</label>
                    <input type="text" name="no_polisi" class="form-control">
                </div>

                <div class="form-group">
                    <label>STNK Atas Nama</label>
                    <input type="text" name="stnk_atas_nama" class="form-control">
                </div>

            </div>

        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
