<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelNasabahController extends Controller
{
    /**
     * Menampilkan detail artikel.
     * Laravel otomatis mencari berdasarkan id_artikel
     */
    public function index(Artikel $artikel)
    {
        $artikel = Artikel::findOrFail($artikel);
        return view('nasabah.pesananc.detail_artikel', compact('artikel'));
    }
}
