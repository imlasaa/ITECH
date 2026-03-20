<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataPribadi;
use App\Models\ProgramStudi;
use App\Models\NomorTes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CalonMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Menampilkan daftar calon mahasiswa
     */
    public function index(Request $request)
    {
        $query = User::with(['programStudi', 'dataPribadi', 'nomorTes', 'hasilUjian']);

        // Filter berdasarkan program studi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('program_studi_id', $request->prodi);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'lulus') {
                $query->whereHas('hasilUjian', function($q) {
                    $q->where('status', 'lulus');
                });
            } elseif ($request->status == 'tidak_lulus') {
                $query->whereHas('hasilUjian', function($q) {
                    $q->where('status', 'tidak_lulus');
                });
            } elseif ($request->status == 'pending') {
                $query->whereHas('hasilUjian', function($q) {
                    $q->where('status', 'belum_dinilai');
                });
            } elseif ($request->status == 'belum_ujian') {
                $query->whereDoesntHave('hasilUjian');
            }
        }

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('nomorTes', function($sub) use ($search) {
                      $sub->where('nomor_tes', 'like', "%{$search}%");
                  });
            });
        }

        $calonMahasiswa = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $programStudi = ProgramStudi::all();

        return view('admin.calon-mahasiswa.index', compact('calonMahasiswa', 'programStudi'));
    }

    /**
     * Menampilkan form tambah calon mahasiswa
     */
    public function create()
    {
        $programStudi = ProgramStudi::all();
        return view('admin.calon-mahasiswa.create', compact('programStudi'));
    }

    /**
     * Menyimpan data calon mahasiswa baru - VERSI OPSIONAL (HANYA AKUN WAJIB)
     */
    public function store(Request $request)
    {
        // Validasi hanya untuk data akun (WAJIB)
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'program_studi_id' => 'required|exists:program_studis,id',
            
            // Data pribadi - SEMUA OPSIONAL (nullable)
            'nik' => 'nullable|string|size:16|unique:data_pribadi,nik',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:15',
            'email_pribadi' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'provinsi' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'asal_sekolah' => 'nullable|string|max:255',
            'tahun_lulus' => 'nullable|integer|min:2000|max:' . date('Y'),
            'nama_ortu' => 'nullable|string|max:255',
            'pekerjaan_ortu' => 'nullable|string|max:255',
            'no_hp_ortu' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        
        try {
            // Simpan user (WAJIB)
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'program_studi_id' => $request->program_studi_id,
            ]);

            // Generate nomor tes
            $tahun = date('Y');
            $nomorTes = 'ITECH-' . $tahun . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT);
            
            NomorTes::create([
                'user_id' => $user->id,
                'nomor_tes' => $nomorTes,
            ]);

            // Siapkan data pribadi (HANYA FIELD YANG DIISI)
            $dataPribadi = [
                'user_id' => $user->id,
                'program_studi_id' => $user->program_studi_id,
            ];

            $fields = [
                'nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
                'no_hp', 'email_pribadi', 'alamat', 'provinsi', 'kota', 'kode_pos',
                'asal_sekolah', 'tahun_lulus', 'nama_ortu', 'pekerjaan_ortu', 'no_hp_ortu'
            ];

            foreach ($fields as $field) {
                if ($request->filled($field)) {
                    $dataPribadi[$field] = $request->$field;
                }
            }

            // Simpan data pribadi (database sudah nullable, jadi aman)
            DataPribadi::create($dataPribadi);

            DB::commit();

            return redirect()->route('admin.calon-mahasiswa.index')
                ->with('success', 'Data calon mahasiswa berhasil ditambahkan. Nomor Tes: ' . $nomorTes);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menampilkan detail calon mahasiswa
     */
    public function show($id)
    {
        $user = User::with([
            'programStudi', 
            'dataPribadi', 
            'nomorTes', 
            'hasilUjian', 
            'daftarUlang', 
            'pembayaran', 
            'mahasiswaAktif'
        ])->findOrFail($id);
        
        return view('admin.calon-mahasiswa.show', compact('user'));
    }

    /**
     * Menampilkan form edit calon mahasiswa
     */
    public function edit($id)
    {
        $user = User::with(['dataPribadi'])->findOrFail($id);
        $programStudi = ProgramStudi::all();
        
        return view('admin.calon-mahasiswa.edit', compact('user', 'programStudi'));
    }

    /**
     * Mengupdate data calon mahasiswa
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $dataPribadi = $user->dataPribadi;

        // Validasi hanya untuk data akun (WAJIB)
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'program_studi_id' => 'required|exists:program_studis,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        
        try {
            // Update user (data akun)
            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->program_studi_id = $request->program_studi_id;
            $user->save();

            // Data pribadi (hanya update jika ada field yang diisi)
            $dataToUpdate = [];
            
            $fields = [
                'nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
                'no_hp', 'email_pribadi', 'alamat', 'provinsi', 'kota', 'kode_pos',
                'asal_sekolah', 'tahun_lulus', 'nama_ortu', 'pekerjaan_ortu', 'no_hp_ortu'
            ];

            foreach ($fields as $field) {
                if ($request->filled($field)) {
                    $dataToUpdate[$field] = $request->$field;
                }
            }

            if (!empty($dataToUpdate)) {
                if ($dataPribadi) {
                    DataPribadi::where('user_id', $user->id)->update($dataToUpdate);
                } else {
                    $dataToUpdate['user_id'] = $user->id;
                    $dataToUpdate['program_studi_id'] = $user->program_studi_id;
                    DataPribadi::create($dataToUpdate);
                }
            }

            DB::commit();

            return redirect()->route('admin.calon-mahasiswa.index')
                ->with('success', 'Data calon mahasiswa berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menghapus data calon mahasiswa
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.calon-mahasiswa.index')
                ->with('success', 'Data calon mahasiswa berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Reset password calon mahasiswa
     */
    public function resetPassword($id)
    {
        try {
            $user = User::findOrFail($id);
            $newPassword = 'password123';
            
            $user->password = Hash::make($newPassword);
            $user->save();

            return redirect()->route('admin.calon-mahasiswa.show', $id)
                ->with('success', 'Password berhasil direset menjadi: ' . $newPassword);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}