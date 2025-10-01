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

    // --- prefill vehicle (dengan fallback) ---
    function prefillVehicle() {
        try {
            let veh = null;
            const raw = localStorage.getItem('selectedVehicle');
            if (raw) {
                try {
                    veh = JSON.parse(raw);
                } catch (e) {
                    warn('selectedVehicle JSON parse err', e);
                }
            }
            if (!veh) {
                const q = new URLSearchParams(window.location.search);
                if (q.get('merk')) {
                    veh = {
                        merk: q.get('merk'),
                        model: q.get('model') || '',
                        warna: q.get('warna') || '',
                        tahun: q.get('tahun') || '',
                        rangka: q.get('rangka') || '',
                        mesin: q.get('mesin') || '',
                        polisi: q.get('polisi') || '',
                        stnk: q.get('stnk') || '',
                        biaya: q.get('biaya') || ''
                    };
                }
            }
            if (!veh) return;
            const setIf = (id, val) => {
                const el = $id(id);
                if (el) el.value = val || '';
            };
            setIf('veh_merk', (veh.merk || '') + (veh.type ? ' ' + veh.type : ''));
            setIf('veh_model', veh.model || '');
            setIf('veh_warna', veh.warna || '');
            setIf('veh_tahun', veh.tahun || '');
            setIf('veh_rangka', veh.rangka || '');
            setIf('veh_mesin', veh.mesin || '');
            setIf('veh_polisi', veh.polisi || '');
            setIf('veh_stnk', veh.stnk || '');
            if (veh.biaya) {
                const b = $id('biaya_harian');
                if (b) b.value = veh.biaya;
            }
            const sumMobil = $id('sum_mobil');
            if (sumMobil) sumMobil.innerText = ((veh.merk || '') + ' ' + (veh.model || '')).trim() || '-';
        } catch (e) {
            err('prefillVehicle error', e);
        }
    }

    // --- file preview ---
    function previewFile(input, previewId) {
        try {
            const preview = $id(previewId);
            if (!preview) return;
            preview.innerHTML = '';
            const file = input && input.files && input.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar (maks 5MB)');
                input.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.style.border = '1px solid #ccc';
                img.style.borderRadius = '8px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        } catch (e) {
            err('previewFile error', e);
        }
    }

    // --- format IDR ---
    function formatIDR(n) {
        return 'Rp ' + Number(n || 0).toLocaleString('id-ID');
    }

    // --- update ringkasan dengan TAMBAHAN selesai rental ---
    function updateSummary(biaya, hari, total) {
        const sumB = $id('sum_biaya');
        if (sumB) sumB.innerText = formatIDR(biaya);
        
        const sumT = $id('sum_total');
        if (sumT) sumT.innerText = formatIDR(total);
        
        const sumL = $id('sum_lama');
        if (sumL) sumL.innerText = hari + ' hari';
        
        const sumN = $id('sum_nama');
        if (sumN) sumN.innerText = ($id('nama_penyewa')?.value) || '-';
        
        const merk = $id('veh_merk')?.value || '';
        const model = $id('veh_model')?.value || '';
        const sumM = $id('sum_mobil');
        if (sumM) sumM.innerText = (merk + ' ' + model).trim() || '-';
        
        // Update tanggal mulai di summary
        const sumMulai = $id('sum_mulai');
        if (sumMulai) {
            const mulaiTgl = $id('mulai_tgl')?.value;
            const mulaiPkl = $id('mulai_pkl')?.value;
            sumMulai.innerText = mulaiTgl ? (formatTanggalDisplay(mulaiTgl) + ' ' + (mulaiPkl || '')) : '-';
        }
        
        // TAMBAHAN: Update tanggal selesai di summary
        const sumSelesai = $id('sum_selesai');
        if (sumSelesai) {
            const selesaiTgl = $id('sel_tgl')?.value;
            const selesaiPkl = $id('sel_pkl')?.value;
            sumSelesai.innerText = selesaiTgl ? (formatTanggalDisplay(selesaiTgl) + ' ' + (selesaiPkl || '')) : '-';
        }
    }

    // --- kalkulasi utama TANPA fitur otomatis mulai/selesai pukul ---
    function calculateAll() {
        try {
            const biayaEl = $id('biaya_harian');
            const hariEl = $id('lama_hari');
            if (!biayaEl || !hariEl) return;

            const biaya = Number(biayaEl.value) || 0;
            const hari = Number(hariEl.value) || 1;

            const mulaiTglEl = $id('mulai_tgl');
            const selTglEl = $id('sel_tgl');

            const mulaiTgl = mulaiTglEl ? mulaiTglEl.value : '';

            // RESET dulu tanggal selesai jika tidak ada tanggal mulai
            if (selTglEl && !mulaiTgl) {
                selTglEl.value = '';
            }

            if (!mulaiTgl) {
                // Update summary tanpa tanggal selesai
                updateSummary(biaya, hari, biaya * hari);
                return;
            }

            const mulaiDT = parseDateTime(mulaiTgl, '00:00'); // Hanya butuh tanggal untuk validasi
            if (!mulaiDT) {
                updateSummary(biaya, hari, biaya * hari);
                return;
            }

            const sekarang = now();
            const hariIni = new Date(sekarang.getFullYear(), sekarang.getMonth(), sekarang.getDate());
            const mulaiHari = new Date(mulaiDT.getFullYear(), mulaiDT.getMonth(), mulaiDT.getDate());
            
            // VALIDASI: Jika tanggal mulai di masa lalu
            if (mulaiHari.getTime() < hariIni.getTime()) {
                alert('Tanggal mulai tidak boleh di masa lalu. Pilih tanggal yang valid.');
                if (mulaiTglEl) mulaiTglEl.value = '';
                if (selTglEl) selTglEl.value = '';
                updateSummary(biaya, hari, biaya * hari);
                return;
            }

            // HANYA JIKA VALIDASI BERHASIL, hitung tanggal selesai
            const selesaiDate = new Date(mulaiDT);
            selesaiDate.setDate(selesaiDate.getDate() + hari);
            const selesaiTgl = selesaiDate.toISOString().split('T')[0];
            
            if (selTglEl) selTglEl.value = selesaiTgl;

            // Hitung total
            const total = biaya * hari;
            const totalEl = $id('total_pembayaran');
            if (totalEl) totalEl.value = total;

            updateSummary(biaya, hari, total);

        } catch (e) {
            err('calculateAll error', e);
        }
    }

    // --- reset / bayar / submit ---
    function resetForm() {
        if (!confirm('Reset seluruh form?')) return;
        const f = $id('rentalForm');
        if (f) f.reset();
        ['preview_ktp', 'preview_sim', 'preview_stnk'].forEach(id => {
            const el = $id(id);
            if (el) el.innerHTML = '';
        });
        const defaults = {
            sum_nama: '-',
            sum_mobil: '-',
            sum_mulai: '-',
            sum_selesai: '-', // TAMBAHAN: reset selesai juga
            sum_lama: '-',
            sum_biaya: 'Rp 0',
            sum_total: 'Rp 0'
        };
        Object.keys(defaults).forEach(k => {
            const el = $id(k);
            if (el) el.innerText = defaults[k];
        });
        if ($id('total_pembayaran')) $id('total_pembayaran').value = '';
        if ($id('sel_tgl')) $id('sel_tgl').value = '';
    }

    function bayarMuka() {
        calculateAll();
        const total = Number($id('total_pembayaran')?.value || 0);
        alert('Bayar muka: ' + formatIDR(total / 2));
    }

    function bayarPenuh() {
        calculateAll();
        const total = Number($id('total_pembayaran')?.value || 0);
        alert('Bayar penuh: ' + formatIDR(total));
    }

    function handleSubmit(ev) {
        ev.preventDefault();
        calculateAll();
        
        // Validasi wajib
        const requiredFields = ['nama_penyewa', 'no_telp', 'tujuan', 'mulai_tgl'];
        for (const field of requiredFields) {
            if (!$id(field)?.value) {
                alert(`Field ${field} harus diisi`);
                $id(field)?.focus();
                return;
            }
        }

        // Validasi tanggal mulai tidak di masa lalu
        const mulaiTgl = $id('mulai_tgl')?.value;
        if (mulaiTgl) {
            const mulaiDT = parseDateTime(mulaiTgl, '00:00');
            const sekarang = now();
            const hariIni = new Date(sekarang.getFullYear(), sekarang.getMonth(), sekarang.getDate());
            const mulaiHari = new Date(mulaiDT.getFullYear(), mulaiDT.getMonth(), mulaiDT.getDate());
            
            if (mulaiHari.getTime() < hariIni.getTime()) {
                alert('Tanggal mulai tidak boleh di masa lalu.');
                return;
            }
        }

        // Validasi file upload berdasarkan bentuk jaminan
        const bentukJaminan = $id('bentuk_jaminan')?.value;
        if (bentukJaminan === 'ktp' && !$id('file_ktp')?.files[0]) {
            alert('Harap upload foto KTP karena Anda memilih KTP sebagai jaminan.');
            return;
        }
        if (bentukJaminan === 'sim' && !$id('file_sim')?.files[0]) {
            alert('Harap upload foto SIM karena Anda memilih SIM sebagai jaminan.');
            return;
        }
        if (bentukJaminan === 'stnk_motor' && !$id('file_stnk_motor')?.files[0]) {
            alert('Harap upload foto STNK motor karena Anda memilih motor sebagai jaminan.');
            return;
        }

        // Jika semua valid, proses submit
        if (confirm('Apakah data sudah benar? Pastikan semua informasi sudah terisi dengan benar.')) {
            // Simulasi proses submit
            alert('Form berhasil disubmit! Data akan diproses oleh admin.');
        }
    }

    // --- init on load ---
    window.addEventListener('load', function() {
        try {
            prefillVehicle();

            // minimal tanggal mulai = hari ini
            const today = new Date().toISOString().split('T')[0];
            if ($id('mulai_tgl')) $id('mulai_tgl').setAttribute('min', today);

            // attach listeners
            const watchIds = ['biaya_harian', 'lama_hari', 'nama_penyewa', 'tujuan', 'mulai_tgl', 'mulai_pkl', 'sel_pkl'];
            watchIds.forEach(id => {
                const el = $id(id);
                if (el) {
                    el.addEventListener('input', calculateAll);
                    el.addEventListener('change', calculateAll);
                }
            });

            // file preview
            const f1 = $id('file_ktp');
            if (f1) f1.addEventListener('change', function() {
                previewFile(this, 'preview_ktp');
            });
            const f2 = $id('file_sim');
            if (f2) f2.addEventListener('change', function() {
                previewFile(this, 'preview_sim');
            });
            const f3 = $id('file_stnk_motor');
            if (f3) f3.addEventListener('change', function() {
                previewFile(this, 'preview_stnk');
            });

            // form submit
            const form = $id('rentalForm');
            if (form) {
                form.addEventListener('submit', handleSubmit);
            }

            // attach buttons
            const btnReset = document.querySelector('button[onclick*="resetForm"]');
            if (btnReset) btnReset.addEventListener('click', resetForm);
            
            const btnHitung = document.querySelector('button[onclick*="calculateAll"]');
            if (btnHitung) btnHitung.addEventListener('click', calculateAll);

            // Bayar buttons
            const btnBayarMuka = document.querySelector('button[onclick*="bayarMuka"]');
            if (btnBayarMuka) btnBayarMuka.addEventListener('click', bayarMuka);
            
            const btnBayarPenuh = document.querySelector('button[onclick*="bayarPenuh"]');
            if (btnBayarPenuh) btnBayarPenuh.addEventListener('click', bayarPenuh);

            calculateAll();
            log('Initialization complete');
        } catch (e) {
            err('init error', e);
        }
    });

    // expose some funcs for debug (optional)
    window.__rental_debug = {
        calculateAll,
        previewFile,
        prefillVehicle,
        handleSubmit,
        updateSummary
    };

})();