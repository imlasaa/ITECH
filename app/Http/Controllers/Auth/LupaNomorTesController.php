<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NomorTes;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LupaNomorTesController extends Controller
{
    /**
     * Tampilkan halaman lupa nomor tes
     */
    public function showForm()
    {
        $programStudi = ProgramStudi::all();
        return view('auth.lupa-nomor-tes', compact('programStudi'));
    }

    /**
     * Cari nomor tes berdasarkan data registrasi
     */
    public function cari(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'program_studi_id' => 'required|exists:program_studis,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari user berdasarkan data
        $user = User::where('nama_lengkap', $request->nama_lengkap)
            ->where('email', $request->email)
            ->where('program_studi_id', $request->program_studi_id)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan. Pastikan nama, email, dan program studi sesuai.')
                ->withInput();
        }

        // Verifikasi password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password salah')
                ->withInput();
        }

        // Ambil nomor tes
        $nomorTes = NomorTes::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();

        if (!$nomorTes) {
            return redirect()->back()
                ->with('error', 'Nomor tes tidak ditemukan')
                ->withInput();
        }

        // Tampilkan hasil
        return redirect()->back()->with([
            'success' => 'Nomor tes ditemukan!',
            'nomor_tes' => $nomorTes->nomor_tes,
            'nama' => $user->nama_lengkap,
            'prodi' => $user->programStudi->nama_prodi,
        ]);
    }
}