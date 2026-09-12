@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Judul halaman --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>

            @can('create', App\Models\Pegawai::class)
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pegawai
                </a>
            @endcan
        </div>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Card --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Pegawai
                </h6>
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
                                {{-- <th>Jabatan</th> --}}
                                <th>Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($pegawais as $pegawai)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($pegawais->currentPage() - 1) * $pegawais->perPage() }}
                                    </td>

                                    <td>
                                        {{ $pegawai->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ $pegawai->nip }}
                                    </td>

                                    <td>
                                        {{ $pegawai->jenis_pegawai }}
                                    </td>

                                    <td>
                                        {{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}
                                    </td>

                                    {{-- <td>
                                        {{ $pegawai->jabatan->nama_jabatan ?? '-' }}
                                    </td> --}}

                                    <td>
                                        {{ $pegawai->status_kepegawaian ?? '-' }}
                                    </td>

                                    <td>

                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @can('update', $pegawai)
                                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $pegawai)
                                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>
                                        @endcan

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data pegawai.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $pegawais->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection
