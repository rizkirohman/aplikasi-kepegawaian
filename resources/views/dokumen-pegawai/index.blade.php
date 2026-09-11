@extends('layouts.app')

@section('title', 'Dokumen Kepegawaian')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Dokumen Kepegawaian
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

                <a href="{{ route('pegawai.dokumen.create', $pegawai->id) }}" class="btn btn-primary">

                    <i class="fas fa-plus"></i>
                    Tambah Dokumen

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

                <button type="button" class="close" data-dismiss="alert">

                    <span>&times;</span>

                </button>

            </div>
        @endif


        {{-- Daftar Dokumen --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Daftar Dokumen
                    </h6>

                    <span class="badge badge-primary">
                        {{ $dokumens->count() }} Dokumen
                    </span>

                </div>

            </div>

            <div class="card-body">

                @if ($dokumens->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Kategori</th>
                                    <th>Nomor Dokumen</th>
                                    <th>Tanggal Dokumen</th>
                                    <th>File</th>
                                    <th width="15%">Aksi</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($dokumens as $index => $dokumen)
                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
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

                                        <td>

                                            @if ($dokumen->file)
                                                <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank"
                                                    class="btn btn-info btn-sm" title="Lihat Dokumen">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('pegawai.dokumen.download', [$pegawai->id, $dokumen->id]) }}"
                                                    class="btn btn-primary btn-sm" title="Download Dokumen">

                                                    <i class="fas fa-download"></i>

                                                </a>
                                            @else
                                                <span class="text-muted">
                                                    -
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('pegawai.dokumen.edit', [$pegawai->id, $dokumen->id]) }}"
                                                class="btn btn-warning btn-sm" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form
                                                action="{{ route('pegawai.dokumen.destroy', [$pegawai->id, $dokumen->id]) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">

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

                        <i class="fas fa-folder-open fa-3x text-gray-300 mb-3"></i>

                        <p class="text-muted mb-0">
                            Belum ada dokumen kepegawaian.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
