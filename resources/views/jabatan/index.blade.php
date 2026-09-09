@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>

            <a href="{{ route('jabatan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Jabatan
            </a>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Jabatan
                </h6>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Jabatan</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($jabatans as $jabatan)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($jabatans->currentPage() - 1) * $jabatans->perPage() }}
                                    </td>

                                    <td>
                                        {{ $jabatan->nama_jabatan }}
                                    </td>

                                    <td>
                                        {{ $jabatan->jenis ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $jabatan->keterangan ?? '-' }}
                                    </td>

                                    <td>

                                        <a href="{{ route('jabatan.edit', $jabatan) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('jabatan.destroy', $jabatan) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus jabatan ini?')">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada data jabatan.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{ $jabatans->links() }}

            </div>
        </div>

    </div>
@endsection
