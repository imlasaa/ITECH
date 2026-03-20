<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaftarUlangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman daftar ulang
     */
    public function index()
    {
        $user = Auth::user();

        // Cek apakah lulus ujian
        $hasilUjian = $user->hasilUjian;
        if (!$hasilUjian || $hasilUjian->status != 'lulus') {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda tidak dapat mengakses daftar ulang');
        }

        $daftarUlang = $user->daftarUlang;
        $pembayaran = $user->pembayaran;
        $mahasiswaAktif = $user->mahasiswaAktif;
        $nomorTes = $user->nomorTes->nomor_tes ?? '-';
        $programStudi = $user->programStudi->nama_prodi ?? '-';
        $nama = $user->nama_lengkap;

        return view('mahasiswa.daftar-ulang.index', compact(
            'user',
            'daftarUlang',
            'pembayaran',
            'mahasiswaAktif',
            'nomorTes',
            'programStudi',
            'nama'
        ));
    }

    /**
     * Simpan berkas daftar ulang
     */
    public function storeBerkas(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'surat_pernyataan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'surat_keterangan_sehat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = [];

        // Upload file jika ada
        if ($request->hasFile('surat_pernyataan')) {
            $data['surat_pernyataan'] = $request->file('surat_pernyataan')
                ->store('daftar-ulang/surat-pernyataan', 'public');
        }

        if ($request->hasFile('pas_foto')) {
            $data['pas_foto'] = $request->file('pas_foto')
                ->store('daftar-ulang/pas-foto', 'public');
        }

        if ($request->hasFile('surat_keterangan_sehat')) {
            $data['surat_keterangan_sehat'] = $request->file('surat_keterangan_sehat')
                ->store('daftar-ulang/surat-sehat', 'public');
        }

        if ($request->hasFile('kartu_keluarga')) {
            $data['kartu_keluarga'] = $request->file('kartu_keluarga')
                ->store('daftar-ulang/kk', 'public');
        }

        $daftarUlang = $user->daftarUlang;

        if ($daftarUlang) {
            // Hapus file lama jika ada
            if (isset($data['surat_pernyataan']) && $daftarUlang->surat_pernyataan) {
                Storage::disk('public')->delete($daftarUlang->surat_pernyataan);
            }
            if (isset($data['pas_foto']) && $daftarUlang->pas_foto) {
                Storage::disk('public')->delete($daftarUlang->pas_foto);
            }
            if (isset($data['surat_keterangan_sehat']) && $daftarUlang->surat_keterangan_sehat) {
                Storage::disk('public')->delete($daftarUlang->surat_keterangan_sehat);
            }
            if (isset($data['kartu_keluarga']) && $daftarUlang->kartu_keluarga) {
                Storage::disk('public')->delete($daftarUlang->kartu_keluarga);
            }

            $daftarUlang->update($data);
        } else {
            $data['user_id'] = $user->id;
            $data['status_berkas'] = 'pending';
            DaftarUlang::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berkas berhasil disimpan'
        ]);
    }

    /**
     * Simpan data pembayaran
     */
    public function storePembayaran(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'metode_pembayaran' => 'required|string',
            'nama_pengirim' => 'required|string|max:255',
            'tanggal_transfer' => 'required|date',
            'bukti_transfer' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = [
            'user_id' => $user->id,
            'jumlah' => 500000,
            'metode_pembayaran' => $request->metode_pembayaran,
            'nama_pengirim' => $request->nama_pengirim,
            'tanggal_transfer' => $request->tanggal_transfer,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ];

        // Upload bukti transfer jika ada
        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')
                ->store('pembayaran/bukti', 'public');
        }

        $pembayaran = $user->pembayaran;

        if ($pembayaran) {
            // Hapus file lama jika ada
            if (isset($data['bukti_transfer']) && $pembayaran->bukti_transfer) {
                Storage::disk('public')->delete($pembayaran->bukti_transfer);
            }
            $pembayaran->update($data);
        } else {
            Pembayaran::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil disimpan'
        ]);
    }
}