@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Riwayat Pendidikan
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

                <a href="{{ route('pegawai.riwayat-pendidikan.create', $pegawai->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Pendidikan
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
                        <p>{{ $pegawai->nama_lengkap }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong>NIP</strong>
                        <p>{{ $pegawai->nip }}</p>
                    </div>

                    <div class="col-md-4">
                        <strong>Jenis Pegawai</strong>
                        <p>{{ $pegawai->jenis_pegawai }}</p>
                    </div>

                </div>

            </div>

        </div>


        {{-- Riwayat Pendidikan --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Riwayat Pendidikan
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Jenjang</th>
                                <th>Program Studi</th>
                                <th>Perguruan Tinggi</th>
                                <th>Tahun Lulus</th>
                                <th>Gelar</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($riwayatPendidikans as $riwayat)
                                <tr>

                                    <td>
                                        {{ $loop->iteration + ($riwayatPendidikans->currentPage() - 1) * $riwayatPendidikans->perPage() }}
                                    </td>

                                    <td>
                                        {{ $riwayat->jenjang }}
                                    </td>

                                    <td>
                                        {{ $riwayat->program_studi }}
                                    </td>

                                    <td>
                                        {{ $riwayat->perguruan_tinggi }}
                                    </td>

                                    <td>
                                        {{ $riwayat->tahun_lulus ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $riwayat->gelar ?? '-' }}
                                    </td>

                                    <td>

                                        <a href="{{ route('pegawai.riwayat-pendidikan.edit', [$pegawai->id, $riwayat->id]) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form
                                            action="{{ route('pegawai.riwayat-pendidikan.destroy', [$pegawai->id, $riwayat->id]) }}"
                                            method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat pendidikan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-4">

                                        <i class="fas fa-graduation-cap fa-2x text-muted mb-2"></i>

                                        <p class="mb-0">
                                            Belum ada riwayat pendidikan.
                                        </p>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $riwayatPendidikans->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection
