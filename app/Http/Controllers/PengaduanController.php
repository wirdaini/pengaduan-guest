<?php
namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Media;
use App\Models\Pengaduan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        // ========== TAMBAH VALIDASI ROLE ==========
        $user = Auth::user();

        $kategories = KategoriPengaduan::all();

        $filterableColumns = ['status', 'kategori_id', 'rt', 'rw'];
        $searchableColumns = ['judul', 'deskripsi', 'nomor_tiket', 'lokasi_text'];

        // Query dasar
        $query = Pengaduan::with(['kategori', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc');

        // ========== FILTER BERDASARKAN ROLE ==========
        if ($user->role == 'warga') {
            // WARGA: hanya lihat pengaduan mereka sendiri
            $query->where('warga_id', $user->id);
        }
        // Admin & petugas lihat semua (tidak perlu filter)

        $pengaduan = $query->paginate(9)->withQueryString();

        return view('pages.pengaduan.index', compact('pengaduan', 'kategories'));
    }

    public function create()
    {
        $warga    = Warga::all();
        $kategori = KategoriPengaduan::all();
        return view('pages.pengaduan.create', compact('warga', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required|exists:warga,warga_id',
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|string|max:10',
            'rw'          => 'required|string|max:10',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240', // 10MB
            'caption'     => 'nullable|string|max:255',
        ]);

        // 1. Simpan pengaduan
        $pengaduan = Pengaduan::create([
            'nomor_tiket' => 'TKT-' . date('YmdHis') . '-' . rand(100, 999),
            'warga_id'    => $request->warga_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'status'      => 'menunggu',
        ]);

        // 2. Upload multiple files jika ada
        if ($request->hasFile('files')) {
            $sortOrder = 1;

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan ke storage
                    $file->storeAs('pengaduan/' . $pengaduan->pengaduan_id, $fileName, 'public');

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table'  => 'pengaduan',
                        'ref_id'     => $pengaduan->pengaduan_id,
                        'file_name'  => 'pengaduan/' . $pengaduan->pengaduan_id . '/' . $fileName,
                        'caption'    => $request->caption,
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => $sortOrder++,
                    ]);
                }
            }
        }

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diajukan!' .
                ($request->hasFile('files') ? ' (' . count($request->file('files')) . ' file terupload)' : ''));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga' && $pengaduan->warga_id != $user->id) {
            abort(403, 'Anda hanya bisa melihat pengaduan Anda sendiri');
        }

        // AMBIL SEMUA FILE MEDIA UNTUK PENGADUAN INI
        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.pengaduan.show', compact('pengaduan', 'mediaFiles'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga') {
            // 1. Cek kepemilikan
            if ($pengaduan->warga_id != $user->id) {
                abort(403, 'Anda hanya bisa mengedit pengaduan Anda sendiri');
            }
            // 2. Cek status (hanya status "menunggu" yang bisa diedit)
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa diedit');
            }
        }

        $warga     = Warga::all();
        $kategori  = KategoriPengaduan::all();

        // AMBIL FILE YANG SUDAH DIUPLOAD
        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.pengaduan.edit', compact('pengaduan', 'warga', 'kategori', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga') {
            // 1. Cek kepemilikan
            if ($pengaduan->warga_id != $user->id) {
                abort(403, 'Anda hanya bisa mengupdate pengaduan Anda sendiri');
            }
            // 2. Cek status (hanya status "menunggu" yang bisa diupdate)
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa diupdate');
            }
            // 3. Warga tidak bisa ubah status, tetap "menunggu"
            $request->merge(['status' => 'menunggu']);
        }

        $request->validate([
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|string|max:10',
            'rw'          => 'required|string|max:10',
            'status'      => 'required|in:menunggu,diproses,selesai,ditolak',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240',
            'caption'     => 'nullable|string|max:255',
        ]);

        // 1. Update data utama
        $pengaduan->update([
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
            'status'      => $request->status,
        ]);

        // 2. Upload file baru jika ada
        if ($request->hasFile('files')) {
            $lastSortOrder = Media::where('ref_table', 'pengaduan')
                ->where('ref_id', $id)
                ->max('sort_order');
            $sortOrder = $lastSortOrder ? $lastSortOrder + 1 : 1;

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->storeAs('pengaduan/' . $id, $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'pengaduan',
                        'ref_id'     => $id,
                        'file_name'  => 'pengaduan/' . $id . '/' . $fileName,
                        'caption'    => $request->caption,
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => $sortOrder++,
                    ]);
                }
            }
        }

        return redirect()->route('pengaduan.show', $id)
            ->with('success', 'Pengaduan berhasil diupdate!' .
                ($request->hasFile('files') ? ' (+' . count($request->file('files')) . ' file baru)' : ''));
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga') {
            // 1. Cek kepemilikan
            if ($pengaduan->warga_id != $user->id) {
                abort(403, 'Anda hanya bisa menghapus pengaduan Anda sendiri');
            }
            // 2. Cek status (hanya status "menunggu" yang bisa dihapus)
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa dihapus');
            }
        }

        // Hapus semua file media terkait
        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $media) {
            // Hapus file dari storage
            if (Storage::disk('public')->exists($media->file_name)) {
                Storage::disk('public')->delete($media->file_name);
            }
            // Hapus dari database
            $media->delete();
        }

        // Hapus folder jika ada
        $folderPath = 'pengaduan/' . $id;
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan dan semua file terkait berhasil dihapus!');
    }

    /**
     * Hapus file media spesifik
     */
    public function destroyMedia($pengaduan_id, $media_id)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga') {
            // 1. Cek kepemilikan
            if ($pengaduan->warga_id != $user->id) {
                abort(403, 'Anda hanya bisa menghapus file dari pengaduan Anda sendiri');
            }
            // 2. Cek status (hanya status "menunggu" yang bisa hapus file)
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa menghapus file');
            }
        }

        $media = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $pengaduan_id)
            ->findOrFail($media_id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return redirect()->back()
            ->with('success', 'File berhasil dihapus!');
    }

    /**
     * Download file
     */
    public function downloadMedia($pengaduan_id, $media_id)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        // ========== TAMBAH VALIDASI UNTUK WARGA ==========
        $user = Auth::user();
        if ($user->role == 'warga' && $pengaduan->warga_id != $user->id) {
            abort(403, 'Anda hanya bisa mendownload file dari pengaduan Anda sendiri');
        }

        $media = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $pengaduan_id)
            ->findOrFail($media_id);

        if (! Storage::disk('public')->exists($media->file_name)) {
            return redirect()->back()
                ->with('error', 'File tidak ditemukan!');
        }

        // Ambil nama file dari file_name (path terakhir)
        $fileName = basename($media->file_name);

        return Storage::disk('public')->download($media->file_name, $fileName);
    }

    /**
     * ========== TAMBAH METHOD BARU ==========
     * Menampilkan pengaduan yang dibuat oleh warga yang login
     */
    public function pengaduanSaya()
    {
        $user = Auth::user();

        // Hanya warga yang bisa akses
        if ($user->role != 'warga') {
            abort(403, 'Hanya warga yang bisa mengakses halaman ini');
        }

        $pengaduans = Pengaduan::where('warga_id', $user->id)
            ->with(['kategori'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.pengaduan.saya', compact('pengaduans'));
    }

    /**
     * ========== TAMBAH METHOD BARU ==========
     * Warga memberi penilaian untuk pengaduan yang selesai
     */
    public function beriPenilaian(Request $request, $id)
    {
        $user = Auth::user();
        $pengaduan = Pengaduan::findOrFail($id);

        // 1. Validasi: hanya warga yang bisa memberi penilaian
        if ($user->role != 'warga') {
            abort(403, 'Hanya warga yang bisa memberi penilaian');
        }

        // 2. Validasi: hanya pemilik pengaduan
        if ($pengaduan->warga_id != $user->id) {
            abort(403, 'Anda hanya bisa memberi penilaian untuk pengaduan Anda sendiri');
        }

        // 3. Validasi: hanya pengaduan dengan status "selesai"
        if ($pengaduan->status != 'selesai') {
            abort(403, 'Hanya pengaduan dengan status "selesai" yang bisa diberi penilaian');
        }

        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        // Simpan penilaian (gunakan model PenilaianLayanan yang sudah ada)
        // Anda perlu menyesuaikan dengan struktur tabel penilaian_layanan Anda
        \App\Models\PenilaianLayanan::updateOrCreate(
            ['pengaduan_id' => $id],
            [
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]
        );

        return redirect()->route('pengaduan.saya')
            ->with('success', 'Penilaian berhasil disimpan!');
    }
}
