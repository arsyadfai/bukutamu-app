<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        // Jika pengguna sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect()->route('home'); // Redirect ke halaman home
        }

        // Cek cache agar tidak disimpan
        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman form buku tamu dengan notifikasi sukses
            return redirect()->route('guestbook.index')->with('success', 'Login berhasil!');
        }

        // Jika login gagal, redirect ke halaman login dengan notifikasi error
        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout

        // Menghapus sesi dan menambahkan header untuk mencegah cache
        $response = redirect()->route('home')->with('success', 'Anda telah logout.');

        // Menambahkan header untuk mencegah cache setelah logout
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
    }
}
