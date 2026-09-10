<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pegawai $pegawai)
    {
        $riwayatJabatans = $pegawai->riwayatJabatan()
            ->latest('tmt')
            ->get();

        return view('riwayat-jabatan.index', compact(
            'pegawai',
            'riwayatJabatans'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pegawai $pegawai)
    {
        return view('riwayat-jabatan.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'dokumen_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('dokumen_sk')) {
            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-jabatan', 'public');
        }

        $pegawai->riwayatJabatan()->create($validated);

        return redirect()
            ->route('pegawai.riwayat-jabatan.index', $pegawai->id)
            ->with('success', 'Riwayat jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai, RiwayatJabatan $riwayatJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai, RiwayatJabatan $riwayatJabatan)
    {
        if ($riwayatJabatan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        return view('riwayat-jabatan.edit', compact(
            'pegawai',
            'riwayatJabatan',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai, RiwayatJabatan $riwayatJabatan)
    {
         // Pastikan riwayat jabatan memang milik pegawai tersebut
        if ($riwayatJabatan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'dokumen_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Jika upload dokumen baru
        if ($request->hasFile('dokumen_sk')) {

            // Hapus dokumen lama
            if ($riwayatJabatan->dokumen_sk) {
                Storage::disk('public')
                    ->delete($riwayatJabatan->dokumen_sk);
            }

            // Simpan dokumen baru
            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-jabatan', 'public');
        }

        $riwayatJabatan->update($validated);

        return redirect()->route('pegawai.riwayat-jabatan.index', $pegawai->id)
            ->with('success','Riwayat jabatan berhasil diperbarui.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai, RiwayatJabatan $riwayatJabatan)
    {
        // Pastikan riwayat jabatan memang milik pegawai tersebut
        if ($riwayatJabatan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        // Hapus file dokumen jika ada
        if ($riwayatJabatan->dokumen_sk) {
            Storage::disk('public')
                ->delete($riwayatJabatan->dokumen_sk);
        }

        // Hapus data riwayat jabatan
        $riwayatJabatan->delete();

        return redirect()->route('pegawai.riwayat-jabatan.index', $pegawai->id)
            ->with('success', 'Riwayat jabatan berhasil dihapus.');
        }
}
