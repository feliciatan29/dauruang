<?php

namespace App\Http\Controllers;

use App\Models\Pesananc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PesananController extends Controller
{
    // Menampilkan semua pesanan
    public function index()
    {
        $pesanans = Pesananc::all();
        return view('admin.pesanan.index', compact('pesanans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    // Proses update pesanan (hanya berat & status)
    public function update(Request $request, $id)
    {
        $request->validate([
            'berat' => 'required|numeric|min:0',
            'status' => 'required|in:sedang diproses,telah diterima,transaksi berhasil',
        ]);

        $pesanan = Pesananc::findOrFail($id);

        // Jika status menjadi "transaksi berhasil", pindahkan ke tabel riwayat
        if ($request->status === 'transaksi berhasil') {
            $gambarName = $pesanan->gambar ? basename($pesanan->gambar) : null;

            DB::table('tbl_riwayat')->insert([
                'nama' => $pesanan->nama,
                'telepon' => $pesanan->telepon,
                'alamat' => $pesanan->alamat,
                'tanggal' => $pesanan->tanggal,
                'waktu' => $pesanan->waktu,
                'gambar' => $gambarName, // hanya nama file
                'catatan' => $pesanan->catatan,
                'status' => 'transaksi berhasil',
                'jenis_sampah' => $pesanan->jenis_sampah,
                'berat' => $request->berat,
                'total_pesanan' => $pesanan->total_pesanan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Hapus pesanan dari tabel utama
            $pesanan->delete();

            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dipindahkan ke Riwayat');
        }

        // Jika belum "transaksi berhasil", cukup update berat dan status
        $pesanan->update([
            'berat' => $request->berat,
            'status' => $request->status,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Status dan berat berhasil diperbarui');
    }

    // Hapus pesanan + gambar (jika ada)
    public function destroy($id)
    {
        $pesanan = Pesananc::findOrFail($id);

        if ($pesanan->gambar) {
            $gambarPath = public_path('Foto_Sampah/' . basename($pesanan->gambar));
            if (File::exists($gambarPath)) {
                File::delete($gambarPath);
            }
        }

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
