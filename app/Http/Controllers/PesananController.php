<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pesananc;
use App\Models\Jenis;
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

        $pesanan->jenis_sampah = json_encode($newJenisSampah);
        $pesanan->berat = $totalBerat; // sesuai field di tabel
        $pesanan->total_pesanan = $totalHarga; // sesuai field di tabel
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui');
    }


    public function destroy($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
