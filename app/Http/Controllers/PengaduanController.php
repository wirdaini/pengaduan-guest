<?php
namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Media;
use App\Models\Pengaduan;
use App\Models\PenilaianLayanan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $filterableColumns = ['status', 'kategori_id', 'rt', 'rw'];
        $searchableColumns = ['judul', 'deskripsi', 'nomor_tiket', 'lokasi_text'];
        $kategories        = KategoriPengaduan::all();

        $query = Pengaduan::with(['kategori', 'warga'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan role
        if ($user->role == 'warga') {
            $warga = $user->warga;

            if ($warga) {
                $query->where('warga_id', $warga->warga_id);
            } else {
                // ⭐ PERBAIKAN: Redirect ke route yang SAMA dengan create()
                return redirect()->route('warga.create.user')
                    ->with('warning', 'Data warga belum terhubung dengan akun Anda. Silakan lengkapi data warga terlebih dahulu.');
            }
        }

        $pengaduan = $query->paginate(16)->withQueryString();
        return view('pages.pengaduan.index', compact('pengaduan', 'kategories'));
    }

    public function create()
    {
        $user     = Auth::user();
        $kategori = KategoriPengaduan::all();

        if ($user->role == 'warga') {
            if (! $user->warga) {
                // Redirect ke route BARU untuk warga
                return redirect()->route('warga.create.user')
                    ->with('info', 'Silakan lengkapi data warga terlebih dahulu sebelum membuat pengaduan.');
            }

            $warga = [$user->warga];
            return view('pages.pengaduan.create', compact('warga', 'kategori'));
        }

        $warga = Warga::all();
        return view('pages.pengaduan.create', compact('warga', 'kategori'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            if (! $warga) {
                return redirect()->back()
                    ->with('error', 'Data warga tidak ditemukan. Lengkapi profil Anda terlebih dahulu.');
            }

            // ✅ PAKAI warga->warga_id
            $request->merge(['warga_id' => $warga->warga_id]);
        }

        // ✅ VALIDASI: exists:warga,warga_id (bukan id)
        $request->validate([
            'warga_id'    => 'required|exists:warga,warga_id',
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|string|max:10',
            'rw'          => 'required|string|max:10',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240',
            'caption'     => 'nullable|string|max:255',
        ]);

        try {
            $nomorTiket = 'TKT-' . date('YmdHis') . '-' . rand(100, 999);

            // ✅ PAKAI $pengaduan->pengaduan_id untuk folder
            $pengaduan = Pengaduan::create([
                'nomor_tiket' => $nomorTiket,
                'warga_id'    => $request->warga_id,
                'judul'       => $request->judul,
                'deskripsi'   => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'lokasi_text' => $request->lokasi_text,
                'rt'          => $request->rt,
                'rw'          => $request->rw,
                'status'      => 'menunggu',
            ]);

            if ($request->hasFile('files')) {
                $sortOrder = 1;
                $folderId  = $pengaduan->pengaduan_id; // ✅ PAKAI pengaduan_id

                foreach ($request->file('files') as $file) {
                    if ($file->isValid()) {
                        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('pengaduan/' . $folderId, $fileName, 'public');

                        Media::create([
                            'ref_table'  => 'pengaduan',
                            'ref_id'     => $folderId, // ✅ PAKAI pengaduan_id
                            'file_name'  => 'pengaduan/' . $folderId . '/' . $fileName,
                            'caption'    => $request->caption,
                            'mime_type'  => $file->getMimeType(),
                            'sort_order' => $sortOrder++,
                        ]);
                    }
                }
            }

            return redirect()->route('pengaduan.index')
                ->with('success', 'Pengaduan berhasil diajukan! Nomor Tiket: ' . $nomorTiket .
                    ($request->hasFile('files') ? ' (' . count($request->file('files')) . ' file terupload)' : ''));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa melihat pengaduan Anda sendiri');
            }
        }

        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        $penilaian = PenilaianLayanan::where('pengaduan_id', $id)->first();

        return view('pages.pengaduan.show', compact('pengaduan', 'mediaFiles', 'penilaian'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori'])->findOrFail($id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa mengedit pengaduan Anda sendiri');
            }

            // ✅ LOGIKA SESUAI PERMINTAAN:
            // Warga hanya bisa edit jika status "menunggu"
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa diedit');
            }
        }

        $wargaList = Warga::all();
        $kategori  = KategoriPengaduan::all();

        $mediaFiles = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.pengaduan.edit', compact('pengaduan', 'wargaList', 'kategori', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa mengupdate pengaduan Anda sendiri');
            }

            // ✅ LOGIKA: Warga hanya bisa update jika status "menunggu"
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa diupdate');
            }

            // ✅ TAMBAHKAN INI: Set warga_id secara otomatis
            $request->merge(['warga_id' => $warga->warga_id]);
            $request->merge(['status' => 'menunggu']); // Warga tidak bisa ubah status
        }

        // ✅ VALIDASI: TAMBAHKAN warga_id untuk admin/petugas
        $validationRules = [
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required|string',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'lokasi_text' => 'required|string|max:255',
            'rt'          => 'required|string|max:10',
            'rw'          => 'required|string|max:10',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240',
            'caption'     => 'nullable|string|max:255',
        ];

        // ✅ Hanya admin/petugas yang bisa ubah status
        if ($user->role != 'warga') {
            $validationRules['status']   = 'required|in:menunggu,diproses,selesai,ditolak';
            $validationRules['warga_id'] = 'required|exists:warga,warga_id';
        } else {
            // ✅ Untuk warga, status selalu "menunggu"
            $request->merge(['status' => 'menunggu']);
        }

        $request->validate($validationRules);

        try {
            // ✅ DATA UNTUK UPDATE
            $updateData = [
                'judul'       => $request->judul,
                'deskripsi'   => $request->deskripsi,
                'kategori_id' => $request->kategori_id,
                'lokasi_text' => $request->lokasi_text,
                'rt'          => $request->rt,
                'rw'          => $request->rw,
                'status'      => $request->status,
            ];

            // ✅ JIKA ADMIN/PETUGAS, UPDATE JUGA warga_id
            if ($user->role != 'warga' && $request->has('warga_id')) {
                $updateData['warga_id'] = $request->warga_id;
            }

            $pengaduan->update($updateData);

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

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa menghapus pengaduan Anda sendiri');
            }

            // ✅ LOGIKA: Warga hanya bisa hapus jika status "menunggu"
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa dihapus');
            }
        }

        try {
            $mediaFiles = Media::where('ref_table', 'pengaduan')
                ->where('ref_id', $id)
                ->get();

            foreach ($mediaFiles as $media) {
                if (Storage::disk('public')->exists($media->file_name)) {
                    Storage::disk('public')->delete($media->file_name);
                }
                $media->delete();
            }

            $folderPath = 'pengaduan/' . $id;
            if (Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->deleteDirectory($folderPath);
            }

            $pengaduan->delete();

            return redirect()->route('pengaduan.index')
                ->with('success', 'Pengaduan dan semua file terkait berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }

    public function destroyMedia($pengaduan_id, $media_id)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa menghapus file dari pengaduan Anda sendiri');
            }

            // ✅ LOGIKA: Warga hanya bisa hapus file jika status "menunggu"
            if ($pengaduan->status != 'menunggu') {
                abort(403, 'Hanya pengaduan dengan status "menunggu" yang bisa menghapus file');
            }
        }

        $media = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $pengaduan_id)
            ->findOrFail($media_id);

        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return redirect()->back()
            ->with('success', 'File berhasil dihapus!');
    }

    public function downloadMedia($pengaduan_id, $media_id)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);
        $user      = Auth::user();

        if ($user->role == 'warga') {
            $warga = $user->warga;

            // ✅ PAKAI $warga->warga_id
            if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
                abort(403, 'Anda hanya bisa mendownload file dari pengaduan Anda sendiri');
            }
        }

        $media = Media::where('ref_table', 'pengaduan')
            ->where('ref_id', $pengaduan_id)
            ->findOrFail($media_id);

        if (! Storage::disk('public')->exists($media->file_name)) {
            return redirect()->back()
                ->with('error', 'File tidak ditemukan!');
        }

        $fileName = basename($media->file_name);
        return Storage::disk('public')->download($media->file_name, $fileName);
    }

    public function beriPenilaian(Request $request, $id)
    {
        $user      = Auth::user();
        $pengaduan = Pengaduan::findOrFail($id);

        if ($user->role != 'warga') {
            abort(403, 'Hanya warga yang bisa memberi penilaian');
        }

        $warga = $user->warga;
        // ✅ PAKAI $warga->warga_id
        if (! $warga || $pengaduan->warga_id != $warga->warga_id) {
            abort(403, 'Anda hanya bisa memberi penilaian untuk pengaduan Anda sendiri');
        }

        if ($pengaduan->status != 'selesai') {
            abort(403, 'Hanya pengaduan dengan status "selesai" yang bisa diberi penilaian');
        }

        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        try {
            PenilaianLayanan::updateOrCreate(
                ['pengaduan_id' => $id],
                [
                    'rating'   => $request->rating,
                    'komentar' => $request->komentar,
                ]
            );

            return redirect()->route('pengaduan.show', $id)
                ->with('success', 'Penilaian berhasil disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
