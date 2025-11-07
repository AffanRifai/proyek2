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
                'warna' => 'Orange',
                'tahun' => '2018',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B3456GHI',
                'stnk_atas_nama' => null,
                'biaya_harian' => 350000,
                'gambar' => 'images/mobil/BrioManual.png',
                'status' => 'tersedia',
                'deskripsi' => "Honda Brio Manual merupakan City Car / LCGC yang dikenal karena kelincahan dan efisiensi bahan bakarnya yang luar biasa. Mobil ini sangat ideal untuk bermanuver di perkotaan dan menjadi pilihan bagi pengemudi yang menyukai kontrol penuh atas kendaraan.

                                Berikut keunggulan unit kami:

                                1. Desain Eksterior & Dimensi
                                    • Tampilan Stylish dan Sporty: Brio memiliki desain modern, compact, dan menarik dengan tampilan depan agresif yang memberikan kesan stylish dan enerjik.
                                    • Dimensi Compact: Dirancang untuk memudahkan parkir dan bermanuver di jalan perkotaan yang padat.
                                        o Panjang: 3.800 mm
                                        o Lebar: 1.680 mm
                                        o Tinggi: 1.485 mm
                                    • Pelek Two-tone Alloy: Pada varian tertentu, Brio dilengkapi dengan pelek alloy dual-tone yang menambah kesan sporty.

                                2. Kenyamanan Interior & Kapasitas
                                    • Kabin Ergonomis: Meskipun berukuran kompak, interior Brio dirancang ergonomis dan fungsional.
                                    • Kapasitas Penumpang: Mampu menampung hingga lima penumpang dengan nyaman.
                                    • Bagasi Praktis: Cocok untuk barang belanjaan harian, dan kursi belakang dapat dilipat untuk menambah ruang angkut.
                                    • Sistem Pendingin Udara Digital: Dilengkapi AC cepat dingin dengan panel kontrol modern (tergantung varian).

                                3. Performa Mesin & Transmisi
                                    • Mesin Irit dan Responsif (i-VTEC): Menggunakan mesin 4-silinder 1.2L SOHC i-VTEC yang efisien dan bertenaga.
                                        o Kapasitas Mesin: 1.199 cc
                                        o Tenaga Maksimal: 90 PS
                                    • Transmisi Manual 5-Percepatan:
                                        o Kontrol Penuh: Memberikan pengemudi kendali total atas akselerasi dan engine braking.
                                        o Akselerasi Optimal: Efisien dalam menyalurkan tenaga, ideal untuk menyalip dan menaklukkan tanjakan.

                                4. Fitur Keselamatan (Safety)
                                    • Dual SRS Airbags untuk pengemudi dan penumpang depan.
                                    • ABS dan Electronic Brake-force Distribution (EBD) untuk pengereman yang lebih aman dan stabil.
                                    • Struktur Rangka G-CON + ACE™ untuk meredam energi benturan.
                                    • Sabuk Pengaman 3 Titik untuk seluruh kursi.

                                Honda Brio Satya Manual sangat ideal untuk disewa sebagai kendaraan:
                                    • Kendaraan Komuter Harian: Sangat efisien dan lincah untuk lalu lintas perkotaan.
                                    • Mobil Tugas Bisnis/Karyawan: Praktis, responsif, dan hemat biaya operasional.
                                    • Pengemudi yang Menyukai Kontrol Manual: Cocok untuk mereka yang ingin kendali penuh atas perpindahan gigi.
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
                'model' => 'Brio Satya E CVT',
                'warna' => 'Kuning',
                'tahun' => '2018',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B9012DEF',
                'stnk_atas_nama' => null,
                'biaya_harian' => 400000,
                'gambar' => 'images/mobil/BrioMatic.png',
                'status' => 'tersedia',
                'deskripsi' => "Honda Brio Matic merupakan City Car Hatchback yang lincah, irit bahan bakar, dan memiliki desain yang stylish serta sporty. Mobil ini sangat ideal untuk mobilitas tinggi di dalam kota.

                                Berikut keunggulan unit kami:

                                1. Desain Eksterior & Dimensi
                                    • Tampilan Modern dan Stylish: Brio Matic memiliki desain sporty dan modern dengan garis bodi stylish yang menonjolkan karakter anak muda.
                                    • Dimensi Kompak Namun Lebih Luas: Ukuran Brio generasi terbaru lebih panjang, lebih lebar, dan lebih tinggi dibanding model sebelumnya.
                                    • Ground Clearance: 189 mm, memberikan kenyamanan saat melewati medan tidak rata.
                                    • Penerangan Canggih: Lampu Proyektor dengan LED Daytime Running Light (DRL) untuk visibilitas maksimal.
                                    • Fitur Eksterior Premium:
                                        o Power Retractable Door Mirror dengan lampu sein LED
                                        o Pelek Alloy 15 inci yang stylish
                                        o Antena Sirip Hiu (Shark Fin Antenna)

                                2. Kenyamanan Interior & Kapasitas
                                    • Desain Interior Sporty: Interior didominasi warna hitam dengan desain modern dan sporty.
                                    • Kapasitas Penumpang: Dapat menampung hingga 5 penumpang dengan nyaman.
                                    • Kapasitas Bagasi: Memiliki kapasitas bagasi hingga 258 liter, termasuk ruang penyimpanan serbaguna di bawah lantai bagasi.
                                    • Kepraktisan dan Fitur:
                                        o Driver Seat Height Adjuster untuk mengatur ketinggian jok pengemudi
                                        o Head Unit 2DIN dengan USB, AUX-IN, dan Bluetooth

                                3. Performa Mesin & Transmisi
                                    • Mesin Irit dan Bertenaga (i-VTEC): Menggunakan mesin 4-silinder 1.2L SOHC i-VTEC yang lincah dan efisien.
                                        o Kapasitas Mesin: 1.199 cc
                                        o Tenaga Maksimal: 90 PS pada 6000 rpm
                                        o Torsi Maksimal: 110 Nm pada 4800 rpm
                                    • Transmisi Otomatis CVT: Perpindahan gigi sangat halus dan responsif, sekaligus meningkatkan efisiensi bahan bakar.
                                    • Sistem Drive by Wire: Menjamin kontrol bukaan gas yang lebih presisi.

                                4. Fitur Keselamatan (Safety)
                                    • Dual SRS Airbags untuk pengemudi dan penumpang depan.
                                    • Sistem Pengereman Canggih: ABS, EBD, dan Brake Assist (BA) untuk pengereman aman dan stabil.
                                    • Struktur Rangka G-CON + ACE yang efektif meredam energi benturan.
                                    • Keamanan Tambahan:
                                        o Immobilizer dan Alarm
                                        o ISOFIX & Tether untuk pemasangan kursi anak
                                        o Sensor Parkir dan Kamera Mundur

                                Honda Brio Matic sangat ideal untuk disewa sebagai kendaraan:
                                    • Kendaraan Harian: Lincah dan irit untuk mobilitas dalam kota.
                                    • Kebutuhan Bisnis atau Pekerjaan: Tampilan profesional dan stylish.
                                    • Perjalanan Akhir Pekan: Nyaman untuk liburan ringan bersama keluarga kecil.
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
                'status' => 'tersedia',
                'deskripsi' => "Toyota All New Avanza merupakan Low MPV generasi terbaru yang tangguh, irit bahan bakar, dan sangat mengutamakan kenyamanan. Mobil ini dikenal sebagai pilihan utama keluarga Indonesia, ideal untuk perjalanan dalam maupun luar kota.

                                Berikut keunggulan unit kami:

                                1. Desain Eksterior & Dimensi
                                    • Tampilan Gagah dan Modern: Avanza generasi terbaru memiliki desain yang agresif, modern, dan kokoh, terutama pada bagian depan yang memberikan kesan premium dan gagah.
                                    • Dimensi Ideal MPV: Menawarkan ukuran proporsional untuk menampung banyak penumpang dan barang, namun tetap mudah dikendalikan di jalan perkotaan.
                                        o Panjang: 4.395 mm
                                        o Lebar: 1.730 mm
                                        o Tinggi: 1.700 mm
                                    • Ground Clearance Tinggi: Dirancang dengan jarak ke tanah tinggi sehingga lebih andal saat melintasi jalan bergelombang atau genangan air.

                                2. Kenyamanan Interior & Kapasitas
                                    • Kabin Fleksibel 7 Penumpang: Avanza mampu menampung tujuh penumpang dengan ruang kabin lega, cocok untuk keluarga besar.
                                    • Mode Sofa (Long Sofa Mode): Kursi baris kedua dan ketiga dapat diatur menjadi mode sofa panjang untuk memberikan fleksibilitas dan kenyamanan maksimal selama perjalanan.
                                    • AC Double Blower: Menyediakan pendinginan cepat dan merata hingga penumpang baris ketiga.
                                    • Bagasi Luas dan Fleksibel: Kapasitas bagasi besar dan dapat diperluas dengan melipat rata kursi baris kedua dan ketiga.

                                3. Performa Mesin & Transmisi
                                    • Mesin Irit dan Andal (Dual VVT-i): Menggunakan mesin bensin 4-silinder 1.3L atau 1.5L Dual VVT-i yang efisien bahan bakar dan memiliki daya tahan tinggi.
                                        o Kapasitas Mesin: Mulai dari 1.329 cc
                                        o Tenaga Maksimal: Sekitar 98 PS (untuk 1.3L)
                                    • Transmisi Manual 5-Percepatan:
                                        o Tangguh dan Responsif: Memberikan kontrol penuh kepada pengemudi untuk akselerasi dan torsi yang optimal, ideal saat membawa beban penuh atau melintasi tanjakan.
                                        o Ketahanan Teruji: Transmisi manual Avanza dikenal sangat bandel dan minim masalah.

                                4. Fitur Keselamatan (Safety)
                                    • Dual SRS Airbags untuk pengemudi dan penumpang depan.
                                    • Sistem Pengereman ABS dan Electronic Brake-force Distribution (EBD) untuk pengereman lebih aman dan terkontrol.
                                    • Struktur Bodi Kuat: Dirancang untuk memberikan perlindungan maksimal kepada seluruh penumpang.

                                Toyota All New Avanza Manual sangat ideal untuk disewa sebagai kendaraan:
                                    • Kendaraan Harian Keluarga: Irit, nyaman, dan praktis untuk segala aktivitas keluarga.
                                    • Perjalanan Luar Kota atau Mudik: Andal di berbagai medan dengan kapasitas bagasi yang besar.
                                    • Tugas Kantor atau Proyek Lapangan: Tangguh, hemat BBM, dan mampu membawa banyak penumpang maupun perlengkapan.
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
                'merk' => 'Toyota',
                'model' => 'All New Avanza AT',
                'warna' => 'Putih',
                'tahun' => '2021',
                'no_rangka' => null,
                'no_mesin' => null,
                'no_polisi' => 'B1234ABC',
                'stnk_atas_nama' => null,
                'biaya_harian' => 500000,
                'gambar' => 'images/mobil/AvanzaAT.png',
                'status' => 'tersedia',
                'deskripsi' => "Toyota All New Avanza Automatic merupakan Low MPV generasi terbaru yang tangguh, lega, dan dirancang untuk memberikan kenyamanan maksimal saat berkendara di kemacetan perkotaan maupun perjalanan jauh. Mobil ini menjadi pilihan utama keluarga Indonesia.

                                Berikut keunggulan unit kami:

                                1. Desain Eksterior & Dimensi
                                    • Tampilan Gagah dan Modern: Avanza generasi terbaru memiliki desain yang lebih agresif, modern, dan kokoh, terutama pada bagian depan yang memberikan kesan premium dan gagah.
                                    • Dimensi Ideal MPV: Menawarkan ukuran proporsional untuk menampung banyak penumpang dan barang.
                                        o Panjang: 4.395 mm
                                        o Lebar: 1.730 mm
                                        o Tinggi: 1.700 mm
                                    • Ground Clearance Tinggi: Memberikan kemampuan melintasi jalan bergelombang atau genangan air dengan lebih aman dan nyaman.

                                2. Kenyamanan Interior & Kapasitas
                                    • Kabin Lega 7 Penumpang: Dirancang untuk menampung tujuh penumpang dengan ruang kabin yang lega, cocok untuk keluarga besar.
                                    • Mode Sofa (Long Sofa Mode): Kursi baris kedua dan ketiga dapat diatur menjadi mode sofa panjang untuk kenyamanan ekstra selama perjalanan.
                                    • AC Double Blower: Sistem pendingin udara merata dan cepat hingga penumpang baris ketiga.
                                    • Bagasi Luas dan Fleksibel: Kapasitas bagasi dapat diperluas dengan melipat rata kursi baris kedua dan ketiga untuk membawa lebih banyak barang.

                                3. Performa Mesin & Transmisi
                                    • Mesin Irit dan Andal (Dual VVT-i): Menggunakan mesin bensin 4-silinder 1.3L atau 1.5L Dual VVT-i yang terkenal efisien dan bertenaga.
                                        o Kapasitas Mesin: Mulai dari 1.329 cc
                                        o Tenaga Maksimal: Sekitar 98 PS (untuk 1.3L)
                                    • Transmisi Otomatis CVT yang Halus:
                                        o Kenyamanan Maksimal: Perpindahan gigi sangat halus, mulus, tanpa hentakan, ideal untuk penggunaan harian di kota.
                                        o Efisiensi BBM: Teknologi CVT membantu mesin bekerja optimal sehingga konsumsi bahan bakar lebih efisien.

                                4. Fitur Keselamatan (Safety)
                                    • Dual SRS Airbags untuk pengemudi dan penumpang depan.
                                    • Sistem Pengereman ABS dan Electronic Brake-force Distribution (EBD) untuk kontrol pengereman lebih aman.
                                    • Hill Start Assist (HSA): Membantu mencegah mobil mundur saat start di tanjakan (tersedia pada varian tertentu).

                                Toyota All New Avanza Automatic sangat ideal untuk disewa sebagai kendaraan:
                                    • Kendaraan Harian Keluarga: Sangat nyaman dan praktis untuk aktivitas keluarga di perkotaan.
                                    • Perjalanan Jarak Jauh atau Wisata: Transmisi otomatis mengurangi kelelahan saat berkendara jauh.
                                    • Tugas Kantor atau Proyek: Handal, lega, dan mudah dikemudikan oleh siapa saja.
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
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
