<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::latest()->paginate(10);

        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_jabatan' => 'required|string|max:255',
                'jenis' => 'required|in:Struktural,Fungsional,Pelaksana',
                'keterangan' => 'nullable|string',
            ],
            [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter.',
                'jenis.required' => 'Jenis jabatan wajib dipilih.',
                'jenis.in' => 'Jenis jabatan tidak valid.',
            ]
        );

        Jabatan::create($validated);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan.');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $request->validate(
            [
                'nama_jabatan' => 'required|string|max:255',
                'jenis' => 'required|in:Struktural,Fungsional,Pelaksana',
                'keterangan' => 'nullable|string',
            ],
            [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter.',
                'jenis.required' => 'Jenis jabatan wajib dipilih.',
                'jenis.in' => 'Jenis jabatan tidak valid.',
            ]
        );

        $jabatan->update($validated);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->pegawai()->exists()) {
            return redirect()
                ->route('jabatan.index')
                ->with('error', 'Jabatan tidak dapat dihapus karena masih digunakan oleh data pegawai.');
            }

        $jabatan->delete();

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus.');
        }
}
