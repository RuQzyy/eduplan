<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Tambahkan logika pengalihan berdasarkan role
            $role = Auth::user()->role; // Pastikan kolom 'role' ada di tabel users
            $peng = Auth::user()->name;

            if ($role === 'admin') {
                Alert::alert('Login', 'selamat datang admin', 'success');
                return redirect()->intended('admin/dashboard');
            } elseif ($role === 'dosen') {

                Alert::alert('Login', 'selamat datang ' . $peng, 'success');
                return redirect()->intended('dosen/dashboard');
            } else {
                return redirect()->intended('dashboard');
            }
        }

        //     return back()->withErrors([
        //         'email' => 'Email atau password salah.',
        //     ])->onlyInput('email');
        Alert::alert('Gagal Login', 'Username atau password salah', 'error');
        return back();
    }

    /**
     * Proses logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::alert('Logout', 'Anda berhasil logout', 'success');
        return redirect('/login');
    }
}
