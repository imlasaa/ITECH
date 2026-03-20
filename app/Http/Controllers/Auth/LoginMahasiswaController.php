<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NomorTes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginMahasiswaController extends Controller
{
    /**
     * Tampilkan halaman login mahasiswa
     */
    public function showLoginForm()
    {
        return view('auth.login-mahasiswa');
    }

    /**
     * Proses login mahasiswa
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nomor_tes' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari nomor tes
        $nomorTes = NomorTes::where('nomor_tes', $request->nomor_tes)
            ->where('is_active', true)
            ->first();

        if (!$nomorTes) {
            return redirect()->back()
                ->with('error', 'Nomor tes tidak ditemukan atau tidak aktif')
                ->withInput();
        }

        // Cari user dan cek password
        $user = User::find($nomorTes->user_id);
        
        if (!$user || !Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return redirect()->back()
                ->with('error', 'Password salah')
                ->withInput();
        }

        // Login sukses
        return redirect()->intended('/mahasiswa/dashboard');
    }

    /**
     * Logout mahasiswa - redirect ke halaman utama (beranda)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman utama (beranda)
        return redirect('/');
    }
}