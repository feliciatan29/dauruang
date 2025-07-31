<?php

namespace App\Http\Controllers;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informasis = Informasi::latest()->paginate(20);
        return view('admin.informasi.index', compact('informasis'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function cari_informasi(Request $request)
    {
        $kata = $request->input('kata');
        $informasis = Informasi::where('judul_informasi', 'LIKE', "%$kata%")
                     ->paginate(20);

        return view('informasi.index', compact('informasis'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.informasi.create');
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
            'judul_informasi' => 'required',
            'kategori' => 'required',
            'tgl_informasi' => 'required',
            'isi_informasi' => 'required',
            'gambar' => 'required',
        ]);
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = "Foto_Informasi";
        $file->move($tujuan_upload,$nama_file);

        Informasi::create([
            'judul_informasi' => $request->judul_informasi,
            'kategori' => $request->kategori,
            'tgl_informasi' => $request->tgl_informasi,
            'isi_informasi' => $request->isi_informasi,
            'gambar' => $nama_file

        ]);

        return redirect()->route('informasi.index')->with('success', 'Data Informasi Berhasil Disimpan');
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
    public function edit(Informasi $informasi)
    {
        // Kirim data ke view
        return view('admin.informasi.edit', compact('informasi'));
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
        'judul_informasi' => 'required',
        'kategori' => 'required',
        'tgl_informasi' => 'required',
        'isi_informasi' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048', // Validasi gambar
    ]);

    $informasi = Informasi::find($id);
    $informasi->judul_informasi = $request->judul_informasi;
    $informasi->kategori = $request->kategori;
    $informasi->tgl_informasi = $request->tgl_informasi;
    $informasi->isi_informasi = $request->isi_informasi;

    // Cek apakah ada file gambar yang di-upload
    if ($request->hasFile('gambar')) {
        if ($informasi->gambar) {
            Storage::delete('Foto_Informasi/' . $informasi->gambar);
        }

        $file = $request->file('gambar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('Foto_Informasi'), $filename);
        $informasi->gambar = $filename;
    }

    $informasi->save();

    return redirect()->route('informasi.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);

    if ($informasi->gambar) {
        $path = public_path('Foto_Informasi/' . $informasi->gambar);
        if (file_exists($path)) {
            unlink($path);
        }
    }

     // Hapus data informasi
    $informasi->delete();

    return redirect()->route('informasi.index')->with('success', 'Data Informasi Berhasil Dihapus');
    }
}
