@extends('layout.master')

@section('admin_content')
<div class="content-wrapper p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 font-weight-bold">Manajemen Mobil</h4>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary btn-sm">
            + Tambah Mobil
        </a>
    </div>

    {{-- ================= DESKTOP ================= --}}
    <div class="d-none d-md-block">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Mobil</th>
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

                    <td>
                        <img src="{{ asset($item->gambar) }}"
                             class="rounded"
                             width="90"
                             style="object-fit:cover">
                    </td>

                    <td class="text-left">
                        <strong>{{ $item->merk }} {{ $item->model }}</strong><br>
                        <small class="text-muted">{{ ucfirst($item->transmisi) }}</small>
                    </td>

                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->kapasitas_penumpang }} Org</td>
                    <td>Rp {{ number_format($item->biaya_harian) }}</td>

                    <td>
                        <span class="badge badge-success px-2 py-1">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('admin.mobil.edit', $item->id) }}"
                           class="btn btn-warning btn-sm mb-1">
                           Edit
                        </a>

                        <form action="{{ route('admin.mobil.destroy', $item->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus mobil ini?')"
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ================= MOBILE (CAKEP) ================= --}}
    <div class="d-block d-md-none">
        @foreach ($mobil as $item)
        <div class="card mb-3 shadow-sm border-0">

            <img src="{{ asset($item->gambar) }}"
                 style="height:180px; object-fit:cover;"
                 class="card-img-top rounded-top">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 font-weight-bold">
                        {{ $item->merk }} {{ $item->model }}
                    </h6>

                    <span class="badge badge-success">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <small class="text-muted">
                    {{ $item->tahun }} • {{ ucfirst($item->transmisi) }} • {{ $item->kapasitas_penumpang }} Org
                </small>

                <div class="mt-2">
                    <strong class="text-primary">
                        Rp {{ number_format($item->biaya_harian) }} / hari
                    </strong>
                </div>

                <div class="row mt-3">
                    <div class="col-6 pr-1">
                        <a href="{{ route('admin.mobil.edit', $item->id) }}"
                           class="btn btn-warning btn-sm w-100">
                            Edit
                        </a>
                    </div>
                    <div class="col-6 pl-1">
                        <form action="{{ route('admin.mobil.destroy', $item->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus mobil ini?')"
                                    class="btn btn-danger btn-sm w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
