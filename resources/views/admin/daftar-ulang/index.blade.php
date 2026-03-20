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
                            <h2 class="fw-bold mb-2">Verifikasi Daftar Ulang</h2>
                            <p class="mb-3 opacity-75">Verifikasi berkas dan pembayaran, serta generate NIM mahasiswa baru</p>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Total Pengajuan</small>
                                    <span class="fw-bold fs-6">{{ $statistik['total'] ?? 0 }}</span>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-3 px-4 py-2">
                                    <small class="d-block">Pending</small>
                                    <span class="fw-bold fs-6">{{ $statistik['pending_berkas'] ?? 0 }}</span>
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

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-2">Total Lulus</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['total'] ?? 0 }}</h3>
                            <small class="text-secondary">Mahasiswa lulus</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
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
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 mb-2">Pending Berkas</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['pending_berkas'] ?? 0 }}</h3>
                            <small class="text-secondary">Menunggu verifikasi</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-file-pdf fa-2x text-warning"></i>
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
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 mb-2">Pending Bayar</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['pending_bayar'] ?? 0 }}</h3>
                            <small class="text-secondary">Menunggu pembayaran</small>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-credit-card fa-2x text-info"></i>
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
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 mb-2">Diterima</span>
                            <h3 class="fw-bold mb-0">{{ $statistik['diterima'] ?? 0 }}</h3>
                            <small class="text-secondary">Sudah generate NIM</small>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-id-card fa-2x text-success"></i>
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
                    <form method="GET" action="{{ route('admin.daftar-ulang.index') }}">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Program Studi</label>
                                <select class="form-select" name="prodi">
                                    <option value="">Semua Prodi</option>
                                    @foreach($programStudi ?? [] as $prodi)
                                        <option value="{{ $prodi->id }}" {{ request('prodi') == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Status Berkas</label>
                                <select class="form-select" name="status_berkas">
                                    <option value="">Semua</option>
                                    <option value="pending" {{ request('status_berkas') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diterima" {{ request('status_berkas') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ request('status_berkas') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Status Bayar</label>
                                <select class="form-select" name="status_bayar">
                                    <option value="">Semua</option>
                                    <option value="pending" {{ request('status_bayar') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diterima" {{ request('status_bayar') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ request('status_bayar') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                                <a href="{{ route('admin.daftar-ulang.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo-alt"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Ulang -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Daftar Pengajuan Daftar Ulang
                        </h5>
                     
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(isset($daftarUlangs) && $daftarUlangs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-4" width="5%">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                    </th>
                                    <th class="py-3" width="5%">No</th>
                                    <th class="py-3" width="12%">Nomor Tes</th>
                                    <th class="py-3" width="15%">Nama Lengkap</th>
                                    <th class="py-3" width="8%">Prodi</th>
                                    <th class="py-3" width="15%">Kelengkapan Berkas</th>
                                    <th class="py-3" width="12%">Pembayaran</th>
                                    <th class="py-3" width="10%">Status</th>
                                    <th class="py-3" width="18%">Aksi</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @foreach($daftarUlangs as $index => $user)
                                @php
                                    $berkasCount = 0;
                                    $berkasList = [];
                                    if($user->daftarUlang) {
                                        if($user->daftarUlang->surat_pernyataan) {
                                            $berkasCount++;
                                            $berkasList[] = 'Surat Pernyataan';
                                        }
                                        if($user->daftarUlang->pas_foto) {
                                            $berkasCount++;
                                            $berkasList[] = 'Pas Foto';
                                        }
                                        if($user->daftarUlang->surat_keterangan_sehat) {
                                            $berkasCount++;
                                            $berkasList[] = 'Surat Sehat';
                                        }
                                        if($user->daftarUlang->kartu_keluarga) {
                                            $berkasCount++;
                                            $berkasList[] = 'Kartu Keluarga';
                                        }
                                    }
                                    
                                    $berkasStatus = $berkasCount == 4 ? 'success' : ($berkasCount >= 2 ? 'warning' : 'danger');
                                    $berkasStatusText = $berkasCount == 4 ? 'Lengkap' : ($berkasCount >= 2 ? 'Kurang' : 'Minim');
                                @endphp
                                <tr>
                                    <td class="px-4">
                                        @if(!$user->mahasiswaAktif)
                                        <input type="checkbox" class="form-check-input row-checkbox" value="{{ $user->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $daftarUlangs->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $user->nomorTes->nomor_tes ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block">{{ $user->nama_lengkap }}</span>
                                                @if($user->dataPribadi)
                                                <small class="text-secondary">NIK: {{ $user->dataPribadi->nik }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            {{ $user->programStudi->kode_prodi ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-{{ $berkasStatus }}" style="width: {{ $berkasCount * 25 }}%"></div>
                                                </div>
                                            </div>
                                            <small class="text-secondary">{{ $berkasCount }}/4</small>
                                        </div>
                                        <div class="mt-1">
                                            <span class="badge bg-{{ $berkasStatus }} bg-opacity-10 text-{{ $berkasStatus }} px-2 py-1">
                                                {{ $berkasStatusText }}
                                            </span>
                                            @if($berkasCount > 0)
                                            <i class="fas fa-info-circle text-secondary ms-1" data-bs-toggle="tooltip" title="{{ implode(', ', $berkasList) }}"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->pembayaran)
                                            @if($user->pembayaran->status == 'diterima')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Diterima
                                                </span>
                                            @elseif($user->pembayaran->status == 'ditolak')
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>Ditolak
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @endif
                                            <br>
                                            <small class="text-secondary">Rp {{ number_format($user->pembayaran->jumlah, 0, ',', '.') }}</small>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="fas fa-minus-circle me-1"></i>Belum Bayar
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->mahasiswaAktif)
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-id-card me-1"></i>NIM: {{ $user->mahasiswaAktif->nim }}
                                            </span>
                                        @else
                                            @if($user->daftarUlang)
                                                @if($user->daftarUlang->status_berkas == 'diterima')
                                                    <span class="badge bg-success px-3 py-2">Diterima</span>
                                                @elseif($user->daftarUlang->status_berkas == 'ditolak')
                                                    <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary px-3 py-2">Belum Upload</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.daftar-ulang.show', $user->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if(!$user->mahasiswaAktif)
                                                @if(($user->daftarUlang && $user->daftarUlang->status_berkas == 'pending') || ($user->pembayaran && $user->pembayaran->status == 'pending') || !$user->daftarUlang)
                                                <button class="btn btn-sm btn-success" onclick="terimaDaftarUlang({{ $user->id }})" title="Terima & Generate NIM">
                                                    <i class="fas fa-id-card"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="tolakDaftarUlang({{ $user->id }})" title="Tolak">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                @endif
                                            @endif
                                            
                                            @if($user->daftarUlang && $user->daftarUlang->surat_pernyataan)
                                            <a href="{{ route('admin.daftar-ulang.download', ['type' => 'surat', 'id' => $user->id]) }}" class="btn btn-sm btn-outline-primary" title="Download Surat" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
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
                            Menampilkan {{ $daftarUlangs->firstItem() }} - {{ $daftarUlangs->lastItem() }} dari {{ $daftarUlangs->total() }} data
                        </div>
                        <nav>
                            {{ $daftarUlangs->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-file-upload fa-4x text-secondary mb-3"></i>
                        <h5 class="text-secondary">Belum ada pengajuan daftar ulang</h5>
                        <p class="text-secondary">Belum ada mahasiswa yang lulus atau mengajukan daftar ulang</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Terima & Generate NIM -->
<div class="modal fade" id="terimaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-id-card me-2"></i>Generate NIM Mahasiswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="fas fa-id-card fa-3x text-success"></i>
                    </div>
                    <h4 class="fw-bold">Konfirmasi Penerimaan</h4>
                    <p class="text-secondary">Terima daftar ulang dan generate NIM untuk mahasiswa</p>
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-secondary">Nama</small>
                            <p class="fw-semibold mb-0" id="terimaNama">-</p>
                        </div>
                        <div class="col-6">
                            <small class="text-secondary">Nomor Tes</small>
                            <p class="fw-semibold mb-0" id="terimaNomorTes">-</p>
                        </div>
                    </div>
                </div>

                <div class="border rounded-3 p-3 mb-3">
                    <label class="fw-semibold mb-2">NIM yang akan digenerate:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">ITECH</span>
                        <input type="text" class="form-control" id="nimPreview" value="{{ date('Y') }}0001" readonly>
                    </div>
                    <small class="text-secondary">NIM akan digenerate otomatis berdasarkan format ITECH[Tahun][4 digit]</small>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold mb-2">Atau isi NIM manual (opsional):</label>
                    <input type="text" class="form-control" id="nimManual" placeholder="Contoh: ITECH20250002">
                    <small class="text-secondary">Kosongkan jika ingin generate otomatis</small>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Mahasiswa akan mendapatkan NIM aktif</li>
                        <li>Kartu mahasiswa akan tersedia</li>
                        <li>Data akan masuk ke database mahasiswa aktif</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success rounded-pill px-4" id="confirmTerimaBtn">
                    <i class="fas fa-id-card me-2"></i>Generate NIM
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="tolakModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Tolak Daftar Ulang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="fas fa-times-circle fa-3x text-danger"></i>
                    </div>
                    <h4 class="fw-bold">Konfirmasi Penolakan</h4>
                    <p class="text-secondary">Apakah Anda yakin ingin menolak daftar ulang mahasiswa ini?</p>
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-secondary">Nama</small>
                            <p class="fw-semibold mb-0" id="tolakNama">-</p>
                        </div>
                        <div class="col-6">
                            <small class="text-secondary">Nomor Tes</small>
                            <p class="fw-semibold mb-0" id="tolakNomorTes">-</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alasanTolak" rows="3" placeholder="Masukkan alasan mengapa daftar ulang ditolak..."></textarea>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Mahasiswa akan diberitahu alasan penolakan.
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger rounded-pill px-4" id="confirmTolakBtn">
                    <i class="fas fa-times me-2"></i>Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Batch Terima -->
<div class="modal fade" id="batchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-layer-group me-2"></i>Batch Terima Daftar Ulang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-3">Anda memilih <span id="selectedCount" class="fw-bold">0</span> mahasiswa untuk diterima.</p>
                
                <div class="alert alert-success">
                    <i class="fas fa-info-circle me-2"></i>
                    Semua mahasiswa yang dipilih akan mendapatkan NIM secara otomatis.
                </div>

                <div class="border rounded-3 p-3">
                    <label class="fw-semibold mb-2">Preview NIM yang akan digenerate:</label>
                    <p class="mb-1">Format: <strong>ITECH[Tahun][Nomor Urut]</strong></p>
                    <small class="text-secondary">NIM akan digenerate berdasarkan program studi masing-masing</small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-success rounded-pill px-4" id="batchConfirmBtn">
                    <i class="fas fa-id-card me-2"></i>Generate NIM
                </button>
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
    document.getElementById('selectedCount').textContent = selectedIds.length;
}

// Terima & Generate NIM
function terimaDaftarUlang(id) {
    const row = event.target.closest('tr');
    const nama = row.querySelector('td:nth-child(4) .fw-semibold').textContent;
    const nomorTes = row.querySelector('td:nth-child(3)').textContent.trim();
    
    document.getElementById('terimaNama').textContent = nama;
    document.getElementById('terimaNomorTes').textContent = nomorTes;
    
    const tahun = new Date().getFullYear();
    document.getElementById('nimPreview').value = tahun + '0001';
    
    const terimaModal = new bootstrap.Modal(document.getElementById('terimaModal'));
    terimaModal.show();
    
    document.getElementById('confirmTerimaBtn').onclick = function() {
        const nimManual = document.getElementById('nimManual').value;
        
        terimaModal.hide();
        
        Swal.fire({
            title: 'Memproses...',
            html: 'Sedang generate NIM, mohon tunggu...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch(`/admin/daftar-ulang/${id}/accept`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nim_custom: nimManual })
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
    };
}

// Tolak Daftar Ulang
function tolakDaftarUlang(id) {
    const row = event.target.closest('tr');
    const nama = row.querySelector('td:nth-child(4) .fw-semibold').textContent;
    const nomorTes = row.querySelector('td:nth-child(3)').textContent.trim();
    
    document.getElementById('tolakNama').textContent = nama;
    document.getElementById('tolakNomorTes').textContent = nomorTes;
    document.getElementById('alasanTolak').value = '';
    
    const tolakModal = new bootstrap.Modal(document.getElementById('tolakModal'));
    tolakModal.show();
    
    document.getElementById('confirmTolakBtn').onclick = function() {
        const alasan = document.getElementById('alasanTolak').value;
        if (!alasan) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Harap isi alasan penolakan!'
            });
            return;
        }
        
        tolakModal.hide();
        
        Swal.fire({
            title: 'Memproses...',
            html: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch(`/admin/daftar-ulang/${id}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ alasan: alasan })
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
    };
}

// Batch Terima
function batchTerima() {
    updateSelectedIds();
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Ada Data',
            text: 'Pilih minimal satu mahasiswa terlebih dahulu!'
        });
        return;
    }
    
    document.getElementById('selectedCount').textContent = selectedIds.length;
    const batchModal = new bootstrap.Modal(document.getElementById('batchModal'));
    batchModal.show();
    
    document.getElementById('batchConfirmBtn').onclick = function() {
        batchModal.hide();
        
        Swal.fire({
            title: 'Memproses...',
            html: 'Sedang generate NIM untuk ' + selectedIds.length + ' mahasiswa...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch('{{ route("admin.daftar-ulang.batch.accept") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: data.message + '<br>NIM: ' + (data.nims ? data.nims.join(', ') : ''),
                    timer: 3000,
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
    };
}



// Notifikasi dari session
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
.bg-gradient-daftarulang {
    background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
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

.progress {
    border-radius: 10px;
    background-color: #e9ecef;
}

.badge {
    font-weight: 500;
    padding: 0.5rem 0.8rem;
}

.modal-content {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
@endsection