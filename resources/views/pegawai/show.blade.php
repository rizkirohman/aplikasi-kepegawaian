@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Detail Pegawai
            </h1>

            <div>
                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>

        {{-- Profil Pegawai --}}
        <div class="row">

            {{-- Foto & Identitas Singkat --}}
            <div class="col-md-4">

                <div class="card shadow mb-4">

                    <div class="card-body text-center">

                        @if ($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto {{ $pegawai->nama_lengkap }}"
                                class="img-thumbnail mb-3" style="width: 180px; height: 220px; object-fit: cover;">
                        @else
                            <div class="mb-3">

                                <div class="border rounded d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 180px; height: 220px;">

                                    <i class="fas fa-user fa-5x text-secondary"></i>

                                </div>

                            </div>
                        @endif

                        <h4 class="font-weight-bold">
                            {{ $pegawai->nama_lengkap }}
                        </h4>

                        <p class="text-muted mb-1">
                            NIP. {{ $pegawai->nip }}
                        </p>

                        <span class="badge badge-primary">
                            {{ $pegawai->jenis_pegawai }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Informasi Pegawai --}}
            <div class="col-md-8">

                {{-- Data Identitas --}}
                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data Identitas
                        </h6>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>NIP</strong>
                                <div>{{ $pegawai->nip }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>NIDN/NIDK</strong>
                                <div>{{ $pegawai->nidn_nidk ?? '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Nama Lengkap</strong>
                                <div>{{ $pegawai->nama_lengkap }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Jenis Kelamin</strong>
                                <div>{{ $pegawai->jenis_kelamin }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Tempat Lahir</strong>
                                <div>{{ $pegawai->tempat_lahir ?? '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Tanggal Lahir</strong>
                                <div>
                                    {{ $pegawai->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Status Perkawinan</strong>
                                <div>{{ $pegawai->status_perkawinan ?? '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>No. HP</strong>
                                <div>{{ $pegawai->no_hp ?? '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Email</strong>
                                <div>{{ $pegawai->email ?? '-' }}</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <strong>Alamat</strong>
                                <div>{{ $pegawai->alamat ?? '-' }}</div>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Data Kepegawaian --}}
                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data Kepegawaian
                        </h6>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>Jenis Pegawai</strong>
                                <div>{{ $pegawai->jenis_pegawai }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Status Kepegawaian</strong>
                                <div>{{ $pegawai->status_kepegawaian ?? '-' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>TMT Kepegawaian</strong>
                                <div>
                                    {{ $pegawai->tmt?->format('d-m-Y') ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Unit Kerja</strong>
                                <div>
                                    {{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Jabatan</strong>
                                <div>
                                    {{ $pegawai->jabatan->nama_jabatan ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Pendidikan Terakhir</strong>
                                <div>
                                    {{ $pegawai->pendidikan_terakhir ?? '-' }}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Jabatan Fungsional</strong>
                                <div>
                                    {{ $pegawai->jabatan_fungsional ?? '-' }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Riwayat Pendidikan Pegawai --}}
                {{-- <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex justify-content-between align-items-center">

                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-history"></i>
                            Riwayat Pendidikan Pegawai
                        </h6>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <div class="card border-left-primary h-100">

                                    <div class="card-body">

                                        <div class="row align-items-center">

                                            <div class="col">

                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Riwayat Pendidikan
                                                </div>

                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $pegawai->riwayatPendidikan->count() }}
                                                    Data
                                                </div>

                                            </div>

                                            <div class="col-auto">
                                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                            </div>

                                        </div>

                                        <hr>

                                        <a href="{{ route('pegawai.riwayat-pendidikan.index', $pegawai->id) }}"
                                            class="btn btn-primary btn-sm">

                                            <i class="fas fa-eye"></i>
                                            Lihat Riwayat Pendidikan

                                        </a>

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                </div> --}}

                {{-- Riwayat Pangkat / Golongan Pegawai --}}
                {{-- <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-medal mr-1"></i>
                            Riwayat Pangkat / Golongan Pegawai
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Riwayat Pangkat / Golongan
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $pegawai->riwayatPangkat->count() }} Data
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-medal fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                        <hr>

                                        <a href="{{ route('pegawai.riwayat-pangkat.index', $pegawai->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye mr-1"></i>
                                            Lihat Riwayat Pangkat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- Card Utama Riwayat --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Data Riwayat
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Riwayat Pendidikan --}}
                            <div class="col-md-4 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Riwayat Pendidikan
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $pegawai->riwayatPendidikan->count() }} Data
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                        <hr>

                                        <a href="{{ route('pegawai.riwayat-pendidikan.index', $pegawai->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye mr-1"></i>
                                            Lihat Riwayat Pendidikan
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Riwayat Pangkat / Golongan --}}
                            <div class="col-md-4 mb-3">
                                <div class="card border-left-primary h-100">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Riwayat Pangkat / Golongan
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $pegawai->riwayatPangkat->count() }} Data
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-medal fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                        <hr>

                                        <a href="{{ route('pegawai.riwayat-pangkat.index', $pegawai->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye mr-1"></i>
                                            Lihat Riwayat Pangkat
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
