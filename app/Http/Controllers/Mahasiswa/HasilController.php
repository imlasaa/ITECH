<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan hasil ujian
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $hasilUjian = $user->hasilUjian;

        if (!$hasilUjian) {
            return redirect()->route('mahasiswa.ujian.index')
                ->with('info', 'Anda belum melakukan ujian');
        }

        // Ambil data untuk ditampilkan
        $status = $hasilUjian->status; // 'lulus', 'tidak_lulus', atau 'belum_dinilai'
        $tanggalUjian = $hasilUjian->waktu_mulai ? Carbon::parse($hasilUjian->waktu_mulai) : null;
        $programStudi = $user->programStudi->nama_prodi ?? '-';
        $nama = $user->nama_lengkap;
        $nomorTes = $user->nomorTes->nomor_tes ?? '-';

        return view('mahasiswa.hasil', compact(
            'status',
            'tanggalUjian',
            'programStudi',
            'nama',
            'nomorTes'
        ));
    }
}