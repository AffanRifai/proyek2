<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'merk' => 'Honda',
                'model' => 'Mobilio E MT',
                'warna' => 'Hitam',
                'tahun' => '2017',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B2345CDE',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'gambar' => 'images/mobil/Mobilio.png',
                'status' => 'tersedia',
                'deskripsi' => null,
                'fasilitas' => null,
                'syarat' => null,
                'kebijakan' => "Kebijakan (Detail Perjanjian)
                                Berikut adalah poin-poin detail dari Surat Perjanjian Sewa antara Pihak Pertama (Kawa Car Rent) dan Pihak Kedua (Penyewa):
                                • PASAL 1 (Tanggung Jawab Pihak Pertama): Pihak Pertama tidak bertanggung jawab atas segala tindakan/perbuatan atau akibat yang ditimbulkan oleh Pihak Kedua sehubungan dengan kendaraan tersebut.
                                • PASAL 2 (Pemindahan Kendaraan): Pihak Kedua tidak diperkenankan memindahkan atau menyerahkan kendaraan tersebut kepada orang lain.
                                • PASAL 3 (Pengambilan Kendaraan Sepihak): Pihak Pertama berhak mengambil kembali kendaraan secara sepihak sebelum masa sewa berakhir jika kendaraan dianggap tidak terawat, digunakan untuk tindakan melawan hukum, atau dipindahtangankan kepada pihak lain.
                                • PASAL 4 (Risiko & Perbaikan): Apabila terjadi musibah atau kelalaian Pihak Kedua yang menyebabkan kecelakaan, kehilangan, kerusakan, pergantian suku cadang, atau perlengkapan kendaraan, Pihak Kedua bertanggung jawab menanggung segala risikonya. Perbaikan atau perawatan harus atas persetujuan Pihak Pertama.
                                • PASAL 5 (Tilang Elektronik): Apabila terkena E-Tilang, Pihak Kedua wajib membayar denda e-Tilang jika Pihak Pertama menerima data/surat tilang dari Kepolisian.
                                • PASAL 6 (Penyelesaian Masalah): Kedua belah pihak sepakat memilih penyelesaian di Kantor Panitera Pengadilan Negeri Kelas 1 Indramayu jika terjadi masalah yang berhubungan dengan Surat Perjanjian.

                                ",

            ],
            [
                'merk' => 'Honda',
                'model' => 'Brio Satya E MT',
                'warna' => 'Kuning',
                'tahun' => '2018',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B3456GHI',
                'stnk_atas_nama' => null,
                'biaya_harian' => 350000,
                'gambar' => 'images/mobil/BrioManual.png',
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Honda',
                'model' => 'Brio Satya E CVT',
                'warna' => 'Kuning',
                'tahun' => '2018',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B9012DEF',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'gambar' => 'images/mobil/BrioMatic.png',
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Toyota',
                'model' => 'All New Avanza MT',
                'warna' => 'Hitam',
                'tahun' => '2021',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B5678XYZ',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'gambar' => 'images/mobil/AvanzaMT.png',
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Toyota',
                'model' => 'All New Avanza AT',
                'warna' => 'Hitam',
                'tahun' => '2021',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B1234ABC',
                'stnk_atas_nama' => null,
                'biaya_harian' => 500000,
                'gambar' => 'images/mobil/AvanzaAT.png',
                'status' => 'tersedia'
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
