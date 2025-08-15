<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    /**
     * Proses login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.beranda');
            } elseif ($user->role === 'nasabah') {
                return redirect()->route('nasabah.beranda');
            } else {
                // Logout jika role tidak valid
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('loginError', 'Role tidak dikenali.');
            }
        }

        return back()->with('loginError', 'Login gagal! Email atau password salah.');
    }

    /**
     * Halaman register nasabah
     */
    public function registerNasabah()
    {
        return view('nasabah.register', ['title' => 'Daftar Nasabah']);
    }

    /**
     * Proses register nasabah
     */
    public function storeNasabah(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'nasabah'
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('nasabah.beranda')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }
}
