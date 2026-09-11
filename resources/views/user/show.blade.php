@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="mb-3">
            <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
            <p class="text-muted">
                Informasi akun pengguna dan data pegawai yang terhubung.
            </p>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Informasi User
                </h6>
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">
                        Nama User
                    </div>
                    <div class="col-md-9">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">
                        Email
                    </div>
                    <div class="col-md-9">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">
                        Role
                    </div>
                    <div class="col-md-9">

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

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">
                        Pegawai
                    </div>

                    <div class="col-md-9">

                        @if ($user->pegawai)
                            {{ $user->pegawai->nama_lengkap }}

                            <div class="text-muted">
                                NIP: {{ $user->pegawai->nip }}
                            </div>
                        @else
                            <span class="text-danger">
                                Belum terhubung dengan data pegawai.
                            </span>
                        @endif

                    </div>
                </div>

                <hr>

                <div class="mt-3">

                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>

                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection
