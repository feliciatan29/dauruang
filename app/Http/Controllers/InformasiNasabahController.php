<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiNasabahController extends Controller
{
    public function show($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('nasabah.pesananc.detail_informasi', compact('informasi'));
    }

    // Jika pakai route model binding:
    // public function show(Informasi $informasi)
    // {
    //     return view('nasabah.detail_informasi', compact('informasi'));
    // }
}
