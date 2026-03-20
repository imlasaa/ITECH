@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-admin text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Dashboard Admin</h2>
                            <p class="mb-3 opacity-75">Selamat datang di panel administrasi Penerimaan Mahasiswa Baru ITECH</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Periode PMB</small>
                                    <span class="fw-bold fs-6">2025/2026</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Total Pendaftar</small>
                                    <span class="fw-bold fs-6">{{ $totalPendaftar }} Orang</span>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                <i class="fas fa-users me-1"></i> Total
                            </span>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $totalPendaftar }}</h3>
                    <p class="text-secondary mb-0">Total Pendaftar</p>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-arrow-up me-1"></i> {{ $totalPendaftar > 0 ? 'Aktif' : 'Belum ada data' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                <i class="fas fa-clock me-1"></i> Pending
                            </span>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-file-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $totalPending }}</h3>
                    <p class="text-secondary mb-0">Menunggu Verifikasi</p>
                    <div class="mt-3 small text-secondary">
                        <i class="fas fa-info-circle me-1"></i> {{ $daftarUlangPending }} berkas, {{ $pembayaranPending }} pembayaran
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                <i class="fas fa-check-circle me-1"></i> Lulus
                            </span>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-graduation-cap fa-2x text-success"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $totalLulus }}</h3>
                    <p class="text-secondary mb-0">Calon Mahasiswa Lulus</p>
                    <div class="mt-3 small text-success">
                        <i class="fas fa-check-circle me-1"></i> {{ $totalPendaftar > 0 ? round(($totalLulus / $totalPendaftar) * 100) : 0 }}% dari total
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                                <i class="fas fa-id-card me-1"></i> Aktif
                            </span>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-credit-card fa-2x text-info"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $mahasiswaAktif }}</h3>
                    <p class="text-secondary mb-0">Mahasiswa Aktif</p>
                    <div class="mt-3 small text-info">
                        <i class="fas fa-sync-alt me-1"></i> Sudah daftar ulang
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Admin -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-menu me-2 text-primary"></i>
                Menu Administrasi
            </h4>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('admin.calon-mahasiswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 menu-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Calon Mahasiswa</h5>
                                <p class="text-secondary small mb-0">CRUD data pendaftar</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{ $totalPendaftar }} Data</span>
                            <i class="fas fa-arrow-right text-primary"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('admin.soal.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 menu-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-question-circle fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Manajemen Soal</h5>
                                <p class="text-secondary small mb-0">CRUD bank soal ujian</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-success">{{ \App\Models\SoalUjian::count() }} Soal</span>
                            <i class="fas fa-arrow-right text-success"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('admin.kelulusan.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 menu-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-clipboard-check fa-2x text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Kelulusan</h5>
                                <p class="text-secondary small mb-0">Accept/Reject hasil ujian</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">{{ $totalPending }} Pending</span>
                            <i class="fas fa-arrow-right text-warning"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <a href="{{ route('admin.daftar-ulang.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 menu-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fas fa-file-upload fa-2x text-info"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Daftar Ulang</h5>
                                <p class="text-secondary small mb-0">Verifikasi berkas & generate NIM</p>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <span class="badge bg-info">{{ $daftarUlangPending }} Pengajuan</span>
                            <i class="fas fa-arrow-right text-info"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Tabel Pendaftar Terbaru -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-user-plus text-primary me-2"></i>
                            Pendaftar Terbaru
                        </h5>
                        <a href="{{ route('admin.calon-mahasiswa.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-4 pt-2">
                    @if($pendaftarTerbaru->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Nama</th>
                                    <th class="py-3">Prodi</th>
                                    <th class="py-3">Tanggal</th>
                                    <th class="py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarTerbaru as $pendaftar)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold">{{ $pendaftar->nama_lengkap }}</span><br>
                                                <small class="text-secondary">{{ $pendaftar->nomorTes->nomor_tes ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $pendaftar->programStudi->nama_prodi ?? '-' }}</td>
                                    <td>{{ $pendaftar->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($pendaftar->hasilUjian)
                                            @if($pendaftar->hasilUjian->status == 'lulus')
                                                <span class="badge bg-success">Lulus</span>
                                            @elseif($pendaftar->hasilUjian->status == 'tidak_lulus')
                                                <span class="badge bg-danger">Tidak Lulus</span>
                                            @elseif($pendaftar->hasilUjian->status == 'belum_dinilai')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Belum Ujian</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-secondary mb-3"></i>
                        <p class="text-secondary">Belum ada pendaftar</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik per Program Studi -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-chart-pie text-primary me-2"></i>
                        Statistik per Program Studi
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($pendaftarPerProdi->count() > 0)
                        @foreach($pendaftarPerProdi as $prodi)
                        @php
                            $persentase = $totalPendaftar > 0 ? round(($prodi->users_count / $totalPendaftar) * 100) : 0;
                            $warna = $loop->iteration == 1 ? 'primary' : ($loop->iteration == 2 ? 'success' : 'warning');
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold">{{ $prodi->nama_prodi }}</span>
                                <span class="fw-bold">{{ $prodi->users_count }} Pendaftar ({{ $persentase }}%)</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-{{ $warna }}" role="progressbar" style="width: {{ $persentase }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-pie fa-3x text-secondary mb-3"></i>
                            <p class="text-secondary">Belum ada data</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.bg-gradient-admin {
    background: linear-gradient(135deg, #141e30 0%, #243b55 100%);
}

.menu-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.menu-card:hover .fa-arrow-right {
    transform: translateX(5px);
    transition: transform 0.3s ease;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    border-radius: 10px;
    transition: width 1s ease;
}
</style>
@endsection