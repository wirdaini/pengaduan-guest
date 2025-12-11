<?php

namespace App\Http\Controllers;

use App\Models\PenilaianLayanan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PenilaianLayananController extends Controller
{
    /**
     * Menampilkan semua penilaian layanan
     */
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['rating'];

        // Kolom yang bisa di-search
        $searchableColumns = ['komentar'];

        // Query dengan scope filter DAN search
        $penilaian = PenilaianLayanan::with(['pengaduan', 'pengaduan.warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.penilaian_layanan.index', compact('penilaian'));
    }

    /**
     * Menampilkan form untuk membuat penilaian baru
     */
    public function create()
    {
        // Ambil pengaduan yang sudah selesai dan belum dinilai
        $pengaduan = Pengaduan::where('status', 'selesai')
            ->whereDoesntHave('penilaian') // Hanya yang belum dinilai
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.penilaian_layanan.create', compact('pengaduan'));
    }

    /**
     * Menyimpan penilaian baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id|unique:penilaian_layanan,pengaduan_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        // Cek apakah pengaduan sudah selesai
        $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);
        if ($pengaduan->status !== 'selesai') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Hanya pengaduan dengan status "Selesai" yang dapat dinilai.');
        }

        PenilaianLayanan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('penilaian_layanan.index')
            ->with('success', 'Penilaian berhasil disimpan! Terima kasih atas feedback Anda.');
    }

    /**
     * Menampilkan detail penilaian
     */
    public function show($id)
    {
        $penilaian = PenilaianLayanan::with(['pengaduan', 'pengaduan.warga'])->findOrFail($id);
        return view('pages.penilaian_layanan.show', compact('penilaian'));
    }

    /**
     * Menampilkan form edit penilaian
     */
    public function edit($id)
    {
        $penilaian = PenilaianLayanan::with(['pengaduan'])->findOrFail($id);

        // Hanya boleh edit dalam waktu 24 jam
        $waktuBuat = $penilaian->created_at;
        $batasWaktu = now()->subHours(24);

        if ($waktuBuat < $batasWaktu) {
            return redirect()->route('penilaian_layanan.show', $id)
                ->with('error', 'Penilaian hanya dapat diedit dalam 24 jam setelah dibuat.');
        }

        return view('pages.penilaian_layanan.edit', compact('penilaian'));
    }

    /**
     * Mengupdate penilaian
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        $penilaian = PenilaianLayanan::findOrFail($id);

        // Cek batas waktu edit
        $waktuBuat = $penilaian->created_at;
        $batasWaktu = now()->subHours(24);

        if ($waktuBuat < $batasWaktu) {
            return redirect()->route('penilaian_layanan.show', $id)
                ->with('error', 'Penilaian hanya dapat diedit dalam 24 jam setelah dibuat.');
        }

        $penilaian->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('penilaian_layanan.index')
            ->with('success', 'Penilaian berhasil diupdate!');
    }

    /**
     * Menghapus penilaian
     */
    public function destroy($id)
    {
        $penilaian = PenilaianLayanan::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian_layanan.index')
            ->with('success', 'Penilaian berhasil dihapus!');
    }

    /**
     * Form penilaian khusus untuk guest berdasarkan pengaduan tertentu
     */
    public function createByPengaduan($pengaduan_id)
    {
        $pengaduan = Pengaduan::with(['warga'])->findOrFail($pengaduan_id);

        // Cek apakah pengaduan sudah selesai
        if ($pengaduan->status !== 'selesai') {
            return redirect()->back()
                ->with('error', 'Pengaduan ini belum selesai. Anda hanya dapat menilai pengaduan yang sudah selesai.');
        }

        // Cek apakah sudah ada penilaian
        if ($pengaduan->penilaian) {
            return redirect()->route('penilaian_layanan.show', $pengaduan->penilaian->penilaian_id)
                ->with('info', 'Anda sudah memberikan penilaian untuk pengaduan ini.');
        }

        return view('pages.penilaian_layanan.create_by_pengaduan', compact('pengaduan'));
    }
}
