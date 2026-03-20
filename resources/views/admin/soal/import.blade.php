@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-import text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Import Soal</h2>
                            <p class="mb-3 opacity-75">Import soal ujian dari file Excel</p>
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

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <!-- Template Download -->
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="fas fa-download fa-2x me-3"></i>
                        <div>
                            <strong>Download Template</strong>
                            <p class="mb-0">Gunakan template ini untuk mengisi soal, lalu upload kembali.</p>
                        </div>
                        <a href="#" class="btn btn-info ms-auto rounded-pill">
                            <i class="fas fa-file-excel me-2"></i>Download Template
                        </a>
                    </div>

                    <!-- Form Import -->
                    <form action="{{ route('admin.soal.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih File Excel</label>
                            <div class="upload-area border-2 border-dashed rounded-4 p-5 text-center" id="uploadArea">
                                <input type="file" class="d-none" id="file" name="file" accept=".xlsx,.xls" required>
                                <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                                <h5 class="fw-semibold mb-2">Klik atau drag file ke sini</h5>
                                <p class="text-secondary mb-0">Format: .xlsx, .xls (Maks 2MB)</p>
                                <div class="preview-area mt-3 d-none" id="previewArea">
                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-excel text-success fa-2x me-3"></i>
                                            <div class="text-start">
                                                <p class="fw-semibold mb-0 file-name">soal.xlsx</p>
                                                <small class="text-secondary file-size">245 KB</small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle" id="removeFile">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Petunjuk -->
                        <div class="bg-light rounded-4 p-4 mb-4">
                            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Petunjuk Import</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>File harus berekstensi .xlsx atau .xls</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Gunakan template yang sudah disediakan</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Pastikan semua kolom terisi dengan benar</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kolom kunci jawaban diisi dengan huruf a,b,c,d,e</li>
                                <li><i class="fas fa-check-circle text-success me-2"></i>Maksimal 100 soal per file</li>
                            </ul>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill px-5" id="btnImport">
                                <i class="fas fa-upload me-2"></i>Import Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-import {
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('file');
    const previewArea = document.getElementById('previewArea');
    const fileName = document.querySelector('.file-name');
    const fileSize = document.querySelector('.file-size');
    const removeBtn = document.getElementById('removeFile');

    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
            previewArea.classList.remove('d-none');
        }
    });

    removeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        previewArea.classList.add('d-none');
    });
});
</script>
@endsection