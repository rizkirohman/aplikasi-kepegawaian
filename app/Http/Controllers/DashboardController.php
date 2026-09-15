<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        // Total seluruh pegawai
        $totalPegawai = Pegawai::count();

        // Total pegawai aktif
        $totalPegawaiAktif = Pegawai::where('status_pegawai', 'Aktif')->count();

        // Total dosen aktif
        $totalDosen = Pegawai::where('jenis_pegawai', 'Dosen')
            ->where('status_pegawai', 'Aktif')
            ->count();

        // Total tenaga kependidikan aktif
        $totalTendik = Pegawai::where('jenis_pegawai', 'Tenaga Kependidikan')
            ->where('status_pegawai', 'Aktif')
            ->count();

        return view('dashboard', compact(
            'totalPegawai',
            'totalPegawaiAktif',
            'totalDosen',
            'totalTendik'
        ));
    }
}
