<?php

namespace App\Http\Controllers;

use App\Models\DokumenPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DokumenPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pegawai $pegawai)
    {
        Gate::authorize('view', $pegawai);
        
        $dokumens = $pegawai->dokumen()
            ->latest()
            ->get();

        return view('dokumen-pegawai.index', compact(
            'pegawai',
            'dokumens'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pegawai $pegawai)
    {
        Gate::authorize('create', Pegawai::class);

        $pegawais = Pegawai::orderBy('nama_lengkap')->get();

        return view('dokumen-pegawai.create', compact(
            'pegawai',
            'pegawais'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pegawai $pegawai)
    {
        Gate::authorize('create', Pegawai::class);

        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:255',
            'tanggal_dokumen' => 'nullable|date',
            'file' => 'required|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        $validated['file'] = $request
            ->file('file')
            ->store('dokumen-pegawai', 'local');

        DokumenPegawai::create($validated);

        return redirect()
            ->route('pegawai.dokumen.index', $pegawai->id)
            ->with('success', 'Dokumen kepegawaian berhasil ditambahkan.');
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
    public function edit(Pegawai $pegawai, DokumenPegawai $dokumen) 
    {
        // Pastikan dokumen milik pegawai yang sedang dibuka
        if ($dokumen->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('update', $pegawai);

        $pegawais = Pegawai::orderBy('nama_lengkap')->get();

        return view('dokumen-pegawai.edit', compact(
            'pegawai',
            'dokumen',
            'pegawais'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai, DokumenPegawai $dokumen) 
    {
        // Pastikan dokumen milik pegawai yang sedang dibuka
        if ($dokumen->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('update', $pegawai);

        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:255',
            'tanggal_dokumen' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'keterangan' => 'nullable|string',
        ]);

        // Jika ada file baru
        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($dokumen->file) {
                Storage::disk('local')->delete($dokumen->file);
            }

            // Simpan file baru
            $validated['file'] = $request
                ->file('file')
                ->store('dokumen-pegawai', 'local');
        }

        // Update data dokumen
        $dokumen->update($validated);

        return redirect()
            ->route('pegawai.dokumen.index', $pegawai->id)
            ->with('success', 'Dokumen kepegawaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai, DokumenPegawai $dokumen) 
    {
        // Pastikan dokumen milik pegawai yang sedang dibuka
        if ($dokumen->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('delete', $pegawai);

        // Hapus file dari storage
        if ($dokumen->file) {
            Storage::disk('local')->delete($dokumen->file);
        }

        // Hapus data dari database
        $dokumen->delete();

        return redirect()
            ->route('pegawai.dokumen.index', $pegawai->id)
            ->with('success', 'Dokumen kepegawaian berhasil dihapus.');
    }

    /**
     * 
     * Download dokumen.
     */
    public function download(Pegawai $pegawai,DokumenPegawai $dokumen) 
    {
        if ($dokumen->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('view', $pegawai);

        if (!Storage::disk('local')->exists($dokumen->file)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $namaFile = $dokumen->nama_dokumen . '.pdf';

        return Storage::disk('local')->download(
            $dokumen->file,
            $namaFile
        );
    }

    public function view(Pegawai $pegawai, DokumenPegawai $dokumen)
    {
        if ($dokumen->pegawai_id !== $pegawai->id) {
            abort(404);
        }

        Gate::authorize('view', $pegawai);

        if (!Storage::disk('local')->exists($dokumen->file)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $path = Storage::disk('local')->path($dokumen->file);

        return response()->file($path);
    }

    /**
     * 
     * Untuk sidebar.
     */
    public function all()
    {
        $user = auth()->user();

        if ($user->isPegawai()) {
            $dokumens = DokumenPegawai::with('pegawai')
                ->whereHas('pegawai', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->latest()
                ->get();
        } else {
            $dokumens = DokumenPegawai::with('pegawai')
                ->latest()
                ->get();
        }

        return view('dokumen-pegawai.all', compact('dokumens'));
    }
}
