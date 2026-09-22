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
            ->paginate(5)
            ->withQueryString();

        $unitKerjas = UnitKerja::orderBy('nama_unit_kerja')->get();

        return view('laporan.pegawai', compact('pegawais', 'unitKerjas'));
    }

    public function cetak(Request $request)
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

        // Filter status kepegawaian
        if ($request->filled('status_kepegawaian')) {
            $query->where('status_kepegawaian', $request->status_kepegawaian);
        }

        // Filter unit kerja
        if ($request->filled('unit_kerja_id')) {
            $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        // Filter status pegawai
        if ($request->filled('status_pegawai')) {
            $query->where('status_pegawai', $request->status_pegawai);
        }

        // Ambil seluruh hasil tanpa pagination
        $pegawais = $query->orderBy('nama_lengkap')->get();

        return view('laporan.cetak-pegawai', compact('pegawais'));
    }

    public function export(Request $request)
    {
        $query = Pegawai::with(['unitKerja', 'jabatan']);

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

        // Filter status pegawai
        if ($request->filled('status_pegawai')) {
            $query->where('status_pegawai', $request->status_pegawai);
        }

        // Filter status kepegawaian
        if ($request->filled('status_kepegawaian')) {
            $query->where(
                'status_kepegawaian',
                $request->status_kepegawaian
            );
        }

        $pegawais = $query->get();

        return response()->streamDownload(function () use ($pegawais) {
            $handle = fopen('php://output', 'w');

            // BOM agar karakter UTF-8 terbaca baik di Microsoft Excel
            fwrite($handle, "\xEF\xBB\xBF");

            // Header kolom CSV
            fputcsv($handle, [
                'No',
                'Nama Lengkap',
                'NIP',
                'NIDN/NIDK',
                'Jenis Pegawai',
                'Unit Kerja',
                'Jabatan',
                'Status Kepegawaian',
                'Status Pegawai',
            ], ';', '"', '');

            foreach ($pegawais as $index => $pegawai) {
                fputcsv($handle, [
                    $index + 1,
                    $pegawai->nama_lengkap,
                    $pegawai->nip,
                    $pegawai->nidn_nidk,
                    $pegawai->jenis_pegawai,
                    $pegawai->unitKerja->nama_unit ?? '',
                    $pegawai->jabatan->nama_jabatan ?? '',
                    $pegawai->status_kepegawaian,
                    $pegawai->status_pegawai,
                ], ';', '"', '');
            }

            fclose($handle);
        }, 'laporan-pegawai-' . now()->format('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}