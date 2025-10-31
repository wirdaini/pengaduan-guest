<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormPengaduanController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;

Route::get('/', function () {
    return view('guest/index');
});

Route::get('/', function () {
    return view('dashboard'); });

Route::get('/formpengaduan', [FormPengaduanController::class, 'index']);

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD ROUTE
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');

// Routes untuk Data Warga
Route::get('/data-warga/create', [WargaController::class, 'create'])->name('datawarga.create');
Route::post('/data-warga', [WargaController::class, 'store'])->name('datawarga.store');

Route::get('/pengaduan/create', function () {
    return view('pengaduan.formpengaduan');
})->name('pengaduan.create');

Route::get('/about', function () {
    return view('guest.about');
})->name('about');
