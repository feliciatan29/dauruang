<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesananc;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $pesanans = Pesananc::orderByDesc('created_at')->paginate(10);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        $jenisSampah = json_decode($pesanan->jenis_sampah, true) ?? [];


        return view('admin.pesanan.edit', compact('pesanan', 'jenisSampah'));
    }

    // Update pesanan & pindahkan ke riwayat jika status = transaksi berhasil
   public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:sedang diproses,telah diterima,transaksi berhasil',
        'jenis_sampah' => 'required|array',
    ]);

    $inputJenis = collect($request->jenis_sampah)
        ->filter(function ($item) {
            return isset($item['checked']) && $item['checked'] == 1 && !empty($item['nama']);
        })->values();

    // Validasi berat dan harga untuk item yang dicentang saja
    foreach ($inputJenis as $index => $item) {
        if (!isset($item['jumlah']) || !is_numeric($item['jumlah']) || $item['jumlah'] < 0) {
            return back()->withErrors([
                "jenis_sampah.{$index}.jumlah" => 'Berat harus diisi dan minimal 0.'
            ])->withInput();
        }

        if (!isset($item['harga']) || !is_numeric($item['harga']) || $item['harga'] < 0) {
            return back()->withErrors([
                "jenis_sampah.{$index}.harga" => 'Harga harus diisi dan minimal 0.'
            ])->withInput();
        }
    }

    $pesanan = Pesananc::findOrFail($id);
    $finalJenis = [];
    $totalBerat = 0;
    $totalHarga = 0;

    foreach ($inputJenis as $item) {
        $nama = $item['nama'];
        $berat = floatval($item['jumlah']);
        $harga = floatval($item['harga']);
        $subtotal = $berat * $harga;

        $finalJenis[] = [
            'nama' => $nama,
            'jumlah' => $berat,
            'harga' => $harga,
        ];

        $totalBerat += $berat;
        $totalHarga += $subtotal;
    }

    if ($request->status === 'transaksi berhasil') {
        DB::table('tbl_riwayat')->insert([
            'nama' => $pesanan->nama,
            'telepon' => $pesanan->telepon,
            'alamat' => $pesanan->alamat,
            'tanggal' => $pesanan->tanggal,
            'waktu' => $pesanan->waktu,
            'gambar' => $pesanan->gambar ? basename($pesanan->gambar) : null,
            'catatan' => $pesanan->catatan,
            'status' => 'transaksi berhasil',
            'jenis_sampah' => json_encode($finalJenis),
            'berat' => $totalBerat,
            'total_pesanan' => $totalHarga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dipindahkan ke Riwayat.');
    }

    $pesanan->update([
        'status' => $request->status,
        'jenis_sampah' => json_encode($finalJenis),
        'berat' => $totalBerat,
        'total_pesanan' => $totalHarga,
    ]);

    return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil diperbarui.');
}

    // Hapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesananc::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
