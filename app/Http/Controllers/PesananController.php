<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan dari tbl_pesanan
    public function index()
    {
        $pesanans = DB::table('tbl_pesanan')->get();

        return view('pesanan.index', compact('pesanans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // Menampilkan form tambah pesanan
    public function create()
    {
        return view('pesanan.create');
    }

    // Menyimpan data pesanan baru ke tbl_pesanan
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'jenis_sampah' => 'required|string',
            'berat' => 'required|numeric',
            'status' => 'required|in:on going,process,done',
        ]);

        Pesanan::create($request->all());

        return redirect()->route('pesanan.index')
            ->with('success', 'Data pesanan berhasil ditambahkan');
    }

    // Menampilkan form edit untuk pesanan
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.edit', compact('pesanan'));
    }

    // Menyimpan perubahan data pesanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string',
            'jenis_sampah' => 'required|string',
            'berat' => 'required|numeric',
            'status' => 'required|in:on going,process,done',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($request->status === 'done') {
            // Simpan ke tbl_riwayat
            DB::table('tbl_riwayat')->insert([
                'tanggal' => $request->tanggal,
                'nama' => $request->nama,
                'jenis_sampah' => $request->jenis_sampah,
                'berat' => $request->berat,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Hapus dari tbl_pesanan
            $pesanan->delete();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan selesai dan dipindahkan ke Riwayat');
        }

        // Update biasa jika status bukan 'done'
        $pesanan->update($request->all());

        return redirect()->route('pesanan.index')
            ->with('success', 'Data pesanan berhasil diperbarui');
    }

    // Menghapus data pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')
            ->with('success', 'Data pesanan berhasil dihapus');
    }

    // Mengubah status pesanan secara terpisah dan pindahkan ke tbl_riwayat jika status = done
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:on going,process,done',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($request->status === 'done') {
            DB::table('tbl_riwayat')->insert([
                'tanggal' => $pesanan->tanggal,
                'nama' => $pesanan->nama,
                'jenis_sampah' => $pesanan->jenis_sampah,
                'berat' => $pesanan->berat,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $pesanan->delete();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan selesai dan dipindahkan ke Riwayat');
        }

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
