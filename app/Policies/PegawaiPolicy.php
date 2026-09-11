<?php

namespace App\Policies;

use App\Models\Pegawai;
use App\Models\User;

class PegawaiPolicy
{
    /**
     * Admin memiliki akses penuh.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Menampilkan data pegawai.
     */
    public function view(User $user, Pegawai $pegawai): bool
    {
        // Pimpinan dapat melihat semua pegawai
        if ($user->isPimpinan()) {
            return true;
        }

        // Pegawai hanya dapat melihat data dirinya sendiri
        if ($user->isPegawai()) {
            return $pegawai->user_id === $user->id;
        }

        return false;
    }

    /**
     * Menambahkan data pegawai.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Mengubah data pegawai.
     */
    public function update(User $user, Pegawai $pegawai): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menghapus data pegawai.
     */
    public function delete(User $user, Pegawai $pegawai): bool
    {
        return $user->isAdmin();
    }
}