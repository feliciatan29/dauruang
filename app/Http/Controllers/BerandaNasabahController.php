<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Informasi;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BerandaNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index()
{
    // Ambil total pesanan dari riwayat dengan status "transaksi berhasil"
    $totalPesanan = Riwayat::whereRaw("LOWER(TRIM(status)) = 'transaksi berhasil'")
        ->sum('total_pesanan');

    // Format ke Rupiah
    $totalRupiah = number_format($totalPesanan, 0, ',', '.');

    // Artikel & Informasi terbaru
    $artikels = Artikel::orderBy('tgl_terbit', 'desc')->take(3)->get();
    $informasis = Informasi::orderBy('tgl_informasi', 'desc')->take(6)->get();

    return view('nasabah.beranda', compact('artikels', 'informasis', 'totalRupiah'));
}





    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
}
