<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    /**
     * Tampilkan daftar nasabah dari profil
     */
    public function index()
    {
        // Ambil data profile beserta relasi user (name, email)
        $profiles = Profiles::with('user')->paginate(20);

        return view('admin.nasabah.index', compact('profiles'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
