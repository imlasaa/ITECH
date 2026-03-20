<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HasilUjian;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KelulusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Menampilkan daftar hasil ujian
     */
    public function index(Request $request)
    {
        $query = HasilUjian::with(['user', 'user.programStudi', 'user.nomorTes']);

        // Filter berdasarkan program studi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('program_studi_id', $request->prodi);
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhereHas('nomorTes', function($sub) use ($search) {
                      $sub->where('nomor_tes', 'like', "%{$search}%");
                  });
            });
        }

        $hasilUjians = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $programStudi = ProgramStudi::all();

        // Statistik
        $statistik = [
            'pending' => HasilUjian::where('status', 'belum_dinilai')->count(),
            'lulus' => HasilUjian::where('status', 'lulus')->count(),
            'tidak_lulus' => HasilUjian::where('status', 'tidak_lulus')->count(),
            'total' => HasilUjian::count(),
        ];

        return view('admin.kelulusan.index', compact('hasilUjians', 'programStudi', 'statistik'));
    }

    /**
     * Menerima kelulusan (LULUS) - VERSI SUPER CEPAT
     */
    public function accept(Request $request, $id)
    {
        try {
            // Update langsung tanpa validasi nilai (lebih cepat)
            $updated = HasilUjian::where('id', $id)
                ->update(['status' => 'lulus']);

            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa dinyatakan LULUS'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Menolak kelulusan (TIDAK LULUS) - VERSI SUPER CEPAT
     */
    public function reject(Request $request, $id)
    {
        try {
            // Update langsung tanpa alasan
            $updated = HasilUjian::where('id', $id)
                ->update(['status' => 'tidak_lulus']);

            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa dinyatakan TIDAK LULUS'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Batch accept (multiple) - VERSI SUPER CEPAT
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

        try {
            $updated = HasilUjian::whereIn('id', $ids)
                ->where('status', 'belum_dinilai')
                ->update(['status' => 'lulus']);

            return response()->json([
                'success' => true,
                'message' => $updated . ' mahasiswa dinyatakan LULUS'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Batch reject (multiple) - VERSI SUPER CEPAT
     */
    public function batchReject(Request $request)
    {
        $ids = $request->ids;
        
        if (!$ids || !is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih'
            ]);
        }

        try {
            $updated = HasilUjian::whereIn('id', $ids)
                ->where('status', 'belum_dinilai')
                ->update(['status' => 'tidak_lulus']);

            return response()->json([
                'success' => true,
                'message' => $updated . ' mahasiswa dinyatakan TIDAK LULUS'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}