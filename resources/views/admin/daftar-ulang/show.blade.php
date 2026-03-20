@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-daftarulang text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Detail Daftar Ulang</h2>
                            <p class="mb-3 opacity-75">Informasi lengkap berkas dan pembayaran mahasiswa</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.daftar-ulang.index') }}" class="btn btn-light btn-lg rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Info Mahasiswa -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3">
                            <i class="fas fa-user-graduate fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mt-3">{{ $user->nama_lengkap }}</h4>
                        <p class="text-secondary mb-1">{{ $user->nomorTes->nomor_tes ?? '-' }}</p>
                        <p class="text-secondary">{{ $user->programStudi->nama_prodi ?? '-' }}</p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">Status Berkas</span>
                        @if($user->daftarUlang)
                            @if($user->daftarUlang->status_berkas == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($user->daftarUlang->status_berkas == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        @else
                            <span class="badge bg-secondary">Belum Upload</span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">Status Pembayaran</span>
                        @if($user->pembayaran)
                            @if($user->pembayaran->status == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($user->pembayaran->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        @else
                            <span class="badge bg-secondary">Belum Bayar</span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Mahasiswa Aktif</span>
                        @if($user->mahasiswaAktif)
                            <span class="badge bg-success">Aktif ({{ $user->mahasiswaAktif->nim }})</span>
                        @else
                            <span class="badge bg-secondary">Belum</span>
                        @endif
                    </div>

                    <hr>

                    @if(!$user->mahasiswaAktif)
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-success" onclick="accept({{ $user->id }})">
                                <i class="fas fa-id-card me-2"></i>Terima & Generate NIM
                            </button>
                            @if($user->daftarUlang || $user->pembayaran)
                                <button class="btn btn-danger" onclick="reject({{ $user->id }})">
                                    <i class="fas fa-times me-2"></i>Tolak
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detail Berkas & Pembayaran -->
        <div class="col-md-8 mb-4">
            <!-- Berkas -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-file-pdf text-primary me-2"></i>
                        Berkas yang Diupload
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($user->daftarUlang)
                        <div class="row g-3">
                            <!-- Surat Pernyataan -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded-3">
                                    <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="fw-semibold mb-0">Surat Pernyataan</p>
                                        @if($user->daftarUlang->surat_pernyataan)
                                            <small class="text-secondary">Tersedia</small>
                                        @else
                                            <small class="text-secondary text-danger">Tidak diupload</small>
                                        @endif
                                    </div>
                                    @if($user->daftarUlang->surat_pernyataan)
                                        <a href="{{ route('admin.daftar-ulang.download', ['type' => 'surat', 'id' => $user->id]) }}" 
                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Pas Foto -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded-3">
                                    <i class="fas fa-image text-primary fa-2x me-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="fw-semibold mb-0">Pas Foto</p>
                                        @if($user->daftarUlang->pas_foto)
                                            <small class="text-secondary">Tersedia</small>
                                        @else
                                            <small class="text-secondary text-danger">Tidak diupload</small>
                                        @endif
                                    </div>
                                    @if($user->daftarUlang->pas_foto)
                                        <a href="{{ route('admin.daftar-ulang.download', ['type' => 'foto', 'id' => $user->id]) }}" 
                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Surat Sehat -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded-3">
                                    <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="fw-semibold mb-0">Surat Sehat</p>
                                        @if($user->daftarUlang->surat_keterangan_sehat)
                                            <small class="text-secondary">Tersedia</small>
                                        @else
                                            <small class="text-secondary text-danger">Tidak diupload</small>
                                        @endif
                                    </div>
                                    @if($user->daftarUlang->surat_keterangan_sehat)
                                        <a href="{{ route('admin.daftar-ulang.download', ['type' => 'sehat', 'id' => $user->id]) }}" 
                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Kartu Keluarga -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded-3">
                                    <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="fw-semibold mb-0">Kartu Keluarga</p>
                                        @if($user->daftarUlang->kartu_keluarga)
                                            <small class="text-secondary">Tersedia</small>
                                        @else
                                            <small class="text-secondary text-danger">Tidak diupload</small>
                                        @endif
                                    </div>
                                    @if($user->daftarUlang->kartu_keluarga)
                                        <a href="{{ route('admin.daftar-ulang.download', ['type' => 'kk', 'id' => $user->id]) }}" 
                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($user->daftarUlang->catatan_berkas)
                            <div class="alert alert-warning mt-3 mb-0">
                                <strong>Catatan:</strong> {{ $user->daftarUlang->catatan_berkas }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle fa-3x text-warning mb-3"></i>
                            <p class="text-secondary">Belum ada berkas yang diupload</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pembayaran -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-credit-card text-success me-2"></i>
                        Detail Pembayaran
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($user->pembayaran)
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Jumlah</small>
                                    <p class="fw-semibold mb-0">Rp {{ number_format($user->pembayaran->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Metode</small>
                                    <p class="fw-semibold mb-0">{{ $user->pembayaran->metode_pembayaran }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Nama Pengirim</small>
                                    <p class="fw-semibold mb-0">{{ $user->pembayaran->nama_pengirim }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Tanggal Transfer</small>
                                    <p class="fw-semibold mb-0">{{ $user->pembayaran->tanggal_transfer->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bukti Transfer -->
                        <div class="d-flex align-items-center p-3 border rounded-3">
                            <i class="fas fa-image text-primary fa-2x me-3"></i>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0">Bukti Transfer</p>
                                @if($user->pembayaran->bukti_transfer)
                                    <small class="text-secondary">Tersedia</small>
                                @else
                                    <small class="text-secondary text-danger">Tidak diupload</small>
                                @endif
                            </div>
                            @if($user->pembayaran->bukti_transfer)
                                <a href="{{ route('admin.daftar-ulang.download', ['type' => 'bukti', 'id' => $user->id]) }}" 
                                   class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                            @endif
                        </div>

                        @if($user->pembayaran->catatan)
                            <div class="mt-3 p-3 bg-light rounded-3">
                                <small class="text-secondary d-block">Catatan</small>
                                <p class="mb-0">{{ $user->pembayaran->catatan }}</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle fa-3x text-warning mb-3"></i>
                            <p class="text-secondary">Belum ada data pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function accept(id) {
    Swal.fire({
        title: 'Terima & Generate NIM',
        text: 'Apakah Anda yakin ingin menerima daftar ulang dan generate NIM untuk mahasiswa ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Generate NIM'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`/admin/daftar-ulang/${id}/accept`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan koneksi'
                });
            });
        }
    });
}

function reject(id) {
    Swal.fire({
        title: 'Tolak Daftar Ulang',
        html: `
            <input type="text" id="alasan" class="swal2-input" placeholder="Alasan penolakan">
        `,
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tolak',
        preConfirm: () => {
            const alasan = document.getElementById('alasan').value;
            if (!alasan) {
                Swal.showValidationMessage('Alasan penolakan harus diisi');
                return false;
            }
            return { alasan: alasan };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`/admin/daftar-ulang/${id}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ alasan: result.value.alasan })
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
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan koneksi'
                });
            });
        }
    });
}
</script>

<style>
.bg-gradient-daftarulang {
    background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
}
.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection