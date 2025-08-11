<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisController extends Controller
{
    public function index()
    {
        $jenish = Jenis::latest()->paginate(20);
        return view('admin.jenis.index', compact('jenish'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function cari_jenis(Request $request)
    {
        $kata = $request->input('kata');
        $jenish = Jenis::where('nm_jenis', 'LIKE', "%$kata%")->paginate(20);

        return view('admin.jenis.index', compact('jenish'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create()
    {
        return view('admin.jenis.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'kd_jenis' => 'required',
        'nm_jenis' => 'required',
        'harga_perkilo' => 'required|numeric',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Pastikan folder ada
    $path = public_path('Foto_Jenis');
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    // Upload file
    $file = $request->file('gambar');
    $nama_file = time() . "_" . $file->getClientOriginalName();
    $file->move($path, $nama_file);

    // Simpan data ke database
    Jenis::create([
        'kd_jenis' => $request->kd_jenis,
        'nm_jenis' => $request->nm_jenis,
        'harga_perkilo' => $request->harga_perkilo,
        'gambar' => $nama_file
    ]);

    return redirect()->route('jenis.index')
        ->with('success', 'Data Jenis Sampah Berhasil Disimpan');
}

    public function edit($id)
{
    $jenis = Jenis::findOrFail($id);
    return view('admin.jenis.edit', compact('jenis'));
}

    public function update(Request $request, $id)
{
    $jenis = Jenis::findOrFail($id);

    $request->validate([
        'kd_jenis' => 'required',
        'nm_jenis' => 'required',
        'harga_perkilo' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $jenis->kd_jenis = $request->kd_jenis;
    $jenis->nm_jenis = $request->nm_jenis;
    $jenis->harga_perkilo = $request->harga_perkilo;

    if ($request->hasFile('gambar')) {
        if ($jenis->gambar && file_exists(public_path('Foto_Jenis/' . $jenis->gambar))) {
            unlink(public_path('Foto_Jenis/' . $jenis->gambar));
        }
        $file = $request->file('gambar');
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('Foto_Jenis'), $filename);
        $jenis->gambar = $filename;
    }

    $jenis->save();

    return redirect()->route('jenis.index')->with('success', 'Data berhasil diupdate.');
}

   public function destroy($id)
{
    $jenis = Jenis::findOrFail($id);

    if ($jenis->gambar && file_exists(public_path('Foto_Jenis/' . $jenis->gambar))) {
        unlink(public_path('Foto_Jenis/' . $jenis->gambar));
    }

    $jenis->delete();

    return redirect()->route('jenis.index')->with('success', 'Data Jenis Sampah Berhasil Dihapus');
}
}
