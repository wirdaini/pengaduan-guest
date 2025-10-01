<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormPengaduanController extends Controller
{
    public function index()
    {
        // contoh data dummy (nanti bisa diambil dari DB)
        $kategori = [
            ['id' => 1, 'nama' => 'Fasilitas Umum'],
            ['id' => 2, 'nama' => 'Lingkungan'],
            ['id' => 3, 'nama' => 'Lain-lain'],
        ];

        $judul = "Form Pengaduan Warga";

        // karena file view langsung formpengaduan.blade.php
        return view('formpengaduan', compact('judul', 'kategori'));
    }
}
