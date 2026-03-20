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
                            <h2 class="fw-bold mb-2">Edit Soal Ujian</h2>
                            <p class="mb-3 opacity-75">Edit soal ujian seleksi</p>
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
                    <form action="{{ route('admin.soal.update', $soal->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Soal -->
                        <div class="mb-5">
                            <label class="form-label fw-bold fs-5 mb-3">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Pertanyaan Soal <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control form-control-lg @error('soal') is-invalid @enderror" 
                                      name="soal" rows="4" placeholder="Tulis pertanyaan soal di sini..." required>{{ old('soal', $soal->soal) }}</textarea>
                            @error('soal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                               name="opsi_a" value="{{ old('opsi_a', $soal->opsi_a) }}" required>
                                    </div>
                                    @error('opsi_a')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white fw-bold px-4">B</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_b') is-invalid @enderror" 
                                               name="opsi_b" value="{{ old('opsi_b', $soal->opsi_b) }}" required>
                                    </div>
                                    @error('opsi_b')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-white fw-bold px-4">C</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_c') is-invalid @enderror" 
                                               name="opsi_c" value="{{ old('opsi_c', $soal->opsi_c) }}" required>
                                    </div>
                                    @error('opsi_c')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white fw-bold px-4">D</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_d') is-invalid @enderror" 
                                               name="opsi_d" value="{{ old('opsi_d', $soal->opsi_d) }}" required>
                                    </div>
                                    @error('opsi_d')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-danger text-white fw-bold px-4">E</span>
                                        <input type="text" class="form-control form-control-lg @error('opsi_e') is-invalid @enderror" 
                                               name="opsi_e" value="{{ old('opsi_e', $soal->opsi_e) }}" required>
                                    </div>
                                    @error('opsi_e')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                                            name="kunci_jawaban" required>
                                        <option value="" disabled>-- Pilih Kunci Jawaban --</option>
                                        <option value="a" {{ old('kunci_jawaban', $soal->kunci_jawaban) == 'a' ? 'selected' : '' }}>A</option>
                                        <option value="b" {{ old('kunci_jawaban', $soal->kunci_jawaban) == 'b' ? 'selected' : '' }}>B</option>
                                        <option value="c" {{ old('kunci_jawaban', $soal->kunci_jawaban) == 'c' ? 'selected' : '' }}>C</option>
                                        <option value="d" {{ old('kunci_jawaban', $soal->kunci_jawaban) == 'd' ? 'selected' : '' }}>D</option>
                                        <option value="e" {{ old('kunci_jawaban', $soal->kunci_jawaban) == 'e' ? 'selected' : '' }}>E</option>
                                    </select>
                                    @error('kunci_jawaban')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="{{ route('admin.soal.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i>Update Soal
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
}

.form-control, .form-select {
    border: 1px solid #dee2e6;
    padding: 0.8rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}
</style>
@endsection