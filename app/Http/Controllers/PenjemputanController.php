<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesananC;

class PenjemputanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('cari');

        $penjemputans = PesananC::when($search, function ($query, $search) {
            $query->where('tanggal', 'like', "%$search%")
                  ->orWhere('waktu', 'like', "%$search%");
        })->get();

        return view('admin.penjemputan.index', compact('penjemputans'))
            ->with('i', 0);
    }

    // Jika tidak ingin create/store/edit/update, bisa hapus fungsi-fungsi di bawah ini.
    // Tapi jika ingin tetap menyimpan ke tabel 'pesananc', gunakan ini:


}
