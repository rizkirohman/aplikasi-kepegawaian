@extends('layouts.app')

@section('title', 'Dokumen Pegawai')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">
            Dokumen Pegawai
        </h1>

        <div class="card shadow">
            <div class="card-header">
                Daftar Dokumen Pegawai
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pegawai</th>
                            <th>Nama Dokumen</th>
                            <th>Kategori</th>
                            <th>Nomor Dokumen</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($dokumens as $dokumen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $dokumen->pegawai->nama_lengkap }}
                                </td>

                                <td>
                                    {{ $dokumen->nama_dokumen }}
                                </td>

                                <td>
                                    {{ $dokumen->kategori }}
                                </td>

                                <td>
                                    {{ $dokumen->nomor_dokumen ?? '-' }}
                                </td>

                                <td>
                                    {{ $dokumen->tanggal_dokumen?->format('d-m-Y') ?? '-' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada dokumen.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>

@endsection
