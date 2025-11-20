<?php
namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->latest()->get(); // TAMBAH with('kategori')
        $dataWarga = Warga::all();
        return view('pages.pengaduan.index', compact('pengaduan', 'dataWarga'));
    }

    public function create()
    {
        $warga    = Warga::all();
        $kategori = KategoriPengaduan::all(); // AMBIL DATA KATEGORI
        return view('pages.pengaduan.create', compact('warga', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required|exists:warga,warga_id',
            'judul'       => 'required',
            'deskripsi'   => 'required',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required',
            'rt'          => 'required',
            'rw'          => 'required',
        ]);

        // Generate nomor tiket otomatis
        $nomor_tiket = 'TKT-' . date('YmdHis') . '-' . rand(100, 999);

        Pengaduan::create([
            'nomor_tiket' => $nomor_tiket,
            'warga_id'    => $request->warga_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'status'      => 'menunggu',
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diajukan! Nomor Tiket: ' . $nomor_tiket);
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id); // with('kategori')
        return view('pages.pengaduan.show', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id); // with('kategori')
        $warga     = Warga::all();
        $kategori  = KategoriPengaduan::all(); // KIRIM DATA KATEGORI
        return view('pages.pengaduan.edit', compact('pengaduan', 'warga', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'       => 'required',
            'deskripsi'   => 'required',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required',
            'rt'          => 'required',
            'rw'          => 'required',
            'status'      => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update($request->all());

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
