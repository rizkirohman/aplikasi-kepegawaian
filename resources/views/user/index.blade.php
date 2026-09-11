@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
                <p class="mb-0 text-muted">
                    Kelola akun pengguna dan hubungan dengan data pegawai.
                </p>
            </div>

            <a href="{{ route('user.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah User
            </a>
        </div>

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

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar User
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Pegawai</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-danger text-white">
                                                Admin
                                            </span>
                                        @elseif($user->role === 'pimpinan')
                                            <span class="badge bg-warning text-dark">
                                                Pimpinan
                                            </span>
                                        @else
                                            <span class="badge bg-primary text-white">
                                                Pegawai
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->pegawai)
                                            {{ $user->pegawai->nama_lengkap }}
                                        @else
                                            <span class="text-muted">
                                                Belum terhubung
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data user.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection
