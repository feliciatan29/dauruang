<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelNasabahController extends Controller
{
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('nasabah.pesananc.detail_artikel', compact('artikel'));
    }

    // Jika pakai route model binding (opsional)
    // public function show(Artikel $artikel)
    // {
    //     return view('nasabah.detail_artikel', compact('artikel'));
    // }
}
