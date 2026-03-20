@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-admin text-white rounded-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-2">Data Calon Mahasiswa</h2>
                            <p class="mb-3 opacity-75">Kelola data calon mahasiswa ITECH</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.calon-mahasiswa.create') }}" class="btn btn-light btn-lg rounded-pill px-4">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Data
                            </a>
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
                    <form method="GET" action="{{ route('admin.calon-mahasiswa.index') }}">
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
                                <label class="form-label fw-semibold">Status</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="belum_ujian" {{ request('status') == 'belum_ujian' ? 'selected' : '' }}>Belum Ujian</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Pencarian</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama atau nomor tes...">
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    @if($calonMahasiswa->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4">No</th>
                                    <th class="py-3">Nomor Tes</th>
                                    <th class="py-3">Nama Lengkap</th>
                                    <th class="py-3">Program Studi</th>
                                    <th class="py-3">Tanggal Daftar</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calonMahasiswa as $index => $user)
                                <tr>
                                    <td class="px-4">{{ $calonMahasiswa->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $user->nomorTes->nomor_tes ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                            <span>{{ $user->nama_lengkap }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $user->programStudi->nama_prodi ?? '-' }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($user->hasilUjian)
                                            @if($user->hasilUjian->status == 'lulus')
                                                <span class="badge bg-success">Lulus</span>
                                            @elseif($user->hasilUjian->status == 'tidak_lulus')
                                                <span class="badge bg-danger">Tidak Lulus</span>
                                            @elseif($user->hasilUjian->status == 'belum_dinilai')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Belum Ujian</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.calon-mahasiswa.show', $user->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.calon-mahasiswa.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDelete({{ $user->id }}, '{{ $user->nama_lengkap }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
                            Menampilkan {{ $calonMahasiswa->firstItem() }} - {{ $calonMahasiswa->lastItem() }} dari {{ $calonMahasiswa->total() }} data
                        </div>
                        <nav>
                            {{ $calonMahasiswa->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-secondary mb-3"></i>
                        <h5 class="text-secondary">Belum ada data calon mahasiswa</h5>
                        <p class="text-secondary mb-3">Silakan tambah data baru</p>
                        <a href="{{ route('admin.calon-mahasiswa.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Data
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p>Apakah Anda yakin ingin menghapus data calon mahasiswa <span class="fw-bold" id="deleteNama"></span>?</p>
                <p class="text-danger mb-0"><small>Data yang sudah dihapus tidak dapat dikembalikan.</small></p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form method="POST" id="deleteForm" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id, nama) {
    document.getElementById('deleteNama').textContent = nama;
    document.getElementById('deleteForm').action = '{{ url("admin/calon-mahasiswa") }}/' + id;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif
</script>

<style>
.bg-gradient-admin {
    background: linear-gradient(135deg, #141e30 0%, #243b55 100%);
}

.table th {
    font-weight: 600;
    color: #495057;
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 0.4rem 0.8rem;
}

.pagination .page-link {
    border: none;
    color: #6c757d;
    margin: 0 3px;
    border-radius: 8px;
}

.pagination .active .page-link {
    background: #0d6efd;
    color: white;
}

.pagination .page-link:hover {
    background: #e9ecef;
    color: #0d6efd;
}
</style>
@endsection