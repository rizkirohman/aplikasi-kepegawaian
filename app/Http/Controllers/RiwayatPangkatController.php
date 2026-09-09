<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatPangkatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pangkat seorang pegawai.
     */
    public function index(Pegawai $pegawai)
    {
        $riwayatPangkats = $pegawai->riwayatPangkat()
            ->latest('tmt')
            ->get();

        return view('riwayat-pangkat.index', compact(
            'pegawai',
            'riwayatPangkats'
        ));
    }

    /**
     * Menampilkan form tambah riwayat pangkat.
     */
    public function create(Pegawai $pegawai)
    {
        return view('riwayat-pangkat.create', compact('pegawai'));
    }

    public function store(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate(
            [
                'pangkat' => 'required|string|max:255',
                'golongan' => 'required|string|max:50',
                'tmt' => 'required|date',
                'nomor_sk' => 'nullable|string|max:255',
                'tanggal_sk' => 'nullable|date',
                'dokumen_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ],
            [
                'pangkat.required' => 'Pangkat wajib diisi.',
                'golongan.required' => 'Golongan wajib diisi.',
                'tmt.required' => 'TMT wajib diisi.',
                'dokumen_sk.file' => 'Dokumen SK harus berupa file.',
                'dokumen_sk.mimes' => 'Dokumen SK harus berformat PDF, JPG, JPEG, atau PNG.',
                'dokumen_sk.max' => 'Ukuran Dokumen SK maksimal 2 MB.',
            ]
        );

        if ($request->hasFile('dokumen_sk')) {
            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-pangkat', 'public');
        }

        $pegawai->riwayatPangkat()->create($validated);

        return redirect()
            ->route('pegawai.riwayat-pangkat.index', $pegawai->id)
            ->with('success', 'Riwayat pangkat berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai, RiwayatPangkat $riwayatPangkat)
    {
        return view('riwayat-pangkat.edit', compact(
            'pegawai',
            'riwayatPangkat'
        ));
    }

    public function update(Request $request, Pegawai $pegawai, RiwayatPangkat $riwayatPangkat) 
    {
        if ($riwayatPangkat->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        $validated = $request->validate(
            [
                'pangkat' => 'required|string|max:100',
                'golongan' => 'required|string|max:20',
                'tmt' => 'required|date',
                'nomor_sk' => 'nullable|string|max:255',
                'tanggal_sk' => 'nullable|date',
                'dokumen_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ],
            [
                'pangkat.required' => 'Pangkat wajib diisi.',
                'golongan.required' => 'Golongan wajib diisi.',
                'tmt.required' => 'TMT wajib diisi.',
                'tmt.date' => 'Format TMT tidak valid.',
                'tanggal_sk.date' => 'Format tanggal SK tidak valid.',
                'dokumen_sk.file' => 'Dokumen SK harus berupa file.',
                'dokumen_sk.mimes' => 'Dokumen SK harus berupa PDF, JPG, JPEG, atau PNG.',
                'dokumen_sk.max' => 'Ukuran dokumen SK maksimal 2 MB.',
            ]
        );

        if ($request->hasFile('dokumen_sk')) {

            if ($riwayatPangkat->dokumen_sk) {
                Storage::disk('public')->delete($riwayatPangkat->dokumen_sk);
            }

            $validated['dokumen_sk'] = $request
                ->file('dokumen_sk')
                ->store('dokumen-pangkat', 'public');
        }

        $riwayatPangkat->update($validated);

        return redirect()
            ->route('pegawai.riwayat-pangkat.index', $pegawai)
            ->with('success', 'Riwayat pangkat berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai, RiwayatPangkat $riwayatPangkat) 
    {
        if ($riwayatPangkat->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        if ($riwayatPangkat->dokumen_sk) {
            Storage::disk('public')->delete($riwayatPangkat->dokumen_sk);
        }

        $riwayatPangkat->delete();

        return redirect()
            ->route('pegawai.riwayat-pangkat.index', $pegawai)
            ->with('success', 'Riwayat pangkat berhasil dihapus.');
    }
}
