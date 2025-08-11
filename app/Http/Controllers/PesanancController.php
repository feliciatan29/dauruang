<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesananc;
use App\Models\Riwayat;


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

    public function formulir()
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

    public function pilihjenis(Request $request)
{
    $form = session('form_sementara', []);
    $keranjang = session('keranjang', []);

    $mode = (!empty($form) || !empty($keranjang)) ? 'edit' : 'baru';

    return view('nasabah.pesananc.pilihjenis', compact('form', 'keranjang', 'mode'));
}

    public function simpanSementara(Request $request)
    {
        $data = $request->only(['telepon', 'alamat', 'tanggal', 'waktu', 'catatan']);

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

    public function simpanSession(Request $request)
    {
        $keranjangBaru = $request->all();
        $keranjangLama = session('keranjang', []);
        $keranjangGabungan = array_merge($keranjangLama, $keranjangBaru);
        session(['keranjang' => $keranjangGabungan]);

        return response()->json(['status' => 'success']);
    }

    public function submit(Request $request)
    {
        $action = $request->input('action');
        \Log::info("Submit action: $action");

        if ($action === 'keranjang') {
            \Log::info("Masuk blok KERANJANG");

            $data = $request->only(['nama', 'telepon', 'alamat', 'tanggal', 'waktu', 'catatan']);

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

            return redirect()->route('pesananc.keranjang')->with('success', 'Form disimpan ke keranjang.');
        }

        if ($action === 'kirim') {
            \Log::info("Masuk blok KIRIM");

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
            } elseif (session()->has('form_sementara')) {
                $gambarPath = session('form_sementara')['gambar'] ?? null;
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
            session()->forget('keranjang');

            return redirect()->route('pesananc.diproses')->with('success', 'Pesanan berhasil dikirim.');
        }

        // Action tidak valid
        \Log::warning("Action tidak valid atau kosong di submit()");
        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }
//yang diedit ini baru 22:32
    public function diterima()
{
    $pesananc = Pesananc::where('status', 'telah diterima')->get();
    return view('nasabah.pesananc.diterima', compact('pesananc'));
}



    public function transaksi_berhasil()
{
    $riwayat = \App\Models\Riwayat::where('status', 'transaksi berhasil')->get();
    return view('nasabah.pesananc.transaksi_berhasil', compact('riwayat'));
}

public function statusPesanan()
{
    return view('nasabah.pesananc.status_pesanan');
}

public function batalkanTransaksi($id)
{
    $pesanan = Pesananc::findOrFail($id);
    $pesanan->status = 'dibatalkan';
    $pesanan->save();

    return redirect()->route('pesananc.diproses')
        ->with('success', 'Pesanan berhasil dibatalkan.');
}







}