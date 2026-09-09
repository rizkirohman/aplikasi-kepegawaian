@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Riwayat Pangkat / Golongan
                </h1>

                <p class="mb-0 text-muted">
                    {{ $pegawai->nama_lengkap }}
                    <br>
                    NIP. {{ $pegawai->nip }}
                </p>
            </div>

            <div>

                <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Detail
                </a>

                <a href="{{ route('pegawai.riwayat-pangkat.create', $pegawai->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Pangkat
                </a>

            </div>

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

                    <div class="col-md-4">
                        <strong>Nama Lengkap</strong>
                        <br>
                        {{ $pegawai->nama_lengkap }}
                    </div>

                    <div class="col-md-4">
                        <strong>NIP</strong>
                        <br>
                        {{ $pegawai->nip }}
                    </div>

                    <div class="col-md-4">
                        <strong>Jenis Pegawai</strong>
                        <br>
                        {{ $pegawai->jenis_pegawai }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <i class="fas fa-check-circle"></i>
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
        @endif


        {{-- Pesan Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
        @endif


        {{-- Daftar Riwayat Pangkat --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Riwayat Pangkat / Golongan
                </h6>

            </div>

            <div class="card-body">

                @if ($riwayatPangkats->count() > 0)
                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>
                                    <th width="5%">No</th>
                                    <th>Pangkat</th>
                                    <th>Golongan</th>
                                    <th>TMT</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal SK</th>
                                    <th>Dokumen SK</th>
                                    <th width="12%">Aksi</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($riwayatPangkats as $index => $riwayat)
                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            {{ $riwayat->pangkat }}
                                        </td>

                                        <td>
                                            {{ $riwayat->golongan }}
                                        </td>

                                        <td>
                                            {{ $riwayat->tmt?->format('d-m-Y') ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $riwayat->nomor_sk ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $riwayat->tanggal_sk?->format('d-m-Y') ?? '-' }}
                                        </td>

                                        <td>

                                            @if ($riwayat->dokumen_sk)
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="fas fa-file"></i>
                                                    Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('pegawai.riwayat-pangkat.edit', [$pegawai->id, $riwayat->id]) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form
                                                action="{{ route('pegawai.riwayat-pangkat.destroy', [$pegawai->id, $riwayat->id]) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat pangkat ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <div class="text-center py-5">

                        <i class="fas fa-medal fa-3x text-gray-300 mb-3"></i>

                        <p class="text-muted mb-0">
                            Belum ada riwayat pangkat/golongan.
                        </p>

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
