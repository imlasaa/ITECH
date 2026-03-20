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
                            <h2 class="fw-bold mb-2">Manajemen Soal Ujian</h2>
                            <p class="mb-3 opacity-75">Kelola bank soal ujian seleksi mahasiswa baru</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('admin.soal.create') }}" class="btn btn-light btn-lg rounded-pill px-4">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Soal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pencarian -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('admin.soal.index') }}">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Pencarian</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari soal...">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Soal -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    @if($soals->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4" width="5%">No</th>
                                    <th class="py-3" width="50%">Soal</th>
                                    <th class="py-3" width="15%">Kunci Jawaban</th>
                                    <th class="py-3" width="20%">Tanggal Dibuat</th>
                                    <th class="py-3" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soals as $index => $soal)
                                <tr>
                                    <td class="px-4">{{ $soals->firstItem() + $index }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $soal->soal }}</div>
                                        <div class="small text-secondary mt-1">
                                            A. {{ $soal->opsi_a }} | 
                                            B. {{ $soal->opsi_b }} | 
                                            C. {{ $soal->opsi_c }} | 
                                            D. {{ $soal->opsi_d }} | 
                                            E. {{ $soal->opsi_e }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            <i class="fas fa-check me-1"></i> {{ strtoupper($soal->kunci_jawaban) }}
                                        </span>
                                    </td>
                                    <td>{{ $soal->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.soal.edit', $soal->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDelete({{ $soal->id }})">
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
                            Menampilkan {{ $soals->firstItem() }} - {{ $soals->lastItem() }} dari {{ $soals->total() }} soal
                        </div>
                        <nav>
                            {{ $soals->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-question-circle fa-4x text-secondary mb-3"></i>
                        <h5 class="text-secondary">Belum ada soal</h5>
                        <p class="text-secondary mb-3">Silakan tambah soal baru</p>
                        <a href="{{ route('admin.soal.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Soal
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
                <p>Apakah Anda yakin ingin menghapus soal ini?</p>
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
function confirmDelete(id) {
    document.getElementById('deleteForm').action = '{{ url("admin/soal") }}/' + id;
    
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
.bg-gradient-soal {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}
</style>
@endsection