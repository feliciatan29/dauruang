<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjemputanController extends Controller
{
    public function index()
    {
        $penjemputans = DB::table('tbl_penjemputan')->get();

        return view('penjemputan.index', compact('penjemputans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('penjemputan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nm_nasabah' => 'required|string',
            'tgl_penjemputan' => 'required|date',
            'waktu_penjemputan' => 'required',
            'alamat' => 'required|string',
            'berat' => 'required|numeric',
            'status' => 'required|in:on going,process,done',
            'gambar_sampah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_sampah')) {
            $file = $request->file('gambar_sampah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sampah'), $filename);
            $data['gambar_sampah'] = $filename;
        }

        Penjemputan::create($data);

        return redirect()->route('penjemputan.index')
            ->with('success', 'Data penjemputan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        return view('penjemputan.edit', compact('penjemputan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_nasabah' => 'required|string',
            'tgl_penjemputan' => 'required|date',
            'waktu_penjemputan' => 'required',
            'alamat' => 'required|string',
            'berat' => 'required|numeric',
            'status' => 'required|in:on going,process,done',
            'gambar_sampah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $penjemputan = Penjemputan::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar_sampah')) {
            $file = $request->file('gambar_sampah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sampah'), $filename);
            $data['gambar_sampah'] = $filename;
        }

        $penjemputan->update($data);

        return redirect()->route('penjemputan.index')
            ->with('success', 'Data penjemputan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        $penjemputan->delete();

        return redirect()->route('penjemputan.index')
            ->with('success', 'Data penjemputan berhasil dihapus');
    }

    // Fungsi update status saja
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:on going,process,done',
        ]);

        $penjemputan = Penjemputan::findOrFail($id);
        $penjemputan->status = $request->status;
        $penjemputan->save();

        return redirect()->back()->with('success', 'Status penjemputan berhasil diperbarui');
    }
}
