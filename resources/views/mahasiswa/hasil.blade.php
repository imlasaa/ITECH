@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-hasil text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Hasil Ujian Seleksi</h2>
                            <p class="mb-3 opacity-75">Pengumuman kelulusan ujian masuk ITECH</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Nomor Tes</small>
                                    <span class="fw-bold fs-6">{{ $nomorTes }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">{{ $programStudi }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-file-alt fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Ujian -->
    <div class="row mb-4">
        <div class="col-12">
            @if($status == 'lulus')
                <!-- VERSI LULUS -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="position-relative bg-gradient-success p-5 text-center">
                        <div class="position-relative">
                            <div class="bg-white text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 120px; height: 120px;">
                                <i class="fas fa-check-circle fa-5x"></i>
                            </div>
                            <h1 class="display-3 fw-bold text-white mb-3">SELAMAT!</h1>
                            <h3 class="text-white mb-4">Anda Dinyatakan LULUS</h3>
                            
                            <div class="d-inline-block bg-white bg-opacity-25 rounded-pill px-4 py-2 mb-4">
                                <span class="text-white fw-semibold">
                                    <i class="fas fa-star me-2"></i>Calon Mahasiswa Baru ITECH 2026
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-id-card fa-3x text-success"></i>
                                    </div>
                                    <h5 class="fw-bold">Status Kelulusan</h5>
                                    <p class="display-6 fw-bold text-success">LULUS</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-calendar-check fa-3x text-success"></i>
                                    </div>
                                    <h5 class="fw-bold">Tanggal Ujian</h5>
                                    <p class="fs-5">{{ $tanggalUjian ? $tanggalUjian->format('d F Y') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-graduation-cap fa-3x text-success"></i>
                                    </div>
                                    <h5 class="fw-bold">Program Studi</h5>
                                    <p class="fs-5">{{ $programStudi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success border-0 bg-success bg-opacity-10 rounded-4 p-4 mb-5">
                            <div class="d-flex">
                                <div class="me-4">
                                    <i class="fas fa-trophy fa-3x text-success"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-success mb-2">Selamat Bergabung di ITECH!</h5>
                                    <p class="mb-0 text-secondary">Anda telah berhasil melewati tahap ujian seleksi. Langkah selanjutnya adalah melakukan daftar ulang untuk menjadi mahasiswa aktif ITECH.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('mahasiswa.daftar-ulang.index') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-semibold">
                                <i class="fas fa-arrow-right me-2"></i>LANJUT DAFTAR ULANG
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($status == 'tidak_lulus')
                <!-- VERSI TIDAK LULUS -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="position-relative bg-gradient-danger p-5 text-center">
                        <div class="position-relative">
                            <div class="bg-white text-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 120px; height: 120px;">
                                <i class="fas fa-times-circle fa-5x"></i>
                            </div>
                            <h1 class="display-3 fw-bold text-white mb-3">MOHON MAAF</h1>
                            <h3 class="text-white mb-4">Anda Tidak Lulus</h3>
                            
                            <div class="d-inline-block bg-white bg-opacity-25 rounded-pill px-4 py-2 mb-4">
                                <span class="text-white fw-semibold">
                                    <i class="fas fa-info-circle me-2"></i>Hasil Ujian Seleksi ITECH 2026
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-id-card fa-3x text-danger"></i>
                                    </div>
                                    <h5 class="fw-bold">Status Kelulusan</h5>
                                    <p class="display-6 fw-bold text-danger">TIDAK LULUS</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-calendar-check fa-3x text-danger"></i>
                                    </div>
                                    <h5 class="fw-bold">Tanggal Ujian</h5>
                                    <p class="fs-5">{{ $tanggalUjian ? $tanggalUjian->format('d F Y') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-graduation-cap fa-3x text-danger"></i>
                                    </div>
                                    <h5 class="fw-bold">Program Studi</h5>
                                    <p class="fs-5">{{ $programStudi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 rounded-4 p-4 mb-5">
                            <div class="d-flex">
                                <div class="me-4">
                                    <i class="fas fa-heart-broken fa-3x text-danger"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-danger mb-2">Jangan Berkecil Hati</h5>
                                    <p class="mb-0 text-secondary">Kami mengucapkan terima kasih atas partisipasi Anda dalam seleksi PMB ITECH. Jangan menyerah, Anda dapat mencoba lagi di tahun depan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3 fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- VERSI BELUM DINILAI / PENDING -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="position-relative bg-gradient-warning p-5 text-center">
                        <div class="position-relative">
                            <div class="bg-white text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 120px; height: 120px;">
                                <i class="fas fa-clock fa-5x"></i>
                            </div>
                            <h1 class="display-3 fw-bold text-white mb-3">HASIL UJIAN</h1>
                            <h3 class="text-white mb-4">Sedang Dalam Proses Penilaian</h3>
                            
                            <div class="d-inline-block bg-white bg-opacity-25 rounded-pill px-4 py-2 mb-4">
                                <span class="text-white fw-semibold">
                                    <i class="fas fa-info-circle me-2"></i>Harap Menunggu
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <p class="fs-5 text-secondary">Hasil ujian Anda sedang dalam proses penilaian oleh tim penguji.</p>
                            <p class="text-secondary">Silakan cek kembali secara berkala. Terima kasih atas kesabaran Anda.</p>
                        </div>

                        <div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-4 p-4 mb-5">
                            <div class="d-flex">
                                <div class="me-4">
                                    <i class="fas fa-info-circle fa-3x text-info"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-info mb-2">Informasi Penting</h5>
                                    <p class="mb-0 text-secondary">Hasil ujian akan diumumkan oleh admin setelah proses penilaian selesai. Anda akan mendapatkan notifikasi melalui email.</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3 fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}
.bg-gradient-danger {
    background: linear-gradient(135deg, #c31432 0%, #240b36 100%);
}
.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}
.bg-gradient-hasil {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.fa-check-circle, .fa-times-circle, .fa-clock {
    animation: popIn 0.5s ease-out;
}
@keyframes popIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
.card {
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection