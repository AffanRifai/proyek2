@extends('layout.master')

@section('admin_content')
<div class="content-wrapper p-4">

    <h3 class="mb-3">Manajemen Mobil</h3>

    <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary mb-3">Tambah Mobil +</a>

    <table class="table table-bordered text-center">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Tahun</th>
                <th>Kapasitas</th>
                <th>Harga / Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mobil as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td><img src="{{ asset('storage/mobil/'.$item->gambar) }}" width="100"></td>

                <td>{{ $item->merk }}</td>
                <td>{{ $item->model }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->kapasitas_penumpang }} Orang</td>

                <td>Rp {{ number_format($item->biaya_harian) }}</td>

                <td>{{ ucfirst($item->status) }}</td>

                <td>
                    <a href="{{ route('admin.mobil.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.mobil.destroy', $item->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Hapus mobil ini?')"
                                class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
