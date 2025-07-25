<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesananc;

class PesanancController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('nasabah.pesananc.form');
    }


    public function store(Request $request)
{
    \Log::info('Form store() dipanggil');
    $request->validate([
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'tanggal' => 'required|date',
        'waktu' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'catatan' => 'nullable|string',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('uploads/gambar', 'public');
    }

    // Simpan ke database
    $pesananc = Pesananc::create([
        'gambar' => $gambarPath,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'catatan' => $request->catatan,
        'status' => 'diproses', // ini penting!
    ]);

    // Redirect ke halaman detail
    return redirect()->route('pesananc.berhasil');

}

    public function show($id)
{
    
}


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function simpanSession(Request $request)
{
    session(['keranjang' => $request->all()]);
    return response()->json(['status' => 'success']);
}

    public function diproses()
{
    $pesananc = Pesananc::where('status', 'diproses')->get();
    return view('nasabah.pesananc.diproses', compact('pesananc'));
}

    




}

