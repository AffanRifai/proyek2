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
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Honda',
                'model' => 'Brio Satya E MT',
                'warna' => 'Kuning',
                'tahun' => '2018',
                'no_rangka' =>null,
                'no_mesin' => null,
                'no_polisi' => 'B3456GHI',
                'stnk_atas_nama' => null,
                'biaya_harian' => 350000,
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Honda',
                'model' => 'Brio Satya E CVT',
                'warna' => 'Kuning',
                'tahun' => '2018',
                'no_rangka' =>null,
                'no_mesin' => null,
                'no_polisi' => 'B9012DEF',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Toyota',
                'model' => 'All New Avanza MT',
                'warna' => 'Hitam',
                'tahun' => '2021',
                'no_rangka' =>null,
                'no_mesin' => null,
                'no_polisi' => 'B5678XYZ',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'status' => 'tersedia'
            ],
            [
                'merk' => 'Toyota',
                'model' => 'All New Avanza AT',
                'warna' => 'Hitam',
                'tahun' => '2021',
                'no_rangka' =>null,
                'no_mesin' => null,
                'no_polisi' => 'B1234ABC',
                'stnk_atas_nama' => null,
                'biaya_harian' => 500000,
                'status' => 'tersedia'
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
