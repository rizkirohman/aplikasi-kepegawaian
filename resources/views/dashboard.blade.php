@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

        <!-- Total Pegawai -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pegawai
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalPegawai }}
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pegawai Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pegawai Aktif
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalPegawaiAktif }}
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dosen -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dosen
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalDosen }}
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tenaga Kependidikan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tendik
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $totalTendik }}
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Pegawai Mendekati Pensiun --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Pegawai Mendekati Pensiun
            </h6>
        </div>

        <div class="card-body">

            @if ($pegawaiMendekatiPensiun->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Pegawai</th>
                                <th>Unit Kerja</th>
                                <th>Pangkat/Golongan Terakhir</th>
                                <th>BUP</th>
                                <th>Tanggal Pensiun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($pegawaiMendekatiPensiun as $pegawai)
                                @php
                                    $pangkatTerakhir = $pegawai->riwayatPangkat->first();
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $pegawai->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ $pegawai->nip }}
                                    </td>

                                    <td>
                                        {{-- {{ $pegawai->jenis_pegawai }} --}}
                                        {{ str_replace('Tenaga Kependidikan', 'Tendik', $pegawai->jenis_pegawai) }}
                                    </td>

                                    <td>
                                        {{ $pegawai->unitKerja?->nama_unit_kerja ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($pangkatTerakhir)
                                            {{ $pangkatTerakhir->pangkat }}
                                            /
                                            {{ $pangkatTerakhir->golongan }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        {{ $pegawai->bup }} tahun
                                    </td>

                                    <td>
                                        {{ $pegawai->tanggal_pensiun->format('d F Y') }}
                                    </td>

                                    <td>
                                        <a href="{{ route('pegawai.show', $pegawai) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @else
                <div class="text-center text-muted py-4">

                    <p class="mb-0">
                        Tidak ada pegawai yang akan memasuki masa pensiun
                        dalam 1 tahun ke depan.
                    </p>
                </div>

            @endif

        </div>

    </div>

@endsection
