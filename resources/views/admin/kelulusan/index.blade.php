@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-kelulusan text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Manajemen Kelulusan</h2>
                            <p class="mb-3 opacity-75">Tentukan kelulusan calon mahasiswa berdasarkan hasil ujian</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <span class="badge bg-white text-primary px-4 py-3 rounded-pill fs-6">
                                    <i class="fas fa-clock me-2"></i>{{ $statistik['pending'] }} Menunggu
                                </span>
                                <span class="badge bg-white text-success px-4 py-3 rounded-pill fs-6">
                                    <i class="fas fa-check-circle me-2"></i>{{ $statistik['lulus'] }} Lulus
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 mb-2">Pending</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['pending'] }}</h3>
                            <small class="text-secondary">Menunggu verifikasi</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-2">Lulus</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['lulus'] }}</h3>
                            <small class="text-secondary">Telah dinyatakan lulus</small>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 mb-2">Tidak Lulus</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['tidak_lulus'] }}</h3>
                            <small class="text-secondary">Tidak memenuhi syarat</small>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 mb-2">Total</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['total'] }}</h3>
                            <small class="text-secondary">Peserta ujian</small>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('admin.kelulusan.index') }}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Program Studi</label>
                                <select class="form-select" name="prodi">
                                    <option value="">Semua Prodi</option>
                                    @foreach($programStudi as $prodi)
                                        <option value="{{ $prodi->id }}" {{ request('prodi') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status Kelulusan</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="belum_dinilai" {{ request('status') == 'belum_dinilai' ? 'selected' : '' }}>Pending</option>
                                    <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pencarian</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama atau nomor tes...">
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                                <a href="{{ route('admin.kelulusan.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo-alt"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Kelulusan -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Daftar Hasil Ujian
                        </h5>
                        <div>
                      
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($hasilUjians->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4" width="5%">
                                       
                                    </th>
                                    <th class="py-3" width="5%">No</th>
                                    <th class="py-3" width="12%">Nomor Tes</th>
                                    <th class="py-3" width="15%">Nama Lengkap</th>
                                    <th class="py-3" width="10%">Program Studi</th>
                                    <th class="py-3" width="10%">Tanggal Ujian</th>
                                    <th class="py-3" width="10%">Nilai</th>
                                    <th class="py-3" width="10%">Status</th>
                                    <th class="py-3" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilUjians as $index => $hasil)
                                <tr>
                                    <td class="px-4">
                                        @if($hasil->status == 'belum_dinilai')
                                        <input type="checkbox" class="form-check-input row-checkbox" value="{{ $hasil->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $hasilUjians->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $hasil->user->nomorTes->nomor_tes ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                            <span class="fw-semibold">{{ $hasil->user->nama_lengkap }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $hasil->user->programStudi->nama_prodi ?? '-' }}</td>
                                    <td>{{ $hasil->created_at->format('d/m/Y') }}</td>
                                    <td class="fw-bold">{{ $hasil->nilai }}</td>
                                    <td>
                                        @if($hasil->status == 'lulus')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Lulus
                                            </span>
                                        @elseif($hasil->status == 'tidak_lulus')
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>Tidak Lulus
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($hasil->status == 'belum_dinilai')
                                                <button class="btn btn-sm btn-success" onclick="acceptKelulusan({{ $hasil->id }})" title="Luluskan">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="rejectKelulusan({{ $hasil->id }})" title="Tidak Luluskan">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @else
                                                <span class="text-secondary">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center p-4 border-top">
                        <div class="text-secondary">
                            Menampilkan {{ $hasilUjians->firstItem() }} - {{ $hasilUjians->lastItem() }} dari {{ $hasilUjians->total() }} data
                        </div>
                        <nav>
                            {{ $hasilUjians->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-4x text-secondary mb-3"></i>
                        <h5 class="text-secondary">Belum ada data hasil ujian</h5>
                        <p class="text-secondary">Belum ada mahasiswa yang mengikuti ujian</p>
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
let selectedIds = [];

// Checkbox All
document.getElementById('checkAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = this.checked;
    });
    updateSelectedIds();
});

// Individual checkbox
document.querySelectorAll('.row-checkbox').forEach(cb => {
    cb.addEventListener('change', function() {
        updateSelectedIds();
        const allChecked = document.querySelectorAll('.row-checkbox:checked').length === document.querySelectorAll('.row-checkbox').length;
        document.getElementById('checkAll').checked = allChecked;
    });
});

function updateSelectedIds() {
    selectedIds = [];
    document.querySelectorAll('.row-checkbox:checked').forEach(cb => {
        selectedIds.push(cb.value);
    });
}

// Accept Kelulusan (TANPA LOADING LAMA)
function acceptKelulusan(id) {
    Swal.fire({
        title: 'Luluskan Mahasiswa',
        text: 'Apakah Anda yakin ingin menyatakan mahasiswa ini LULUS?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Luluskan'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading cepat
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`/admin/kelulusan/${id}/accept`, {
                method: 'POST',
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
                        timer: 1000,
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

// Reject Kelulusan (TANPA ALASAN)
function rejectKelulusan(id) {
    Swal.fire({
        title: 'Tidak Luluskan Mahasiswa',
        text: 'Apakah Anda yakin ingin menyatakan mahasiswa ini TIDAK LULUS?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tidak Luluskan'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading cepat
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`/admin/kelulusan/${id}/reject`, {
                method: 'POST',
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
                        timer: 1000,
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
.bg-gradient-kelulusan {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.table th {
    font-weight: 600;
    color: #495057;
    background-color: #f8f9fa;
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 0.4rem 0.8rem;
}

.badge {
    font-weight: 500;
    padding: 0.5rem 0.8rem;
}

.btn-outline-success:hover, .btn-outline-danger:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
</style>
@endsection