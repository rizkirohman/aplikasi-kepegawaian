@extends('layouts.app')

@section('title', 'Riwayat Jabatan')

@section('content')

    <div class="container-fluid">

        {{-- Judul --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Riwayat Jabatan</h1>
                <p class="mb-0 text-muted">
                    Riwayat jabatan pegawai
                </p>
            </div>

            <a href="{{ route('pegawai.riwayat-jabatan.create', $pegawai->id) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Riwayat Jabatan
            </a>
        </div>


        {{-- Informasi Pegawai --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Informasi Pegawai
                </h6>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>NIP</strong>
                        <div>{{ $pegawai->nip }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Nama Lengkap</strong>
                        <div>{{ $pegawai->nama_lengkap }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Jenis Pegawai</strong>
                        <div>{{ $pegawai->jenis_pegawai }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Unit Kerja</strong>
                        <div>
                            {{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}
                        </div>
                    </div>

                </div>

            </div>
        </div>


        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif


        {{-- Tabel Riwayat Jabatan --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Riwayat Jabatan
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>TMT</th>
                                <th>Nomor SK</th>
                                <th>Tanggal SK</th>
                                <th>Dokumen SK</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($riwayatJabatans as $riwayat)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $riwayat->jabatan }}
                                    </td>

                                    <td>
                                        {{ $riwayat->unit_kerja ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $riwayat->tmt?->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ $riwayat->nomor_sk ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $riwayat->tanggal_sk?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($riwayat->dokumen_sk)
                                            <a href="{{ asset('storage/' . $riwayat->dokumen_sk) }}" target="_blank"
                                                class="btn btn-sm btn-info">

                                                <i class="fas fa-file-alt"></i>
                                                Lihat

                                            </a>
                                        @else
                                            <span class="badge badge-secondary">
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('pegawai.riwayat-jabatan.edit', [$pegawai->id, $riwayat->id]) }}"
                                            class="btn btn-sm btn-warning">

                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form
                                            action="{{ route('pegawai.riwayat-jabatan.destroy', [$pegawai->id, $riwayat->id]) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus riwayat jabatan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">

                                        Belum ada riwayat jabatan.

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
