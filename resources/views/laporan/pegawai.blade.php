@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Judul halaman --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Laporan Pegawai
            </h1>
        </div>

        {{-- Card Laporan --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex justify-content-between align-items-center">

                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Laporan Pegawai
                </h6>

                <span class="badge badge-primary">
                    Total: {{ $pegawais->count() }} Pegawai
                </span>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>Jenis Pegawai</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($pegawais as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $pegawai->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ $pegawai->nip }}
                                    </td>

                                    <td>
                                        {{ str_replace('Tenaga Kependidikan', 'Tendik', $pegawai->jenis_pegawai) }}
                                    </td>

                                    <td>
                                        {{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pegawai->jabatan->nama_jabatan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pegawai->status_kepegawaian ?? '-' }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada data pegawai.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
