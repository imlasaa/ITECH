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
                                    <span class="fw-bold fs-6">ITECH-2025-0001</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Program Studi</small>
                                    <span class="fw-bold fs-6">Teknik Informatika</span>
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
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                        <i class="fas fa-file-pdf fa-2x text-warning"></i>
                                    </div>
                                    <div class="position-absolute top-0 end-0">
                                        <span class="badge bg-secondary rounded-pill">0/4</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Berkas</h6>
                                    <small class="text-secondary">Belum ada upload</small>
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
                                        <span class="badge bg-secondary rounded-pill">0/1</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Pembayaran</h6>
                                    <small class="text-secondary">Belum upload</small>
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
                                    <small class="text-secondary">Pending</small>
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
                                    <small class="text-secondary">Pending</small>
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
                                <input type="file" class="d-none" id="fileSurat" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview (hidden) -->
                                <div class="preview-area mt-3 d-none" id="previewSurat">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">surat_pernyataan.pdf</p>
                                                <small class="text-secondary file-size">245 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
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
                                <input type="file" class="d-none" id="filePasFoto" accept=".jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview (hidden) -->
                                <div class="preview-area mt-3 d-none" id="previewPasFoto">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-image text-primary fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">pas_foto.jpg</p>
                                                <small class="text-secondary file-size">150 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
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
                                <input type="file" class="d-none" id="fileSehat" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview (hidden) -->
                                <div class="preview-area mt-3 d-none" id="previewSehat">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">surat_sehat.pdf</p>
                                                <small class="text-secondary file-size">300 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
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
                                <input type="file" class="d-none" id="fileKK" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview (hidden) -->
                                <div class="preview-area mt-3 d-none" id="previewKK">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">kartu_keluarga.pdf</p>
                                                <small class="text-secondary file-size">400 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
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

                    <form id="formPembayaran">
                        @csrf

                        <!-- Metode Pembayaran -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="metode" required>
                                <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>
                                <option value="bni">Transfer Bank BNI</option>
                                <option value="bri">Transfer Bank BRI</option>
                                <option value="mandiri">Transfer Bank Mandiri</option>
                                <option value="va">Virtual Account</option>
                            </select>
                        </div>

                        <!-- Nama Pengirim -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Pengirim <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-user text-success"></i></span>
                                <input type="text" class="form-control form-control-lg" id="nama_pengirim" 
                                       placeholder="Nama sesuai rekening" required>
                            </div>
                        </div>

                        <!-- Tanggal Transfer -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tanggal Transfer <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-calendar text-success"></i></span>
                                <input type="date" class="form-control form-control-lg" id="tanggal" required>
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
                                <input type="file" class="d-none" id="fileBukti" accept=".pdf,.jpg,.jpeg,.png">
                                <i class="fas fa-cloud-upload-alt fa-3x text-warning mb-3"></i>
                                <p class="mb-1 fw-semibold">Klik atau drag file ke sini</p>
                                <small class="text-secondary">Format: PDF, JPG, PNG (Max 2MB)</small>
                                
                                <!-- Preview (hidden) -->
                                <div class="preview-area mt-3 d-none" id="previewBukti">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-image text-primary fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">bukti_transfer.jpg</p>
                                                <small class="text-secondary file-size">200 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="3" id="catatan" placeholder="Tambahkan catatan jika perlu"></textarea>
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
                                <tr>
                                    <td>5 April 2026, 14:30</td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                            <i class="fas fa-file-pdf me-1"></i>Berkas
                                        </span>
                                    </td>
                                    <td>Surat Pernyataan berhasil diupload</td>
                                    <td><span class="badge bg-warning text-dark px-3 py-2">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>6 April 2026, 09:15</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            <i class="fas fa-credit-card me-1"></i>Pembayaran
                                        </span>
                                    </td>
                                    <td>Pembayaran Rp 500.000 via BNI a.n Budi Santoso</td>
                                    <td><span class="badge bg-warning text-dark px-3 py-2">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>7 April 2026, 10:00</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Sistem
                                        </span>
                                    </td>
                                    <td>Menunggu verifikasi admin</td>
                                    <td><span class="badge bg-info text-white px-3 py-2">Diproses</span></td>
                                </tr>
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

/* Responsive */
@media (max-width: 768px) {
    .upload-area {
        padding: 1.5rem !important;
    }
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk handle upload
    function setupUpload(triggerId, fileId, previewId) {
        const trigger = document.getElementById(triggerId);
        const fileInput = document.getElementById(fileId);
        const preview = document.getElementById(previewId);
        
        trigger.addEventListener('click', function() {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const fileName = preview.querySelector('.file-name');
                const fileSize = preview.querySelector('.file-size');
                
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
                
                preview.classList.remove('d-none');
                
                // Update status progress
                updateProgress();
            }
        });
        
        // Remove file
        preview.querySelector('.remove-file').addEventListener('click', function() {
            fileInput.value = '';
            preview.classList.add('d-none');
            updateProgress();
        });
    }
    
    // Setup semua upload area
    setupUpload('uploadSurat', 'fileSurat', 'previewSurat');
    setupUpload('uploadPasFoto', 'filePasFoto', 'previewPasFoto');
    setupUpload('uploadSehat', 'fileSehat', 'previewSehat');
    setupUpload('uploadKK', 'fileKK', 'previewKK');
    setupUpload('uploadBukti', 'fileBukti', 'previewBukti');
    
    // Update progress
    function updateProgress() {
        const totalBerkas = 4;
        let uploadedBerkas = 0;
        
        const previews = ['previewSurat', 'previewPasFoto', 'previewSehat', 'previewKK'];
        previews.forEach(id => {
            if (!document.getElementById(id).classList.contains('d-none')) {
                uploadedBerkas++;
            }
        });
        
        // Update badge
        document.querySelector('.badge.bg-secondary:first-child').textContent = 
            `${uploadedBerkas}/${totalBerkas}`;
        
        // Update status pembayaran
        const buktiPreview = document.getElementById('previewBukti');
        if (!buktiPreview.classList.contains('d-none')) {
            document.querySelectorAll('.badge.bg-secondary')[1].textContent = '1/1';
        }
    }
    
    // Simpan Berkas
    document.getElementById('simpanBerkas').addEventListener('click', function() {
        // Simulasi simpan
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>MENYIMPAN...';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check me-2"></i>BERHASIL DISIMPAN';
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');
            
            // Tampilkan notifikasi
            alert('Berkas berhasil disimpan!');
        }, 1500);
    });
    
    // Simpan Pembayaran
    document.getElementById('simpanPembayaran').addEventListener('click', function() {
        // Validasi sederhana
        const metode = document.getElementById('metode').value;
        const nama = document.getElementById('nama_pengirim').value;
        const tanggal = document.getElementById('tanggal').value;
        
        if (!metode || !nama || !tanggal) {
            alert('Harap isi semua field yang wajib!');
            return;
        }
        
        // Simulasi simpan
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>MENYIMPAN...';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check me-2"></i>BERHASIL DISIMPAN';
            this.classList.remove('btn-success');
            this.classList.add('btn-info');
            
            // Tampilkan notifikasi
            alert('Data pembayaran berhasil disimpan!');
        }, 1500);
    });
    
    // Drag and drop (sederhana)
    const dropZones = document.querySelectorAll('.upload-area');
    
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.style.backgroundColor = '#e7f1ff';
        });
        
        zone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            zone.style.backgroundColor = '';
        });
        
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.style.backgroundColor = '';
            // Logic drop file bisa ditambahkan
        });
    });
});
</script>
@endsection