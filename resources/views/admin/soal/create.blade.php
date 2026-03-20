@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-soal text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Tambah Soal Ujian</h2>
                            <p class="mb-3 opacity-75">Buat soal baru untuk bank soal ujian</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.soal.index') }}" class="btn btn-light btn-lg rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <!-- Tampilkan error validasi -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form dengan action ke store -->
                    <form method="POST" action="{{ route('admin.soal.store') }}">
                        @csrf

                        <!-- Soal -->
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-5 mb-3">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Pertanyaan Soal <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control form-control-lg @error('soal') is-invalid @enderror" 
                                      name="soal" rows="4" placeholder="Tulis pertanyaan soal di sini...">{{ old('soal') }}</textarea>
                            @error('soal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Tulis pertanyaan dengan jelas dan lengkap</small>
                        </div>

                        <!-- Opsi Jawaban -->
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-5 mb-3">
                                <i class="fas fa-list-ul text-primary me-2"></i>
                                Opsi Jawaban <span class="text-danger">*</span>
                            </label>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white fw-bold px-4">A</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_a') is-invalid @enderror" 
                                               name="opsi_a" value="{{ old('opsi_a') }}" placeholder="Opsi A">
                                    </div>
                                    @error('opsi_a')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white fw-bold px-4">B</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_b') is-invalid @enderror" 
                                               name="opsi_b" value="{{ old('opsi_b') }}" placeholder="Opsi B">
                                    </div>
                                    @error('opsi_b')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white fw-bold px-4">C</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_c') is-invalid @enderror" 
                                               name="opsi_c" value="{{ old('opsi_c') }}" placeholder="Opsi C">
                                    </div>
                                    @error('opsi_c')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white fw-bold px-4">D</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_d') is-invalid @enderror" 
                                               name="opsi_d" value="{{ old('opsi_d') }}" placeholder="Opsi D">
                                    </div>
                                    @error('opsi_d')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-danger text-white fw-bold px-4">E</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_e') is-invalid @enderror" 
                                               name="opsi_e" value="{{ old('opsi_e') }}" placeholder="Opsi E">
                                    </div>
                                    @error('opsi_e')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <small class="text-muted">Isi semua opsi jawaban dengan lengkap</small>
                        </div>

                        <!-- Kunci Jawaban -->
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-5 mb-3">
                                <i class="fas fa-key text-primary me-2"></i>
                                Kunci Jawaban <span class="text-danger">*</span>
                            </label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-select form-select-lg @error('kunci_jawaban') is-invalid @enderror" 
                                            name="kunci_jawaban">
                                        <option value="" selected disabled>-- Pilih Kunci Jawaban --</option>
                                        <option value="a" {{ old('kunci_jawaban') == 'a' ? 'selected' : '' }}>A</option>
                                        <option value="b" {{ old('kunci_jawaban') == 'b' ? 'selected' : '' }}>B</option>
                                        <option value="c" {{ old('kunci_jawaban') == 'c' ? 'selected' : '' }}>C</option>
                                        <option value="d" {{ old('kunci_jawaban') == 'd' ? 'selected' : '' }}>D</option>
                                        <option value="e" {{ old('kunci_jawaban') == 'e' ? 'selected' : '' }}>E</option>
                                    </select>
                                    @error('kunci_jawaban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <small class="text-muted">Pilih satu jawaban yang benar</small>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="{{ route('admin.soal.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i>Simpan Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-soal {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.input-group-text {
    font-weight: 600;
    border: none;
    min-width: 45px;
    justify-content: center;
}

.form-control, .form-select {
    border: 1px solid #dee2e6;
    padding: 0.8rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.text-muted {
    font-size: 0.85rem;
    margin-top: 0.3rem;
    display: block;
}
</style>
@endsection