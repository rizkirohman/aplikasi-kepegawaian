<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RiwayatPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pegawai $pegawai)
    {
        Gate::authorize('view', $pegawai);

        $riwayatPendidikans = $pegawai->riwayatPendidikan()
            ->latest('tahun_lulus')
            ->paginate(10);

        return view('riwayat-pendidikan.index', compact(
            'pegawai',
            'riwayatPendidikans'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pegawai $pegawai)
    {
        Gate::authorize('create', Pegawai::class);

        return view('riwayat-pendidikan.create', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pegawai $pegawai)
    {
        Gate::authorize('create', Pegawai::class);

        $validated = $request->validate(
            [
                'jenjang' => 'required|in:SMA,D3,S1,S2,S3',
                'program_studi' => 'required|string|max:255',
                'perguruan_tinggi' => 'required|string|max:255',
                'tahun_lulus' => 'nullable|integer|min:1900|max:' . date('Y'),
                'gelar' => 'nullable|string|max:100',
            ],
            [
                'jenjang.required' => 'Jenjang wajib dipilih.',
                'jenjang.in' => 'Jenjang tidak valid.',
                'program_studi.required' => 'Program studi wajib diisi.',
                'program_studi.max' => 'Program studi maksimal 255 karakter.',
                'perguruan_tinggi.required' => 'Perguruan tinggi wajib diisi.',
                'perguruan_tinggi.max' => 'Perguruan tinggi maksimal 255 karakter.',
                'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
                'tahun_lulus.min' => 'Tahun lulus tidak valid.',
                'tahun_lulus.max' => 'Tahun lulus tidak boleh lebih dari tahun sekarang.',
                'gelar.max' => 'Gelar maksimal 100 karakter.',
            ]
        );

        $pegawai->riwayatPendidikan()->create($validated);

        return redirect()
            ->route('pegawai.riwayat-pendidikan.index', $pegawai->id)
            ->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
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
    public function edit(Pegawai $pegawai, RiwayatPendidikan $riwayatPendidikan)
    {
        if ($riwayatPendidikan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('update', $pegawai);

        return view('riwayat-pendidikan.edit', compact(
            'pegawai',
            'riwayatPendidikan'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai, RiwayatPendidikan $riwayatPendidikan)
    {
        if ($riwayatPendidikan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('update', $pegawai);

        $validated = $request->validate(
            [
                'jenjang' => 'required|in:SMA,D3,S1,S2,S3',
                'program_studi' => 'required|string|max:255',
                'perguruan_tinggi' => 'required|string|max:255',
                'tahun_lulus' => 'nullable|integer|min:1900|max:' . date('Y'),
                'gelar' => 'nullable|string|max:100',
            ],
            [
                'jenjang.required' => 'Jenjang wajib dipilih.',
                'jenjang.in' => 'Jenjang tidak valid.',
                'program_studi.required' => 'Program studi wajib diisi.',
                'program_studi.max' => 'Program studi maksimal 255 karakter.',
                'perguruan_tinggi.required' => 'Perguruan tinggi wajib diisi.',
                'perguruan_tinggi.max' => 'Perguruan tinggi maksimal 255 karakter.',
                'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
                'tahun_lulus.min' => 'Tahun lulus tidak valid.',
                'tahun_lulus.max' => 'Tahun lulus tidak boleh lebih dari tahun sekarang.',
                'gelar.max' => 'Gelar maksimal 100 karakter.',
            ]
        );

        $riwayatPendidikan->update($validated);

        return redirect()
            ->route('pegawai.riwayat-pendidikan.index', $pegawai->id)
            ->with('success', 'Riwayat pendidikan berhasil diperbarui.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai, RiwayatPendidikan $riwayatPendidikan)
    {
        if ($riwayatPendidikan->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('delete', $pegawai);

        $riwayatPendidikan->delete();

        return redirect()
            ->route('pegawai.riwayat-pendidikan.index', $pegawai->id)
            ->with('success', 'Riwayat pendidikan berhasil dihapus.');
        }
}
