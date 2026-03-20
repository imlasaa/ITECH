@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Selamat Datang -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Halo, {{ $user->nama_lengkap }}! 👋</h2>
                            <p class="mb-3 opacity-75">Selamat datang di dashboard Penerimaan Mahasiswa Baru ITECH</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Nomor Tes</small>
                                    <span class="fw-bold fs-5">{{ $nomorTes }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-5">{{ $user->programStudi->nama_prodi ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-user-graduate fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Cards dengan Data Real -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold mb-3">Status Pendaftaran Anda</h4>
        </div>
        
        <!-- Data Pribadi -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                        </div>
                        <div class="position-absolute top-0 end-0">
                            @if($dataPribadi)
                                <span class="badge bg-success rounded-pill p-2"><i class="fas fa-check"></i></span>
                            @else
                                <span class="badge bg-warning rounded-pill p-2"><i class="fas fa-clock"></i></span>
                            @endif
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Data Pribadi</h5>
                    <p class="text-secondary small mb-3">Status kelengkapan data diri</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($dataPribadi)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i>Sudah diisi
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                <i class="fas fa-clock me-1"></i>Belum diisi
                            </span>
                        @endif
                    </div>
                    <hr class="my-3">
                    <a href="{{ route('mahasiswa.data-pribadi') }}" class="btn btn-outline-primary w-100 rounded-pill">
                        <i class="fas fa-edit me-2"></i>Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Ujian -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-pencil-alt fa-3x text-warning"></i>
                        </div>
                        <div class="position-absolute top-0 end-0">
                            @if($hasilUjian)
                                @if($hasilUjian->status == 'lulus')
                                    <span class="badge bg-success rounded-pill p-2"><i class="fas fa-check"></i></span>
                                @elseif($hasilUjian->status == 'tidak_lulus')
                                    <span class="badge bg-danger rounded-pill p-2"><i class="fas fa-times"></i></span>
                                @else
                                    <span class="badge bg-warning rounded-pill p-2"><i class="fas fa-clock"></i></span>
                                @endif
                            @else
                                <span class="badge bg-secondary rounded-pill p-2"><i class="fas fa-minus"></i></span>
                            @endif
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Ujian Online</h5>
                    <p class="text-secondary small mb-3">Ujian seleksi mahasiswa baru</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($hasilUjian)
                            @if($hasilUjian->status == 'lulus')
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Lulus</span>
                            @elseif($hasilUjian->status == 'tidak_lulus')
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">Tidak Lulus</span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">Belum Dinilai</span>
                            @endif
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">Belum ujian</span>
                        @endif
                    </div>
                    <hr class="my-3">
                    <a href="{{ route('mahasiswa.ujian.index') }}" class="btn btn-outline-warning w-100 rounded-pill">
                        <i class="fas fa-arrow-right me-2"></i>
                        @if($hasilUjian)
                            @if($hasilUjian->status == 'belum_dinilai')
                                Lanjut Ujian
                            @else
                                Lihat Detail
                            @endif
                        @else
                            Mulai Ujian
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Hasil Ujian -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-file-alt fa-3x text-info"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Hasil Ujian</h5>
                    <p class="text-secondary small mb-3">Pengumuman kelulusan</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($hasilUjian)
                            @if($hasilUjian->status == 'lulus')
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>Lulus
                                </span>
                            @elseif($hasilUjian->status == 'tidak_lulus')
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                    <i class="fas fa-times-circle me-1"></i>Tidak Lulus
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                    <i class="fas fa-clock me-1"></i>Proses
                                </span>
                            @endif
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                <i class="fas fa-minus me-1"></i>Belum
                            </span>
                        @endif
                    </div>
                    <hr class="my-3">
                    <a href="{{ route('mahasiswa.hasil') }}" class="btn btn-outline-info w-100 rounded-pill">
                        <i class="fas fa-eye me-2"></i>Lihat
                    </a>
                </div>
            </div>
        </div>

        <!-- Daftar Ulang -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="position-relative d-inline-block mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-credit-card fa-3x text-success"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-2">Daftar Ulang</h5>
                    <p class="text-secondary small mb-3">Upload berkas & pembayaran</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if($mahasiswaAktif)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="fas fa-id-card me-1"></i>Aktif
                            </span>
                        @elseif($daftarUlang)
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                <i class="fas fa-clock me-1"></i>Diproses
                            </span>
                        @elseif($hasilUjian && $hasilUjian->status == 'lulus')
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                <i class="fas fa-arrow-right me-1"></i>Dapat diakses
                            </span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                <i class="fas fa-lock me-1"></i>Terkunci
                            </span>
                        @endif
                    </div>
                    <hr class="my-3">
                    <a href="{{ route('mahasiswa.daftar-ulang.index') }}" 
                       class="btn btn-outline-success w-100 rounded-pill 
                              @if(!$hasilUjian || $hasilUjian->status != 'lulus') disabled @endif">
                        <i class="fas fa-arrow-right me-2"></i>Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Penting & Timeline -->
    <div class="row">
        <!-- Informasi Penting -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-bullhorn text-primary me-2"></i>
                        Informasi Penting
                    </h5>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="list-group list-group-flush bg-transparent">
                        <div class="list-group-item bg-transparent border-0 ps-0 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-danger rounded-pill px-3 py-2">BARU</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Jadwal Ujian Telah Diumumkan</h6>
                                    <p class="text-secondary small mb-0">Ujian akan dilaksanakan pada tanggal 5-7 April 2026. Pastikan Anda sudah menyiapkan diri.</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent border-0 ps-0 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-warning rounded-pill px-3 py-2">INFO</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Ujian Online</h6>
                                    <p class="text-secondary small mb-0">Hanya satu kali submit.</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent border-0 ps-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-info rounded-pill px-3 py-2">PENTING</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Batas Akhir Isi Data Pribadi</h6>
                                    <p class="text-secondary small mb-0">Harap lengkapi data pribadi sebelum ujian dimulai.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Pendaftaran -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                        Timeline Pendaftaran
                    </h5>
                </div>
                <div class="card-body p-4 pt-2">
                    @php
                        $tahap1 = $dataPribadi ? 'selesai' : 'aktif';
                        $tahap2 = $hasilUjian ? 'selesai' : ($dataPribadi ? 'aktif' : 'pending');
                        $tahap3 = ($hasilUjian && $hasilUjian->status != 'belum_dinilai') ? 'selesai' : ($hasilUjian ? 'aktif' : 'pending');
                        $tahap4 = $mahasiswaAktif ? 'selesai' : (($hasilUjian && $hasilUjian->status == 'lulus') ? 'aktif' : 'pending');
                    @endphp

                    <div class="timeline">
                        <!-- Item 1 -->
                        <div class="timeline-item d-flex mb-4">
                            <div class="timeline-icon me-3">
                                <div class="bg-{{ $tahap1 == 'selesai' ? 'success' : ($tahap1 == 'aktif' ? 'warning' : 'secondary') }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    @if($tahap1 == 'selesai')
                                        <i class="fas fa-check"></i>
                                    @elseif($tahap1 == 'aktif')
                                        <i class="fas fa-clock"></i>
                                    @else
                                        <i class="fas fa-hourglass"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold mb-1">Data Pribadi</h6>
                                    <small class="text-{{ $tahap1 == 'selesai' ? 'success' : ($tahap1 == 'aktif' ? 'warning' : 'secondary') }}">
                                        {{ $tahap1 == 'selesai' ? 'Selesai' : ($tahap1 == 'aktif' ? 'Sedang Berlangsung' : 'Belum') }}
                                    </small>
                                </div>
                                <p class="text-secondary small mb-0">Lengkapi data diri Anda</p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="timeline-item d-flex mb-4">
                            <div class="timeline-icon me-3">
                                <div class="bg-{{ $tahap2 == 'selesai' ? 'success' : ($tahap2 == 'aktif' ? 'warning' : 'secondary') }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    @if($tahap2 == 'selesai')
                                        <i class="fas fa-check"></i>
                                    @elseif($tahap2 == 'aktif')
                                        <i class="fas fa-clock"></i>
                                    @else
                                        <i class="fas fa-hourglass"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold mb-1">Ujian Seleksi</h6>
                                    <small class="text-{{ $tahap2 == 'selesai' ? 'success' : ($tahap2 == 'aktif' ? 'warning' : 'secondary') }}">
                                        {{ $tahap2 == 'selesai' ? 'Selesai' : ($tahap2 == 'aktif' ? 'Sedang Berlangsung' : 'Belum') }}
                                    </small>
                                </div>
                                <p class="text-secondary small mb-0">Ikuti ujian online</p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="timeline-item d-flex mb-4">
                            <div class="timeline-icon me-3">
                                <div class="bg-{{ $tahap3 == 'selesai' ? 'success' : ($tahap3 == 'aktif' ? 'warning' : 'secondary') }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    @if($tahap3 == 'selesai')
                                        <i class="fas fa-check"></i>
                                    @elseif($tahap3 == 'aktif')
                                        <i class="fas fa-clock"></i>
                                    @else
                                        <i class="fas fa-hourglass"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold mb-1">Pengumuman Kelulusan</h6>
                                    <small class="text-{{ $tahap3 == 'selesai' ? 'success' : ($tahap3 == 'aktif' ? 'warning' : 'secondary') }}">
                                        {{ $tahap3 == 'selesai' ? 'Selesai' : ($tahap3 == 'aktif' ? 'Diproses' : 'Belum') }}
                                    </small>
                                </div>
                                <p class="text-secondary small mb-0">Lihat hasil kelulusan</p>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="timeline-item d-flex">
                            <div class="timeline-icon me-3">
                                <div class="bg-{{ $tahap4 == 'selesai' ? 'success' : ($tahap4 == 'aktif' ? 'warning' : 'secondary') }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    @if($tahap4 == 'selesai')
                                        <i class="fas fa-check"></i>
                                    @elseif($tahap4 == 'aktif')
                                        <i class="fas fa-clock"></i>
                                    @else
                                        <i class="fas fa-hourglass"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-semibold mb-1">Daftar Ulang</h6>
                                    <small class="text-{{ $tahap4 == 'selesai' ? 'success' : ($tahap4 == 'aktif' ? 'warning' : 'secondary') }}">
                                        {{ $tahap4 == 'selesai' ? 'Selesai' : ($tahap4 == 'aktif' ? 'Sedang Berlangsung' : 'Terkunci') }}
                                    </small>
                                </div>
                                <p class="text-secondary small mb-0">Upload berkas & pembayaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Mahasiswa (Jika Sudah Aktif) -->
    @if($mahasiswaAktif)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 bg-success bg-gradient text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white text-success rounded-circle p-3 me-3">
                                    <i class="fas fa-id-card fa-2x"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">Kartu Mahasiswa Tersedia</h4>
                                    <p class="mb-0 opacity-75">NIM Anda telah aktif, cetak kartu mahasiswa sekarang</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">NIM</small>
                                    <span class="fw-bold fs-5">{{ $mahasiswaAktif->nim }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-5">{{ $mahasiswaAktif->programStudi->nama_prodi ?? $user->programStudi->nama_prodi }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('mahasiswa.kartu') }}" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-semibold">
                                <i class="fas fa-eye me-2"></i>Lihat Kartu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- Alert Penolakan Daftar Ulang -->
@if($daftarUlang && $daftarUlang->status_berkas == 'ditolak')
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-danger">
            <i class="fas fa-times-circle me-2"></i>
            <strong>Daftar Ulang Ditolak!</strong> 
            Silakan cek halaman daftar ulang untuk melihat alasan dan upload ulang berkas.
            <a href="{{ route('mahasiswa.daftar-ulang.index') }}" class="alert-link">Klik di sini</a>
        </div>
    </div>
</div>
@endif
<!-- Custom CSS -->
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.timeline-item:last-child .timeline-content {
    margin-bottom: 0;
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}
</style>
@endsection