<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KartuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan kartu mahasiswa
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah sudah menjadi mahasiswa aktif
        $mahasiswaAktif = $user->mahasiswaAktif;

        if (!$mahasiswaAktif) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum terdaftar sebagai mahasiswa aktif');
        }

        // Ambil data yang diperlukan
        $nim = $mahasiswaAktif->nim;
        $nama = $user->nama_lengkap;
        $programStudi = $user->programStudi->nama_prodi ?? '-';
        $tahunMasuk = $mahasiswaAktif->tahun_masuk;
        $masaBerlaku = ($tahunMasuk + 4) . '';
        
        // Ambil pas foto dari mahasiswa aktif atau daftar ulang
        $pasFoto = null;
        if ($mahasiswaAktif->pas_foto) {
            $pasFoto = $mahasiswaAktif->pas_foto;
        } elseif ($user->daftarUlang && $user->daftarUlang->pas_foto) {
            $pasFoto = $user->daftarUlang->pas_foto;
        }
        
        // Data untuk QR Code (bisa dikosongkan jika tidak dipakai)
        $qrCode = null;

        return view('mahasiswa.kartu', compact(
            'nim',
            'nama',
            'programStudi',
            'tahunMasuk',
            'masaBerlaku',
            'pasFoto',
            'qrCode',
            'user'
        ));
    }

    /**
     * Halaman cetak kartu
     */
    public function cetak()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('auth.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $mahasiswaAktif = $user->mahasiswaAktif;

        if (!$mahasiswaAktif) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum terdaftar sebagai mahasiswa aktif');
        }

        $nim = $mahasiswaAktif->nim;
        $nama = $user->nama_lengkap;
        $programStudi = $user->programStudi->nama_prodi ?? '-';
        $tahunMasuk = $mahasiswaAktif->tahun_masuk;
        $masaBerlaku = ($tahunMasuk + 4) . '';
        
        $pasFoto = null;
        if ($mahasiswaAktif->pas_foto) {
            $pasFoto = $mahasiswaAktif->pas_foto;
        } elseif ($user->daftarUlang && $user->daftarUlang->pas_foto) {
            $pasFoto = $user->daftarUlang->pas_foto;
        }

        return view('mahasiswa.kartu-cetak', compact(
            'nim',
            'nama',
            'programStudi',
            'tahunMasuk',
            'masaBerlaku',
            'pasFoto'
        ));
    }
}