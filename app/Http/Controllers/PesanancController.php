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
        'nama' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'tanggal' => 'required|date',
        'waktu' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'catatan' => 'nullable|string',
        'jenis_sampah' => 'required|json',
        'berat' => 'required|numeric',
        'total_pesanan' => 'required|numeric',
    ]);

    $gambarPath = null;

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = public_path('Foto_Sampah');

        if (!file_exists($tujuan_upload)) {
            mkdir($tujuan_upload, 0777, true);
        }

        $file->move($tujuan_upload, $nama_file);
        $gambarPath = 'Foto_Sampah/' . $nama_file;
    }

    Pesananc::create([
        'nama' => $request->nama,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'gambar' => $gambarPath,
        'catatan' => $request->catatan,
        'jenis_sampah' => $request->jenis_sampah,
        'berat' => $request->berat,
        'total_pesanan' => $request->total_pesanan,
        'status' => 'diproses',
    ]);

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

public function keranjang()
{
    $form = session('form_sementara');
    $keranjang = session('keranjang', []);

    return view('nasabah.pesananc.keranjang', compact('form', 'keranjang'));
}

public function formulir()
{
    return view('nasabah.pesananc.form');
}

public function simpanSementara(Request $request)
{
    $data = $request->only([
        'telepon', 'alamat', 'tanggal', 'waktu', 'catatan'
    ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        $tujuan_upload = public_path('Foto_Sampah');
        if (!file_exists($tujuan_upload)) {
            mkdir($tujuan_upload, 0777, true);
        }

        $file->move($tujuan_upload, $nama_file);
        $data['gambar'] = 'Foto_Sampah/' . $nama_file;
    }

    session(['form_sementara' => $data]);

    return redirect()->route('pesananc.keranjang')->with('success', 'Data berhasil disimpan sementara.');
}


public function simpanFormulir(Request $request) {
    $isLengkap = $request->telepon && $request->alamat && $request->tanggal && $request->waktu;

    if ($isLengkap) {
        // Simpan sebagai pesanan diproses
        Pesanan::create([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
            'status' => 'diproses'
        ]);

        return redirect()->route('riwayat.index');
    } else {
        // Simpan ke keranjang (session atau database, status: "draft")
        KeranjangFormulir::create([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
            'status' => 'draft'
        ]);

        return redirect()->route('keranjang.index');
    }
}

public function submit(Request $request)
{
    $action = $request->input('action');

    if ($action === 'keranjang') {
        // Simpan ke keranjang tanpa validasi lengkap
        $data = $request->only(['telepon', 'alamat', 'tanggal', 'waktu', 'catatan']);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar_sementara', 'public');
            $data['gambar'] = $gambar;
        }

        session(['form_sementara' => $data]);
        return redirect()->route('pesananc.keranjang')->with('success', 'Form disimpan ke keranjang.');
    }

   if ($action === 'kirim') {
    $request->validate([
        'nama' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'tanggal' => 'required|date',
        'waktu' => 'required|string',
        'catatan' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'jenis_sampah' => 'required|json',
        'berat' => 'required|numeric',
        'total_pesanan' => 'required|numeric',
    ]);

    $gambarPath = null;

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = public_path('Foto_Sampah');
        if (!file_exists($tujuan_upload)) {
            mkdir($tujuan_upload, 0777, true);
        }
        $file->move($tujuan_upload, $nama_file);
        $gambarPath = 'Foto_Sampah/' . $nama_file;
    } elseif (session()->has('form_sementara.gambar')) {
        $gambarPath = session('form_sementara.gambar');
    }

    Pesananc::create([
        'nama' => $request->nama,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'catatan' => $request->catatan,
        'gambar' => $gambarPath,
        'jenis_sampah' => $request->jenis_sampah,
        'berat' => $request->berat,
        'total_pesanan' => $request->total_pesanan,
        'status' => 'diproses',
    ]);

    session()->forget('form_sementara');

    return redirect()->route('pesananc.diproses')->with('success', 'Pesanan berhasil dikirim.');
}


}
}


