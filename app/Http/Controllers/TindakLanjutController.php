<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa di-filter
        $filterableColumns = ['petugas'];

        // Kolom yang bisa di-search
        $searchableColumns = ['aksi', 'catatan', 'petugas'];

        // Query dengan scope filter DAN search (SESUAI STYLE-MU)
        $tindak_lanjut = TindakLanjut::with(['pengaduan'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.tindak_lanjut.index', compact('tindak_lanjut'));
    }

    public function create()
    {
        // Ambil pengaduan yang statusnya belum selesai
        $pengaduan = Pengaduan::whereIn('status', ['menunggu', 'diproses'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.tindak_lanjut.create', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        // Validasi data utama
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id',
            'petugas'      => 'required|string|max:100',
            'aksi'         => 'required|string',
            'catatan'      => 'nullable|string',
            'files.*'      => 'nullable|file|max:10240', // Max 10MB per file
            'caption'      => 'nullable|string|max:255',
        ]);

        // 1. Simpan tindak lanjut
        $tindakLanjut = TindakLanjut::create([
            'pengaduan_id' => $request->pengaduan_id,
            'petugas'      => $request->petugas,
            'aksi'         => $request->aksi,
            'catatan'      => $request->catatan,
        ]);

        // 2. Upload multiple files jika ada
        if ($request->hasFile('files')) {
            $sortOrder = 1;

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Simpan ke storage
                    $file->storeAs('tindak_lanjut/' . $tindakLanjut->tindak_id, $fileName, 'public');

                    // Simpan ke tabel media (SESUAI STRUKTUR DOSEN)
                    Media::create([
                        'ref_table'  => 'tindak_lanjut',
                        'ref_id'     => $tindakLanjut->tindak_id,
                        'file_name'  => 'tindak_lanjut/' . $tindakLanjut->tindak_id . '/' . $fileName,
                        'caption'    => $request->caption,
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => $sortOrder++,
                    ]);
                }
            }
        }

        // 3. Update status pengaduan
        Pengaduan::where('pengaduan_id', $request->pengaduan_id)
            ->update(['status' => 'diproses']);

        return redirect()->route('tindak_lanjut.index')
            ->with('success', 'Tindak lanjut berhasil disimpan!' .
                ($request->hasFile('files') ? ' (' . count($request->file('files')) . ' file terupload)' : ''));
    }

    public function show($id)
    {
        $tindakLanjut = TindakLanjut::with(['pengaduan'])->findOrFail($id);

        // AMBIL SEMUA FILE MEDIA UNTUK TINDAK LANJUT INI
        $mediaFiles = Media::where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.tindak_lanjut.show', compact('tindakLanjut', 'mediaFiles')); // TAMBAH $mediaFiles
    }

    public function edit($id)
    {
        $tindakLanjut = TindakLanjut::with(['pengaduan'])->findOrFail($id);
        $pengaduan    = Pengaduan::whereIn('status', ['menunggu', 'diproses', 'selesai'])
            ->orWhere('pengaduan_id', $tindakLanjut->pengaduan_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // AMBIL FILE YANG SUDAH DIUPLOAD
        $mediaFiles = Media::where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.tindak_lanjut.edit', compact('tindakLanjut', 'pengaduan', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'petugas' => 'required|string|max:100',
            'aksi'    => 'required|string',
            'catatan' => 'nullable|string',
            'files.*' => 'nullable|file|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);

        $tindakLanjut = TindakLanjut::findOrFail($id);

        // 1. Update data utama
        $tindakLanjut->update([
            'petugas' => $request->petugas,
            'aksi'    => $request->aksi,
            'catatan' => $request->catatan,
        ]);

        // 2. Upload file baru jika ada
        if ($request->hasFile('files')) {
            $lastSortOrder = Media::where('ref_table', 'tindak_lanjut')
                ->where('ref_id', $id)
                ->max('sort_order');
            $sortOrder = $lastSortOrder ? $lastSortOrder + 1 : 1;

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->storeAs('tindak_lanjut/' . $id, $fileName, 'public');

                    Media::create([
                        'ref_table'  => 'tindak_lanjut',
                        'ref_id'     => $id,
                        'file_name'  => 'tindak_lanjut/' . $id . '/' . $fileName,
                        'caption'    => $request->caption,
                        'mime_type'  => $file->getMimeType(),
                        'sort_order' => $sortOrder++,
                    ]);
                }
            }
        }

        return redirect()->route('tindak_lanjut.show', $id)
            ->with('success', 'Tindak lanjut berhasil diupdate!' .
                ($request->hasFile('files') ? ' (+' . count($request->file('files')) . ' file baru)' : ''));
    }

    public function destroy($id)
    {
        $tindakLanjut = TindakLanjut::findOrFail($id);
        $tindakLanjut->delete();

        return redirect()->route('tindak_lanjut.index')
            ->with('success', 'Tindak lanjut berhasil dihapus!');
    }

    public function downloadMedia($tindak_id, $media_id)
    {
        $media = Media::where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $tindak_id)
            ->findOrFail($media_id);

        if (! Storage::disk('public')->exists($media->file_name)) {
            return redirect()->back()
                ->with('error', 'File tidak ditemukan!');
        }

        // Ambil nama file dari file_name (path terakhir)
        $fileName = basename($media->file_name);

        return Storage::disk('public')->download($media->file_name, $fileName);
    }
}
