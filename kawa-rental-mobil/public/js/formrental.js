(function() {
    const DEBUG = true;
    const log = (...a) => {
        if (DEBUG) console.log(...a);
    };
    const warn = (...a) => {
        if (DEBUG) console.warn(...a);
    };
    const err = (...a) => {
        console.error(...a);
    };

    // helper safe-get
    function $id(id) {
        const el = document.getElementById(id);
        if (!el) warn('[safe] element not found:', id);
        return el;
    }

    function $query(selector) {
        return document.querySelector(selector);
    }

    function $queryAll(selector) {
        return document.querySelectorAll(selector);
    }

    // waktu helpers
    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function now() {
        return new Date();
    }

    // parse "YYYY-MM-DD" + "HH:MM" ke Date lokal
    function parseDateTime(dateStr, timeStr) {
        if (!dateStr) return null;
        const t = timeStr ? timeStr : '00:00';
        const s = `${dateStr}T${t}:00`;
        const d = new Date(s);
        if (isNaN(d.getTime())) {
            warn('parseDateTime failed for', s);
            return null;
        }
        return d;
    }

    // format tanggal untuk display: "DD/MM/YYYY"
    function formatTanggalDisplay(dateStr) {
        if (!dateStr) return '-';
        const parts = dateStr.split('-');
        if (parts.length === 3) {
            return `${parts[2]}/${parts[1]}/${parts[0]}`;
        }
        return dateStr;
    }

    // format datetime untuk display
    function formatDateTimeDisplay(dateStr, timeStr) {
        if (!dateStr) return '-';
        const datePart = formatTanggalDisplay(dateStr);
        return timeStr ? `${datePart} ${timeStr}` : datePart;
    }

    // --- Availability Check ---
    async function checkAvailability() {
        const carId = $id('car_id')?.value || $query('input[name="car_id"]')?.value;
        const mulaiTgl = $id('mulai_tgl')?.value;
        const selTgl = $id('sel_tgl')?.value;

        if (!carId || !mulaiTgl || !selTgl) {
            updateAvailabilityStatus('info', 'Masukkan tanggal mulai dan selesai untuk memeriksa ketersediaan');
            return;
        }

        // Validasi tanggal
        const mulaiDT = parseDateTime(mulaiTgl, '00:00');
        const selDT = parseDateTime(selTgl, '00:00');
        
        if (!mulaiDT || !selDT) {
            updateAvailabilityStatus('error', 'Format tanggal tidak valid');
            return;
        }

        if (selDT <= mulaiDT) {
            updateAvailabilityStatus('error', 'Tanggal selesai harus setelah tanggal mulai');
            return;
        }

        const sekarang = new Date();
        if (mulaiDT < sekarang) {
            updateAvailabilityStatus('error', 'Tanggal mulai tidak boleh di masa lalu');
            return;
        }

        try {
            updateAvailabilityStatus('loading', 'Memeriksa ketersediaan...');
            
            const response = await fetch('/booking/check-availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $query('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({
                    car_id: carId,
                    mulai_tgl: mulaiTgl,
                    sel_tgl: selTgl
                })
            });

            const data = await response.json();

            if (data.available) {
                updateAvailabilityStatus('success', data.message || 'Mobil tersedia untuk tanggal yang dipilih');
            } else {
                updateAvailabilityStatus('error', data.message || 'Mobil tidak tersedia untuk tanggal yang dipilih');
            }
        } catch (error) {
            console.error('Availability check error:', error);
            updateAvailabilityStatus('error', 'Gagal memeriksa ketersediaan. Silakan coba lagi.');
        }
    }

    function updateAvailabilityStatus(type, message) {
        const availabilityEl = $id('availability-check');
        if (!availabilityEl) return;

        availabilityEl.className = `availability-status ${type}`;
        availabilityEl.innerHTML = `<p>${message}</p>`;
    }

    // --- file preview & validation ---
    function previewImage(event, previewId) {
        try {
            const preview = $id(previewId);
            if (!preview) return;
            
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (!file) return;

            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar (maks 2MB)');
                event.target.value = '';
                return;
            }

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                if (file.type === 'application/pdf') {
                    // Untuk PDF, tampilkan icon
                    preview.innerHTML = `
                        <div class="file-preview-pdf">
                            <span>📄 ${file.name}</span>
                            <small>PDF Document</small>
                        </div>
                    `;
                } else {
                    // Untuk gambar, tampilkan thumbnail
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview dokumen';
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    img.style.borderRadius = '8px';
                    img.style.objectFit = 'cover';
                    preview.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        } catch (e) {
            err('previewImage error', e);
        }
    }

    function validateFile(input, errorId) {
        const errorEl = $id(errorId);
        if (!errorEl) return;

        if (!input.files[0]) {
            errorEl.textContent = 'File harus diupload';
            return false;
        }

        const file = input.files[0];
        
        // Validasi ukuran
        if (file.size > 2 * 1024 * 1024) {
            errorEl.textContent = 'Ukuran file maksimal 2MB';
            return false;
        }

        // Validasi tipe
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        if (!allowedTypes.includes(file.type)) {
            errorEl.textContent = 'Format harus JPG, PNG, atau PDF';
            return false;
        }

        errorEl.textContent = '';
        return true;
    }

    // --- format IDR ---
    function formatIDR(n) {
        return 'Rp ' + Number(n || 0).toLocaleString('id-ID');
    }

    // --- update ringkasan lengkap ---
    function updateSummary() {
        const biaya = Number($id('biaya_harian')?.value) || 0;
        const hari = Number($id('lama_hari')?.value) || 0;
        const total = biaya * hari;

        // Update summary display
        const sumNama = $id('sum_nama');
        if (sumNama) {
            const nama = $id('nama_penyewa')?.value || '-';
            sumNama.textContent = nama;
        }

        const sumPeriode = $id('sum_periode');
        if (sumPeriode) {
            const mulaiTgl = $id('mulai_tgl')?.value;
            const selTgl = $id('sel_tgl')?.value;
            if (mulaiTgl && selTgl) {
                sumPeriode.textContent = `${formatTanggalDisplay(mulaiTgl)} - ${formatTanggalDisplay(selTgl)}`;
            } else {
                sumPeriode.textContent = '-';
            }
        }

        const sumLama = $id('sum_lama');
        if (sumLama) sumLama.textContent = hari > 0 ? `${hari} hari` : '-';

        const sumBiaya = $id('sum_biaya');
        if (sumBiaya) sumBiaya.textContent = formatIDR(biaya);

        const sumTotal = $id('sum_total');
        if (sumTotal) sumTotal.textContent = formatIDR(total);

        // Update payment amounts
        const dpAmount = $id('dp_amount');
        if (dpAmount) dpAmount.textContent = formatIDR(total * 0.5);

        const fullAmount = $id('full_amount');
        if (fullAmount) fullAmount.textContent = formatIDR(total);
    }

    // --- kalkulasi utama dengan validasi lengkap ---
    function calculateAll() {
        try {
            const biayaEl = $id('biaya_harian');
            const mulaiTglEl = $id('mulai_tgl');
            const selTglEl = $id('sel_tgl');
            const lamaHariEl = $id('lama_hari');
            const lamaHariDisplay = $id('lama_hari_display');

            if (!biayaEl || !mulaiTglEl) return;

            const biaya = Number(biayaEl.value) || 0;
            const mulaiTgl = mulaiTglEl.value;
            const selTgl = selTglEl?.value;

            let hari = 1;

            // Hitung hari berdasarkan tanggal jika tersedia
            if (mulaiTgl && selTgl) {
                const mulaiDT = parseDateTime(mulaiTgl, '00:00');
                const selDT = parseDateTime(selTgl, '00:00');
                
                if (mulaiDT && selDT) {
                    const diffTime = selDT - mulaiDT;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    hari = Math.max(1, diffDays);
                }
            } else if (lamaHariEl) {
                // Fallback ke input manual
                hari = Number(lamaHariEl.value) || 1;
            }

            // Update display
            if (lamaHariDisplay) lamaHariDisplay.value = `${hari} hari`;
            if (lamaHariEl) lamaHariEl.value = hari;

            const total = biaya * hari;
            const totalEl = $id('total_pembayaran');
            if (totalEl) totalEl.value = total;

            updateSummary();

        } catch (e) {
            err('calculateAll error', e);
        }
    }

    // --- validasi form sebelum submit ---
    function validateForm() {
        const requiredFields = [
            { id: 'nama_penyewa', name: 'Nama Penyewa' },
            { id: 'no_telp', name: 'No. Telepon' },
            { id: 'alamat', name: 'Alamat' },
            { id: 'tujuan', name: 'Tujuan' },
            { id: 'mulai_tgl', name: 'Tanggal Mulai' },
            { id: 'sel_tgl', name: 'Tanggal Selesai' },
            { id: 'bentuk_jaminan', name: 'Bentuk Jaminan' },
            { id: 'posisi_bbm', name: 'Posisi BBM' }
        ];

        for (const field of requiredFields) {
            const element = $id(field.id);
            if (!element?.value) {
                alert(`${field.name} harus diisi`);
                element?.focus();
                return false;
            }
        }

        // Validasi file upload
        if (!validateFile($id('file_ktp'), 'ktp_error')) return false;
        if (!validateFile($id('file_sim'), 'sim_error')) return false;

        const bentukJaminan = $id('bentuk_jaminan')?.value;
        if (bentukJaminan === 'stnk_motor') {
            if (!validateFile($id('file_stnk_motor'), 'stnk_error')) return false;
        }

        // Validasi tanggal
        const mulaiTgl = $id('mulai_tgl')?.value;
        const selTgl = $id('sel_tgl')?.value;
        
        if (mulaiTgl && selTgl) {
            const mulaiDT = parseDateTime(mulaiTgl, '00:00');
            const selDT = parseDateTime(selTgl, '00:00');
            const sekarang = new Date();

            if (mulaiDT < sekarang) {
                alert('Tanggal mulai tidak boleh di masa lalu');
                return false;
            }

            if (selDT <= mulaiDT) {
                alert('Tanggal selesai harus setelah tanggal mulai');
                return false;
            }
        }

        // Validasi terms & conditions
        const agreeTerms = $id('agree_terms');
        if (agreeTerms && !agreeTerms.checked) {
            alert('Anda harus menyetujui Syarat & Ketentuan');
            return false;
        }

        return true;
    }

    // --- reset form ---
    function resetForm() {
        if (!confirm('Apakah Anda yakin ingin mereset seluruh form?')) return;
        
        const form = $id('bookingForm');
        if (form) form.reset();

        // Reset previews
        ['preview_ktp', 'preview_sim', 'preview_stnk'].forEach(id => {
            const el = $id(id);
            if (el) el.innerHTML = '';
        });

        // Reset error messages
        $queryAll('.error-message').forEach(el => {
            el.textContent = '';
        });

        // Reset summary
        updateSummary();
        
        log('Form reset successfully');
    }

    // --- init on load ---
    window.addEventListener('DOMContentLoaded', function() {
        try {
            // Set minimum dates
            const today = new Date().toISOString().split('T')[0];
            const mulaiTglEl = $id('mulai_tgl');
            if (mulaiTglEl) {
                mulaiTglEl.setAttribute('min', today);
            }

            // Attach event listeners
            const watchIds = [
                'biaya_harian', 'nama_penyewa', 'no_telp', 'alamat', 
                'tujuan', 'mulai_tgl', 'sel_tgl', 'mulai_pkl', 'sel_pkl',
                'bentuk_jaminan', 'posisi_bbm'
            ];

            watchIds.forEach(id => {
                const el = $id(id);
                if (el) {
                    el.addEventListener('input', calculateAll);
                    el.addEventListener('change', calculateAll);
                }
            });

            // Date-specific listeners for availability check
            const dateFields = ['mulai_tgl', 'sel_tgl'];
            dateFields.forEach(id => {
                const el = $id(id);
                if (el) {
                    el.addEventListener('change', checkAvailability);
                }
            });

            // File upload listeners
            const fileFields = ['file_ktp', 'file_sim', 'file_stnk_motor'];
            fileFields.forEach(id => {
                const el = $id(id);
                if (el) {
                    const previewId = `preview_${id.split('_')[1]}`;
                    el.addEventListener('change', (e) => {
                        previewImage(e, previewId);
                        validateFile(e.target, `${id.split('_')[1]}_error`);
                    });
                }
            });

            // Form submission
            const form = $id('bookingForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!validateForm()) {
                        e.preventDefault();
                    }
                });
            }

            // Initial calculations
            calculateAll();
            checkAvailability();
            
            log('Rental form initialization complete');

        } catch (e) {
            err('Initialization error', e);
        }
    });

    // Expose functions for global access
    window.RentalForm = {
        calculateAll,
        checkAvailability,
        validateForm,
        resetForm,
        updateSummary
    };

})();