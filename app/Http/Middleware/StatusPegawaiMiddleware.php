<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusPegawaiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Jika belum login, lanjutkan ke middleware auth
        if (!$user) {
            return $next($request);
        }

        // Jika user tidak memiliki data pegawai
        if (!$user->pegawai) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Akun tidak memiliki data pegawai.',
                ]);
        }

        // Hanya pegawai Aktif yang boleh mengakses aplikasi
        if ($user->pegawai->status_pegawai !== 'Aktif') {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Akses ditolak karena status pegawai adalah '
                        . $user->pegawai->status_pegawai . '.',
                ]);
        }

        return $next($request);
    }
}