@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="fw-bold mb-0">Registrasi Mahasiswa Baru</h3>
                    <p class="mb-0 mt-2 text-white-50">Isi data dengan benar untuk mendapatkan nomor tes</p>
                </div>
                
                <div class="card-body p-4">
                    <!-- TAMPILKAN ERROR -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Alert Info -->
                    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <strong>Perhatian!</strong> Setelah registrasi, Anda akan mendapatkan nomor tes yang digunakan untuk login.
                        </div>
                    </div>

                    <form method="POST" action="{{ route('auth.register.post') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                <input type="text" class="form-control form-control-lg @error('nama_lengkap') is-invalid @enderror" 
                                       id="nama_lengkap" name="nama_lengkap" 
                                       value="{{ old('nama_lengkap') }}"
                                       placeholder="Masukkan nama lengkap" required>
                            </div>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="contoh@email.com" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Program Studi -->
                        <div class="mb-4">
                            <label for="program_studi_id" class="form-label fw-semibold">Pilih Program Studi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-graduation-cap text-primary"></i></span>
                                <select class="form-select form-select-lg @error('program_studi_id') is-invalid @enderror" 
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

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Minimal 6 karakter" required minlength="6">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-lock text-primary"></i></span>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Checkbox Persetujuan -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="setuju" required>
                            <label class="form-check-label" for="setuju">
                                Saya menyetujui <a href="#" class="text-primary">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>

                        <!-- Tombol Daftar -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3 rounded-pill fw-semibold">
                                <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                            </button>
                        </div>

                        <!-- Link ke Login -->
                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="{{ route('auth.login') }}" class="text-primary fw-semibold text-decoration-none">Login di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                        <div>
                            <small class="text-secondary">Data terjamin</small>
                            <h6 class="mb-0">Kerahasiaan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock text-primary fa-2x me-3"></i>
                        <div>
                            <small class="text-secondary">Proses cepat</small>
                            <h6 class="mb-0">Kurang dari 5 menit</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-headset text-warning fa-2x me-3"></i>
                        <div>
                            <small class="text-secondary">Bantuan 24/7</small>
                            <h6 class="mb-0">Call center</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
(function() {
    'use strict';
    
    // Validasi form
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

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Validasi konfirmasi password
    const passwordConfirm = document.getElementById('password_confirmation');
    const password = document.getElementById('password');
    
    function validatePassword() {
        if (password.value !== passwordConfirm.value) {
            passwordConfirm.setCustomValidity('Password tidak cocok');
        } else {
            passwordConfirm.setCustomValidity('');
        }
    }
    
    password.addEventListener('change', validatePassword);
    passwordConfirm.addEventListener('keyup', validatePassword);
})();
</script>
@endsection