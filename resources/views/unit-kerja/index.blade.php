@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Unit Kerja</h1>

            <a href="{{ route('unit-kerja.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Unit Kerja
            </a>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Unit Kerja
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
                                <th>Nama Unit Kerja</th>
                                <th>Kode</th>
                                <th>Keterangan</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($unitKerjas as $unitKerja)
                                <tr>
                                    <td>
                                        {{ $loop->iteration + ($unitKerjas->currentPage() - 1) * $unitKerjas->perPage() }}
                                    </td>

                                    <td>
                                        {{ $unitKerja->nama_unit_kerja }}
                                    </td>

                                    <td>
                                        {{ $unitKerja->kode ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $unitKerja->keterangan ?? '-' }}
                                    </td>

                                    <td>

                                        <a href="{{ route('unit-kerja.edit', $unitKerja->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('unit-kerja.destroy', $unitKerja->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus unit kerja ini?')">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada data unit kerja.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{ $unitKerjas->links() }}

            </div>
        </div>

    </div>
@endsection
