@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Unit Kerja</h1>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Tambah Unit Kerja
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('unit-kerja.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="nama_unit_kerja" class="form-label">
                            Nama Unit Kerja
                        </label>

                        <input type="text" name="nama_unit_kerja" id="nama_unit_kerja" class="form-control"
                            value="{{ old('nama_unit_kerja') }}" placeholder="Contoh: Prodi Ilmu Keolahragaan">

                        @error('nama_unit_kerja')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kode" class="form-label">
                            Kode
                        </label>

                        <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}"
                            placeholder="Contoh: PIK (Optional)">

                        @error('kode')
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
                            placeholder="Keterangan unit kerja (opsional)">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <a href="{{ route('unit-kerja.index') }}" class="btn btn-secondary">
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
