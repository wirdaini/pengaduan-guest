<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenilaianLayananController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', [DashboardController::class, 'index'])->name('home');

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
        // User Management - HANYA ADMIN
        Route::resource('user', UserController::class);

        // Warga Management - HANYA ADMIN
        Route::resource('warga', WargaController::class);

        // Kategori Pengaduan - HANYA ADMIN
        Route::resource('kategori_pengaduan', KategoriPengaduanController::class);
    });

    // ========== ROUTES UNTUK ADMIN & PETUGAS ==========
    Route::middleware(['checkrole:admin,petugas'])->group(function () {
        // Tindak Lanjut - ADMIN & PETUGAS
        Route::resource('tindak_lanjut', TindakLanjutController::class);
        Route::delete('/tindak_lanjut/{tindak_id}/media/{media_id}',
            [TindakLanjutController::class, 'destroyMedia'])->name('tindak_lanjut.destroy.media');
        Route::get('/tindak_lanjut/{tindak_id}/media/{media_id}/download',
            [TindakLanjutController::class, 'downloadMedia'])->name('tindak_lanjut.download.media');
    });

    // ========== PENGADUAN - LOGIKA BERBEDA BERDASARKAN ROLE ==========
    // Semua role bisa akses, tapi data yang ditampilkan berbeda di Controller
    Route::middleware(['checkrole:admin,petugas,warga'])->group(function () {
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');

        // Edit/Update/Delete hanya untuk pemilik pengaduan (warga) atau admin/petugas
        Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // File management pengaduan
        Route::delete('/pengaduan/{pengaduan_id}/media/{media_id}',
            [PengaduanController::class, 'destroyMedia'])->name('pengaduan.destroy.media');
        Route::get('/pengaduan/{pengaduan_id}/media/{media_id}/download',
            [PengaduanController::class, 'downloadMedia'])->name('pengaduan.download.media');
    });

    // ========== PENILAIAN LAYANAN ==========
    Route::middleware(['checkrole:admin,petugas,warga'])->group(function () {
        Route::resource('penilaian_layanan', PenilaianLayananController::class);
        Route::get('/penilaian/pengaduan/{pengaduan_id}', [PenilaianLayananController::class, 'createByPengaduan'])
            ->name('penilaian_layanan.create_by_pengaduan');
    });


    // ========== ROUTES KHUSUS WARGA ==========
    Route::middleware(['checkrole:warga'])->group(function () {
        // Pengaduan Saya - halaman khusus untuk warga melihat pengaduan mereka
        Route::get('/pengaduan-saya', [PengaduanController::class, 'pengaduanSaya'])->name('pengaduan.saya');

        // Beri penilaian untuk pengaduan yang selesai
        Route::post('/pengaduan/{id}/penilaian', [PengaduanController::class, 'beriPenilaian'])
            ->name('pengaduan.penilaian');
    });
});
