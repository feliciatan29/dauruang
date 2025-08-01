<?php

namespace App\Http\Controllers;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ INI YANG WAJIB ADA

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('nasabah.pesananc.profil', compact('user', 'profile'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
{
    $user = Auth::user();
    $profile = $user->profile;

    return view('nasabah.pesananc.edit_profil', compact('user', 'profile'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
{
    $data = $request->validate([
        'nama' => 'string|max:255', // nama di tabel users
        'nama_lengkap' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        'nomor_hp' => 'nullable|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    ]);

    $user = Auth::user();

    // Update nama di tabel users
    if ($request->filled('nama')) {
        $user->name = $request->nama;
        $user->save();
    }

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');

        $folder = public_path('Foto_Profil');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $nama_file = time() . '_' . $foto->getClientOriginalName();
        $foto->move($folder, $nama_file);

        // Simpan path yang bisa dipakai untuk ditampilkan
        $data['foto'] = 'Foto_Profil/' . $nama_file;
    }

    // Update atau buat profil
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        $data
    );

    return redirect()->route('profiles.show')->with('success', 'Profil berhasil diperbarui!');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
