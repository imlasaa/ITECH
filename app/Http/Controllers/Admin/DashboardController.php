<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HasilUjian;
use App\Models\DaftarUlang;
use App\Models\Pembayaran;
use App\Models\MahasiswaAktif;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Tampilkan dashboard admin dengan data real
     */
    public function index()
    {
        // Statistik Utama
        $totalPendaftar = User::count();
        $totalLulus = HasilUjian::where('status', 'lulus')->count();
        $totalTidakLulus = HasilUjian::where('status', 'tidak_lulus')->count();
        $totalPending = HasilUjian::where('status', 'belum_dinilai')->count();
        
        // Statistik Daftar Ulang
        $daftarUlangPending = DaftarUlang::where('status_berkas', 'pending')->count();
        $daftarUlangDiterima = DaftarUlang::where('status_berkas', 'diterima')->count();
        $daftarUlangDitolak = DaftarUlang::where('status_berkas', 'ditolak')->count();
        
        // Statistik Pembayaran
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();
        $pembayaranDiterima = Pembayaran::where('status', 'diterima')->count();
        $pembayaranDitolak = Pembayaran::where('status', 'ditolak')->count();
        
        // Mahasiswa Aktif
        $mahasiswaAktif = MahasiswaAktif::count();
        
        // Pendaftar per Program Studi
        $pendaftarPerProdi = ProgramStudi::withCount('users')->get();
        
        // Pendaftar Terbaru (5 data terakhir)
        $pendaftarTerbaru = User::with(['programStudi', 'hasilUjian', 'nomorTes'])
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'totalLulus',
            'totalTidakLulus',
            'totalPending',
            'daftarUlangPending',
            'daftarUlangDiterima',
            'daftarUlangDitolak',
            'pembayaranPending',
            'pembayaranDiterima',
            'pembayaranDitolak',
            'mahasiswaAktif',
            'pendaftarPerProdi',
            'pendaftarTerbaru'
        ));
    }
}