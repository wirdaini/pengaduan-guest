<?php
namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter (sesuai dengan form)
        $filterableColumns = ['prioritas', 'sla_hari'];

        // Kolom yang bisa di-search
        $searchableColumns = ['nama', 'prioritas', 'sla_hari']; 

        // Query dengan filter DAN search
        $kategoris = KategoriPengaduan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.kategori_pengaduan.index', compact('kategoris'));
    }

    public function create()
    {
        return view('pages.kategori_pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'sla_hari'  => 'required|integer|min:1',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi,Kritis',
        ]);

        KategoriPengaduan::create($request->all());

        return redirect()->route('kategori_pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('pages.kategori_pengaduan.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        return view('pages.kategori_pengaduan.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'sla_hari'  => 'required|integer|min:1',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi,Kritis',
        ]);

        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori_pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori_pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil dihapus!');
    }
}
