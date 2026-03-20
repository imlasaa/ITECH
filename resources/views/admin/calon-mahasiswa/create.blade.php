@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Tambah Calon Mahasiswa</h2>
                            <p class="mb-3 opacity-75">Input data calon mahasiswa baru</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.calon-mahasiswa.index') }}" class="btn btn-light btn-lg rounded-pill px-4">
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

                    <form action="{{ route('admin.calon-mahasiswa.store') }}" method="POST">
                        @csrf

                        <!-- Data Akun (WAJIB) -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-user-circle me-2"></i>
                                    Data Akun <span class="text-warning"></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                               name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                               name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                                        <select class="form-select @error('program_studi_id') is-invalid @enderror" 
                                                name="program_studi_id" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach($programStudi as $prodi)
                                                <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>
                                                    {{ $prodi->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('program_studi_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pribadi (OPSIONAL) -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-id-card me-2"></i>
                                    Data Pribadi <span class="text-light"></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">NIK</label>
                                        <input type="text" class="form-control" 
                                               name="nik" value="{{ old('nik') }}" 
                                               placeholder="16 digit NIK" maxlength="16">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tempat Lahir</label>
                                        <input type="text" class="form-control" 
                                               name="tempat_lahir" value="{{ old('tempat_lahir') }}" 
                                               placeholder="Kota lahir">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                        <input type="date" class="form-control" 
                                               name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin">
                                            <option value="" selected>-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Agama</label>
                                        <select class="form-select" name="agama">
                                            <option value="" selected>-- Pilih --</option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">No. HP</label>
                                        <input type="text" class="form-control" 
                                               name="no_hp" value="{{ old('no_hp') }}" 
                                               placeholder="081234567890">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Email Pribadi</label>
                                        <input type="email" class="form-control" 
                                               name="email_pribadi" value="{{ old('email_pribadi') }}" 
                                               placeholder="contoh@email.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat (OPSIONAL) -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    Alamat <span class="text-light"></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="2">{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Provinsi</label>
                                        <input type="text" class="form-control" 
                                               name="provinsi" value="{{ old('provinsi') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Kota/Kabupaten</label>
                                        <input type="text" class="form-control" 
                                               name="kota" value="{{ old('kota') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Kode Pos</label>
                                        <input type="text" class="form-control" 
                                               name="kode_pos" value="{{ old('kode_pos') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pendidikan (OPSIONAL) -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-graduation-cap me-2"></i>
                                    Pendidikan <span class="text-light"></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Asal Sekolah</label>
                                        <input type="text" class="form-control" 
                                               name="asal_sekolah" value="{{ old('asal_sekolah') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tahun Lulus</label>
                                        <select class="form-select" name="tahun_lulus">
                                            <option value="" selected>-- Tahun Lulus --</option>
                                            @for($year = date('Y'); $year >= 2000; $year--)
                                                <option value="{{ $year }}" {{ old('tahun_lulus') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orang Tua (OPSIONAL) -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-users me-2"></i>
                                    Data Orang Tua <span class="text-light">(Opsional)</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Nama Orang Tua</label>
                                        <input type="text" class="form-control" 
                                               name="nama_ortu" value="{{ old('nama_ortu') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Pekerjaan Orang Tua</label>
                                        <input type="text" class="form-control" 
                                               name="pekerjaan_ortu" value="{{ old('pekerjaan_ortu') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">No. HP Orang Tua</label>
                                        <input type="text" class="form-control" 
                                               name="no_hp_ortu" value="{{ old('no_hp_ortu') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="{{ route('admin.calon-mahasiswa.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.form-label {
    font-weight: 500;
    color: #344767;
}
.form-control, .form-select {
    border: 1px solid #dee2e6;
    padding: 0.6rem 1rem;
}
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
}
.card-header {
    font-weight: 600;
}
</style>
@endsection