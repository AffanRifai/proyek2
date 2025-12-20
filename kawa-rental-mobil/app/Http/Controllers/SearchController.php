<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Artikel;
use App\Models\Car;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchMobil(Request $request)
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = Car::where(function ($q) use ($query) {
            $q->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('merk', 'LIKE', "%{$query}%")
                ->orWhere('tipe', 'LIKE', "%{$query}%")
                ->orWhere('deskripsi', 'LIKE', "%{$query}%");
        })
            ->where('status', 'tersedia')
            ->limit(10)
            ->get()
            ->map(function ($mobil) use ($query) {
                return [
                    'id' => $mobil->id,
                    'title' => $mobil->nama . ' - ' . $mobil->merk,
                    'url' => route('mobil.detail', $mobil->slug),
                    'excerpt' => $this->highlightText(substr($mobil->deskripsi, 0, 150), $query),
                    'type' => 'mobil',
                    'image' => $mobil->foto_utama ? asset('storage/' . $mobil->foto_utama) : asset('img/default-car.png'),
                    'price' => 'Rp ' . number_format($mobil->harga_sewa, 0, ',', '.') . '/hari'
                ];
            });

        return response()->json($results);
    }

    public function searchArtikel(Request $request)
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = Artikel::where(function ($q) use ($query) {
            $q->where('judul', 'LIKE', "%{$query}%")
                ->orWhere('konten', 'LIKE', "%{$query}%");
        })
            ->where('status', 'published')
            ->limit(10)
            ->get()
            ->map(function ($artikel) use ($query) {
                return [
                    'id' => $artikel->id,
                    'title' => $artikel->judul,
                    'url' => route('artikel.detail', $artikel->slug),
                    'excerpt' => $this->highlightText(strip_tags(substr($artikel->konten, 0, 150)), $query),
                    'type' => 'artikel',
                    'date' => $artikel->created_at->format('d M Y'),
                    'category' => $artikel->kategori
                ];
            });

        return response()->json($results);
    }

    public function searchAll(Request $request)
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $mobilResults = $this->searchMobil($request)->getData();
        $artikelResults = $this->searchArtikel($request)->getData();

        return response()->json([
            'mobil' => $mobilResults,
            'artikel' => $artikelResults,
            'total' => count($mobilResults) + count($artikelResults)
        ]);
    }

    private function highlightText($text, $query)
    {
        if (empty($query)) {
            return $text;
        }

        $highlighted = preg_replace(
            "/(" . preg_quote($query, '/') . ")/i",
            "<mark>$1</mark>",
            $text
        );

        return $highlighted;
    }
}
