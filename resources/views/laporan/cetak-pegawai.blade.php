<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pegawai</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-size: 12px;
            color: #000;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 6px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            @page {
                size: landscape;
                margin: 1cm;
            }
        }

        <style>body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin-bottom: 6px;
            font-size: 18px;
        }

        .header p {
            margin-top: 0;
            font-size: 13px;
        }

        .print-actions {
            margin-bottom: 20px;
        }

        .print-actions button {
            padding: 8px 14px;
            margin-right: 6px;
            border: 1px solid #777;
            border-radius: 4px;
            background: #f5f5f5;
            cursor: pointer;
        }

        .table-laporan {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        .table-laporan th,
        .table-laporan td {
            border: 1px solid #333;
            padding: 7px;
            text-align: left;
            vertical-align: top;
        }

        .table-laporan th {
            background: #eaeaea;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: A4 landscape;
                margin: 1cm;
            }

            .table-laporan th {
                background: #eaeaea !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid mt-4">

        <div class="print-actions no-print">
            <button onclick="window.print()">
                Cetak / Simpan PDF
            </button>

            <button onclick="window.close()">
                Tutup
            </button>
        </div>

        <h4 class="text-center mb-1">LAPORAN DATA PEGAWAI</h4>

        <p>Total Pegawai: {{ $pegawais->count() }}</p>

        <table class="table-laporan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>NIDN/NIDK</th>
                    <th>Jenis Pegawai</th>
                    <th>Unit Kerja</th>
                    <th>Jabatan</th>
                    <th>Status Kepegawaian</th>
                    <th>Status Pegawai</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pegawais as $pegawai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pegawai->nama_lengkap }}</td>
                        <td>{{ $pegawai->nip ?? '-' }}</td>
                        <td>{{ $pegawai->nidn_nidk ?? '-' }}</td>
                        <td>{{ $pegawai->jenis_pegawai }}</td>
                        <td>{{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}</td>
                        <td>{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                        <td>{{ $pegawai->status_kepegawaian ?? '-' }}</td>
                        <td>{{ $pegawai->status_pegawai ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            Tidak ada data pegawai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</body>

</html>
