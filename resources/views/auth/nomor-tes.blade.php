@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Card Utama Nomor Tes -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header dengan pattern -->
                <div class="bg-primary py-4 position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" 
                         style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                    </div>
                    <div class="position-relative text-center">
                        <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-check-circle fa-4x"></i>
                        </div>
                        <h2 class="text-white fw-bold mb-1">REGISTRASI BERHASIL!</h2>
                        <p class="text-white-50 mb-0">Selamat, akun Anda telah terdaftar</p>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-5">
                    <!-- Info Akun (DATA REAL DARI DATABASE) -->
                    <div class="text-center mb-4">
                        <h5 class="text-secondary">Nama Lengkap</h5>
                        <h4 class="fw-bold">{{ $user->nama_lengkap ?? 'Nama Tidak Ditemukan' }}</h4>
                    </div>

                    <!-- Card Nomor Tes (DATA REAL DARI DATABASE) -->
                    <div class="bg-light rounded-4 p-4 mb-4 border border-2 border-primary border-opacity-25">
                        <div class="text-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill">
                                <i class="fas fa-id-card me-2"></i>NOMOR TES ANDA
                            </span>
                        </div>
                        
                        <!-- Nomor Tes Besar (DATA REAL) -->
                        <div class="text-center mb-3">
                            <div class="display-1 fw-bold text-primary" style="letter-spacing: 5px;">{{ $nomorTes }}</div>
                        </div>
                    </div>
                    
                    <!-- Data Registrasi (DATA REAL) -->
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3">
                                <small class="text-secondary d-block">Email</small>
                                <span class="fw-semibold">{{ $user->email ?? 'email@example.com' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-light p-3 rounded-3">
                                <small class="text-secondary d-block">Program Studi</small>
                                <span class="fw-semibold">{{ $user->programStudi->nama_prodi ?? 'Teknik Informatika' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-3">
                        <a href="{{ route('auth.login') }}" class="btn btn-primary btn-lg py-3 rounded-pill fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i>LANJUT KE LOGIN
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tips Card -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i>Tips Penting:</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Screenshot halaman ini sebagai cadangan</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Nomor tes akan dikirim ke email Anda</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Gunakan nomor tes dan password untuk login</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Lengkapi data pribadi setelah login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style untuk print -->
<style>
@media print {
    .navbar, footer, .btn, .card:last-child {
        display: none !important;
    }
    .card {
        box-shadow: none !important;
        border: 2px solid #000 !important;
    }
    .display-1 {
        color: black !important;
    }
}
</style>
@endsection