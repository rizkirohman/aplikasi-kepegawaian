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

        // Admin dan Pimpinan tidak wajib memiliki data Pegawai
        if ($user->isAdmin() || $user->isPimpinan()) {
            return $next($request);
        }

        // Pegawai wajib memiliki data Pegawai
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

        // Pegawai hanya boleh mengakses sistem jika statusnya Aktif
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