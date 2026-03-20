@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Header -->
                <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                    <div class="bg-white text-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-user-cog fa-3x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Login Admin</h3>
                    <p class="mb-0 text-white-50">Akses khusus administrator ITECH</p>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Alert -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="#" class="needs-validation" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-envelope text-dark"></i></span>
                                <input type="email" class="form-control form-control-lg" id="email" 
                                       name="email" placeholder="admin@itech.ac.id" 
                                       value="{{ old('email') }}" required>
                            </div>
                            <div class="invalid-feedback">Email harus diisi</div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-lock text-dark"></i></span>
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
                            <button type="submit" class="btn btn-dark btn-lg py-3 rounded-pill fw-semibold">
                                <i class="fas fa-sign-in-alt me-2"></i>LOGIN ADMIN
                            </button>
                        </div>

                    
                    </form>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light border-0 text-center p-4">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/" class="text-decoration-none small">
                            <i class="fas fa-home me-1"></i>Kembali ke Beranda
                        </a>
                    
                    </div>
                </div>
            </div>

            <!-- Security Info -->
            <div class="text-center mt-4">
                <div class="d-inline-block bg-light rounded-pill px-4 py-2">
                    <small class="text-secondary">
                        <i class="fas fa-shield-alt me-1 text-dark"></i>
                        Area terbatas - Hanya untuk admin
                    </small>
                </div>
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