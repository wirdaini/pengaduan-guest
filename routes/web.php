<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormPengaduanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formpengaduan', [FormPengaduanController::class, 'index']);

