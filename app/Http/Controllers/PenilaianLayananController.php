<?php

namespace App\Http\Controllers;

use App\Models\PenilaianLayanan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianLayananController extends Controller
{
    /**
     * Menampilkan semua penilaian layanan
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Kolom yang bisa di-filter
        $filterableColumns = ['rating'];

        // Kolom yang bisa di-search
        $searchableColumns = ['komentar'];

        // Query dengan scope filter DAN search
        $query = PenilaianLayanan::with(['pengaduan', 'pengaduan.warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc');

        // ========== TAMBAH FILTER BERDASARKAN ROLE ==========
        if ($user->role == 'warga') {
            // WARGA: hanya lihat penilaian untuk pengaduan mereka sendiri
            $warga = $user->warga;

            if ($warga) {
                $query->whereHas('pengaduan', function($q) use ($warga) {
                    $q->where('warga_id', $warga->warga_id);
                });
            } else {
                $query->where('id', 0); // Kosongkan hasil jika tidak ada data warga
            }
        }
        // Admin & petugas lihat semua

        $penilaian = $query->paginate(16)->withQueryString();

        return view('pages.penilaian_layanan.index', compact('penilaian'));
    }

    /**
     * Menampilkan form untuk membuat penilaian baru
     */
    public function create()
    {
        $user = Auth::user();

        // ========== TAMBAH VALIDASI ROLE ==========
        if ($user->role == 'warga') {
            // WARGA: hanya bisa beri penilaian untuk pengaduan mereka sendiri
            $warga = $user->warga;

            if (!$warga) {
                abort(403, 'Data warga tidak ditemukan. Hubungi admin.');
            }

            // Ambil pengaduan warga yang selesai dan belum dinilai
            $pengaduan = Pengaduan::where('status', 'selesai')
                ->where('warga_id', $warga->warga_id)
                ->whereDoesntHave('penilaian')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // ADMIN/PETUGAS: bisa pilih semua pengaduan selesai
            $pengaduan = Pengaduan::where('status', 'selesai')
                ->whereDoesntHave('penilaian')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.penilaian_layanan.create', compact('pengaduan'));
    }

    /**
     * Menyimpan penilaian baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();

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

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa memberi penilaian untuk pengaduan Anda sendiri');
            }
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
        $user = Auth::user();

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $penilaian->pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa melihat penilaian untuk pengaduan Anda sendiri');
            }
        }

        return view('pages.penilaian_layanan.show', compact('penilaian'));
    }

    /**
     * Menampilkan form edit penilaian
     */
    public function edit($id)
    {
        $penilaian = PenilaianLayanan::with(['pengaduan'])->findOrFail($id);
        $user = Auth::user();

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $penilaian->pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa mengedit penilaian untuk pengaduan Anda sendiri');
            }
        }

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
        $user = Auth::user();

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $penilaian->pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate penilaian untuk pengaduan Anda sendiri');
            }
        }

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
        $user = Auth::user();

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $penilaian->pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa menghapus penilaian untuk pengaduan Anda sendiri');
            }
        }

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
        $user = Auth::user();

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (!$warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa memberi penilaian untuk pengaduan Anda sendiri');
            }
        }

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
