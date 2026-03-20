@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-info text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Data Pribadi</h2>
                            <p class="mb-3 opacity-75">Lengkapi data diri Anda untuk keperluan administrasi</p>
                            <div class="d-flex gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Nomor Tes</small>
                                    <span class="fw-bold fs-6">{{ $nomorTes ?? '-' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">{{ $user->programStudi->nama_prodi ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-user-edit fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Opsional -->
    <div class="row mb-4">
        <div class="col-12">
         
        </div>
    </div>

    <!-- Form Data Pribadi -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <ul class="nav nav-tabs card-header-tabs" id="dataTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ !$dataPribadi ? 'active' : '' }}" id="pribadi-tab" data-bs-toggle="tab" 
                                    data-bs-target="#pribadi" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Data Pribadi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="alamat-tab" data-bs-toggle="tab" 
                                    data-bs-target="#alamat" type="button" role="tab">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" 
                                    data-bs-target="#pendidikan" type="button" role="tab">
                                <i class="fas fa-graduation-cap me-2"></i>Pendidikan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ortu-tab" data-bs-toggle="tab" 
                                    data-bs-target="#ortu" type="button" role="tab">
                                <i class="fas fa-users me-2"></i>Orang Tua
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <!-- TAMPILKAN ERROR & SUCCESS -->
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

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ $dataPribadi ? route('mahasiswa.data-pribadi.update') : route('mahasiswa.data-pribadi.store') }}" 
                          enctype="multipart/form-data" novalidate>
                        @csrf
                        @if($dataPribadi)
                            @method('PUT')
                        @endif

                        <!-- Tab Content -->
                        <div class="tab-content" id="dataTabsContent">
                            
                            <!-- TAB 1: DATA PRIBADI -->
                            <div class="tab-pane fade show active" id="pribadi" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">NIK</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-id-card text-primary"></i></span>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                                   name="nik" value="{{ old('nik', $dataPribadi->nik ?? '') }}" 
                                                   placeholder="16 digit NIK" maxlength="16">
                                        </div>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                                   name="nama_lengkap" value="{{ old('nama_lengkap', $dataPribadi->nama_lengkap ?? '') }}" 
                                                   placeholder="Sesuai Ijazah">
                                        </div>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tempat Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-map-pin text-primary"></i></span>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                                   name="tempat_lahir" value="{{ old('tempat_lahir', $dataPribadi->tempat_lahir ?? '') }}" 
                                                   placeholder="Kota lahir">
                                        </div>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-calendar text-primary"></i></span>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                                   name="tanggal_lahir" value="{{ old('tanggal_lahir', $dataPribadi->tanggal_lahir ?? '') }}">
                                        </div>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-venus-mars text-primary"></i></span>
                                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                                    name="jenis_kelamin">
                                                <option value="" selected>-- Pilih --</option>
                                                <option value="L" {{ old('jenis_kelamin', $dataPribadi->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $dataPribadi->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Agama</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-pray text-primary"></i></span>
                                            <select class="form-select @error('agama') is-invalid @enderror" name="agama">
                                                <option value="" selected>-- Pilih --</option>
                                                <option value="Islam" {{ old('agama', $dataPribadi->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $dataPribadi->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $dataPribadi->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $dataPribadi->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $dataPribadi->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ old('agama', $dataPribadi->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">No. HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-phone text-primary"></i></span>
                                            <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" 
                                                   name="no_hp" value="{{ old('no_hp', $dataPribadi->no_hp ?? '') }}" 
                                                   placeholder="081234567890">
                                        </div>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Email Pribadi</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                                            <input type="email" class="form-control @error('email_pribadi') is-invalid @enderror" 
                                                   name="email_pribadi" value="{{ old('email_pribadi', $dataPribadi->email_pribadi ?? '') }}" 
                                                   placeholder="contoh@email.com">
                                        </div>
                                        @error('email_pribadi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: ALAMAT -->
                            <div class="tab-pane fade" id="alamat" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  name="alamat" rows="3">{{ old('alamat', $dataPribadi->alamat ?? '') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Provinsi</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-map text-primary"></i></span>
                                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror" 
                                                   name="provinsi" value="{{ old('provinsi', $dataPribadi->provinsi ?? '') }}">
                                        </div>
                                        @error('provinsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Kota/Kabupaten</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-city text-primary"></i></span>
                                            <input type="text" class="form-control @error('kota') is-invalid @enderror" 
                                                   name="kota" value="{{ old('kota', $dataPribadi->kota ?? '') }}">
                                        </div>
                                        @error('kota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Kode Pos</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-mail-bulk text-primary"></i></span>
                                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                                   name="kode_pos" value="{{ old('kode_pos', $dataPribadi->kode_pos ?? '') }}">
                                        </div>
                                        @error('kode_pos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: PENDIDIKAN -->
                            <div class="tab-pane fade" id="pendidikan" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Asal Sekolah</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-school text-primary"></i></span>
                                            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                                   name="asal_sekolah" value="{{ old('asal_sekolah', $dataPribadi->asal_sekolah ?? '') }}">
                                        </div>
                                        @error('asal_sekolah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tahun Lulus</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-primary"></i></span>
                                            <select class="form-select @error('tahun_lulus') is-invalid @enderror" 
                                                    name="tahun_lulus">
                                                <option value="" selected>-- Tahun Lulus --</option>
                                                @for($year = date('Y'); $year >= 2000; $year--)
                                                    <option value="{{ $year }}" 
                                                        {{ old('tahun_lulus', $dataPribadi->tahun_lulus ?? '') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        @error('tahun_lulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-info d-flex align-items-center" role="alert">
                                            <i class="fas fa-info-circle fa-2x me-3"></i>
                                            <div>
                                                <strong>Program Studi Pilihan Anda:</strong> {{ $user->programStudi->nama_prodi ?? '-' }}
                                                <br>
                                                <small>Tidak dapat diubah setelah registrasi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: ORANG TUA -->
                            <div class="tab-pane fade" id="ortu" role="tabpanel">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Nama Orang Tua/Wali</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-user-tie text-primary"></i></span>
                                            <input type="text" class="form-control @error('nama_ortu') is-invalid @enderror" 
                                                   name="nama_ortu" value="{{ old('nama_ortu', $dataPribadi->nama_ortu ?? '') }}">
                                        </div>
                                        @error('nama_ortu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Pekerjaan Orang Tua</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-briefcase text-primary"></i></span>
                                            <input type="text" class="form-control @error('pekerjaan_ortu') is-invalid @enderror" 
                                                   name="pekerjaan_ortu" value="{{ old('pekerjaan_ortu', $dataPribadi->pekerjaan_ortu ?? '') }}">
                                        </div>
                                        @error('pekerjaan_ortu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">No. HP Orang Tua</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-phone-alt text-primary"></i></span>
                                            <input type="tel" class="form-control @error('no_hp_ortu') is-invalid @enderror" 
                                                   name="no_hp_ortu" value="{{ old('no_hp_ortu', $dataPribadi->no_hp_ortu ?? '') }}">
                                        </div>
                                        @error('no_hp_ortu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                            <div>
                                                <strong>Data orang tua/wali</strong> akan digunakan untuk kontak darurat.
                                                Pastikan nomor HP yang diisi aktif.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-between">
                                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-5 py-2">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold">
                                    <i class="fas fa-save me-2"></i>{{ $dataPribadi ? 'Update Data' : 'Simpan Data' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Panduan Pengisian -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 bg-light rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Panduan Pengisian Data Pribadi
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">1</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Data Pribadi</h6>
                                    <small class="text-secondary">Isi NIK, nama lengkap, tempat/tanggal lahir sesuai dokumen resmi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">2</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Alamat</h6>
                                    <small class="text-secondary">Isi alamat lengkap dan pastikan kode pos benar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">3</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Pendidikan</h6>
                                    <small class="text-secondary">Sesuaikan asal sekolah dan tahun lulus dengan ijazah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <span class="badge bg-primary rounded-circle p-2">4</span>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Orang Tua</h6>
                                    <small class="text-secondary">Data orang tua untuk kontak darurat</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
.bg-gradient-info {
    background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
}
.nav-tabs .nav-link {
    color: #6c757d;
    font-weight: 500;
    border: none;
    padding: 0.75rem 1.5rem;
    margin-right: 0.5rem;
    border-radius: 50px;
}
.nav-tabs .nav-link:hover {
    border: none;
    color: #0d6efd;
    background-color: #e7f1ff;
}
.nav-tabs .nav-link.active {
    color: #0d6efd !important;
    background-color: #e7f1ff !important;
    border: none !important;
    font-weight: 600 !important;
}
.form-label {
    margin-bottom: 0.5rem;
    color: #344767;
}
.input-group-text {
    border: none;
    border-radius: 10px 0 0 10px;
}
.form-control, .form-select {
    border: 1px solid #dee2e6;
    border-radius: 0 10px 10px 0;
    padding: 0.75rem 1rem;
}
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}
@media (max-width: 768px) {
    .nav-tabs .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}
</style>
@endsection