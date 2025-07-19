<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabahs = Nasabah::paginate(20);
        return view('nasabah.index', compact('nasabahs'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_nasabah' => 'required',
            'nm_nasabah' => 'required',
            'alamat' => 'required',
            'jenis_nasabah' => 'required',
            'no_telephone' => 'required',
            'tgl_daftar' => 'required',
            'status' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $tujuan_upload = public_path('Foto_Nasabah');
        if (!file_exists($tujuan_upload)) {
            mkdir($tujuan_upload, 0777, true);
        }

        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move($tujuan_upload, $nama_file);

        try {
            Nasabah::create([
                'kd_nasabah' => $request->kd_nasabah,
                'nm_nasabah' => $request->nm_nasabah,
                'alamat' => $request->alamat,
                'jenis_nasabah' => $request->jenis_nasabah,
                'no_telephone' => $request->no_telephone,
                'tgl_daftar' => $request->tgl_daftar,
                'status' => $request->status,
                'gambar' => $nama_file,
            ]);

            return redirect()->route('nasabah.index')->with('success', 'Data Nasabah Berhasil Disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Data gagal disimpan: ' . $e->getMessage()]);
        }
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'kd_nasabah' => 'required',
            'nm_nasabah' => 'required',
            'alamat' => 'required',
            'jenis_nasabah' => 'required',
            'no_telephone' => 'required',
            'tgl_daftar' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $tujuan_upload = public_path('Foto_Nasabah');

            // Hapus gambar lama
            if ($nasabah->gambar && file_exists($tujuan_upload . '/' . $nasabah->gambar)) {
                unlink($tujuan_upload . '/' . $nasabah->gambar);
            }

            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move($tujuan_upload, $nama_file);

            $data['gambar'] = $nama_file;
        }

        try {
            $nasabah->update($data);
            return redirect()->route('nasabah.index')->with('success', 'Data Nasabah Berhasil Diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Data gagal diperbarui: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $tujuan_upload = public_path('Foto_Nasabah');

        if ($nasabah->gambar && file_exists($tujuan_upload . '/' . $nasabah->gambar)) {
            unlink($tujuan_upload . '/' . $nasabah->gambar);
        }

        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Data Nasabah Berhasil Dihapus');
    }
}
