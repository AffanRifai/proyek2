<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class AdminCarController extends Controller
{
    // LIST MOBIL
    public function index()
    {
        $mobil = Car::all();
        return view('admin.manajemen-mobil.index', compact('mobil'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.manajemen-mobil.create');
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tahun' => 'required',
            'transmisi' => 'required',
            'kapasitas_penumpang' => 'required|integer',
            'biaya_harian' => 'required|integer',
            'gambar' => 'required|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/mobil', $filename);
            $path = 'storage/mobil/' . $filename;
        }

        Car::create([
            'merk' => $request->merk,
            'model' => $request->model,
            'warna' => $request->warna,
            'tahun' => $request->tahun,
            'transmisi' => $request->transmisi,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'biaya_harian' => $request->biaya_harian,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'no_polisi' => $request->no_polisi,
            'stnk_atas_nama' => $request->stnk_atas_nama,
            'deskripsi' => $request->deskripsi,
            'fasilitas' => $request->fasilitas,
            'syarat' => $request->syarat,
            'kebijakan' => $request->kebijakan,
            'gambar' => $path,
            'status' => 'tersedia',
        ]);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $mobil = Car::findOrFail($id);
        return view('admin.manajemen-mobil.edit', compact('mobil'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mobil = Car::findOrFail($id);

        $request->validate([
            'merk' => 'required',
            'model' => 'required',
            'warna' => 'required',
            'tahun' => 'required',
            'transmisi' => 'required',
            'kapasitas_penumpang' => 'required|integer',
            'biaya_harian' => 'required|integer',
            'gambar' => 'image|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('public/mobil', $filename);
            $data['gambar'] = 'storage/mobil/' . $filename;
        }

        $mobil->update($data);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil diperbarui');
    }

    // HAPUS
    public function destroy($id)
    {
        Car::destroy($id);
        return redirect()->back()
            ->with('success', 'Mobil berhasil dihapus');
    }
}
