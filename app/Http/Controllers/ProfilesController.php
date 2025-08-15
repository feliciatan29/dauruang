<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan semua profil (khusus admin)
    public function index()
    {
        $profiles = Profiles::with('user')
            ->whereHas('user', fn($q) => $q->where('role', 'nasabah'))
            ->get();

        return view('nasabah.pesananc.index_profil', compact('profiles'));
    }

    // Form create profil
    public function create()
    {
        $this->authorizeNasabah();
        return view('nasabah.pesananc.create_profil');
    }

    // Simpan profil baru
    public function store(Request $request)
    {
        $this->authorizeNasabah();

        $data = $this->validateData($request);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->uploadFoto($request->file('foto'));
        }

        Auth::user()->profile()->create($data);

        return redirect()->route('profiles.show')
            ->with('success', 'Profil berhasil dibuat!');
    }

    // Tampilkan profil nasabah
    public function show()
    {
        $this->authorizeNasabah();
        $user = Auth::user();
        $profile = $user->profile;

        return view('nasabah.pesananc.profil', compact('user', 'profile'));
    }

    // Form edit profil
    public function edit()
    {
        $this->authorizeNasabah();
        $user = Auth::user();
        $profile = $user->profile;

        return view('nasabah.pesananc.edit_profil', compact('user', 'profile'));
    }

    // Update profil
    public function update(Request $request)
    {
        $this->authorizeNasabah();

        $data = $this->validateData($request, true);
        $user = Auth::user();

        // Update nama di tabel users
        if (!empty($data['nama'])) {
            $user->name = $data['nama'];
            $user->save();
            unset($data['nama']);
        }

        // Upload foto jika ada, jika tidak ada tetap pakai yang lama
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->uploadFoto($request->file('foto'));
        }

        // Update data lama hanya pada field yang diisi
        $profile = $user->profile;
        if ($profile) {
            $profile->fill(array_filter($data))->save();
        } else {
            $user->profile()->create($data);
        }

        return redirect()->route('profiles.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // Hapus profil (khusus admin)
    public function destroy($id)
    {
        $profile = Profiles::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')
            ->with('success', 'Profil berhasil dihapus!');
    }

    // ======================== Helper Methods ========================

    private function authorizeNasabah()
    {
        if (Auth::user()->role !== 'nasabah') {
            abort(403, 'Akses ditolak');
        }
    }

    private function validateData(Request $request, $isUpdate = false)
    {
        $rules = [
            'nama'          => 'nullable|string|max:255', // untuk tabel users
            'nama_lengkap'  => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp'      => 'nullable|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ];

        return $request->validate($rules);
    }

    private function uploadFoto($file)
    {
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $folder = public_path('Foto_Profil');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $file->move($folder, $nama_file);
        return 'Foto_Profil/' . $nama_file;
    }
}
