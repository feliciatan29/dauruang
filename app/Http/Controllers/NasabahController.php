<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        // Ambil data profile beserta relasi user
        $profiles = Profiles::with('user')->paginate(20);

        return view('admin.nasabah.index', compact('profiles'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'nomor_hp'      => 'nullable|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $tujuan_upload = public_path('Foto_Nasabah');
            if (!file_exists($tujuan_upload)) {
                mkdir($tujuan_upload, 0777, true);
            }
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move($tujuan_upload, $nama_file);
            $data['foto'] = $nama_file;
        }

        Profiles::create($data);

        return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil disimpan.');
    }

    public function edit(Profiles $profile)
    {
        return view('admin.nasabah.edit', compact('profile'));
    }

    public function update(Request $request, Profiles $profile)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'nomor_hp'      => 'nullable|string|max:20',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $tujuan_upload = public_path('Foto_Nasabah');

            if ($profile->foto && file_exists($tujuan_upload . '/' . $profile->foto)) {
                unlink($tujuan_upload . '/' . $profile->foto);
            }

            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move($tujuan_upload, $nama_file);
            $data['foto'] = $nama_file;
        }

        $profile->update($data);

        return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil diperbarui.');
    }

    public function destroy(Profiles $profile)
    {
        $tujuan_upload = public_path('Foto_Nasabah');

        if ($profile->foto && file_exists($tujuan_upload . '/' . $profile->foto)) {
            unlink($tujuan_upload . '/' . $profile->foto);
        }

        $profile->delete();

        return redirect()->route('admin.nasabah.index')->with('success', 'Data nasabah berhasil dihapus.');
    }
}
