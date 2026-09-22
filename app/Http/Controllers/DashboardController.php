<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Carbon\Carbon;

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

        // Periode 1 tahun ke depan
        $hariIni = Carbon::today();
        $satuTahunLagi = $hariIni->copy()->addYear();

        // Pegawai yang akan pensiun dalam 1 tahun ke depan
        $pegawaiMendekatiPensiun = Pegawai::with([
            'unitKerja',
            'jabatan',
            'riwayatPangkat' => function ($query) {
                $query->latest('tmt');
            },
        ])
            ->where('status_pegawai', 'Aktif')
            ->get()
            ->filter(function ($pegawai) use ($hariIni, $satuTahunLagi) {
                if (!$pegawai->tanggal_pensiun) {
                    return false;
                }

                return $pegawai->tanggal_pensiun->between(
                    $hariIni,
                    $satuTahunLagi
                );
            })
            ->sortBy('tanggal_pensiun')
            ->values();

        return view('dashboard', compact(
            'totalPegawai',
            'totalPegawaiAktif',
            'totalDosen',
            'totalTendik',
            'pegawaiMendekatiPensiun',
        ));
    }
}