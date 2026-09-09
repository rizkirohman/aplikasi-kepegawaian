@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Jabatan</h1>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Tambah Jabatan
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('jabatan.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">
                            Nama Jabatan
                        </label>

                        <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control"
                            value="{{ old('nama_jabatan') }}" placeholder="Contoh: Ketua Program Studi">

                        @error('nama_jabatan')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">
                            Jenis Jabatan
                        </label>

                        <select name="jenis" id="jenis" class="form-control">

                            <option value="">-- Pilih Jenis Jabatan --</option>

                            <option value="Struktural" {{ old('jenis') == 'Struktural' ? 'selected' : '' }}>
                                Struktural
                            </option>

                            <option value="Fungsional" {{ old('jenis') == 'Fungsional' ? 'selected' : '' }}>
                                Fungsional
                            </option>

                            <option value="Pelaksana" {{ old('jenis') == 'Pelaksana' ? 'selected' : '' }}>
                                Pelaksana
                            </option>

                        </select>

                        @error('jenis')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">
                            Keterangan
                        </label>

                        <textarea name="keterangan" id="keterangan" class="form-control" rows="4"
                            placeholder="Keterangan jabatan (opsional)">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection
