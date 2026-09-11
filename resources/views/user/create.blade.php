@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="mb-3">
            <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
            <p class="text-muted">
                Tambahkan akun pengguna dan hubungkan dengan data pegawai.
            </p>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Tambah User
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">
                            Nama User
                        </label>

                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="form-group mb-3">
                        <label for="role" class="form-label">
                            Role
                        </label>

                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                            required>

                            <option value="">-- Pilih Role --</option>

                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="pimpinan" {{ old('role') === 'pimpinan' ? 'selected' : '' }}>
                                Pimpinan
                            </option>

                            <option value="pegawai" {{ old('role') === 'pegawai' ? 'selected' : '' }}>
                                Pegawai
                            </option>

                        </select>

                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Pegawai --}}
                    <div class="form-group mb-3">
                        <label for="pegawai_id" class="form-label">
                            Hubungkan dengan Pegawai
                        </label>

                        <select name="pegawai_id" id="pegawai_id"
                            class="form-control @error('pegawai_id') is-invalid @enderror" required>

                            <option value="">-- Pilih Pegawai --</option>

                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}"
                                    {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->nama_lengkap }} -
                                    {{ $pegawai->nip }}
                                </option>
                            @endforeach

                        </select>

                        <small class="form-text text-muted">
                            Hanya pegawai yang belum memiliki akun yang ditampilkan.
                        </small>

                        @error('pegawai_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-4">

                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
