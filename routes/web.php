<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormPengaduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('guest/index');
});

Route::get('/formpengaduan', [FormPengaduanController::class, 'index']);

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD ROUTE
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');

// Routes sementara untuk testing
Route::get('/data-warga/create', function () {
    return view('warga.create');
})->name('datawarga.create');

Route::get('/pengaduan/create', function () {
    return view('pengaduan.formpengaduan'); // Arahkan ke file yang sudah ada
})->name('pengaduan.create');
