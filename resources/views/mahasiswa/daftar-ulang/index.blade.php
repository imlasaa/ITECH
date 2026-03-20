@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-daftar-ulang text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Daftar Ulang Mahasiswa Baru</h2>
                            <p class="mb-3 opacity-75">Lengkapi berkas dan pembayaran untuk menjadi mahasiswa aktif ITECH</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Nomor Tes</small>
                                    <span class="fw-bold fs-6">{{ $nomorTes ?? '-' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">{{ $programStudi ?? '-' }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Status</small>
                                    <span class="fw-bold fs-6">LULUS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-file-upload fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ALERT PENOLAKAN (Jika Ditolak) -->
@if($daftarUlang && $daftarUlang->status_berkas == 'ditolak')
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 rounded-4 p-4">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-times-circle fa-2x text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-danger mb-2">Daftar Ulang Ditolak</h5>
                    <p class="mb-2">Mohon maaf, berkas daftar ulang Anda ditolak dengan alasan:</p>
                    <div class="bg-white rounded-3 p-3 mb-3">
                        <i class="fas fa-quote-left text-secondary me-2"></i>
                        <span class="text-dark">{{ $daftarUlang->catatan_berkas ?? 'Tidak ada alasan yang diberikan' }}</span>
                    </div>
                    <p class="mb-0 text-secondary">
                        <i class="fas fa-info-circle me-2"></i>
                        Silakan perbaiki berkas sesuai alasan di atas, lalu upload ulang.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- ALERT PEMBAYARAN DITOLAK (Jika Pembayaran Ditolak) -->
@if($pembayaran && $pembayaran->status == 'ditolak')
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-danger border-0 bg-danger bg-opacity-10 rounded-4 p-4">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-credit-card fa-2x text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-danger mb-2">Pembayaran Ditolak</h5>
                    <p class="mb-2">Pembayaran Anda ditolak. Silakan upload ulang bukti transfer yang valid.</p>
                    <p class="mb-0 text-secondary">
                        <i class="fas fa-info-circle me-2"></i>
                        Pastikan bukti transfer jelas dan sesuai dengan nominal yang ditentukan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- ALERT BERKAS DITERIMA (Jika Diterima dan Belum Generate NIM) -->
@if($daftarUlang && $daftarUlang->status_berkas == 'diterima' && !$mahasiswaAktif)
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-success border-0 bg-success bg-opacity-10 rounded-4 p-4">
            <div class="d-flex">
                <div class="me-3">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold text-success mb-2">Berkas Diterima</h5>
                    <p class="mb-0">Berkas Anda telah diterima. Menunggu verifikasi pembayaran.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    <!-- Info Penting -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning border-0 bg-warning bg-opacity-10 rounded-4 p-4">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-warning mb-2">Informasi Penting</h5>
                        <p class="mb-0 text-secondary">Batas akhir daftar ulang: <strong>30 April 2026</strong>. Semua upload bersifat opsional, namun disarankan untuk melengkapi agar proses verifikasi lebih cepat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Status -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-chart-line text-primary me-2"></i>
                        Status Kelengkapan
                    </h5>
                    <div class="row g-4">
                        @php
                            $uploadedCount = 0;
                            if($daftarUlang) {
                                if($daftarUlang->surat_pernyataan) $uploadedCount++;
                                if($daftarUlang->pas_foto) $uploadedCount++;
                                if($daftarUlang->surat_keterangan_sehat) $uploadedCount++;
                                if($daftarUlang->kartu_keluarga) $uploadedCount++;
                            }
                        @endphp
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-file-pdf fa-2x text-warning"></i>
                                    </div>
                                    <div class="position-absolute top-0 end-0">
                                        <span class="badge {{ $uploadedCount == 4 ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                            {{ $uploadedCount }}/4
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Berkas</h6>
                                    <small class="text-secondary">{{ $uploadedCount == 0 ? 'Belum ada upload' : ($uploadedCount == 4 ? 'Lengkap' : $uploadedCount.' file') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-credit-card fa-2x text-info"></i>
                                    </div>
                                    <div class="position-absolute top-0 end-0">
                                        <span class="badge {{ $pembayaran ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                            {{ $pembayaran ? '1/1' : '0/1' }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Pembayaran</h6>
                                    <small class="text-secondary">{{ $pembayaran ? 'Sudah upload' : 'Belum upload' }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Verifikasi Berkas</h6>
                                    <small class="text-secondary">
                                        @if($daftarUlang)
                                            @if($daftarUlang->status_berkas == 'diterima')
                                                <span class="text-success">Diterima</span>
                                            @elseif($daftarUlang->status_berkas == 'ditolak')
                                                <span class="text-danger">Ditolak</span>
                                            @else
                                                <span class="text-warning">Pending</span>
                                            @endif
                                        @else
                                            <span class="text-secondary">Belum upload</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Verifikasi Bayar</h6>
                                    <small class="text-secondary">
                                        @if($pembayaran)
                                            @if($pembayaran->status == 'diterima')
                                                <span class="text-success">Diterima</span>
                                            @elseif($pembayaran->status == 'ditolak')
                                                <span class="text-danger">Ditolak</span>
                                            @else
                                                <span class="text-warning">Pending</span>
                                            @endif
                                        @else
                                            <span class="text-secondary">Belum bayar</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Upload Berkas -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">
                        <i class="fas fa-upload text-primary me-2"></i>
                        Upload Berkas
                    </h4>
                    <p class="text-secondary small mb-0 mt-1">Semua upload bersifat opsional (tidak wajib)</p>
                </div>
                <div class="card-body p-4">
                    <form id="formBerkas" enctype="multipart/form-data">
                        @csrf

                        <!-- Surat Pernyataan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                Surat Pernyataan
                                <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">Opsional</span>
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" id="uploadSurat">
                                <input type="file" class="d-none" id="fileSurat" name="surat_pernyataan" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview -->
                                <div class="preview-area mt-3 {{ $daftarUlang && $daftarUlang->surat_pernyataan ? '' : 'd-none' }}" id="previewSurat">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">
                                                    {{ $daftarUlang && $daftarUlang->surat_pernyataan ? basename($daftarUlang->surat_pernyataan) : 'surat_pernyataan.pdf' }}
                                                </p>
                                                <small class="text-secondary file-size">
                                                    @if($daftarUlang && $daftarUlang->surat_pernyataan)
                                                        File sudah diupload
                                                    @else
                                                        0 KB
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        @if($daftarUlang && $daftarUlang->surat_pernyataan)
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-for="surat">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pas Foto -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-camera text-primary me-2"></i>
                                Pas Foto 3x4
                                <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">Opsional</span>
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" id="uploadPasFoto">
                                <input type="file" class="d-none" id="filePasFoto" name="pas_foto" accept=".jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview -->
                                <div class="preview-area mt-3 {{ $daftarUlang && $daftarUlang->pas_foto ? '' : 'd-none' }}" id="previewPasFoto">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-image text-primary fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">
                                                    {{ $daftarUlang && $daftarUlang->pas_foto ? basename($daftarUlang->pas_foto) : 'pas_foto.jpg' }}
                                                </p>
                                                <small class="text-secondary file-size">
                                                    @if($daftarUlang && $daftarUlang->pas_foto)
                                                        File sudah diupload
                                                    @else
                                                        0 KB
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        @if($daftarUlang && $daftarUlang->pas_foto)
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-for="pas_foto">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Surat Sehat -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-heartbeat text-success me-2"></i>
                                Surat Keterangan Sehat
                                <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">Opsional</span>
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" id="uploadSehat">
                                <input type="file" class="d-none" id="fileSehat" name="surat_keterangan_sehat" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview -->
                                <div class="preview-area mt-3 {{ $daftarUlang && $daftarUlang->surat_keterangan_sehat ? '' : 'd-none' }}" id="previewSehat">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">
                                                    {{ $daftarUlang && $daftarUlang->surat_keterangan_sehat ? basename($daftarUlang->surat_keterangan_sehat) : 'surat_sehat.pdf' }}
                                                </p>
                                                <small class="text-secondary file-size">
                                                    @if($daftarUlang && $daftarUlang->surat_keterangan_sehat)
                                                        File sudah diupload
                                                    @else
                                                        0 KB
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        @if($daftarUlang && $daftarUlang->surat_keterangan_sehat)
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-for="surat_keterangan_sehat">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kartu Keluarga -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-users text-info me-2"></i>
                                Kartu Keluarga
                                <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">Opsional</span>
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" id="uploadKK">
                                <input type="file" class="d-none" id="fileKK" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview -->
                                <div class="preview-area mt-3 {{ $daftarUlang && $daftarUlang->kartu_keluarga ? '' : 'd-none' }}" id="previewKK">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">
                                                    {{ $daftarUlang && $daftarUlang->kartu_keluarga ? basename($daftarUlang->kartu_keluarga) : 'kartu_keluarga.pdf' }}
                                                </p>
                                                <small class="text-secondary file-size">
                                                    @if($daftarUlang && $daftarUlang->kartu_keluarga)
                                                        File sudah diupload
                                                    @else
                                                        0 KB
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        @if($daftarUlang && $daftarUlang->kartu_keluarga)
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-for="kartu_keluarga">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="button" class="btn btn-primary btn-lg rounded-pill py-3 fw-semibold" id="simpanBerkas">
                                <i class="fas fa-save me-2"></i>SIMPAN BERKAS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pembayaran -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">
                        <i class="fas fa-credit-card text-success me-2"></i>
                        Pembayaran
                    </h4>
                    <p class="text-secondary small mb-0 mt-1">Jumlah pembayaran fixed Rp 500.000</p>
                </div>
                <div class="card-body p-4">
                    <!-- Info Biaya -->
                    <div class="bg-light rounded-4 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-semibold">Biaya Daftar Ulang</span>
                            <span class="fs-3 fw-bold text-primary">Rp 500.000</span>
                        </div>
                        <div class="alert alert-info border-0 bg-info bg-opacity-10 p-3 mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Nominal sudah termasuk biaya administrasi dan formulir</small>
                        </div>
                    </div>

                    <form id="formPembayaran" enctype="multipart/form-data">
                        @csrf

                        <!-- Metode Pembayaran -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="metode" name="metode_pembayaran" required>
                                <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>
                                <option value="Transfer Bank BNI" {{ $pembayaran && $pembayaran->metode_pembayaran == 'Transfer Bank BNI' ? 'selected' : '' }}>Transfer Bank BNI</option>
                                <option value="Transfer Bank BRI" {{ $pembayaran && $pembayaran->metode_pembayaran == 'Transfer Bank BRI' ? 'selected' : '' }}>Transfer Bank BRI</option>
                                <option value="Transfer Bank Mandiri" {{ $pembayaran && $pembayaran->metode_pembayaran == 'Transfer Bank Mandiri' ? 'selected' : '' }}>Transfer Bank Mandiri</option>
                                <option value="Virtual Account" {{ $pembayaran && $pembayaran->metode_pembayaran == 'Virtual Account' ? 'selected' : '' }}>Virtual Account</option>
                            </select>
                        </div>

                        <!-- Nama Pengirim -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Pengirim <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-user text-success"></i></span>
                                <input type="text" class="form-control form-control-lg" id="nama_pengirim" name="nama_pengirim" 
                                       value="{{ old('nama_pengirim', $pembayaran->nama_pengirim ?? $nama ?? '') }}" 
                                       placeholder="Nama sesuai rekening" required>
                            </div>
                        </div>

                        <!-- Tanggal Transfer -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tanggal Transfer <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-calendar text-success"></i></span>
                                <input type="date" class="form-control form-control-lg" id="tanggal" name="tanggal_transfer" 
                                       value="{{ old('tanggal_transfer', $pembayaran->tanggal_transfer ?? date('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-receipt text-warning me-2"></i>
                                Upload Bukti Transfer
                                <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">Opsional</span>
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center" id="uploadBukti">
                                <input type="file" class="d-none" id="fileBukti" name="bukti_transfer" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-warning mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview -->
                                <div class="preview-area mt-3 {{ $pembayaran && $pembayaran->bukti_transfer ? '' : 'd-none' }}" id="previewBukti">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-image text-primary fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">
                                                    {{ $pembayaran && $pembayaran->bukti_transfer ? basename($pembayaran->bukti_transfer) : 'bukti_transfer.jpg' }}
                                                </p>
                                                <small class="text-secondary file-size">
                                                    @if($pembayaran && $pembayaran->bukti_transfer)
                                                        File sudah diupload
                                                    @else
                                                        0 KB
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        @if($pembayaran && $pembayaran->bukti_transfer)
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file" data-for="bukti">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="3" id="catatan" name="catatan" placeholder="Tambahkan catatan jika perlu">{{ old('catatan', $pembayaran->catatan ?? '') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="button" class="btn btn-success btn-lg rounded-pill py-3 fw-semibold" id="simpanPembayaran">
                                <i class="fas fa-save me-2"></i>SIMPAN PEMBAYARAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Status -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-history text-primary me-2"></i>
                        Riwayat Status Verifikasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3">Waktu</th>
                                    <th class="py-3">Tipe</th>
                                    <th class="py-3">Keterangan</th>
                                    <th class="py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($daftarUlang && $daftarUlang->created_at)
                                <tr>
                                    <td>{{ $daftarUlang->created_at->format('d F Y, H:i') }}</td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                            <i class="fas fa-file-pdf me-1"></i>Berkas
                                        </span>
                                    </td>
                                    <td>Berkas daftar ulang diupload</td>
                                    <td>
                                        @if($daftarUlang->status_berkas == 'diterima')
                                            <span class="badge bg-success px-3 py-2">Diterima</span>
                                        @elseif($daftarUlang->status_berkas == 'ditolak')
                                            <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                
                                @if($pembayaran && $pembayaran->created_at)
                                <tr>
                                    <td>{{ $pembayaran->created_at->format('d F Y, H:i') }}</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            <i class="fas fa-credit-card me-1"></i>Pembayaran
                                        </span>
                                    </td>
                                    <td>Pembayaran Rp 500.000 via {{ $pembayaran->metode_pembayaran ?? '-' }} a.n {{ $pembayaran->nama_pengirim ?? '-' }}</td>
                                    <td>
                                        @if($pembayaran->status == 'diterima')
                                            <span class="badge bg-success px-3 py-2">Diterima</span>
                                        @elseif($pembayaran->status == 'ditolak')
                                            <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                
                                @if(!$daftarUlang && !$pembayaran)
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-secondary">
                                        <i class="fas fa-info-circle me-2"></i>Belum ada riwayat
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panduan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 bg-light rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Panduan Daftar Ulang
                    </h5>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex">
                                <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">1</span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Upload Berkas</h6>
                                    <small class="text-secondary">Siapkan dokumen dalam format PDF/JPG/PNG (maks 2MB)</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">2</span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Lakukan Pembayaran</h6>
                                    <small class="text-secondary">Transfer Rp 500.000 ke rekening ITECH</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">3</span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Upload Bukti</h6>
                                    <small class="text-secondary">Upload bukti transfer untuk verifikasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <span class="badge bg-primary rounded-circle me-3" style="width: 24px; height: 24px;">4</span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Tunggu Verifikasi</h6>
                                    <small class="text-secondary">Admin akan memverifikasi 1x24 jam</small>
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
.bg-gradient-daftar-ulang {
    background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
}

.border-dashed {
    border-style: dashed !important;
    border-color: #dee2e6 !important;
    transition: all 0.3s ease;
}

.upload-area {
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9fa;
}

.preview-area {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk handle upload
    function setupUpload(triggerId, fileId, previewId, fieldName) {
        const trigger = document.getElementById(triggerId);
        const fileInput = document.getElementById(fileId);
        const preview = document.getElementById(previewId);
        
        if (!trigger || !fileInput || !preview) return;
        
        trigger.addEventListener('click', function() {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const fileName = preview.querySelector('.file-name');
                const fileSize = preview.querySelector('.file-size');
                
                if (fileName) fileName.textContent = file.name;
                if (fileSize) fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                
                preview.classList.remove('d-none');
                updateProgress();
            }
        });
        
        // Remove file
        const removeBtn = preview.querySelector('.remove-file');
        if (removeBtn) {
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                preview.classList.add('d-none');
                updateProgress();
            });
        }
    }
    
    // Setup semua upload area
    setupUpload('uploadSurat', 'fileSurat', 'previewSurat', 'surat_pernyataan');
    setupUpload('uploadPasFoto', 'filePasFoto', 'previewPasFoto', 'pas_foto');
    setupUpload('uploadSehat', 'fileSehat', 'previewSehat', 'surat_keterangan_sehat');
    setupUpload('uploadKK', 'fileKK', 'previewKK', 'kartu_keluarga');
    setupUpload('uploadBukti', 'fileBukti', 'previewBukti', 'bukti');
    
    // Update progress
    function updateProgress() {
        const totalBerkas = 4;
        let uploadedBerkas = 0;
        
        const previews = ['previewSurat', 'previewPasFoto', 'previewSehat', 'previewKK'];
        previews.forEach(id => {
            const el = document.getElementById(id);
            if (el && !el.classList.contains('d-none')) {
                uploadedBerkas++;
            }
        });
        
        // Update badge
        const badge = document.querySelector('.badge.bg-secondary, .badge.bg-success');
        if (badge) {
            badge.textContent = `${uploadedBerkas}/${totalBerkas}`;
            if (uploadedBerkas === totalBerkas) {
                badge.classList.remove('bg-secondary');
                badge.classList.add('bg-success');
            } else {
                badge.classList.remove('bg-success');
                badge.classList.add('bg-secondary');
            }
        }
        
        // Update status pembayaran
        const buktiPreview = document.getElementById('previewBukti');
        const bayarBadge = document.querySelectorAll('.badge.bg-secondary, .badge.bg-success')[1];
        if (bayarBadge && buktiPreview) {
            if (!buktiPreview.classList.contains('d-none')) {
                bayarBadge.textContent = '1/1';
                bayarBadge.classList.remove('bg-secondary');
                bayarBadge.classList.add('bg-success');
            } else {
                bayarBadge.textContent = '0/1';
                bayarBadge.classList.remove('bg-success');
                bayarBadge.classList.add('bg-secondary');
            }
        }
    }
    
    // Simpan Berkas
    document.getElementById('simpanBerkas').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('formBerkas'));
        
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch('{{ route("mahasiswa.daftar-ulang.berkas") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan',
                });
            }
        });
    });
    
    // Simpan Pembayaran
    document.getElementById('simpanPembayaran').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('formPembayaran'));
        
        // Validasi sederhana
        const metode = document.getElementById('metode').value;
        const nama = document.getElementById('nama_pengirim').value;
        const tanggal = document.getElementById('tanggal').value;
        
        if (!metode || !nama || !tanggal) {
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                text: 'Harap isi semua field yang wajib!'
            });
            return;
        }
        
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch('{{ route("mahasiswa.daftar-ulang.pembayaran") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan',
                });
            }
        });
    });
});
</script>
@endsection