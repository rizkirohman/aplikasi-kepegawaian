<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Pastikan user memiliki data pegawai
            if (!$user->pegawai) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun belum terhubung dengan data pegawai.',
                ])->onlyInput('email');
            }

            // Hanya pegawai dengan status Aktif yang boleh login
            if ($user->pegawai->status_pegawai !== 'Aktif') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun tidak dapat login karena status pegawai adalah '
                        . $user->pegawai->status_pegawai . '.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}