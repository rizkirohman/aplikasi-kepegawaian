<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatJabatan;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pegawai $pegawai)
    {
        Gate::authorize('view', $pegawai);

        $riwayatJabatans = $pegawai->riwayatJabatan()
            ->latest('tmt')
            ->paginate(5);

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
        Gate::authorize('create', Pegawai::class);

        return view('riwayat-jabatan.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pegawai $pegawai)
    {
        Gate::authorize('create', Pegawai::class);

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'dokumen_sk' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('dokumen_sk')) {
            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-jabatan', 'local');
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

        Gate::authorize('update', $pegawai);

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

        Gate::authorize('update', $pegawai);

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'nullable|string|max:255',
            'tmt' => 'required|date',
            'nomor_sk' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'dokumen_sk' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Jika upload dokumen baru
        if ($request->hasFile('dokumen_sk')) {

            // Hapus dokumen lama
            if ($riwayatJabatan->dokumen_sk) {
                Storage::disk('local')
                    ->delete($riwayatJabatan->dokumen_sk);
            }

            // Simpan dokumen baru
            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-jabatan', 'local');
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

        Gate::authorize('delete', $pegawai);

        // Hapus file dokumen jika ada
        if ($riwayatJabatan->dokumen_sk) {
            Storage::disk('local')
                ->delete($riwayatJabatan->dokumen_sk);
        }

        // Hapus data riwayat jabatan
        $riwayatJabatan->delete();

        return redirect()->route('pegawai.riwayat-jabatan.index', $pegawai->id)
            ->with('success', 'Riwayat jabatan berhasil dihapus.');
        }

        public function view(Pegawai $pegawai, RiwayatJabatan $riwayatJabatan)
        {
            if ($riwayatJabatan->pegawai_id !== $pegawai->id) {
                abort(404);
            }

            Gate::authorize('view', $pegawai);

            if (!Storage::disk('local')->exists($riwayatJabatan->dokumen_sk)) {
                abort(404, 'File dokumen SK tidak ditemukan.');
            }

            $path = Storage::disk('local')->path($riwayatJabatan->dokumen_sk);

            return response()->file($path);
        }
}
