<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function store(Request $request)
{
    $request->validate([
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'tanggal' => 'required|date',
        'waktu' => 'required|string',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'catatan' => 'nullable|string',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('uploads/gambar', 'public');
    }
    // Simpan ke DB
    $pesanan = Pesanan::create([
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'gambar' => $gambarPath,
        'catatan' => $request->catatan,
        'jenis_sampah' => json_encode(session('keranjang')),
        'status' => 'diproses',
    ]);

    return redirect()->route('pesanan.detail', $pesanan->id)->with('success', 'Pesanan berhasil dikirim!');
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pesananc');
    }
};
