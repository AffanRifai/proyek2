@extends('layout.master')

@section('admin_content')
<div class="content-wrapper p-4">

    <h3 class="mb-4">Edit Mobil</h3>

    <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" name="merk" value="{{ $mobil->merk }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="model" value="{{ $mobil->model }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Warna</label>
                    <input type="text" name="warna" value="{{ $mobil->warna }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" name="tahun" value="{{ $mobil->tahun }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Transmisi</label>
                    <select name="transmisi" class="form-control">
                        <option value="manual" {{ $mobil->transmisi == 'manual' ? 'selected' : '' }}>Manual</option>
                        <option value="matic" {{ $mobil->transmisi == 'matic' ? 'selected' : '' }}>Matic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kapasitas Penumpang</label>
                    <input type="number" name="kapasitas_penumpang" value="{{ $mobil->kapasitas_penumpang }}" class="form-control">
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label>Biaya Harian</label>
                    <input type="number" name="biaya_harian" value="{{ $mobil->biaya_harian }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Foto Mobil Saat Ini</label><br>
                    <img src="{{ asset('storage/mobil/' . $mobil->gambar) }}" width="200" class="mb-2">
                </div>

                <div class="form-group">
                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Rangka</label>
                    <input type="text" name="no_rangka" value="{{ $mobil->no_rangka }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Mesin</label>
                    <input type="text" name="no_mesin" value="{{ $mobil->no_mesin }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>No. Polisi</label>
                    <input type="text" name="no_polisi" value="{{ $mobil->no_polisi }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>STNK Atas Nama</label>
                    <input type="text" name="stnk_atas_nama" value="{{ $mobil->stnk_atas_nama }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status Mobil</label>
                    <select name="status" class="form-control">
                        <option value="tersedia" {{ $mobil->status=='tersedia' ? 'selected' : ''}}>Tersedia</option>
                        <option value="disewa" {{ $mobil->status=='disewa' ? 'selected' : ''}}>Disewa</option>
                        <option value="perawatan" {{ $mobil->status=='perawatan' ? 'selected' : ''}}>Perawatan</option>
                    </select>
                </div>

            </div>

        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $mobil->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
