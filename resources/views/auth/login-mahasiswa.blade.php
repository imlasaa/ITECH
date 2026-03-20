@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Header -->
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <div class="bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-user-graduate fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Login Mahasiswa</h3>
                    <p class="mb-0 text-white-50">Masukkan nomor tes dan password Anda</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Alert -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                <form method="POST" action="{{ route('auth.login.post') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Nomor Tes -->
                        <div class="mb-4">
                            <label for="nomor_tes" class="form-label fw-semibold">Nomor Tes</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-id-card text-primary"></i></span>
                                <input type="text" class="form-control form-control-lg" id="nomor_tes" 
                                       name="nomor_tes" placeholder="Contoh: ITECH-2025-0001" 
                                       value="{{ old('nomor_tes') }}" required>
                            </div>
                            <div class="invalid-feedback">Nomor tes harus diisi</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                                <input type="password" class="form-control form-control-lg" id="password" 
                                       name="password" placeholder="Masukkan password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">Password harus diisi</div>
                        </div>

                        <!-- Tombol Login -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3 rounded-pill fw-semibold">
                                <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                            </button>
                        </div>

                        <!-- Link Lupa Nomor Tes -->
                        <div class="text-center mt-3">
                            <a href="/auth/lupa-nomor-tes" class="text-decoration-none">
                                <i class="fas fa-question-circle me-1"></i>Lupa Nomor Tes?
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light border-0 text-center p-4">
                    <p class="mb-2">Belum punya akun?</p>
                    <a href="/auth/register" class="btn btn-outline-primary rounded-pill px-5 py-2">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>

            <!-- Info -->
            <div class="text-center mt-4">
                <small class="text-secondary">
                    <i class="fas fa-shield-alt me-1"></i>
                    Data Anda aman dan terenkripsi
                </small>
            </div>
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