<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriPengaduanController;

Route::get('/', function () {
    return view('pages.home.landing');
})->name('home');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// // Logout Route
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/about', function () {
    return view('pages.home.about');
})->name('about');

Route::get('/services', function () {
    return view('pages.home.services');
})->name('services');

Route::get('/contact', function () {
    return view('pages.home.contact');
})->name('contact');

// Route Warga
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{warga}', [WargaController::class, 'show'])->name('warga.show');
Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

// Route Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

// Route User
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

// Kategori Pengaduan
Route::get('/kategori_pengaduan', [KategoriPengaduanController::class, 'index'])->name('kategori_pengaduan.index');
Route::get('/kategori_pengaduan/create', [KategoriPengaduanController::class, 'create'])->name('kategori_pengaduan.create');
Route::post('/kategori_pengaduan', [KategoriPengaduanController::class, 'store'])->name('kategori_pengaduan.store');
Route::get('/kategori_pengaduan/{kategori_pengaduan}', [KategoriPengaduanController::class, 'show'])->name('kategori_pengaduan.show');
Route::get('/kategori_pengaduan/{kategori_pengaduan}/edit', [KategoriPengaduanController::class, 'edit'])->name('kategori_pengaduan.edit');
Route::put('/kategori_pengaduan/{kategori_pengaduan}', [KategoriPengaduanController::class, 'update'])->name('kategori_pengaduan.update');
Route::delete('/kategori_pengaduan/{kategori_pengaduan}', [KategoriPengaduanController::class, 'destroy'])->name('kategori_pengaduan.destroy');
