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
                'transmisi' => 'Manual',
                'kapasitas_penumpang' => '7',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B2345CDE',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'gambar' => 'images/mobil/Mobilio.png',
                'status' => 'tersedia',
                'deskripsi' => "Honda Mobilio merupakan Low MPV yang lincah dan irit bahan bakar, dirancang untuk memberikan kenyamanan dan kepraktisan maksimal bagi keluarga serta kebutuhan sehari-hari.
                                Berikut keunggulan unit kami:
                                1. Desain Eksterior & Dimensi
                                    • Tampilan Modern dan Dinamis: Mobilio memiliki desain yang sporty dan modern, dengan garis bodi yang aerodinamis. Desain lampu depan (headlamp) yang tajam dan gril berlapis krom (pada beberapa varian) memberikan kesan elegan di kelasnya.
                                    • Dimensi Kompak: Sebagai Low MPV, Mobilio menawarkan dimensi yang ideal untuk bermanuver di jalan perkotaan yang padat.
                                        o Panjang: Sekitar 4.386 mm
                                        o Lebar: Sekitar 1.683 mm
                                        o Tinggi: Sekitar 1.603 mm
                                    • Ground Clearance Tinggi: Dengan jarak ke tanah yang cukup tinggi, Mobilio lebih percaya diri melintasi jalan bergelombang atau genangan air.
                                2. Kenyamanan Interior & Kapasitas
                                    • Kabin Fleksibel 7 Penumpang: Mobilio didesain untuk menampung tujuh penumpang (7-seater) dengan konfigurasi kursi 2-3-2.
                                    • Akses Mudah ke Baris Ketiga: Kursi baris kedua dapat dilipat dengan mudah (One-Touch Tumble) untuk memberikan akses yang praktis.
                                    • AC Double Blower: Dilengkapi dengan sistem pendingin udara Double Blower yang memastikan pendinginan merata hingga ke belakang.
                                    • Bagasi Luas: Ketika kursi baris ketiga dilipat, Mobilio menawarkan ruang bagasi yang sangat luas dan fleksibel, mampu menampung banyak barang bawaan.
                                3. Performa Mesin & Transmisi
                                    • Mesin Irit dan Bertenaga (i-VTEC): Ditenagai mesin bensin 4-silinder 1.5L SOHC i-VTEC yang terkenal efisien dan menghasilkan tenaga responsif.
                                        o Kapasitas: 1.496 cc.
                                        o Tenaga Maksimal: Sekitar 118 PS, salah satu yang terbesar di kelasnya.
                                    • Transmisi Manual yang Responsif: Unit dengan transmisi manual (biasanya 5 percepatan) memberikan pengemudi kontrol penuh atas akselerasi dan *engine braking*, ideal untuk pengalaman berkendara yang *sporty* dan efisien saat melintasi rute menanjak.
                                4. Fitur Keselamatan (Safety)
                                    Mobilio dilengkapi dengan fitur keselamatan standar untuk melindungi penumpang:
                                        • Dual SRS Airbags (untuk pengemudi dan penumpang depan).
                                        • Anti-lock Braking System (ABS) dan Electronic Brake-force Distribution (EBD) untuk memastikan pengereman yang aman dan optimal, terutama dalam kondisi darurat.
                                        • Struktur Rangka G-CON + ACE™: Struktur bodi yang dirancang untuk meredam energi benturan saat terjadi tabrakan.
                                        • ISOFIX dan Tether: Tersedia fitur pengait kursi anak untuk keselamatan balita.
                                    Honda Mobilio Manual sangat ideal untuk disewa sebagai kendaraan:
                                        • Kendaraan Harian Keluarga: Irit dan praktis untuk mengantar anak sekolah atau berbelanja.
                                        • Perjalanan Luar Kota Ringan: Mesin 1.5L yang bertenaga menjamin performa yang andal.
                                        • Liburan Keluarga Kecil/Menengah: Kapasitas 7-seater memberikan fleksibilitas tanpa perlu kendaraan yang terlalu besar.

                                ",
                'fasilitas' => "• AC otomatis dan ventilasi rear AC
                                • Radio/Tape/CD/MP3 Android
                                • Charger
                                ",
                'syarat' => "Syarat & Ketentuan Sewa
                            Berikut adalah poin-poin kesepakatan antara Pihak Pertama (Kawa Car Rent) dan Pihak Kedua (Penyewa):
                            • Perpanjangan Waktu (Overtime): Wajib dikonfirmasi minimal 6 (enam) Jam sebelum masa sewa berakhir.
                            • Penyalahgunaan Kendaraan: Segala bentuk penyalahgunaan kendaraan diluar tanggung jawab Pihak Pertama (Kawa Car Rent).
                            • Tanggung Jawab Kerusakan/Kehilangan: Segala resiko kerusakan, kecelakaan, dan kehilangan kendaraan adalah tanggung jawab Pihak Kedua (Penyewa).
                            • Tilang Elektronik (E-Tilang): Apabila terkena E-Tilang, Pihak Kedua wajib membayar denda e-Tilang jika Pihak Pertama menerima data/surat tilang dari Kepolisian.
                            •Persetujuan: Penyewa telah membaca dan menyetujui seluruh kesepakatan yang tertulis di atas.
                            ",
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
