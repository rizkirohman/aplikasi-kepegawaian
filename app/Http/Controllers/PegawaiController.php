<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::with(['unitKerja', 'jabatan'])
            ->latest()
            ->paginate(10);

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unitKerjas = UnitKerja::orderBy('nama_unit_kerja')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();

        return view('pegawai.create', compact('unitKerjas', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nip' => 'required|string|max:50|unique:pegawais,nip',
                'nidn_nidk' => 'nullable|string|max:50',
                'nama_lengkap' => 'required|string|max:255',

                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'nullable|string|max:100',
                'tanggal_lahir' => 'required|date',

                'status_perkawinan' => 'nullable|in:Menikah,Bercerai',

                'alamat' => 'nullable|string',
                'no_hp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',

                'jenis_pegawai' => 'required|in:Dosen,Tenaga Kependidikan',
                'status_kepegawaian' => 'nullable|string|max:100',
                'tmt' => 'nullable|date',

                'unit_kerja_id' => 'nullable|exists:unit_kerjas,id',
                'jabatan_id' => 'nullable|exists:jabatans,id',

                'pendidikan_terakhir' => 'nullable|in:SMA,D3,S1,S2,S3',

                'jabatan_fungsional' => 'nullable|in:Asisten Ahli,Lektor,Lektor Kepala,Profesor',
            ],
            [
                'nip.required' => 'NIP wajib diisi.',
                'nip.unique' => 'NIP sudah terdaftar.',
                'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'jenis_pegawai.required' => 'Jenis pegawai wajib dipilih.',

                'foto.image' => 'File foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
                'foto.max' => 'Ukuran foto maksimal 2 MB.',

                'email.email' => 'Format email tidak valid.',

                'unit_kerja_id.exists' => 'Unit kerja tidak valid.',
                'jabatan_id.exists' => 'Jabatan tidak valid.',
            ]
        );

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto-pegawai', 'public');
        }

        Pegawai::create($validated);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        $pegawai->load([
        'unitKerja',
        'jabatan',
        ]);

        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $unitKerjas = UnitKerja::orderBy('nama_unit_kerja')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();

        return view('pegawai.edit', compact(
            'pegawai',
            'unitKerjas',
            'jabatans'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate(
            [
                'nip' => 'required|string|max:50|unique:pegawais,nip,' . $pegawai->id,
                'nidn_nidk' => 'nullable|string|max:50',
                'nama_lengkap' => 'required|string|max:255',

                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'nullable|string|max:100',
                'tanggal_lahir' => 'required|date',

                'status_perkawinan' => 'nullable|in:Menikah,Bercerai',

                'alamat' => 'nullable|string',
                'no_hp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',

                'jenis_pegawai' => 'required|in:Dosen,Tenaga Kependidikan',
                'status_kepegawaian' => 'nullable|string|max:100',
                'tmt' => 'nullable|date',

                'unit_kerja_id' => 'nullable|exists:unit_kerjas,id',
                'jabatan_id' => 'nullable|exists:jabatans,id',

                'pendidikan_terakhir' => 'nullable|in:SMA,D3,S1,S2,S3',

                'jabatan_fungsional' => 'nullable|in:Asisten Ahli,Lektor,Lektor Kepala,Profesor',
            ],
            [
                'nip.required' => 'NIP wajib diisi.',
                'nip.unique' => 'NIP sudah terdaftar.',
                'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'jenis_pegawai.required' => 'Jenis pegawai wajib dipilih.',

                'foto.image' => 'File foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
                'foto.max' => 'Ukuran foto maksimal 2 MB.',

                'email.email' => 'Format email tidak valid.',

                'unit_kerja_id.exists' => 'Unit kerja tidak valid.',
                'jabatan_id.exists' => 'Jabatan tidak valid.',
            ]
        );

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            // Simpan foto baru
            $validated['foto'] = $request->file('foto')
                ->store('foto-pegawai', 'public');
        }

        // Update data pegawai
        $pegawai->update($validated);

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        // Hapus foto jika pegawai memiliki foto
        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        // Hapus data pegawai
        $pegawai->delete();

        return redirect()
            ->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
        }
}
