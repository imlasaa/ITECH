<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\SoalUjian;
use App\Models\HasilUjian;
use App\Models\JawabanUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman informasi ujian
     */
    public function index()
    {
        $user = Auth::user();

        // Cek apakah sudah punya data pribadi
        if (!$user->dataPribadi) {
            return redirect()->route('mahasiswa.data-pribadi')
                ->with('error', 'Anda harus mengisi data pribadi terlebih dahulu');
        }

        // Cek apakah sudah pernah ujian
        $hasilUjian = $user->hasilUjian;
        if ($hasilUjian && $hasilUjian->status != 'belum_dinilai') {
            return redirect()->route('mahasiswa.hasil')
                ->with('info', 'Anda sudah melakukan ujian');
        }

        $totalSoal = SoalUjian::count();
        $durasi = 30; // menit
        
        // Ambil data user untuk ditampilkan
        $nomorTes = $user->nomorTes->nomor_tes ?? '-';
        $programStudi = $user->programStudi->nama_prodi ?? '-';

        return view('mahasiswa.ujian.index', compact('totalSoal', 'durasi', 'nomorTes', 'programStudi'));
    }

    /**
     * Mulai ujian (ambil soal)
     */
 

public function mulai(Request $request)
{
    $user = Auth::user();

    // Cek apakah sudah pernah ujian
    $existingHasil = $user->hasilUjian;
    if ($existingHasil && $existingHasil->status != 'belum_dinilai') {
        return redirect()->route('mahasiswa.hasil')
            ->with('info', 'Anda sudah melakukan ujian');
    }

    // Ambil semua soal secara acak
    $soals = SoalUjian::inRandomOrder()->get();

    if ($soals->isEmpty()) {
        return redirect()->route('mahasiswa.ujian.index')
            ->with('error', 'Soal ujian belum tersedia');
    }

    // Hapus jawaban lama jika ada
    JawabanUjian::where('user_id', $user->id)->delete();
    if ($existingHasil) {
        $existingHasil->delete();
    }

    // Simpan hasil ujian baru
    $hasilUjian = HasilUjian::create([
        'user_id' => $user->id,
        'total_soal' => $soals->count(),
        'jawaban_benar' => 0,
        'jawaban_salah' => 0,
        'nilai' => 0,
        'status' => 'belum_dinilai',
        'waktu_mulai' => Carbon::now(),
        'waktu_selesai' => Carbon::now()->addMinutes(30)
    ]);

    // Simpan jawaban kosong untuk setiap soal
    foreach ($soals as $soal) {
        JawabanUjian::create([
            'user_id' => $user->id,
            'soal_ujian_id' => $soal->id,
            'jawaban' => null,
            'is_correct' => false
        ]);
    }

    // Redirect ke halaman soal dengan data
    return view('mahasiswa.ujian.soal', [
        'soals' => $soals,
        'totalSoal' => $soals->count(),
        'waktuSelesai' => $hasilUjian->waktu_selesai->timestamp,
        'nomorTes' => $user->nomorTes->nomor_tes ?? '-'
    ]);

        return response()->json([
            'success' => true,
            'soals' => $soalList,
            'waktu_selesai' => $hasilUjian->waktu_selesai->timestamp,
            'durasi' => 30
        ]);
    }

    /**
     * Simpan jawaban per soal (via AJAX)
     */
    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'soal_id' => 'required|exists:soal_ujian,id',
            'jawaban' => 'required|in:a,b,c,d,e'
        ]);

        $user = Auth::user();

        $jawaban = JawabanUjian::where('user_id', $user->id)
            ->where('soal_ujian_id', $request->soal_id)
            ->first();

        if (!$jawaban) {
            return response()->json([
                'success' => false,
                'message' => 'Soal tidak ditemukan'
            ]);
        }

        $soal = SoalUjian::find($request->soal_id);
        $isCorrect = ($request->jawaban == $soal->kunci_jawaban);

        $jawaban->update([
            'jawaban' => $request->jawaban,
            'is_correct' => $isCorrect
        ]);

        return response()->json([
            'success' => true,
            'is_correct' => $isCorrect
        ]);
    }

/**
 * Akhiri ujian dan hitung hasil (TANPA STATUS LULUS)
 */
public function submit(Request $request)
{
    $user = Auth::user();

    $jawabans = JawabanUjian::where('user_id', $user->id)->get();

    if ($jawabans->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada data ujian'
        ]);
    }

    $benar = $jawabans->where('is_correct', true)->count();
    $salah = $jawabans->where('is_correct', false)->whereNotNull('jawaban')->count();
    $total = $jawabans->count();
    $tidakDijawab = $total - ($benar + $salah);

    // Hitung nilai
    $nilai = ($benar / $total) * 100;
    
    // HAPUS PENENTUAN STATUS - SET JADI 'belum_dinilai'
    $status = 'belum_dinilai';

    $hasilUjian = $user->hasilUjian;
    if ($hasilUjian) {
        $hasilUjian->update([
            'jawaban_benar' => $benar,
            'jawaban_salah' => $salah,
            'nilai' => round($nilai, 2),
            'status' => $status,
            'waktu_selesai' => Carbon::now()
        ]);
    }

    return response()->json([
        'success' => true,
        'benar' => $benar,
        'salah' => $salah,
        'tidak_dijawab' => $tidakDijawab,
        'total' => $total,
        'status' => $status,
        'nilai' => round($nilai, 2)
    ]);
}

    /**
     * Cek sisa waktu (via AJAX)
     */
    public function cekWaktu()
    {
        $user = Auth::user();
        $hasilUjian = $user->hasilUjian;

        if (!$hasilUjian || $hasilUjian->status != 'belum_dinilai') {
            return response()->json([
                'success' => false,
                'message' => 'Ujian tidak aktif'
            ]);
        }

        $waktuSelesai = Carbon::parse($hasilUjian->waktu_selesai);
        $sisaDetik = Carbon::now()->diffInSeconds($waktuSelesai, false);

        if ($sisaDetik <= 0) {
            // Waktu habis, auto submit
            $this->submit(new Request());
            return response()->json([
                'success' => false,
                'waktu_habis' => true,
                'message' => 'Waktu ujian telah habis'
            ]);
        }

        return response()->json([
            'success' => true,
            'sisa_detik' => $sisaDetik
        ]);
    }
}