<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('admin.login', ['title' => 'Login']);
    }

    /**
     * Proses autentikasi login.
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi sesi untuk keamanan
            return redirect()->intended('/admin.beranda'); // ✅ arahkan ke halaman beranda
        }

        // Jika gagal login
        return back()->with('loginError', 'Login gagal! Periksa email atau password.');
    }

    /**
     * Logout user dan hapus session.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token untuk keamanan
        return redirect('/login'); // Kembali ke login
    }
}
