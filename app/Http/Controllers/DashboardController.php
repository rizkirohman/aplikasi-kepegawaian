<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();

        $totalDosen = Pegawai::where('jenis_pegawai', 'Dosen')->count();

        $totalTendik = Pegawai::where('jenis_pegawai', 'Tenaga Kependidikan')->count();

        return view('dashboard', compact(
            'totalPegawai',
            'totalDosen',
            'totalTendik'
        ));
    }
}
