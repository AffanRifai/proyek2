@extends('layout.app')

@section('title', 'Beranda - KAWA Rental Mobil')

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/formrental.css') }}">
@endpush

@section('content')
    <div class="wrap">

        <div class="title-badge">SURAT PERJANJIAN TERIMA SEWA KENDARAAN</div>

        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input type="hidden" id="car_id" value="{{ $car->id }}">

                <div class="grid-2">
                    <!-- LEFT COLUMN -->
                    <div>
                        <!-- DATA PENYEWA -->
                        <div class="section">
                            <h3><span class="step-number">1</span> DATA PENYEWA</h3>
                            <div class="two-col">
                                <div class="form-group">
                                    <label for="nama_penyewa">Nama Penyewa (sesuai KTP) *</label>
                                    <input type="text" id="nama_penyewa" name="nama_penyewa"
                                        value="{{ old('nama_penyewa') }}" required>
                                    <small class="error-message" id="nama_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No. Telp *</label>
                                    <input id="no_telp" name="no_telp" type="tel" value="{{ old('no_telp') }}"
                                        required>
                                    <small class="error-message" id="telp_error"></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap *</label>
                                <textarea id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                <small class="error-message" id="alamat_error"></small>
                            </div>

                            <div class="two-col">
                                <div class="form-group">
                                    <label for="nama_supir">Nama Supir (jika ada)</label>
                                    <input id="nama_supir" name="nama_supir" value="{{ old('nama_supir') }}">
                                </div>
                                <div class="form-group">
                                    <label for="telp_supir">No. Telp Supir</label>
                                    <input id="telp_supir" name="telp_supir" value="{{ old('telp_supir') }}">
                                </div>
                            </div>
                        </div>

                        <!-- DATA KENDARAAN -->
                        <div class="section">
                            <h3><span class="step-number">2</span> DATA KENDARAAN</h3>
                            <div class="car-info-display">
                                <div class="car-image-small">
                                    <img src="{{ asset($car->gambar) }}" alt="{{ $car->merk }} {{ $car->model }}" />
                                </div>
                            </div>

                            <div class="readonly-fields">
                                <div class="two-col">
                                    <div class="form-group">
                                        <label>Merk / Type</label>
                                        <input value="{{ $car->merk }} {{ $car->model }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input value="{{ $car->tahun }}" readonly>
                                    </div>
                                </div>
                                <div class="two-col">
                                    <div class="form-group">
                                        <label>No. Polisi</label>
                                        <input value="{{ $car->no_polisi }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Biaya Harian</label>
                                        <input id="biaya_harian" name="biaya_harian" value="{{ $car->biaya_harian }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DATA SEWA -->
                        <div class="section">
                            <h3><span class="step-number">3</span> DATA SEWA KENDARAAN</h3>

                            <!-- Availability Check -->
                            <div id="availability-check" class="availability-status info">
                                <p>Silakan pilih tanggal untuk memeriksa ketersediaan</p>
                            </div>

                            <div class="three-col">
                                <div class="form-group">
                                    <label for="tujuan">Tujuan Kota/Kab. *</label>
                                    <input id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required>
                                    <small class="error-message" id="tujuan_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="mulai_tgl">Mulai Sewa (tgl) *</label>
                                    <input id="mulai_tgl" name="mulai_tgl" type="date" min="{{ date('Y-m-d') }}"
                                        value="{{ old('mulai_tgl', date('Y-m-d')) }}" required>
                                    <small class="error-message" id="mulai_tgl_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="mulai_pkl">Mulai Pukul *</label>
                                    <input id="mulai_pkl" name="mulai_pkl" type="time" value="{{ old('mulai_pkl') }}">
                                </div>
                            </div>

                            <div class="three-col">
                                <div class="form-group">
                                    <label for="sel_tgl">Selesai Sewa (tgl) *</label>
                                    <input id="sel_tgl" name="sel_tgl" type="date" value="{{ old('sel_tgl') }}"
                                        required>
                                    <small class="error-message" id="sel_tgl_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="sel_pkl">Selesai Pukul *</label>
                                    <input id="sel_pkl" name="sel_pkl" type="time" value="{{ old('sel_pkl') }}">
                                </div>
                                <div class="form-group">
                                    <label for="lama_hari">Lama Sewa (hari) *</label>
                                    <select id="lama_hari" name="lama_hari" required>
                                        <option value="">Pilih Lama Sewa</option>
                                        @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('lama_hari') == $i ? 'selected' : '' }}>
                                                {{ $i }} hari
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="error-message" id="lama_hari_error"></small>
                                </div>
                            </div>

                            <!-- Bagian BENTUK JAMINAN (dihapus pilihan KTP) -->
                            <div class="two-col">
                                <div class="form-group">
                                    <label for="bentuk_jaminan">Bentuk Jaminan *</label>
                                    <select id="bentuk_jaminan" name="bentuk_jaminan" required>
                                        <option value="">Pilih Jaminan</option>
                                        <option value="sim" {{ old('bentuk_jaminan') == 'sim' ? 'selected' : '' }}>
                                            SIM</option>
                                        <option value="stnk_motor"
                                            {{ old('bentuk_jaminan') == 'stnk_motor' ? 'selected' : '' }}>STNK Motor
                                        </option>
                                        <option value="kk" {{ old('bentuk_jaminan') == 'kk' ? 'selected' : '' }}>
                                            Kartu Keluarga</option>
                                        <option value="kartu_pelajar"
                                            {{ old('bentuk_jaminan') == 'kartu_pelajar' ? 'selected' : '' }}>Kartu
                                            Pelajar/Mahasiswa</option>
                                        <option value="lain" {{ old('bentuk_jaminan') == 'lain' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    <small class="error-message" id="jaminan_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="posisi_bbm">Posisi BBM saat keluar *</label>
                                    <select id="posisi_bbm" name="posisi_bbm" required>
                                        <option value="">Pilih Posisi BBM</option>
                                        <option value="full" {{ old('posisi_bbm') == 'full' ? 'selected' : '' }}>
                                            Full</option>
                                        <option value="3/4" {{ old('posisi_bbm') == '3/4' ? 'selected' : '' }}>3/4
                                        </option>
                                        <option value="1/2" {{ old('posisi_bbm') == '1/2' ? 'selected' : '' }}>1/2
                                        </option>
                                        <option value="1/4" {{ old('posisi_bbm') == '1/4' ? 'selected' : '' }}>1/4
                                        </option>
                                    </select>
                                    <small class="error-message" id="bbm_error"></small>
                                </div>
                            </div>
                            <!-- Tipe Pembayaran -->
                            <div class="form-group">
                                <label for="tipe_pembayaran">Tipe Pembayaran *</label>
                                <select id="tipe_pembayaran" name="tipe_pembayaran" required>
                                    <option value="">Pilih Tipe Pembayaran</option>
                                    <option value="dp" {{ old('tipe_pembayaran') == 'dp' ? 'selected' : '' }}>Down
                                        Payment (20%)</option>
                                    <option value="bayar_penuh"
                                        {{ old('tipe_pembayaran') == 'bayar_penuh' ? 'selected' : '' }}>Bayar Penuh
                                        (100%)</option>
                                </select>
                                <small class="error-message" id="pembayaran_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="total_pembayaran">Total Pembayaran (Rp)</label>
                                <input id="total_pembayaran" name="total_pembayaran" readonly value="0">
                            </div>
                        </div>

                        <!-- Bagian UPLOAD DOKUMEN (revisi) -->
                        <div class="section">
                            <h3><span class="step-number">4</span> UPLOAD DOKUMEN</h3>
                            <div class="small">Upload dokumen identitas dan jaminan. Maks 2MB per file.</div>

                            <div class="two-col">
                                <div class="form-group">
                                    <label for="file_identitas">File Identitas (KTP/Kartu Pelajar) *</label>
                                    <input type="file" name="file_identitas" accept="image/*,.pdf"
                                        id="file_identitas" required>
                                    <div class="file-preview" id="preview_identitas"></div>
                                    <small class="error-message" id="identitas_error"></small>
                                    <small class="file-info">KTP, Kartu Pelajar, atau Kartu Mahasiswa</small>
                                </div>
                                <div class="form-group">
                                    <label for="file_jaminan">File Jaminan *</label>
                                    <input type="file" name="file_jaminan" accept="image/*,.pdf" id="file_jaminan"
                                        required>
                                    <div class="file-preview" id="preview_jaminan"></div>
                                    <small class="error-message" id="jaminan_file_error"></small>
                                    <small class="file-info" id="jaminan_info">SIM, STNK, KK, dll sesuai pilihan
                                        jaminan</small>
                                </div>
                            </div>

                            <!-- STNK Motor additional field (jika memilih STNK sebagai jaminan) -->
                            <div class="form-group" id="stnk_motor_field" style="display: none;">
                                <label for="file_stnk_motor">Foto STNK Motor (Tambahan) *</label>
                                <input type="file" name="file_stnk_motor" accept="image/*,.pdf" id="file_stnk_motor">
                                <div class="file-preview" id="preview_stnk"></div>
                                <small class="error-message" id="stnk_error"></small>
                                <small class="file-info">Wajib diisi jika memilih STNK Motor sebagai jaminan</small>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div>
                        <!-- RINGKASAN & PEMBAYARAN -->
                        <div class="section sticky-summary">
                            <h3>RINGKASAN PEMESANAN</h3>
                            <div class="summary">
                                <div class="summary-item">
                                    <span>Mobil</span>
                                    <span id="sum_mobil">{{ $car->merk }} {{ $car->model }}</span>
                                </div>
                                <div class="summary-item">
                                    <span>Nama Penyewa</span>
                                    <span id="sum_nama">-</span>
                                </div>
                                <div class="summary-item">
                                    <span>Telepon</span>
                                    <span id="sum_telepon">-</span>
                                </div>
                                <div class="summary-item">
                                    <span>Tujuan</span>
                                    <span id="sum_tujuan">-</span>
                                </div>
                                <div class="summary-item">
                                    <span>Periode Sewa</span>
                                    <span id="sum_periode">-</span>
                                </div>
                                <div class="summary-item">
                                    <span>Lama Sewa</span>
                                    <span id="sum_lama">-</span>
                                </div>
                                <div class="summary-item">
                                    <span>Biaya Harian</span>
                                    <span id="sum_biaya">Rp
                                        {{ number_format($car->biaya_harian, 0, ',', '.') }}</span>
                                </div>
                                <div class="summary-item">
                                    <span>Tipe Pembayaran</span>
                                    <span id="sum_tipe_pembayaran">-</span>
                                </div>
                                <div class="summary-item total">
                                    <strong>Total Pembayaran</strong>
                                    <strong id="sum_total">Rp 0</strong>
                                </div>
                            </div>


                            <div class="payment-options">
                                <h4>KONFIRMASI PEMBAYARAN</h4>
                                <div class="payment-info">
                                    <button type="submit">
                                        <span class="submit-text">Kirim Booking Request & lakukan pembayaran</span>
                                    </button>
                                </div>
                            </div>

                            <div class="terms-agreement">
                                <label class="checkbox-container">
                                    <input type="checkbox" id="agree_terms" required>
                                    <span class="checkmark"></span>
                                    Saya menyetujui Syarat & Ketentuan yang berlaku
                                </label>
                            </div>

                            <div class="actions">
                                <button type="button" onclick="resetForm()">
                                    Reset Form
                                </button>
                            </div>
                            <br>
                            <hr>
                            <div class="note">
                                <small>Catatan: </small>
                                <br>
                                <small>Jika sudah melakukan <strong>booking & pembayaran</strong> booking & pembayaran
                                    data akan diverifikasi oleh admin, silakan
                                    cek di <strong>pesanan saya</strong> untuk mengetahui status pesanan</small>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
        <p>Memproses permintaan...</p>
    </div>

    <script>
        // File Upload Preview Functionality
        function setupFilePreview(inputId, previewId) {
            const fileInput = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewId);

            fileInput.addEventListener('change', function(e) {
                const files = e.target.files;
                previewContainer.innerHTML = ''; // Clear previous preview

                if (files.length > 0) {
                    const file = files[0];

                    // Check file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file maksimal 2MB');
                        fileInput.value = '';
                        return;
                    }

                    // Create preview element
                    const previewElement = document.createElement('div');
                    previewElement.className = 'file-preview-item';
                    previewElement.style.border = '2px dashed #ddd';
                    previewElement.style.borderRadius = '8px';
                    previewElement.style.padding = '15px';
                    previewElement.style.textAlign = 'center';
                    previewElement.style.backgroundColor = '#f9f9f9';
                    previewElement.style.marginTop = '6px';
                    previewElement.style.marginBottom = '8px';
                    previewElement.style.position = 'relative';

                    if (file.type.startsWith('image/')) {
                        // For image files
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Preview ' + file.name;
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '120px';
                            img.style.borderRadius = '4px';
                            img.style.marginBottom = '8px';

                            const fileName = document.createElement('div');
                            fileName.textContent = truncateFileName(file.name, 20);
                            fileName.style.fontSize = '0.85rem';
                            fileName.style.color = '#333';
                            fileName.style.fontWeight = '500';
                            fileName.style.marginBottom = '5px';

                            const fileSize = document.createElement('div');
                            fileSize.textContent = formatFileSize(file.size);
                            fileSize.style.fontSize = '0.75rem';
                            fileSize.style.color = '#666';
                            fileSize.style.marginBottom = '10px';

                            previewElement.appendChild(img);
                            previewElement.appendChild(fileName);
                            previewElement.appendChild(fileSize);

                            // Add cancel button
                            const cancelBtn = createCancelButton(fileInput, previewContainer);
                            previewElement.appendChild(cancelBtn);
                        };
                        reader.readAsDataURL(file);
                    } else if (file.type === 'application/pdf') {
                        // For PDF files
                        const pdfIcon = document.createElement('div');
                        pdfIcon.innerHTML = `
                        <div style="background: #ff4444; color: white; width: 60px; height: 80px;
                              border-radius: 6px; display: flex; flex-direction: column;
                              align-items: center; justify-content: center; margin: 0 auto 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white">
                                <path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8.5 7.5c0 .83-.67 1.5-1.5 1.5H9v2H7.5V7H10c.83 0 1.5.67 1.5 1.5v1zm5 2c0 .83-.67 1.5-1.5 1.5h-2.5V7H15c.83 0 1.5.67 1.5 1.5v3zm4-3H19v1h1.5V11H19v2h-1.5V7h3v1.5zM9 9.5h1v-1H9v1z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                            <span style="font-size: 0.7rem; margin-top: 5px;">PDF</span>
                        </div>
                    `;

                        const fileName = document.createElement('div');
                        fileName.textContent = truncateFileName(file.name, 20);
                        fileName.style.fontSize = '0.85rem';
                        fileName.style.color = '#333';
                        fileName.style.fontWeight = '500';
                        fileName.style.marginBottom = '5px';

                        const fileSize = document.createElement('div');
                        fileSize.textContent = formatFileSize(file.size);
                        fileSize.style.fontSize = '0.75rem';
                        fileSize.style.color = '#666';
                        fileSize.style.marginBottom = '10px';

                        previewElement.appendChild(pdfIcon);
                        previewElement.appendChild(fileName);
                        previewElement.appendChild(fileSize);

                        // Add cancel button
                        const cancelBtn = createCancelButton(fileInput, previewContainer);
                        previewElement.appendChild(cancelBtn);
                    } else {
                        // For other file types
                        const fileIcon = document.createElement('div');
                        fileIcon.innerHTML = `
                        <div style="background: #4CAF50; color: white; width: 60px; height: 80px;
                              border-radius: 6px; display: flex; flex-direction: column;
                              align-items: center; justify-content: center; margin: 0 auto 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                            </svg>
                            <span style="font-size: 0.7rem; margin-top: 5px;">FILE</span>
                        </div>
                    `;

                        const fileName = document.createElement('div');
                        fileName.textContent = truncateFileName(file.name, 20);
                        fileName.style.fontSize = '0.85rem';
                        fileName.style.color = '#333';
                        fileName.style.fontWeight = '500';
                        fileName.style.marginBottom = '5px';

                        const fileSize = document.createElement('div');
                        fileSize.textContent = formatFileSize(file.size);
                        fileSize.style.fontSize = '0.75rem';
                        fileSize.style.color = '#666';
                        fileSize.style.marginBottom = '10px';

                        previewElement.appendChild(fileIcon);
                        previewElement.appendChild(fileName);
                        previewElement.appendChild(fileSize);

                        // Add cancel button
                        const cancelBtn = createCancelButton(fileInput, previewContainer);
                        previewElement.appendChild(cancelBtn);
                    }

                    previewContainer.appendChild(previewElement);
                }
            });
        }

        // Helper function to create cancel button
        function createCancelButton(fileInput, previewContainer) {
            const cancelBtn = document.createElement('button');
            cancelBtn.type = 'button';
            cancelBtn.className = 'cancel-btn';
            cancelBtn.textContent = 'Batal Upload';
            cancelBtn.style.background = '#dc3545';
            cancelBtn.style.color = 'white';
            cancelBtn.style.border = 'none';
            cancelBtn.style.borderRadius = '4px';
            cancelBtn.style.padding = '6px 12px';
            cancelBtn.style.fontSize = '0.8rem';
            cancelBtn.style.cursor = 'pointer';
            cancelBtn.style.marginTop = '5px';
            cancelBtn.style.width = '100%';

            cancelBtn.onclick = function() {
                if (confirm('Apakah Anda yakin ingin membatalkan upload file ini?')) {
                    fileInput.value = '';
                    previewContainer.innerHTML = '';
                }
            };

            return cancelBtn;
        }

        // Helper function to truncate file name if too long
        function truncateFileName(name, maxLength) {
            if (name.length <= maxLength) return name;
            return name.substring(0, maxLength) + '...' + name.substring(name.lastIndexOf('.'));
        }

        // Helper function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        // Initialize file previews
        document.addEventListener('DOMContentLoaded', function() {
            // Setup preview for identity file
            setupFilePreview('file_identitas', 'preview_identitas');

            // Setup preview for guarantee file
            setupFilePreview('file_jaminan', 'preview_jaminan');

            // Setup preview for STNK file (if exists)
            const stnkInput = document.getElementById('file_stnk_motor');
            if (stnkInput) {
                setupFilePreview('file_stnk_motor', 'preview_stnk');
            }

            // Update guarantee info text based on selection
            document.getElementById('bentuk_jaminan').addEventListener('change', function() {
                const selected = this.value;
                const infoText = document.getElementById('jaminan_info');
                let text = '';

                switch (selected) {
                    case 'sim':
                        text = 'SIM A atau SIM C';
                        break;
                    case 'stnk_motor':
                        text = 'STNK Motor (wajib upload foto STNK juga)';
                        break;
                    case 'kk':
                        text = 'Kartu Keluarga';
                        break;
                    case 'kartu_pelajar':
                        text = 'Kartu Pelajar/Mahasiswa';
                        break;
                    case 'lain':
                        text = 'Dokumen jaminan lainnya';
                        break;
                    default:
                        text = 'SIM, STNK, KK, dll sesuai pilihan jaminan';
                }

                infoText.textContent = text;
            });

            // Trigger initial update
            document.getElementById('bentuk_jaminan').dispatchEvent(new Event('change'));
        });

        // Update form validation to include file preview check
        const originalValidateForm = window.validateForm;
        window.validateForm = function() {
            // Check agreement checkbox
            const agreeTerms = document.getElementById('agree_terms');
            if (!agreeTerms.checked) {
                alert('Anda harus menyetujui Syarat & Ketentuan');
                return false;
            }

            // Check file uploads
            const fileIdentitas = document.getElementById('file_identitas');
            const fileJaminan = document.getElementById('file_jaminan');
            const bentukJaminan = document.getElementById('bentuk_jaminan').value;

            if (!fileIdentitas.files[0]) {
                alert('File Identitas (KTP/Kartu Pelajar) harus diupload');
                return false;
            }

            if (!fileJaminan.files[0]) {
                alert('File Jaminan harus diupload');
                return false;
            }

            // Check STNK motor if selected
            if (bentukJaminan === 'stnk_motor') {
                const fileStnk = document.getElementById('file_stnk_motor');
                if (!fileStnk || !fileStnk.files[0]) {
                    alert('Foto STNK Motor harus diupload karena Anda memilih STNK sebagai jaminan');
                    return false;
                }
            }

            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            return true;
        };
    </script>

    <script>
        // Real-time date calculation
        function calculateAll() {
            const biayaHarian = parseFloat(document.getElementById('biaya_harian').value) || 0;
            const mulaiTgl = document.getElementById('mulai_tgl').value;
            const lamaHari = parseInt(document.getElementById('lama_hari').value) || 1;
            const tipePembayaran = document.getElementById('tipe_pembayaran').value;

            // Calculate end date based on start date and rental days
            if (mulaiTgl && lamaHari > 0) {
                const startDate = new Date(mulaiTgl);
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + lamaHari - 1); // -1 karena inklusif

                // Format to YYYY-MM-DD
                const endDateStr = endDate.toISOString().split('T')[0];
                document.getElementById('sel_tgl').value = endDateStr;
            }

            // Calculate total BASE amount (before payment type)
            const totalBase = biayaHarian * lamaHari;
            let totalPembayaran = totalBase;

            // Apply payment type discount
            if (tipePembayaran === 'dp') {
                totalPembayaran = totalBase * 0.2; // 20% for down payment
            }

            // Update total payment field - ROUND to avoid decimal issues
            document.getElementById('total_pembayaran').value = Math.round(totalPembayaran);

            // Update summary
            updateSummary(totalPembayaran, lamaHari, tipePembayaran, totalBase);
        }

        function updateSummary(totalPembayaran = 0, lamaHari = 0, tipePembayaran = '', totalBase = 0) {
            // Update basic info
            document.getElementById('sum_nama').textContent = document.getElementById('nama_penyewa').value || '-';
            document.getElementById('sum_telepon').textContent = document.getElementById('no_telp').value || '-';
            document.getElementById('sum_tujuan').textContent = document.getElementById('tujuan').value || '-';

            // Update dates
            const mulaiTgl = document.getElementById('mulai_tgl').value;
            const selTgl = document.getElementById('sel_tgl').value;
            if (mulaiTgl && selTgl) {
                document.getElementById('sum_periode').textContent =
                    formatDate(mulaiTgl) + ' - ' + formatDate(selTgl);
            } else {
                document.getElementById('sum_periode').textContent = '-';
            }

            // Update rental info
            document.getElementById('sum_lama').textContent = lamaHari > 0 ? lamaHari + ' hari' : '-';

            // Update payment info
            const paymentTypeText = tipePembayaran === 'dp' ? 'DP (20%)' :
                tipePembayaran === 'bayar_penuh' ? 'Bayar Penuh' : '-';
            document.getElementById('sum_tipe_pembayaran').textContent = paymentTypeText;

            // Show breakdown for DP
            if (tipePembayaran === 'dp' && totalBase > 0) {
                document.getElementById('sum_total').innerHTML =
                    formatCurrency(totalPembayaran) + '<br><small>(' + formatCurrency(totalBase) + ' × 20%)</small>';
            } else {
                document.getElementById('sum_total').textContent = formatCurrency(totalPembayaran);
            }
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function formatCurrency(amount) {
            return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
        }

        function toggleSTNKField() {
            const jaminan = document.getElementById('bentuk_jaminan').value;
            const stnkField = document.getElementById('stnk_motor_field');

            if (jaminan === 'stnk_motor') {
                stnkField.style.display = 'block';
                document.getElementById('file_stnk_motor').required = true;
            } else {
                stnkField.style.display = 'none';
                document.getElementById('file_stnk_motor').required = false;
            }
        }

        async function checkAvailability() {
            const carId = document.getElementById('car_id').value;
            const mulaiTgl = document.getElementById('mulai_tgl').value;
            const selTgl = document.getElementById('sel_tgl').value;

            if (!mulaiTgl || !selTgl) {
                updateAvailabilityStatus('info', 'Pilih tanggal mulai dan selesai');
                return;
            }

            try {
                updateAvailabilityStatus('loading', 'Memeriksa ketersediaan...');

                const response = await fetch('{{ route('booking.check-availability') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        car_id: carId,
                        mulai_tgl: mulaiTgl,
                        sel_tgl: selTgl
                    })
                });

                const data = await response.json();

                if (data.available) {
                    updateAvailabilityStatus('success', data.message);
                } else {
                    updateAvailabilityStatus('error', data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                updateAvailabilityStatus('error', 'Gagal memeriksa ketersediaan');
            }
        }

        function updateAvailabilityStatus(type, message) {
            const element = document.getElementById('availability-check');
            element.className = `availability-status ${type}`;
            element.innerHTML = `<p>${message}</p>`;
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form?')) {
                document.getElementById('bookingForm').reset();
                // Set default values
                document.getElementById('mulai_tgl').value = '{{ date('Y-m-d') }}';
                document.getElementById('mulai_pkl').value = '08:00';
                document.getElementById('sel_pkl').value = '17:00';
                document.getElementById('total_pembayaran').value = '0';
                calculateAll();
                updateSummary();
                updateAvailabilityStatus('info', 'Silakan pilih tanggal untuk memeriksa ketersediaan');
            }
        }

        function validateForm() {
            const agreeTerms = document.getElementById('agree_terms');
            if (!agreeTerms.checked) {
                alert('Anda harus menyetujui Syarat & Ketentuan');
                return false;
            }
            document.getElementById('loadingOverlay').style.display = 'flex';
            return true;

            // Validasi file upload
            const fileIdentitas = document.getElementById('file_identitas');
            const fileJaminan = document.getElementById('file_jaminan');
            const bentukJaminan = document.getElementById('bentuk_jaminan').value;

            if (!fileIdentitas.files[0]) {
                alert('File Identitas (KTP/Kartu Pelajar) harus diupload');
                return false;
            }

            if (!fileJaminan.files[0]) {
                alert('File Jaminan harus diupload');
                return false;
            }

            // Validasi STNK motor jika dipilih
            if (bentukJaminan === 'stnk_motor') {
                const fileStnk = document.getElementById('file_stnk_motor');
                if (!fileStnk.files[0]) {
                    alert('Foto STNK Motor harus diupload karena Anda memilih STNK sebagai jaminan');
                    return false;
                }
            }
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for real-time updates
            const inputs = ['nama_penyewa', 'no_telp', 'tujuan', 'mulai_tgl', 'lama_hari', 'tipe_pembayaran'];
            inputs.forEach(id => {
                document.getElementById(id).addEventListener('input', calculateAll);
                document.getElementById(id).addEventListener('change', calculateAll);
            });

            document.getElementById('bentuk_jaminan').addEventListener('change', toggleSTNKField);

            // Add availability check on date change
            document.getElementById('mulai_tgl').addEventListener('change', checkAvailability);
            document.getElementById('sel_tgl').addEventListener('change', checkAvailability);

            // Set default values
            document.getElementById('mulai_tgl').value = '{{ date('Y-m-d') }}';

            // Initial calculations
            calculateAll();
            toggleSTNKField();
        });
    </script>

@endsection
