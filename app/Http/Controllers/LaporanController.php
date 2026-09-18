<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pegawai(Request $request)
    {
        $query = Pegawai::with([
            'unitKerja',
            'jabatan',
        ]);

        // Pencarian nama, NIP, atau NIDN/NIDK
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('nidn_nidk', 'like', '%' . $search . '%');
            });
        }

        // Filter jenis pegawai
        if ($request->filled('jenis_pegawai')) {
            $query->where('jenis_pegawai', $request->jenis_pegawai);
        }

        // Filter unit kerja
        if ($request->filled('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        // Filter status kepegawaian
        if ($request->filled('status_kepegawaian')) {
            $query->where('status_kepegawaian', $request->status_kepegawaian);
        }

        // Filter status pegawai
        if ($request->filled('status_pegawai')) {
            $query->where('status_pegawai', $request->status_pegawai);
        }

        $pegawais = $query
            ->orderBy('nama_lengkap')
            ->get();

        $unitKerjas = UnitKerja::orderBy('nama_unit_kerja')->get();

        return view('laporan.pegawai', compact('pegawais', 'unitKerjas'));
    }
}