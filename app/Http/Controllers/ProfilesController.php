<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function __construct()
    {
        // Pastikan semua method butuh login
        $this->middleware('auth');
    }

    public function index()
    {
        // Jika ingin menampilkan semua profile (opsional)
        $profiles = Profiles::with('user')->get();
        return view('nasabah.pesananc.index_profil', compact('profiles'));
    }

    public function create()
    {
        return view('nasabah.pesananc.create_profil');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'  => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp'      => 'nullable|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $user = Auth::user();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_file = time() . '_' . $foto->getClientOriginalName();
            $folder = public_path('Foto_Profil');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $foto->move($folder, $nama_file);
            $data['foto'] = 'Foto_Profil/' . $nama_file;
        }

        $user->profile()->create($data);

        return redirect()->route('profiles.show')
            ->with('success', 'Profil berhasil dibuat!');
    }

    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('nasabah.pesananc.profil', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile; // Bisa null kalau belum dibuat

        return view('nasabah.pesananc.edit_profil', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'nullable|string|max:255', // nama di tabel users
            'nama_lengkap'  => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp'      => 'nullable|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $user = Auth::user();

        // Update nama user jika diubah
        if ($request->filled('nama')) {
            $user->name = $request->nama;
            $user->save();
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_file = time() . '_' . $foto->getClientOriginalName();
            $folder = public_path('Foto_Profil');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $foto->move($folder, $nama_file);
            $data['foto'] = 'Foto_Profil/' . $nama_file;
        }

        // Update atau buat profil
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()->route('profiles.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = Profiles::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')
            ->with('success', 'Profil berhasil dihapus!');
    }
}
