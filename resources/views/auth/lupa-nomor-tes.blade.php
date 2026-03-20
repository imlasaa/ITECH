@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Header -->
                <div class="card-header bg-warning text-dark text-center py-4 rounded-top-4">
                    <div class="bg-white text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-search fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Lupa Nomor Tes</h3>
                    <p class="mb-0 text-dark">Masukkan data sesuai registrasi untuk menemukan nomor tes</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- TAMPILKAN ERROR -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- HASIL PENCARIAN (jika ditemukan) -->
                    @if(session('nomor_tes'))
                        <div class="mb-4">
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                            <div class="bg-light rounded-4 p-4 border border-warning border-2">
                                <div class="text-center mb-3">
                                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill">
                                        <i class="fas fa-id-card me-2"></i>NOMOR TES DITEMUKAN
                                    </span>
                                </div>
                                
                                <!-- Data User -->
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <small class="text-secondary">Nama</small>
                                        <p class="fw-semibold mb-0">{{ session('nama') }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-secondary">Program Studi</small>
                                        <p class="fw-semibold mb-0">{{ session('prodi') }}</p>
                                    </div>
                                </div>

                                <!-- Nomor Tes Result -->
                                <div class="text-center p-3 bg-white rounded-3 mb-3">
                                    <small class="text-secondary d-block mb-1">Nomor Tes Anda</small>
                                    <h2 class="fw-bold text-warning mb-0" style="letter-spacing: 2px;">{{ session('nomor_tes') }}</h2>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-grid">
                                    <a href="{{ route('auth.login') }}" class="btn btn-warning">
                                        <i class="fas fa-sign-in-alt me-2"></i>LANJUT KE LOGIN
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- FORM PENCARIAN - HANYA DITAMPILKAN JIKA BELUM ADA HASIL -->
                    @if(!session('nomor_tes'))
                        <!-- Alert Info -->
                        <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-info-circle fa-2x me-3"></i>
                            <div>
                                <strong>Perhatian!</strong> Isi data dengan benar sesuai saat registrasi.
                                Data akan dicocokkan untuk menampilkan nomor tes Anda.
                            </div>
                        </div>

                        <form method="POST" action="{{ route('auth.lupa-nomor-tes.cari') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user text-warning"></i></span>
                                    <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                           id="nama_lengkap" name="nama_lengkap" 
                                           value="{{ old('nama_lengkap') }}" 
                                           placeholder="Masukkan nama lengkap" required>
                                </div>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-warning"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="contoh@email.com" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password (UNTUK VERIFIKASI) -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock text-warning"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="Masukkan password saat registrasi" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kami memerlukan password untuk verifikasi identitas Anda</div>
                            </div>

                            <!-- Program Studi -->
                            <div class="mb-4">
                                <label for="program_studi_id" class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-graduation-cap text-warning"></i></span>
                                    <select class="form-select @error('program_studi_id') is-invalid @enderror" 
                                            id="program_studi_id" name="program_studi_id" required>
                                        <option value="" selected disabled>-- Pilih Program Studi --</option>
                                        @foreach($programStudi as $prodi)
                                            <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                                {{ $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('program_studi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Cari -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning btn-lg py-3 fw-semibold">
                                    <i class="fas fa-search me-2"></i>CARI NOMOR TES
                                </button>
                            </div>
                        </form>
                    @else
                        <!-- Tombol untuk mencari lagi (opsional) -->
                        <div class="text-center mt-3">
                            <form method="POST" action="{{ route('auth.lupa-nomor-tes.cari') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="reset" value="1">
                                <button type="submit" class="btn btn-link text-decoration-none">
                                    <i class="fas fa-search me-1"></i>Cari nomor tes lain?
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light border-0 text-center p-4">
                    <p class="mb-0">
                        <i class="fas fa-arrow-left me-2"></i>
                        <a href="{{ route('auth.login') }}" class="text-decoration-none">Kembali ke halaman login</a>
                    </p>
                </div>
            </div>

            <!-- Tips - HANYA DITAMPILKAN JIKA BELUM ADA HASIL -->
            @if(!session('nomor_tes'))
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i>Tips:</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pastikan email sesuai dengan saat registrasi</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Password digunakan untuk verifikasi keamanan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Jika masih kesulitan, hubungi panitia di 0812-3456-7890</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
// Toggle password visibility
const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

// Form validation
(function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>
@endsection