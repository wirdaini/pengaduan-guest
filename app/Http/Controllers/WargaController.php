<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'no_ktp' => 'required|string|size:16|unique:warga',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        try {
            // Simpan ke database
            Warga::create($validated);

            return redirect()->route('warga.create')
                ->with('success', 'Data warga berhasil disimpan! Sekarang Anda bisa mengajukan pengaduan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
