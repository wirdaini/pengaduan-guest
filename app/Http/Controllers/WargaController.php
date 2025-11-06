<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('pages.warga.index', compact('warga'));
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
