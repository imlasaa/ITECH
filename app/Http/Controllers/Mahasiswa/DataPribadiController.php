<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DataPribadi;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataPribadiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan form data pribadi
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $dataPribadi = $user->dataPribadi;
        $programStudi = ProgramStudi::all();
        $nomorTes = $user->nomorTes->nomor_tes ?? '-';

        return view('mahasiswa.data-pribadi', compact('dataPribadi', 'programStudi', 'user', 'nomorTes'));
    }

    /**
     * Simpan data pribadi - VERSI OPSIONAL (TIDAK WAJIB)
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah sudah ada data
        if ($user->dataPribadi) {
            return redirect()->route('mahasiswa.data-pribadi')
                ->with('error', 'Data pribadi sudah ada, silakan edit');
        }

        // Validasi hanya untuk field yang diisi (nullable)
        $validator = Validator::make($request->all(), [
            'nik' => 'nullable|string|size:16|unique:data_pribadi,nik',
            'nama_lengkap' => 'nullable|string|max:255',
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

        // Siapkan data hanya untuk field yang diisi
        $data = [];
        $fields = [
            'nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
            'agama', 'no_hp', 'email_pribadi', 'alamat', 'provinsi', 'kota', 'kode_pos',
            'asal_sekolah', 'tahun_lulus', 'nama_ortu', 'pekerjaan_ortu', 'no_hp_ortu'
        ];

        foreach ($fields as $field) {
            if ($request->filled($field)) {
                $data[$field] = $request->$field;
            }
        }

        // Jika tidak ada data yang diisi, redirect dengan pesan
        if (empty($data)) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('info', 'Tidak ada data yang disimpan. Anda bisa mengisi nanti.');
        }

        // Tambahkan field wajib
        $data['user_id'] = $user->id;
        $data['program_studi_id'] = $user->program_studi_id;

        // Simpan data
        try {
            DataPribadi::create($data);

            return redirect()->route('mahasiswa.data-pribadi')
                ->with('success', 'Data pribadi berhasil disimpan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update data pribadi - VERSI OPSIONAL
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $dataPribadi = $user->dataPribadi;

        if (!$dataPribadi) {
            return redirect()->route('mahasiswa.data-pribadi')
                ->with('error', 'Data tidak ditemukan');
        }

        // Validasi hanya untuk field yang diisi (nullable)
        $validator = Validator::make($request->all(), [
            'nik' => 'nullable|string|size:16|unique:data_pribadi,nik,' . $dataPribadi->id,
            'nama_lengkap' => 'nullable|string|max:255',
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

        // Siapkan data hanya untuk field yang diisi
        $data = [];
        $fields = [
            'nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
            'agama', 'no_hp', 'email_pribadi', 'alamat', 'provinsi', 'kota', 'kode_pos',
            'asal_sekolah', 'tahun_lulus', 'nama_ortu', 'pekerjaan_ortu', 'no_hp_ortu'
        ];

        foreach ($fields as $field) {
            if ($request->filled($field)) {
                $data[$field] = $request->$field;
            }
        }

        // Jika tidak ada data yang diupdate, redirect dengan pesan
        if (empty($data)) {
            return redirect()->route('mahasiswa.data-pribadi')
                ->with('info', 'Tidak ada perubahan data.');
        }

        // Update data
        try {
            $dataPribadi->update($data);

            return redirect()->route('mahasiswa.data-pribadi')
                ->with('success', 'Data pribadi berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate: ' . $e->getMessage())
                ->withInput();
        }
    }
}