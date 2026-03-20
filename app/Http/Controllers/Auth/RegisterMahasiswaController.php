<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\NomorTes;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterMahasiswaController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function showRegistrationForm()
    {
        $programStudi = ProgramStudi::all();
        return view('auth.register', compact('programStudi'));
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'program_studi_id' => 'required|exists:program_studis,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Gunakan DB transaction untuk memastikan kedua tabel terisi
        DB::beginTransaction();
        
        try {
            // Simpan user baru
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'program_studi_id' => $request->program_studi_id,
                'password' => Hash::make($request->password),
            ]);

            // Generate nomor tes
            $tahun = date('Y');
            $nomorTes = 'ITECH-' . $tahun . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT);
            
            NomorTes::create([
                'user_id' => $user->id,
                'nomor_tes' => $nomorTes,
                'is_active' => true,
            ]);

            DB::commit();

            // Redirect ke halaman sukses dengan nomor tes
            return redirect()->route('auth.register.success', ['nomor_tes' => $nomorTes]);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            
            // TAMPILKAN ERROR DETAIL QUERY
            dd('QueryException: ' . $e->getMessage());
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // TAMPILKAN ERROR DETAIL
            dd('Exception: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman sukses registrasi dengan nomor tes
     */
    public function success(Request $request)
    {
        $nomorTes = $request->get('nomor_tes');
        
        if (!$nomorTes) {
            return redirect()->route('auth.register')
                ->with('error', 'Nomor tes tidak ditemukan');
        }

        // Ambil data user berdasarkan nomor tes
        $nomorTesModel = NomorTes::with('user.programStudi')
                                 ->where('nomor_tes', $nomorTes)
                                 ->first();

        if (!$nomorTesModel) {
            return redirect()->route('auth.register')
                ->with('error', 'Data user tidak ditemukan');
        }

        $user = $nomorTesModel->user;

        return view('auth.nomor-tes', compact('nomorTes', 'user'));
    }
}