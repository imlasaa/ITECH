<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DaftarUlang;
use App\Models\Pembayaran;
use App\Models\MahasiswaAktif;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaftarUlangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Menampilkan daftar pengajuan daftar ulang
     */
    public function index(Request $request)
    {
        $query = User::with([
            'programStudi', 
            'nomorTes', 
            'daftarUlang', 
            'pembayaran', 
            'mahasiswaAktif',
            'hasilUjian'
        ])->whereHas('hasilUjian', function($q) {
            $q->where('status', 'lulus');
        });

        // Filter berdasarkan program studi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('program_studi_id', $request->prodi);
        }

        // Filter berdasarkan status berkas
        if ($request->has('status_berkas') && $request->status_berkas != '') {
            $query->whereHas('daftarUlang', function($q) use ($request) {
                $q->where('status_berkas', $request->status_berkas);
            });
        }

        // Filter berdasarkan status pembayaran
        if ($request->has('status_bayar') && $request->status_bayar != '') {
            $query->whereHas('pembayaran', function($q) use ($request) {
                $q->where('status', $request->status_bayar);
            });
        }

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhereHas('nomorTes', function($sub) use ($search) {
                      $sub->where('nomor_tes', 'like', "%{$search}%");
                  });
            });
        }

        $daftarUlangs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $programStudi = ProgramStudi::all();

        // Statistik
        $statistik = [
            'total' => User::whereHas('hasilUjian', fn($q) => $q->where('status', 'lulus'))->count(),
            'pending_berkas' => DaftarUlang::where('status_berkas', 'pending')->count(),
            'pending_bayar' => Pembayaran::where('status', 'pending')->count(),
            'diterima' => MahasiswaAktif::count(),
            'ditolak' => DaftarUlang::where('status_berkas', 'ditolak')->count(),
        ];

        return view('admin.daftar-ulang.index', compact('daftarUlangs', 'programStudi', 'statistik'));
    }

    /**
     * Menampilkan detail daftar ulang
     */
    public function show($id)
    {
        $user = User::with([
            'programStudi', 
            'dataPribadi', 
            'nomorTes', 
            'daftarUlang', 
            'pembayaran',
            'mahasiswaAktif'
        ])->findOrFail($id);
        
        return view('admin.daftar-ulang.show', compact('user'));
    }

    /**
     * Generate NIM otomatis - VERSI SEDERHANA DAN PASTI UNIK
     * Format: ITECH[TAHUN][4 DIGIT URUT BERDASARKAN PRODI]
     */
    private function generateNIM($programStudiId, $tahunMasuk)
    {
        // Cari NIM terakhir untuk prodi dan tahun tertentu
        $lastMahasiswa = MahasiswaAktif::where('program_studi_id', $programStudiId)
            ->where('tahun_masuk', $tahunMasuk)
            ->orderBy('nim', 'desc')
            ->first();

        if ($lastMahasiswa) {
            // Ambil 4 digit terakhir dari NIM terakhir
            $lastNumber = (int) substr($lastMahasiswa->nim, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format dengan leading zeros
        return 'ITECH' . $tahunMasuk . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Terima daftar ulang dan generate NIM - VERSI SEDERHANA
     */
    public function accept(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim_custom' => 'nullable|string|unique:mahasiswa_aktif,nim'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'NIM sudah digunakan'
            ]);
        }

        $user = User::with(['daftarUlang', 'pembayaran', 'programStudi'])->findOrFail($id);

        // Cek apakah sudah punya NIM
        if ($user->mahasiswaAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa ini sudah memiliki NIM'
            ]);
        }

        DB::beginTransaction();
        try {
            // Update status berkas
            if ($user->daftarUlang) {
                $user->daftarUlang->status_berkas = 'diterima';
                $user->daftarUlang->save();
            }

            // Update status pembayaran
            if ($user->pembayaran) {
                $user->pembayaran->status = 'diterima';
                $user->pembayaran->save();
            }

            // Generate NIM
            $tahunMasuk = date('Y');
            $programStudiId = $user->program_studi_id;
            
            if ($request->filled('nim_custom')) {
                $nim = $request->nim_custom;
            } else {
                $nim = $this->generateNIM($programStudiId, $tahunMasuk);
                
                // Pastikan NIM benar-benar unik
                $counter = 1;
                while (MahasiswaAktif::where('nim', $nim)->exists()) {
                    $lastNumber = (int) substr($nim, -4);
                    $newNumber = $lastNumber + $counter;
                    $nim = 'ITECH' . $tahunMasuk . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
                    $counter++;
                }
            }

            // Simpan ke mahasiswa_aktif
            MahasiswaAktif::create([
                'user_id' => $user->id,
                'nim' => $nim,
                'program_studi_id' => $programStudiId,
                'tahun_masuk' => $tahunMasuk,
                'pas_foto' => $user->daftarUlang->pas_foto ?? null
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Daftar ulang diterima, NIM: ' . $nim,
                'nim' => $nim
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

 /**
 * Tolak daftar ulang
 */
public function reject(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'alasan' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Alasan penolakan harus diisi'
        ]);
    }

    $user = User::findOrFail($id);

    DB::beginTransaction();
    try {
        if ($user->daftarUlang) {
            $user->daftarUlang->status_berkas = 'ditolak';
            $user->daftarUlang->catatan_berkas = $request->alasan;
            $user->daftarUlang->save();
        }

        if ($user->pembayaran) {
            $user->pembayaran->status = 'ditolak';
            $user->pembayaran->save();
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Daftar ulang ditolak'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}
    /**
     * Batch accept - VERSI SEDERHANA
     */
    public function batchAccept(Request $request)
    {
        $ids = $request->ids;
        
        if (!$ids || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih'
            ]);
        }

        $success = 0;
        $errors = 0;
        $generatedNims = [];
        $tahunMasuk = date('Y');

        DB::beginTransaction();
        try {
            // Ambil semua user yang dipilih dan belum punya NIM
            $users = User::with(['daftarUlang', 'pembayaran', 'programStudi'])
                        ->whereIn('id', $ids)
                        ->whereDoesntHave('mahasiswaAktif')
                        ->get();

            if ($users->isEmpty()) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada mahasiswa yang dapat diproses'
                ]);
            }

            // Group by program studi
            $usersByProdi = $users->groupBy('program_studi_id');
            
            foreach ($usersByProdi as $prodiId => $prodiUsers) {
                // Hitung NIM terakhir untuk prodi ini
                $lastMahasiswa = MahasiswaAktif::where('program_studi_id', $prodiId)
                    ->where('tahun_masuk', $tahunMasuk)
                    ->orderBy('nim', 'desc')
                    ->first();
                
                $lastNumber = $lastMahasiswa ? (int) substr($lastMahasiswa->nim, -4) : 0;
                
                foreach ($prodiUsers as $index => $user) {
                    $newNumber = $lastNumber + $index + 1;
                    $nim = 'ITECH' . $tahunMasuk . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

                    // Update status
                    if ($user->daftarUlang) {
                        $user->daftarUlang->status_berkas = 'diterima';
                        $user->daftarUlang->save();
                    }

                    if ($user->pembayaran) {
                        $user->pembayaran->status = 'diterima';
                        $user->pembayaran->save();
                    }

                    // Simpan mahasiswa aktif
                    MahasiswaAktif::create([
                        'user_id' => $user->id,
                        'nim' => $nim,
                        'program_studi_id' => $prodiId,
                        'tahun_masuk' => $tahunMasuk,
                        'pas_foto' => $user->daftarUlang->pas_foto ?? null
                    ]);

                    $generatedNims[] = $nim;
                    $success++;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $success . ' mahasiswa berhasil diterima',
                'nims' => $generatedNims
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Download file berkas
     */
    public function downloadFile($type, $id)
    {
        $user = User::findOrFail($id);
        
        $path = null;
        $filename = null;

        switch ($type) {
            case 'surat':
                if ($user->daftarUlang && $user->daftarUlang->surat_pernyataan) {
                    $path = $user->daftarUlang->surat_pernyataan;
                    $filename = 'surat_pernyataan_' . ($user->nomorTes->nomor_tes ?? 'unknown') . '.' . pathinfo($path, PATHINFO_EXTENSION);
                }
                break;
            case 'foto':
                if ($user->daftarUlang && $user->daftarUlang->pas_foto) {
                    $path = $user->daftarUlang->pas_foto;
                    $filename = 'pas_foto_' . ($user->nomorTes->nomor_tes ?? 'unknown') . '.' . pathinfo($path, PATHINFO_EXTENSION);
                }
                break;
            case 'sehat':
                if ($user->daftarUlang && $user->daftarUlang->surat_keterangan_sehat) {
                    $path = $user->daftarUlang->surat_keterangan_sehat;
                    $filename = 'surat_sehat_' . ($user->nomorTes->nomor_tes ?? 'unknown') . '.' . pathinfo($path, PATHINFO_EXTENSION);
                }
                break;
            case 'kk':
                if ($user->daftarUlang && $user->daftarUlang->kartu_keluarga) {
                    $path = $user->daftarUlang->kartu_keluarga;
                    $filename = 'kartu_keluarga_' . ($user->nomorTes->nomor_tes ?? 'unknown') . '.' . pathinfo($path, PATHINFO_EXTENSION);
                }
                break;
            case 'bukti':
                if ($user->pembayaran && $user->pembayaran->bukti_transfer) {
                    $path = $user->pembayaran->bukti_transfer;
                    $filename = 'bukti_transfer_' . ($user->nomorTes->nomor_tes ?? 'unknown') . '.' . pathinfo($path, PATHINFO_EXTENSION);
                }
                break;
            default:
                return redirect()->back()->with('error', 'Tipe file tidak dikenal');
        }

        if (!$path || !Storage::disk('public')->exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($path, $filename);
    }

    /**
     * Lihat file (preview)
     */
    public function viewFile($type, $id)
    {
        $user = User::findOrFail($id);
        
        $path = null;

        switch ($type) {
            case 'surat':
                $path = $user->daftarUlang->surat_pernyataan ?? null;
                break;
            case 'foto':
                $path = $user->daftarUlang->pas_foto ?? null;
                break;
            case 'sehat':
                $path = $user->daftarUlang->surat_keterangan_sehat ?? null;
                break;
            case 'kk':
                $path = $user->daftarUlang->kartu_keluarga ?? null;
                break;
            case 'bukti':
                $path = $user->pembayaran->bukti_transfer ?? null;
                break;
            default:
                abort(404);
        }

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path('app/public/' . $path));
    }
}