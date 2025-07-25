<?php

namespace App\Http\Controllers;

use App\Models\Pesananc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $pesanans = Pesananc::all();
        return view('admin.pesanan.index', compact('pesanans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // Form tambah pesanan
    public function create()
    {
        return view('admin.pesanan.create');
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
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

        Pesananc::create([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'gambar' => $gambarPath,
            'catatan' => $request->catatan,
            'status' => 'sedang diproses',
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    // Simpan update data pesanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
            'status' => 'required|in:sedang diproses,telah diterima,transaksi berhasil',
        ]);

        $pesanan = Pesananc::findOrFail($id);

        // Jika status menjadi transaksi berhasil → pindahkan ke riwayat
        if ($request->status === 'transaksi berhasil') {
            DB::table('tbl_riwayat')->insert([
                'telepon' => $pesanan->telepon,
                'alamat' => $pesanan->alamat,
                'tanggal' => $pesanan->tanggal,
                'waktu' => $pesanan->waktu,
                'gambar' => $pesanan->gambar,
                'catatan' => $pesanan->catatan,
                'status' => 'transaksi berhasil',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Hapus data pesanan
            if ($pesanan->gambar && Storage::disk('public')->exists($pesanan->gambar)) {
                Storage::disk('public')->delete($pesanan->gambar);
            }

            $pesanan->delete();

            return redirect()->route('pesanan.index')->with('success', 'Pesanan selesai dan dipindahkan ke Riwayat');
        }

        // Jika gambar baru diupload, ganti gambar lama
        if ($request->hasFile('gambar')) {
            if ($pesanan->gambar && Storage::disk('public')->exists($pesanan->gambar)) {
                Storage::disk('public')->delete($pesanan->gambar);
            }
            $pesanan->gambar = $request->file('gambar')->store('uploads/gambar', 'public');
        }

        $pesanan->update([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
            'status' => $request->status,
            'gambar' => $pesanan->gambar,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesananc::findOrFail($id);

        if ($pesanan->gambar && Storage::disk('public')->exists($pesanan->gambar)) {
            Storage::disk('public')->delete($pesanan->gambar);
        }

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }

    // Update status secara terpisah
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:sedang diproses,telah diterima,transaksi berhasil',
        ]);

        $pesanan = Pesananc::findOrFail($id);

        if ($request->status === 'transaksi berhasil') {
            DB::table('tbl_riwayat')->insert([
                'telepon' => $pesanan->telepon,
                'alamat' => $pesanan->alamat,
                'tanggal' => $pesanan->tanggal,
                'waktu' => $pesanan->waktu,
                'gambar' => $pesanan->gambar,
                'catatan' => $pesanan->catatan,
                'status' => 'transaksi berhasil',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($pesanan->gambar && Storage::disk('public')->exists($pesanan->gambar)) {
                Storage::disk('public')->delete($pesanan->gambar);
            }

            $pesanan->delete();

            return redirect()->route('pesanan.index')->with('success', 'Pesanan selesai dan dipindahkan ke Riwayat');
        }

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
