@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-ujian text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Ujian Seleksi Mahasiswa Baru</h2>
                            <p class="mb-3 opacity-75">Baca petunjuk dengan teliti sebelum memulai ujian</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Nomor Tes</small>
                                    <span class="fw-bold fs-6">{{ $nomorTes ?? 'ITECH-2025-0001' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">{{ $programStudi ?? 'Teknik Informatika' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-pencil-alt fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Ujian -->
    <div class="row">
        <!-- Kolom Kiri: Timer dan Info -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h4 class="fw-bold mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Ujian
                    </h4>

                    <!-- Timer Info - Full Width -->
                    <div class="bg-light rounded-4 p-5 text-center flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="display-1 fw-bold text-primary mb-2">{{ $durasi ?? 30 }}:00</div>
                        <p class="text-secondary mb-0 fs-5">Durasi Ujian (menit)</p>
                    </div>
                    
                    <!-- Informasi Tambahan -->
                    <div class="mt-3 text-center text-secondary">
                        <small>Waktu akan berjalan mundur setelah ujian dimulai</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Aturan Ujian -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <h4 class="fw-bold mb-4">
                        <i class="fas fa-list-alt text-primary me-2"></i>
                        Aturan Ujian
                    </h4>
                    
                    <div class="rules-list flex-grow-1">
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">1</span>
                            <p class="mb-0">Ujian terdiri dari <strong>{{ $totalSoal ?? 30 }} soal</strong> pilihan ganda</p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">2</span>
                            <p class="mb-0">Waktu pengerjaan <strong>{{ $durasi ?? 30 }} menit</strong></p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">3</span>
                            <p class="mb-0">Setiap soal memiliki <strong>5 opsi jawaban</strong> (A, B, C, D, E)</p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">4</span>
                            <p class="mb-0">Anda dapat menjawab soal <strong>tidak berurutan</strong></p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">5</span>
                            <p class="mb-0">Jawaban akan <strong>tersimpan otomatis</strong></p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">6</span>
                            <p class="mb-0">Waktu akan <strong>berhenti otomatis</strong> jika habis</p>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">7</span>
                            <p class="mb-0">Nilai minimal kelulusan: <strong>60</strong></p>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4 mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Perhatian!</strong> Pastikan koneksi internet stabil selama ujian.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Persiapan - Baris Penuh -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h5 class="fw-bold mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Anda Siap Memulai Ujian?
                            </h5>
                            <p class="text-secondary mb-0">Pastikan Anda dalam kondisi siap dan tidak akan ada gangguan selama ujian berlangsung.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <button class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-semibold" 
                                    data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
                                <i class="fas fa-play me-2"></i>MULAI UJIAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Mulai Ujian -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-warning border-0">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Memulai Ujian
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-clock fa-4x text-warning"></i>
                    </div>
                    <h4 class="fw-bold">Apakah Anda Yakin?</h4>
                    <p class="text-secondary">Setelah memulai, timer akan berjalan dan tidak dapat dijeda.</p>
                </div>

                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Peringatan:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Durasi ujian <strong>{{ $durasi ?? 30 }} menit</strong></li>
                        <li>Waktu akan terus berjalan meskipun Anda keluar halaman</li>
                        <li>Hanya ada <strong>1 kali kesempatan</strong> ujian</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0 p-4">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                
                <!-- FORM DENGAN METHOD POST -->
                <form method="POST" action="{{ route('mahasiswa.ujian.mulai') }}">
                    @csrf
                    <button type="submit" class="btn btn-warning rounded-pill px-5 py-2 fw-semibold">
                        <i class="fas fa-play me-2"></i>YA, MULAI UJIAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.bg-gradient-ujian {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.rules-list p {
    line-height: 1.5;
    color: #4a5568;
    margin-bottom: 0;
}

.badge.rounded-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

/* Style untuk tampilan lebih rapi */
.card {
    transition: all 0.3s ease;
    height: 100%;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

/* Timer display lebih besar */
.display-1 {
    font-size: 5rem;
    line-height: 1.2;
}

/* Flexbox untuk tinggi yang sama */
.d-flex.flex-column {
    height: 100%;
}

.flex-grow-1 {
    flex: 1 1 auto;
}

/* Responsive */
@media (max-width: 768px) {
    .display-1 {
        font-size: 3.5rem;
    }
    
    .bg-light.rounded-4.p-5 {
        padding: 2rem !important;
    }
}
</style>
@endsection