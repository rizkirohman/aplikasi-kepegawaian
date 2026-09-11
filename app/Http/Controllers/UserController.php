<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::with('pegawai')
            ->latest()
            ->paginate(5);

        return view('user.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        $pegawais = Pegawai::whereNull('user_id')
            ->orderBy('nama_lengkap')
            ->get();

        return view('user.create', compact('pegawais'));
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pimpinan,pegawai',
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        // Pastikan pegawai belum memiliki akun
        $pegawai = Pegawai::findOrFail($validated['pegawai_id']);

        if ($pegawai->user_id !== null) {
            return back()
                ->withInput()
                ->withErrors([
                    'pegawai_id' => 'Pegawai tersebut sudah memiliki akun.',
                ]);
        }

        // Buat user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        // Hubungkan user dengan pegawai
        $pegawai->update([
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan dan dihubungkan dengan pegawai.');
    }

    /**
     * Menampilkan detail user.
     */
    public function show(User $user)
    {
        $user->load('pegawai');

        return view('user.show', compact('user'));
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit(User $user)
    {
        $pegawais = Pegawai::whereNull('user_id')
            ->orWhere('user_id', $user->id)
            ->orderBy('nama_lengkap')
            ->get();

        return view('user.edit', compact('user', 'pegawais'));
    }

    /**
     * Memperbarui user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,pimpinan,pegawai',
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        // Pastikan pegawai yang dipilih belum terhubung
        // atau memang milik user yang sedang diedit.
        $pegawai = Pegawai::findOrFail($validated['pegawai_id']);

        if (
            $pegawai->user_id !== null &&
            $pegawai->user_id !== $user->id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'pegawai_id' => 'Pegawai tersebut sudah terhubung dengan user lain.',
                ]);
        }

        // Cari pegawai lama yang terhubung dengan user ini.
        $pegawaiLama = $user->pegawai;

        // Update data user.
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        // Jika pegawai diganti, lepaskan hubungan pegawai lama.
        if ($pegawaiLama && $pegawaiLama->id !== $pegawai->id) {
            $pegawaiLama->update([
                'user_id' => null,
            ]);
        }

        // Hubungkan dengan pegawai baru.
        $pegawai->update([
            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user)
    {
        // Jangan izinkan admin menghapus akun yang sedang digunakan.
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        // Cari pegawai yang terhubung dengan user.
        $pegawai = $user->pegawai;

        // Lepaskan hubungan User dengan Pegawai.
        if ($pegawai) {
            $pegawai->update([
                'user_id' => null,
            ]);
        }

        // Hapus user.
        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}