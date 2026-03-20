@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-kartu text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Kartu Mahasiswa ITECH</h2>
                            <p class="mb-3 opacity-75">Kartu identitas resmi mahasiswa aktif Institut Teknologi dan Kesehatan</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">NIM</small>
                                    <span class="fw-bold fs-6">{{ $nim }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">{{ $programStudi }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-id-card fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Mahasiswa -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="kartu-ktp p-4 mb-4">
                <!-- Header Kartu -->
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <div class="d-inline-block bg-primary text-white px-4 py-1 rounded-pill mb-2">
                            <small>KARTU MAHASISWA</small>
                        </div>
                        <h3 class="fw-bold text-primary mb-0">ITECH</h3>
                        <p class="small text-secondary">Institut Teknologi dan Kesehatan</p>
                    </div>
                </div>

                <!-- Body Kartu -->
                <div class="row">
                    <!-- Kolom Kiri: Foto -->
                    <div class="col-md-4 text-center">
                        <div class="foto-container">
                            @if($pasFoto)
                                <img src="{{ asset('storage/' . $pasFoto) }}" alt="Pas Foto" class="img-fluid foto-ktp" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center foto-ktp" style="width: 100%; height: 180px; border-radius: 8px;">
                                    <i class="fas fa-user fa-4x text-secondary"></i>
                                </div>
                            @endif
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-success">AKTIF</span>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Data -->
                    <div class="col-md-8">
                        <table class="table-ktp" style="width: 100%;">
                            <tr>
                                <td class="label" style="width: 35%; padding: 8px 0; color: #6c757d;">NIM</td>
                                <td class="separator" style="width: 5%; padding: 8px 0;">:</td>
                                <td class="value fw-bold text-primary" style="padding: 8px 0;">{{ $nim }}</td>
                            </tr>
                            <tr>
                                <td class="label" style="padding: 8px 0; color: #6c757d;">Nama Lengkap</td>
                                <td class="separator" style="padding: 8px 0;">:</td>
                                <td class="value" style="padding: 8px 0;">{{ $nama }}</td>
                            </tr>
                            <tr>
                                <td class="label" style="padding: 8px 0; color: #6c757d;">Program Studi</td>
                                <td class="separator" style="padding: 8px 0;">:</td>
                                <td class="value" style="padding: 8px 0;">{{ $programStudi }}</td>
                            </tr>
                            <tr>
                                <td class="label" style="padding: 8px 0; color: #6c757d;">Tahun Masuk</td>
                                <td class="separator" style="padding: 8px 0;">:</td>
                                <td class="value" style="padding: 8px 0;">{{ $tahunMasuk }}</td>
                            </tr>
                            <tr>
                                <td class="label" style="padding: 8px 0; color: #6c757d;">Masa Berlaku</td>
                                <td class="separator" style="padding: 8px 0;">:</td>
                                <td class="value" style="padding: 8px 0;">{{ $tahunMasuk }} - {{ $masaBerlaku }}</td>
                            </tr>
                        </table>

                        <!-- Informasi Tambahan -->
                        <div class="mt-3 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small class="text-secondary">Status: <strong>Mahasiswa Aktif</strong></small>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <small class="text-secondary">Terdaftar sejak: {{ $tahunMasuk }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="row mt-3">
                    <div class="col-12">
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center small text-secondary">
                            <span><i class="fas fa-credit-card me-1"></i> Kartu ini adalah milik ITECH</span>
                            <span>Jika ditemukan, harap kembalikan ke kampus</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-center gap-3 mb-5">
                <a href="{{ route('mahasiswa.kartu.cetak') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3" target="_blank">
                    <i class="fas fa-print me-2"></i>Cetak Kartu
                </a>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Informasi Penggunaan -->
            <div class="card border-0 bg-light rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Kartu Mahasiswa
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="fas fa-check-circle text-success me-3 mt-1 fa-2x"></i>
                                <div>
                                    <h6 class="fw-semibold mb-1">Identitas Resmi</h6>
                                    <small class="text-secondary">Kartu ini adalah bukti status mahasiswa aktif ITECH</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="fas fa-print text-primary me-3 mt-1 fa-2x"></i>
                                <div>
                                    <h6 class="fw-semibold mb-1">Dapat Dicetak</h6>
                                    <small class="text-secondary">Cetak kartu untuk keperluan administrasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <i class="fas fa-shield-alt text-warning me-3 mt-1 fa-2x"></i>
                                <div>
                                    <h6 class="fw-semibold mb-1">Berlaku 4 Tahun</h6>
                                    <small class="text-secondary">Masa berlaku sampai dengan tahun {{ $masaBerlaku }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.bg-gradient-kartu {
    background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 50%, #fdbb2d 100%);
}

.kartu-ktp {
    background: white;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    position: relative;
    overflow: hidden;
    border: 1px solid #dee2e6;
    max-width: 900px;
    margin: 0 auto;
}

.kartu-ktp::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #1a2a6c, #b21f1f, #fdbb2d);
}

.foto-container {
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
}

.foto-ktp {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border: 3px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table-ktp {
    width: 100%;
    border-collapse: collapse;
}

.table-ktp tr {
    border-bottom: 1px solid #f0f0f0;
}

.table-ktp tr:last-child {
    border-bottom: none;
}

/* Animasi */
@keyframes cardFloat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.kartu-ktp {
    animation: cardFloat 6s ease-in-out infinite;
}

/* Responsive */
@media (max-width: 768px) {
    .kartu-ktp {
        padding: 1rem !important;
    }
    
    .foto-ktp {
        height: 150px;
        margin-bottom: 1rem;
    }
}
</style>
@endsection