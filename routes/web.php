<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterMahasiswaController;
use App\Http\Controllers\Auth\LoginMahasiswaController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LupaNomorTesController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\DataPribadiController;
use App\Http\Controllers\Mahasiswa\UjianController;
use App\Http\Controllers\Mahasiswa\HasilController;
use App\Http\Controllers\Mahasiswa\DaftarUlangController;
use App\Http\Controllers\Mahasiswa\KartuController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CalonMahasiswaController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\KelulusanController;
use App\Http\Controllers\Admin\DaftarUlangController as AdminDaftarUlangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Test Session (hapus setelah selesai debugging)
Route::get('/test-session', function() {
    session(['test' => 'Session bekerja!']);
    return 'Session disimpan: ' . session('test');
});

// ============================================
// HALAMAN PUBLIC
// ============================================
Route::get('/', [HomeController::class, 'beranda'])->name('beranda');
Route::get('/program-studi', [HomeController::class, 'programStudi'])->name('program-studi');
Route::get('/alur', [HomeController::class, 'alur'])->name('alur');
Route::get('/jadwal', [HomeController::class, 'jadwal'])->name('jadwal');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

// ============================================
// AUTH MAHASISWA
// ============================================
Route::prefix('auth')->name('auth.')->group(function () {
    // Register
    Route::get('/register', [RegisterMahasiswaController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterMahasiswaController::class, 'register'])->name('register.post');
    Route::get('/register/success', [RegisterMahasiswaController::class, 'success'])->name('register.success');
    
    // Login Mahasiswa
    Route::get('/login', [LoginMahasiswaController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginMahasiswaController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginMahasiswaController::class, 'logout'])->name('logout');
    
    // Lupa Nomor Tes
    Route::get('/lupa-nomor-tes', [LupaNomorTesController::class, 'showForm'])->name('lupa-nomor-tes');
    Route::post('/lupa-nomor-tes/cari', [LupaNomorTesController::class, 'cari'])->name('lupa-nomor-tes.cari');
});

// ============================================
// LOGIN ADMIN (TERPISAH)
// ============================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginAdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginAdminController::class, 'login'])->name('login.post');
    Route::post('/', [LoginAdminController::class, 'logout'])->name('logout');
});

// ============================================
// MAHASISWA AREA (HARUS LOGIN)
// ============================================
Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth:web')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    
    // Data Pribadi
    Route::get('/data-pribadi', [DataPribadiController::class, 'index'])->name('data-pribadi');
    Route::post('/data-pribadi', [DataPribadiController::class, 'store'])->name('data-pribadi.store');
    Route::put('/data-pribadi', [DataPribadiController::class, 'update'])->name('data-pribadi.update');
    
    // Ujian
    Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');
    Route::post('/ujian/mulai', [UjianController::class, 'mulai'])->name('ujian.mulai');
    Route::post('/ujian/simpan-jawaban', [UjianController::class, 'simpanJawaban'])->name('ujian.simpan-jawaban');
    Route::post('/ujian/submit', [UjianController::class, 'submit'])->name('ujian.submit');
    Route::post('/ujian/cek-waktu', [UjianController::class, 'cekWaktu'])->name('ujian.cek-waktu');
    
    // Hasil
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
    
    // Daftar Ulang
    Route::get('/daftar-ulang', [DaftarUlangController::class, 'index'])->name('daftar-ulang.index');
    Route::post('/daftar-ulang/berkas', [DaftarUlangController::class, 'storeBerkas'])->name('daftar-ulang.berkas');
    Route::post('/daftar-ulang/pembayaran', [DaftarUlangController::class, 'storePembayaran'])->name('daftar-ulang.pembayaran');
    
    // Kartu Mahasiswa
    Route::get('/kartu', [KartuController::class, 'index'])->name('kartu');
    Route::get('/kartu/cetak', [KartuController::class, 'cetak'])->name('kartu.cetak');
});

// ============================================
// ADMIN AREA (HARUS LOGIN ADMIN)
// ============================================
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Calon Mahasiswa
    Route::get('/calon-mahasiswa', [CalonMahasiswaController::class, 'index'])->name('calon-mahasiswa.index');
    Route::get('/calon-mahasiswa/create', [CalonMahasiswaController::class, 'create'])->name('calon-mahasiswa.create');
    Route::post('/calon-mahasiswa', [CalonMahasiswaController::class, 'store'])->name('calon-mahasiswa.store');
    Route::get('/calon-mahasiswa/{id}', [CalonMahasiswaController::class, 'show'])->name('calon-mahasiswa.show');
    Route::get('/calon-mahasiswa/{id}/edit', [CalonMahasiswaController::class, 'edit'])->name('calon-mahasiswa.edit');
    Route::put('/calon-mahasiswa/{id}', [CalonMahasiswaController::class, 'update'])->name('calon-mahasiswa.update');
    Route::delete('/calon-mahasiswa/{id}', [CalonMahasiswaController::class, 'destroy'])->name('calon-mahasiswa.destroy');
    Route::post('/calon-mahasiswa/{id}/reset-password', [CalonMahasiswaController::class, 'resetPassword'])->name('calon-mahasiswa.reset-password');
    
    // Soal
    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::get('/soal/{id}/edit', [SoalController::class, 'edit'])->name('soal.edit');
    Route::put('/soal/{id}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');
    Route::get('/soal/import', [SoalController::class, 'importForm'])->name('soal.import-form');
    Route::post('/soal/import', [SoalController::class, 'import'])->name('soal.import');
    
    // Kelulusan
    Route::get('/kelulusan', [KelulusanController::class, 'index'])->name('kelulusan.index');
    Route::get('/kelulusan/{id}', [KelulusanController::class, 'show'])->name('kelulusan.show');
    Route::post('/kelulusan/{id}/accept', [KelulusanController::class, 'accept'])->name('kelulusan.accept');
    Route::post('/kelulusan/{id}/reject', [KelulusanController::class, 'reject'])->name('kelulusan.reject');
    Route::post('/kelulusan/batch/accept', [KelulusanController::class, 'batchAccept'])->name('kelulusan.batch.accept');
    Route::post('/kelulusan/batch/reject', [KelulusanController::class, 'batchReject'])->name('kelulusan.batch.reject');
    Route::post('/kelulusan/{id}/ubah-status', [KelulusanController::class, 'ubahStatus'])->name('kelulusan.ubah-status');
    
    // Daftar Ulang
    Route::get('/daftar-ulang', [AdminDaftarUlangController::class, 'index'])->name('daftar-ulang.index');
    Route::get('/daftar-ulang/{id}', [AdminDaftarUlangController::class, 'show'])->name('daftar-ulang.show');
    Route::post('/daftar-ulang/{id}/accept', [AdminDaftarUlangController::class, 'accept'])->name('daftar-ulang.accept');
    Route::post('/daftar-ulang/{id}/reject', [AdminDaftarUlangController::class, 'reject'])->name('daftar-ulang.reject');
    Route::post('/daftar-ulang/batch/accept', [AdminDaftarUlangController::class, 'batchAccept'])->name('daftar-ulang.batch.accept');
    Route::get('/daftar-ulang/download/{type}/{id}', [AdminDaftarUlangController::class, 'downloadFile'])->name('daftar-ulang.download');
});