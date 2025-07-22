<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenish = Jenis::latest()->paginate(20);
        return view('admin.jenis.index', compact('jenish'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function cari_jenis(Request $request)
    {
        $kata = $request->input('kata');
        $jenish = Jenis::where('nm_jenis', 'LIKE', "%$kata%")
                     ->paginate(20);

        return view('admin.jenis.index', compact('jenish'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis.create');
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
            'kd_jenis' => 'required',
            'nm_jenis' => 'required',
            'harga_perkilo' => 'required',
            'harga_satuan' => 'required',
            'gambar' => 'required',
        ]);
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = "Foto_Jenis";
        $file->move($tujuan_upload,$nama_file);

        Jenis::create([
            'kd_jenis' => $request->kd_jenis,
            'nm_jenis' => $request->nm_jenis,
            'harga_perkilo' => $request->harga_perkilo,
            'harga_satuan' => $request->harga_satuan,
            'gambar' => $nama_file

        ]);

        return redirect()->route('jenis.index')->with('success', 'Data Jenis Sampah Berhasil Disimpan');
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
    public function edit(Jenis $jenis)
    {
        return view('admin.jenis.edit', compact('jenis'));
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
        'kd_jenis' => 'required',
        'nm_jenis' => 'required',
        'harga_perkilo' => 'required',
        'harga_satuan' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    $jenis = Jenis::find($id);
    $jenis->kd_jenis = $request->kd_jenis;
    $jenis->nm_jenis = $request->nm_jenis;
    $jenis->harga_perkilo = $request->harga_perkilo;
    $jenis->harga_satuan = $request->harga_satuan;

    // Cek apakah ada file gambar yang di-upload
    if ($request->hasFile('gambar')) {
        if ($jenis->gambar) {
            Storage::delete('Foto_Jenis/' . $jenis->gambar);
        }

        $file = $request->file('gambar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('Foto_Jenis'), $filename);
        $jenis->gambar = $filename;
    }

    $jenis->save();

    return redirect()->route('jenis.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::findOrFail($id);

    if ($jenis->gambar) {
        $path = public_path('Foto_Jenis/' . $jenis->gambar);
        if (file_exists($path)) {
            unlink($path);
        }
    }
     // Hapus data jenis
    $jenis->delete();

    return redirect()->route('jenis.index')->with('success', 'Data Jenis Sampah Berhasil Dihapus');
    }
}
