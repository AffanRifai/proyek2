<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Surat Perjanjian & Formulir Sewa - KAWA Car Rent</title>
    <link rel="stylesheet" href="{{ secure_asset('css/formrental.css')}}">
    <!-- poppins -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Montserrat -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600,700&display=swap" rel="stylesheet">
    <!-- Lato -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="#" class="logo">
            <img src="/kawa-rental-mobil/public/img/logo-kawa.png" alt="logo kawa rental mobil" />
        </a>
        <nav>
            <ul>
                <li><a href="/kawa-rental-mobil/resources/views/landingpage.blade.php">Beranda</a></li>
                <li><a href="#">Daftar Mobil</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="#">Tentang</a></li>
                <li class="search-container">
                    <input type="search" placeholder="Search" aria-label="Cari" />
                </li>
                <li><button class="login-btn" aria-label="Login">Login</button></li>
            </ul>
        </nav>
    </header>

    <div class="wrap">
        <div class="title-badge">SURAT PERJANJIAN TERIMA SEWA KENDARAAN</div>
        <div class="card">
            <form id="rentalForm" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
                <div class="grid-2">
                    <!-- LEFT: Main form -->
                    <div>
                        <!-- Data Penyewa -->
                        <div class="section">
                            <h3>DATA PENYEWA</h3>
                            <div class="two-col">
                                <div>
                                    <label>Nama Penyewa (sesuai KTP)</label>
                                    <input id="nama_penyewa" name="nama_penyewa" required>
                                </div>
                                <div>
                                    <label>No. Telp</label>
                                    <input id="no_telp" name="no_telp" type="tel" required>
                                </div>
                            </div>

                            <div style="margin-top:8px">
                                <label>Alamat</label>
                                <input id="alamat" name="alamat">
                            </div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Nama Supir (jika ada)</label>
                                    <input id="nama_supir" name="nama_supir">
                                </div>
                                <div>
                                    <label>No. Telp Supir</label>
                                    <input id="telp_supir" name="telp_supir">
                                </div>
                            </div>
                        </div>

                        <!-- Data Kendaraan (otomatis) -->
                        <div class="section" style="margin-top:12px">
                            <h3>DATA KENDARAAN (otomatis)</h3>

                            <div class="two-col">
                                <div>
                                    <label>Merk / Type</label>
                                    <input id="veh_merk" name="veh_merk" readonly>
                                </div>
                                <div>
                                    <label>Jenis / Model</label>
                                    <input id="veh_model" name="veh_model" readonly>
                                </div>
                            </div>

                            <div class="two-col" style="margin-top:8px">
                                <div>
                                    <label>Warna</label>
                                    <input id="veh_warna" name="veh_warna" readonly>
                                </div>
                                <div>
                                    <label>Tahun Pembuatan</label>
                                    <input id="veh_tahun" name="veh_tahun" readonly>
                                </div>
                            </div>

                            <div class="two-col" style="margin-top:8px">
                                <div>
                                    <label>No. Rangka</label>
                                    <input id="veh_rangka" name="veh_rangka" readonly>
                                </div>
                                <div>
                                    <label>No. Mesin</label>
                                    <input id="veh_mesin" name="veh_mesin" readonly>
                                </div>
                            </div>

                            <div class="two-col" style="margin-top:8px">
                                <div>
                                    <label>No. Polisi</label>
                                    <input id="veh_polisi" name="veh_polisi" readonly>
                                </div>
                                <div>
                                    <label>STNK Atas Nama</label>
                                    <input id="veh_stnk" name="veh_stnk" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Data Sewa Kendaraan -->
                        <div class="section" style="margin-top:12px">
                            <h3>DATA SEWA KENDARAAN</h3>

                            <div class="three-col">
                                <div>
                                    <label>Tujuan Kota/Kab.</label>
                                    <input id="tujuan" name="tujuan" required>
                                </div>
                                <div>
                                    <label>Mulai Sewa (tgl)</label>
                                    <input id="mulai_tgl" name="mulai_tgl" type="date" onchange="calculateAll()" required>
                                </div>
                                <div>
                                    <label>Mulai Pukul</label>
                                    <input id="mulai_pkl" name="mulai_pkl" type="time">
                                </div>
                            </div>

                            <div class="three-col" style="margin-top:8px">
                                <div>
                                    <label>Selesai Sewa (tgl)</label>
                                    <input id="sel_tgl" name="sel_tgl" type="date" readonly>
                                </div>
                                <div>
                                    <label>Selesai Pukul</label>
                                    <input id="sel_pkl" name="sel_pkl" type="time">
                                </div>
                                <div>
                                    <label>Lama Sewa (hari)</label>
                                    <select id="lama_hari" name="lama_hari" onchange="calculateAll()" required>
                                        <option value="1">1 hari</option>
                                        <option value="2">2 hari</option>
                                        <option value="3">3 hari</option>
                                        <option value="4">4 hari</option>
                                        <option value="5">5 hari</option>
                                        <option value="6">6 hari</option>
                                        <option value="7">7 hari</option>
                                    </select>
                                </div>
                            </div>

                            <div class="two-col" style="margin-top:8px">
                                <div>
                                    <label>Biaya per Hari (Rp)</label>
                                    <input id="biaya_harian" name="biaya_harian" type="number" min="0" readonly>
                                </div>
                            </div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Berangkat KM (opsional)</label>
                                    <input id="brg_km" name="brg_km" type="number">
                                </div>
                                <div>
                                    <label>Pulang KM (opsional)</label>
                                    <input id="plg_km" name="plg_km" type="number">
                                </div>
                            </div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Bentuk Jaminan</label>
                                    <select id="bentuk_jaminan" name="bentuk_jaminan">
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                        <option value="stnk_motor">STNK Motor</option>
                                        <option value="kk">Kartu Keluarga</option>
                                        <option value="lain">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top:8px">
                                <label>Posisi BBM saat keluar</label>
                                <select id="posisi_bbm" name="posisi_bbm">
                                    <option value="full">Full</option>
                                    <option value="3/4">3/4</option>
                                    <option value="1/2">1/2</option>
                                    <option value="1/4">1/4</option>
                                </select>
                            </div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Total Pembayaran (Rp)</label>
                                    <input id="total_pembayaran" name="total_pembayaran" readonly>
                                </div>
                            </div>

                        </div>

                        <!-- Upload Jaminan -->
                        <div class="section" style="margin-top:12px">
                            <h3>UPLOAD FOTO JAMINAN</h3>
                            <div class="small">Upload foto KTP/SIM atau STNK apabila menggunakan kendaraan (motor) sebagai jaminan. Maks 5MB / file.</div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Foto KTP (jika KTP sebagai jaminan)</label>
                                    <input type="file" accept="image/*" id="file_ktp">
                                    <div class="file-preview" id="preview_ktp"></div>
                                </div>
                                <div>
                                    <label>Foto SIM (jika SIM sebagai jaminan)</label>
                                    <input type="file" accept="image/*" id="file_sim">
                                    <div class="file-preview" id="preview_sim"></div>
                                </div>
                            </div>

                            <div style="margin-top:8px" class="two-col">
                                <div>
                                    <label>Foto STNK Motor (jika motor sebagai jaminan)</label>
                                    <input type="file" accept="image/*" id="file_stnk_motor">
                                    <div class="file-preview" id="preview_stnk"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div>
                        <div class="section">
                            <h3>RINGKASAN & PEMBAYARAN</h3>
                            <div class="summary">
                                <div><span>Nama</span><span id="sum_nama">-</span></div>
                                <div><span>Mobil</span><span id="sum_mobil">-</span></div>
                                <div><span>Mulai</span><span id="sum_mulai">-</span></div>
                                <div><span>Selesai</span><span id="sum_selesai">-</span></div> <!-- BARU -->
                                <div><span>Lama</span><span id="sum_lama">-</span></div>
                                <div><span>Biaya / Hari</span><span id="sum_biaya">Rp 0</span></div>
                                <div><strong>Total</strong><strong id="sum_total">Rp 0</strong></div>
                            </div>

                            <div class="small">Catatan: Biaya & konfirmasi akhir akan diverifikasi oleh admin. Upload identitas dan STNK motor jika menggunakan motor sebagai jaminan.</div>

                            <div style="margin-top:10px" class="actions">
                                <button type="button" class="btn btn-ghost" onclick="resetForm()">Reset</button>
                                <button type="button" class="btn btn-primary" onclick="calculateAll()">Hitung Total</button>
                            </div>
                        </div>

                        <div class="section">
                            <h3>PEMBAYARAN</h3>
                            <div class="small">Pembayaran dapat dilakukan via transfer bank atau e-wallet. Pilih metode pembayaran di bawah ini.</div>
                            <div class="payment">
                                <button type="button" class="btn btn-primary" onclick="bayarMuka()">Bayar Muka</button>
                                <button type="button" class="btn btn-primary" onclick="bayarPenuh()">Bayar Penuh</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="/kawa-rental-mobil/public/js/formrental.js"></script>

</body>

</html>