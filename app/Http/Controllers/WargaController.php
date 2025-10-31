<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        // Validasi data - TAMBAH field yang missing
        $validated = $request->validate([
            'no_ktp'        => 'required|string|size:16|unique:warga',
            'nama'          => 'required|string|max:255',
            'tempat_lahir'  => 'required|string|max:255', // TAMBAH
            'tanggal_lahir' => 'required|date',           // TAMBAH
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required|string|max:255',
            'status'        => 'required|string|max:255', // TAMBAH
            'pekerjaan'     => 'required|string|max:255',
            'telp'          => 'required|string|max:15',
            'email'         => 'nullable|email|max:255',
            'alamat'        => 'required|string',         // TAMBAH
            'rt'            => 'required|string|max:5',   // TAMBAH
            'rw'            => 'required|string|max:5',   // TAMBAH
            'kelurahan'     => 'required|string|max:255', // TAMBAH
            'kecamatan'     => 'required|string|max:255', // TAMBAH
            'kota'          => 'required|string|max:255', // TAMBAH
        ]);

        try {
            // Simpan ke database
            Warga::create($validated);

            return redirect()->route('datawarga.create')
                ->with('success', 'Data warga berhasil disimpan! Sekarang Anda bisa mengajukan pengaduan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
