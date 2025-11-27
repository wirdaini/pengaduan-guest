<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        // Mendefinisikan kolom yang boleh difilter
        $filterableColumns = [
            'jenis_kelamin', // Harus sesuai dengan name di form
            'pekerjaan',    // Harus sesuai dengan name di form
            'agama'         // Harus sesuai dengan name di form
        ];

        $wargaQuery = Warga::latest();

        // Panggil ::filter (Sesuai Modul)
        $wargaQuery->filter($request, $filterableColumns);

        // Data pendukung untuk dropdown Pekerjaan
        $listPekerjaan = Warga::select('pekerjaan')->distinct()->pluck('pekerjaan');

        // Kolom yang bisa di-search - SESUAI MODUL
        $searchableColumns = ['nama', 'no_ktp', 'email', 'telp']; // cari berdasarkan nama, no KTP, email, telp

        // Query dengan filter DAN search
        $warga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('nama', 'asc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.warga.index', compact('warga', 'request', 'listPekerjaan'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|digits:16|unique:warga',
            'nama'          => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email',
        ]);

        Warga::create([
            'user_id'       => auth()->id() ?? 1,
            'no_ktp'        => $request->no_ktp,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'pekerjaan'     => $request->pekerjaan,
            'telp'          => $request->telp,
            'email'         => $request->email,
        ]);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.show', compact('warga'));
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ktp'        => 'required|digits:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama'          => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diupdate!');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus!');
    }
}
