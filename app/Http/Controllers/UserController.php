<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Halaman login admin
     */
    public function index()
    {
        return view('admin.login', ['title' => 'Login Admin']);
    }

    /**
     * Halaman login nasabah
     */
    public function loginNasabah()
    {
        return view('nasabah.login', ['title' => 'Login Nasabah']);
    }

    /**
     * Proses login admin
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin.beranda');
        }

        return back()->with('loginError', 'Login gagal! Email atau password salah.');
    }

    /**
     * Proses login nasabah
     */
    public function authenticateNasabah(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda-nasabah'); // langsung ke beranda nasabah
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
            'name'                  => 'required|min:3',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:5|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Langsung login setelah register
        Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ]);

        $request->session()->regenerate();

        // Langsung ke beranda nasabah
        return redirect('/beranda-nasabah')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Logout nasabah
     */
    public function logoutNasabah(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-nasabah');
    }
}
