<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class LaporanController extends Controller
{
    public function pegawai()
    {
        $pegawais = Pegawai::with([
            'unitKerja',
            'jabatan',
        ])
            ->orderBy('nama_lengkap')
            ->get();

        return view('laporan.pegawai', compact('pegawais'));
    }
}