<?php

namespace App\Http\Controllers;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitKerjas = UnitKerja::latest()->paginate(10);

        return view('unit-kerja.index', compact('unitKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit-kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_unit_kerja' => 'required|string|max:255',
                'kode' => 'nullable|string|max:50',
                'keterangan' => 'nullable|string',
            ],
            [
                'nama_unit_kerja.required' => 'Nama unit kerja wajib diisi.',
                'nama_unit_kerja.max' => 'Nama unit kerja maksimal 255 karakter.',
                'kode.max' => 'Kode maksimal 50 karakter.',
            ]
        );

        UnitKerja::create($validated);

        return redirect()
            ->route('unit-kerja.index')
            ->with('success', 'Unit kerja berhasil ditambahkan.');
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
    public function edit(UnitKerja $unitKerja)
    {
        return view('unit-kerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitKerja $unitKerja)
    {
        $validated = $request->validate(
            [
                'nama_unit_kerja' => 'required|string|max:255',
                'kode' => 'nullable|string|max:50',
                'keterangan' => 'nullable|string',
            ],
            [
                'nama_unit_kerja.required' => 'Nama unit kerja wajib diisi.',
                'nama_unit_kerja.max' => 'Nama unit kerja maksimal 255 karakter.',
                'kode.max' => 'Kode maksimal 50 karakter.',
            ]
        );

        $unitKerja->update($validated);

        return redirect()
            ->route('unit-kerja.index')
            ->with('success', 'Unit kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitKerja $unitKerja)
    {
        if ($unitKerja->pegawai()->exists()) {
            return redirect()
                ->route('unit-kerja.index')
                ->with('error', 'Unit kerja tidak dapat dihapus karena masih digunakan oleh data pegawai.');
        }

        $unitKerja->delete();

        return redirect()
            ->route('unit-kerja.index')
            ->with('success', 'Unit kerja berhasil dihapus.');
        }
}
