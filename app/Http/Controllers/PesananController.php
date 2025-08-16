<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesananc;
use App\Models\Jenis;
use App\Models\Riwayat; // ✅ Tambahkan Model Riwayat
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesananc::orderByDesc('created_at')->paginate(10);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function edit($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        $jenisSampah = json_decode($pesanan->jenis_sampah, true) ?? [];
        $allJenis = Jenis::all();

        return view('admin.pesanan.edit', compact('pesanan', 'jenisSampah', 'allJenis'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesananc::findOrFail($id);

        $inputSampah = $request->input('jenis_sampah', []);
        $newJenisSampah = [];
        $totalBerat = 0;
        $totalHarga = 0;

        foreach ($inputSampah as $item) {
            // Hanya masukkan jika checkbox dicentang
            if (isset($item['checked'])) {
                $jumlah = floatval($item['jumlah'] ?? 0);
                $harga = floatval($item['harga'] ?? 0);
                $total = $jumlah * $harga;

                $newJenisSampah[] = [
                    'nama' => $item['nama'] ?? '',
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'total' => $total,
                    'checked' => true
                ];

                $totalBerat += $jumlah;
                $totalHarga += $total;
            }
        }

        // Update nilai di model
        $pesanan->jenis_sampah = json_encode($newJenisSampah);
        $pesanan->berat = $totalBerat;
        $pesanan->total_pesanan = $totalHarga;
        $pesanan->status = $request->status;
        $pesanan->catatan = $request->catatan; // <-- tambah ini biar catatan ikut terupdate


        // ✅ Tambahan: Pindahkan ke tbl_riwayat jika transaksi berhasil
        if ($request->status === 'transaksi berhasil') {
            Riwayat::create([
                'nama'          => $pesanan->nama,
                'tanggal'       => $pesanan->tanggal,
                'waktu'         => $pesanan->waktu,
                'telepon'       => $pesanan->telepon,
                'alamat'        => $pesanan->alamat,
                'jenis_sampah'  => $pesanan->jenis_sampah,
                'berat'         => $pesanan->berat,
                'total_pesanan' => $pesanan->total_pesanan,
                'catatan'       => $pesanan->catatan,
                'status'        => $pesanan->status,
                'gambar'        => $pesanan->gambar,
                'created_at'    => $pesanan->created_at,
                'updated_at'    => now()
            ]);

            // Hapus dari tabel pesanan
            $pesanan->delete();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan berhasil dipindahkan ke Riwayat');
        }

        // Jika status bukan transaksi berhasil → simpan biasa
        $pesanan->save();

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
