@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    <!-- Header Ujian -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                    <i class="fas fa-id-card fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-secondary">Nomor Tes</small>
                                    <p class="fw-bold mb-0" id="nomorTes">{{ $nomorTes ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="d-inline-block bg-danger text-white rounded-pill px-4 py-2">
                                <i class="fas fa-hourglass-half me-2"></i>
                                <span class="fw-bold fs-4 timer" id="timer">30:00</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <span class="badge bg-info text-white px-4 py-2 rounded-pill">
                                <i class="fas fa-question-circle me-2"></i>Soal <span id="soal-sekarang">1</span>/<span id="total-soal">{{ $totalSoal }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Navigasi Soal -->
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-th text-primary me-2"></i>
                        Navigasi Soal
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-2" id="navigasi-soal">
                        <!-- Navigasi akan diisi oleh JavaScript -->
                    </div>

                    <!-- Legend -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between small">
                        <div><span class="badge bg-success me-2">&nbsp;</span> Sudah dijawab</div>
                        <div><span class="badge bg-secondary me-2">&nbsp;</span> Belum dijawab</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Soal -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold mb-0">
                            <span class="badge bg-primary me-2" id="soal-badge">Soal #1</span>
                            Pilihan Ganda
                        </h4>
                        <span class="badge bg-secondary">Bobot: 1 poin</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Soal -->
                    <div class="mb-4">
                        <p class="fs-5 fw-medium" id="teks-soal"></p>
                    </div>

                    <!-- Opsi Jawaban -->
                    <div class="options-container" id="opsi-container">
                        <!-- Opsi akan diisi oleh JavaScript -->
                    </div>

                    <!-- Navigasi -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <button class="btn btn-outline-secondary rounded-pill px-4" id="prevSoal">
                            <i class="fas fa-chevron-left me-2"></i>Sebelumnya
                        </button>
                        <button class="btn btn-outline-primary rounded-pill px-4" id="nextSoal">
                            Selanjutnya<i class="fas fa-chevron-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tombol Akhiri Ujian -->
            <div class="text-center mt-4">
                <button class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-semibold" 
                        data-bs-toggle="modal" data-bs-target="#akhiriModal">
                    <i class="fas fa-stop-circle me-2"></i>AKHIRI UJIAN
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Akhiri Ujian -->
<div class="modal fade" id="akhiriModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Akhiri Ujian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-question-circle fa-4x text-danger"></i>
                    </div>
                    <h4 class="fw-bold">Yakin ingin mengakhiri?</h4>
                    <p class="text-secondary">Pastikan semua soal sudah dijawab. Anda tidak dapat mengulang ujian.</p>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    Soal yang belum dijawab: <strong id="soal-belum">0 soal</strong>
                </div>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger rounded-pill px-5 py-2 fw-semibold" id="btnAkhiri">
                    <i class="fas fa-check me-2"></i>YA, AKHIRI
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden input untuk menyimpan data -->
<input type="hidden" id="waktu-selesai" value="{{ $waktuSelesai ?? 0 }}">
<input type="hidden" id="user-id" value="{{ auth()->id() }}">

<!-- Custom CSS -->
<style>
.bg-gradient-ujian {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}
.sticky-top {
    z-index: 1020;
}
.timer {
    font-family: 'Courier New', monospace;
    letter-spacing: 2px;
}
.hover-option {
    transition: all 0.2s ease;
    cursor: pointer;
    border-color: #dee2e6 !important;
}
.hover-option:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd !important;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
}
.form-check-input:checked + .form-check-label {
    font-weight: 500;
    color: #0d6efd;
}
.nav-soal {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    transition: all 0.2s;
    border-radius: 8px;
    font-size: 0.9rem;
    padding: 0.5rem;
}
.nav-soal.btn-success {
    background-color: #198754;
    color: white;
    border: none;
}
.nav-soal.btn-outline-secondary {
    background-color: white;
    border: 1px solid #ced4da;
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data dari server
    const soalData = @json($soals ?? []);
    const waktuSelesai = {{ $waktuSelesai ?? 0 }};
    
    if (!soalData.length) {
        alert('Tidak ada data soal!');
        window.location.href = '{{ route("mahasiswa.ujian.index") }}';
        return;
    }
    
    let currentIndex = 0;
    let jawabanUser = {};
    let timerInterval;
    let soalTerjawab = 0;
    
    // Inisialisasi navigasi soal
    function initNavigasi() {
        let html = '';
        soalData.forEach((soal, index) => {
            html += `<div class="col-4 col-md-3 col-lg-4 mb-2">
                <button class="btn btn-outline-secondary w-100 nav-soal" data-index="${index}">${index + 1}</button>
            </div>`;
        });
        document.getElementById('navigasi-soal').innerHTML = html;
        
        // Event klik navigasi
        document.querySelectorAll('.nav-soal').forEach(btn => {
            btn.addEventListener('click', function() {
                let index = parseInt(this.dataset.index);
                tampilSoal(index);
            });
        });
    }
    
    // Tampilkan soal berdasarkan index
    function tampilSoal(index) {
        currentIndex = index;
        let soal = soalData[index];
        
        document.getElementById('soal-badge').textContent = 'Soal #' + (index + 1);
        document.getElementById('soal-sekarang').textContent = index + 1;
        document.getElementById('teks-soal').textContent = soal.soal;
        
        // Buat opsi jawaban
        let opsiHtml = '';
        const opsi = ['a', 'b', 'c', 'd', 'e'];
        const opsiText = {
            'a': soal.opsi_a,
            'b': soal.opsi_b,
            'c': soal.opsi_c,
            'd': soal.opsi_d,
            'e': soal.opsi_e
        };
        
        opsi.forEach(huruf => {
            const checked = (jawabanUser[soal.id] && jawabanUser[soal.id].jawaban === huruf) ? 'checked' : '';
            opsiHtml += `
                <div class="option-item mb-3">
                    <div class="form-check p-3 border rounded-3 hover-option">
                        <input class="form-check-input" type="radio" name="jawaban" 
                               value="${huruf}" id="opsi${huruf.toUpperCase()}" ${checked}>
                        <label class="form-check-label w-100" for="opsi${huruf.toUpperCase()}">
                            <span class="fw-bold me-3">${huruf.toUpperCase()}.</span> ${opsiText[huruf]}
                        </label>
                    </div>
                </div>
            `;
        });
        
        document.getElementById('opsi-container').innerHTML = opsiHtml;
        
        // Update navigasi - HAPUS WARNA BIRU (tidak ada penanda soal aktif)
        document.querySelectorAll('.nav-soal').forEach(btn => {
            btn.classList.remove('btn-primary');
        });
        
        // Update prev/next button
        document.getElementById('prevSoal').disabled = index === 0;
        document.getElementById('nextSoal').disabled = index === soalData.length - 1;
    }
    
    // Simpan jawaban
    function simpanJawaban(soalId, jawaban) {
        // Cek apakah jawaban sudah ada sebelumnya
        const sebelumnyaAda = jawabanUser[soalId] ? true : false;
        
        jawabanUser[soalId] = { jawaban: jawaban };
        
        // Update counter soal terjawab
        if (!sebelumnyaAda) {
            soalTerjawab++;
        }
        
        // Update jumlah soal belum dijawab di modal
        updateSoalBelum();
        
        // Tandai navigasi sebagai sudah dijawab (WARNA HIJAU)
        const soalIndex = soalData.findIndex(s => s.id === soalId);
        if (soalIndex !== -1) {
            const navBtn = document.querySelector(`.nav-soal[data-index="${soalIndex}"]`);
            navBtn.classList.remove('btn-outline-secondary');
            navBtn.classList.add('btn-success');
        }
        
        // Kirim ke server via AJAX
        fetch('{{ route("mahasiswa.ujian.simpan-jawaban") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                soal_id: soalId,
                jawaban: jawaban
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Gagal menyimpan jawaban');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    // Hitung soal belum dijawab
    function updateSoalBelum() {
        let total = soalData.length;
        let terjawab = soalTerjawab;
        let belum = total - terjawab;
        document.getElementById('soal-belum').textContent = belum + ' soal';
    }
    
    // Event listener untuk perubahan jawaban
    document.addEventListener('change', function(e) {
        if (e.target.name === 'jawaban') {
            let soalId = soalData[currentIndex].id;
            simpanJawaban(soalId, e.target.value);
        }
    });
    
    // Navigasi previous
    document.getElementById('prevSoal').addEventListener('click', function() {
        if (currentIndex > 0) {
            tampilSoal(currentIndex - 1);
        }
    });
    
    // Navigasi next
    document.getElementById('nextSoal').addEventListener('click', function() {
        if (currentIndex < soalData.length - 1) {
            tampilSoal(currentIndex + 1);
        }
    });
    
    // Timer
    function startTimer(waktuSelesai) {
        timerInterval = setInterval(function() {
            let now = Math.floor(Date.now() / 1000);
            let sisa = waktuSelesai - now;
            
            if (sisa <= 0) {
                clearInterval(timerInterval);
                Swal.fire({
                    icon: 'warning',
                    title: 'Waktu Habis!',
                    text: 'Waktu ujian telah habis. Ujian akan diakhiri secara otomatis.',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    submitUjian();
                });
                return;
            }
            
            let menit = Math.floor(sisa / 60);
            let detik = sisa % 60;
            let waktuStr = menit.toString().padStart(2, '0') + ':' + detik.toString().padStart(2, '0');
            
            document.getElementById('timer').textContent = waktuStr;
            
            // Warning ketika waktu tinggal 5 menit
            if (sisa <= 300 && sisa > 0) {
                document.querySelector('.bg-danger').classList.remove('bg-danger');
                document.querySelector('.bg-danger').classList.add('bg-warning');
            }
        }, 1000);
    }
    
    // Submit ujian
    function submitUjian() {
        Swal.fire({
            title: 'Mengakhiri Ujian...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch('{{ route("mahasiswa.ujian.submit") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("mahasiswa.hasil") }}';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat mengakhiri ujian'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan koneksi'
            });
        });
    }
    
    // Event listener untuk tombol akhiri (di modal)
    document.querySelector('#akhiriModal .btn-danger').addEventListener('click', function() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('akhiriModal'));
        modal.hide();
        submitUjian();
    });
    
    // Event listener untuk tombol yang membuka modal
    document.querySelector('[data-bs-target="#akhiriModal"]').addEventListener('click', function() {
        updateSoalBelum();
    });
    
    // Inisialisasi awal
    initNavigasi();
    tampilSoal(0);
    
    // Hitung soal terjawab dari data awal (jika ada jawaban yang sudah tersimpan)
    soalTerjawab = 0;
    updateSoalBelum();
    
    if (waktuSelesai > 0) {
        startTimer(waktuSelesai);
    }
});
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection