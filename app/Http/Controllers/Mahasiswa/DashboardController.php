<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard mahasiswa
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil data relasi
        $nomorTes = $user->nomorTes->nomor_tes ?? '-';
        $dataPribadi = $user->dataPribadi;
        $hasilUjian = $user->hasilUjian;
        $daftarUlang = $user->daftarUlang;
        $pembayaran = $user->pembayaran;
        $mahasiswaAktif = $user->mahasiswaAktif;

        return view('mahasiswa.dashboard', compact(
            'user',
            'nomorTes',
            'dataPribadi',
            'hasilUjian',
            'daftarUlang',
            'pembayaran',
            'mahasiswaAktif'
        ));
    }
}