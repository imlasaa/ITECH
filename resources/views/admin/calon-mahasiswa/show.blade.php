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
                            <h2 class="fw-bold mb-2">Detail Calon Mahasiswa</h2>
                            <p class="mb-3 opacity-75">Informasi lengkap calon mahasiswa</p>
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

    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-user-graduate fa-4x text-primary"></i>
                    </div>
                    <h4 class="fw-bold">{{ $user->nama_lengkap }}</h4>
                    <p class="text-secondary mb-2">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="fas fa-id-card me-1"></i>{{ $user->nomorTes->nomor_tes ?? '-' }}
                        </span>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                            {{ $user->programStudi->nama_prodi ?? '-' }}
                        </span>
                    </div>
                    
                    <hr>
                    
                    <div class="text-start mt-3">
                        <h6 class="fw-semibold mb-3">Informasi Akun</h6>
                        <table class="table table-sm">
                            <tr>
                                <td class="text-secondary">Status Ujian</td>
                                <td class="fw-semibold">
                                    @if($user->hasilUjian)
                                        @if($user->hasilUjian->status == 'lulus')
                                            <span class="badge bg-success">Lulus</span>
                                        @elseif($user->hasilUjian->status == 'tidak_lulus')
                                            <span class="badge bg-danger">Tidak Lulus</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Belum Ujian</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Status Daftar Ulang</td>
                                <td class="fw-semibold">
                                    @if($user->mahasiswaAktif)
                                        <span class="badge bg-success">Sudah Daftar Ulang</span>
                                    @elseif($user->daftarUlang)
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-secondary">Belum</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Tanggal Daftar</td>
                                <td class="fw-semibold">{{ $user->created_at->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.calon-mahasiswa.edit', $user->id) }}" class="btn btn-warning rounded-pill">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </a>
                        <button class="btn btn-outline-danger rounded-pill" onclick="resetPassword({{ $user->id }})">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Pribadi -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-user-circle text-primary me-2"></i>
                        Data Pribadi
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($user->dataPribadi)
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">NIK</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->nik }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Nama Lengkap</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->nama_lengkap }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Tempat Lahir</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->tempat_lahir }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Tanggal Lahir</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->tanggal_lahir->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Jenis Kelamin</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Agama</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->agama }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">No. HP</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->no_hp }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Email Pribadi</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->email_pribadi }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-semibold mb-3">Alamat</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Alamat Lengkap</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->alamat }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Provinsi</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->provinsi }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Kota</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->kota }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Kode Pos</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->kode_pos }}</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-semibold mb-3">Pendidikan</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Asal Sekolah</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->asal_sekolah }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Tahun Lulus</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->tahun_lulus }}</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-semibold mb-3">Data Orang Tua</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Nama Orang Tua</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->nama_ortu }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">Pekerjaan</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->pekerjaan_ortu }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bg-light rounded-3 p-3">
                                    <small class="text-secondary d-block">No. HP Orang Tua</small>
                                    <p class="fw-semibold mb-0">{{ $user->dataPribadi->no_hp_ortu }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle fa-3x text-warning mb-3"></i>
                            <p class="text-secondary">Data pribadi belum diisi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function resetPassword(id) {
    Swal.fire({
        title: 'Reset Password',
        text: 'Password akan direset menjadi "password123". Lanjutkan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/calon-mahasiswa/${id}/reset-password`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                Swal.fire(
                    'Berhasil!',
                    'Password telah direset.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            });
        }
    });
}
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection