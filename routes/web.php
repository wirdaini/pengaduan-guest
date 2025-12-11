<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenilaianLayananController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('pages.home.landing');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Pages
Route::get('/about', function () {
    return view('pages.home.about');
})->name('about');
Route::get('/services', function () {
    return view('pages.home.services');
})->name('services');
Route::get('/contact', function () {
    return view('pages.home.contact');
})->name('contact');

// ==================== PROTECTED ROUTES (HARUS LOGIN) ====================
Route::middleware(['checkislogin'])->group(function () {

    // ========== DASHBOARD UNTUK SEMUA ROLE ==========
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========== ROUTES KHUSUS ADMIN ==========
    Route::middleware(['checkrole:admin'])->group(function () {
        // User Management
        Route::resource('user', UserController::class);

        // Warga Management
        Route::resource('warga', WargaController::class);

        // Kategori Pengaduan
        Route::resource('kategori_pengaduan', KategoriPengaduanController::class);
    });

    // ========== ROUTES UNTUK ADMIN & PETUGAS ==========
    Route::middleware(['checkrole:admin,petugas'])->group(function () {
        // Tindak Lanjut
        Route::resource('tindak_lanjut', TindakLanjutController::class);
        Route::delete('/tindak_lanjut/{tindak_id}/media/{media_id}',
            [TindakLanjutController::class, 'destroyMedia'])->name('tindak_lanjut.destroy.media');
        Route::get('/tindak_lanjut/{tindak_id}/media/{media_id}/download',
            [TindakLanjutController::class, 'downloadMedia'])->name('tindak_lanjut.download.media');
    });

    // ========== ROUTES UNTUK SEMUA YANG LOGIN ==========
    Route::middleware(['checkrole:admin,petugas,warga'])->group(function () {
        // PENGADUAN - dengan pembatasan di Controller
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');

        // EDIT/UPDATE/DELETE - khusus pengaduan status "baru"
        Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // File management pengaduan
        Route::delete('/pengaduan/{pengaduan_id}/media/{media_id}',
            [PengaduanController::class, 'destroyMedia'])->name('pengaduan.destroy.media');
        Route::get('/pengaduan/{pengaduan_id}/media/{media_id}/download',
            [PengaduanController::class, 'downloadMedia'])->name('pengaduan.download.media');

        // PENILAIAN LAYANAN
        Route::resource('penilaian_layanan', PenilaianLayananController::class);
        Route::get('/penilaian/pengaduan/{pengaduan_id}', [PenilaianLayananController::class, 'createByPengaduan'])
            ->name('penilaian_layanan.create_by_pengaduan');

        // PROFIL USER
        Route::get('/profil', [UserController::class, 'profil'])->name('profil');
        Route::put('/profil', [UserController::class, 'updateProfil'])->name('profil.update');
    });

    // ========== ROUTES KHUSUS WARGA ==========
    Route::middleware(['checkrole:warga'])->group(function () {
        // Pengaduan Saya
        Route::get('/pengaduan-saya', [PengaduanController::class, 'pengaduanSaya'])->name('pengaduan.saya');

        // Beri Penilaian untuk pengaduan selesai
        Route::post('/pengaduan/{id}/penilaian', [PengaduanController::class, 'beriPenilaian'])->name('pengaduan.penilaian');
    });
});
