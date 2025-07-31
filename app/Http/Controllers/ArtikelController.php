<?php

namespace App\Http\Controllers;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikels = Artikel::latest()->paginate(20);
        return view('admin.artikel.index', compact('artikels'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

     public function cari_artikel(Request $request)
    {
        $kata = $request->input('kata');
        $artikels = Artikel::where('judul_artikel', 'LIKE', "%$kata%")
                     ->paginate(20);

        return view('admin.artikel.index', compact('artikels'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request -> validate([
            'judul_artikel' => 'required',
            'nm_penulis' => 'required',
            'kategori' => 'required',
            'tgl_terbit' => 'required',
            'isi_artikel' => 'required',
            'gambar' => 'required',
        ]);
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = "Foto_Artikel";
        $file->move($tujuan_upload,$nama_file);

        Artikel::create([
            'judul_artikel' => $request->judul_artikel,
            'nm_penulis' => $request->nm_penulis,
            'kategori' => $request->kategori,
            'tgl_terbit' => $request->tgl_terbit,
            'isi_artikel' => $request->isi_artikel,
            'gambar' => $nama_file

        ]);

        return redirect()->route('artikel.index')->with('success', 'Data Artikel Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
         // Kirim data ke view
        return view('admin.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'judul_artikel' => 'required',
        'nm_penulis' => 'required',
        'kategori' => 'required',
        'tgl_terbit' => 'required',
        'isi_artikel' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $artikel = Artikel::find($id);
    $artikel->judul_artikel = $request->judul_artikel;
    $artikel->nm_penulis = $request->nm_penulis;
    $artikel->kategori = $request->kategori;
    $artikel->tgl_terbit = $request->tgl_terbit;
    $artikel->isi_artikel = $request->isi_artikel;

    // Cek apakah ada file gambar yang di-upload
    if ($request->hasFile('gambar')) {
        if ($artikel->gambar) {
            Storage::delete('Foto_Artikel/' . $artikel->gambar);
        }

        $file = $request->file('gambar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('Foto_Artikel'), $filename);
        $artikel->gambar = $filename;
    }

    $artikel->save();

    return redirect()->route('artikel.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

    if ($artikel->gambar) {
        $path = public_path('Foto_Artikel/' . $artikel->gambar);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // Hapus data artikel
    $artikel->delete();

    return redirect()->route('artikel.index')->with('success', 'Data Artikel Berhasil Dihapus');
    }
}
