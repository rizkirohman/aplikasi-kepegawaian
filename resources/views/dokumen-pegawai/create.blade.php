@extends('layouts.app')

@section('title', 'Tambah Dokumen Kepegawaian')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Tambah Dokumen Kepegawaian
                </h1>

                <p class="mb-0 text-muted">
                    Upload dokumen kepegawaian pegawai
                </p>
            </div>

            <div>

                <a href="{{ route('pegawai.dokumen.index', $pegawai->id) }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

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

                    <div class="col-md-6">

                        <strong>Nama Lengkap</strong>
                        <br>

                        {{ $pegawai->nama_lengkap }}

                    </div>

                    <div class="col-md-6">

                        <strong>NIP</strong>
                        <br>

                        {{ $pegawai->nip }}

                    </div>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Form Dokumen Kepegawaian
                </h6>

            </div>

            <div class="card-body">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('pegawai.dokumen.store', $pegawai->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    {{-- Pegawai --}}
                    <div class="form-group">

                        <label for="pegawai_id">
                            Pegawai <span class="text-danger">*</span>
                        </label>

                        <select name="pegawai_id" id="pegawai_id"
                            class="form-control @error('pegawai_id') is-invalid @enderror" required>

                            <option value="">
                                -- Pilih Pegawai --
                            </option>

                            @foreach ($pegawais as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pegawai_id', $pegawai->id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama_lengkap }}
                                    - {{ $item->nip }}

                                </option>
                            @endforeach

                        </select>

                        @error('pegawai_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Nama Dokumen --}}
                    <div class="form-group">

                        <label for="nama_dokumen">
                            Nama Dokumen <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="nama_dokumen" id="nama_dokumen"
                            class="form-control @error('nama_dokumen') is-invalid @enderror"
                            value="{{ old('nama_dokumen') }}" placeholder="Contoh: SK Pengangkatan" required>

                        @error('nama_dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Kategori --}}
                    <div class="form-group">

                        <label for="kategori">
                            Kategori <span class="text-danger">*</span>
                        </label>

                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror"
                            required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option value="SK Pengangkatan" {{ old('kategori') == 'SK Pengangkatan' ? 'selected' : '' }}>
                                SK Pengangkatan
                            </option>

                            <option value="SK Pangkat/Golongan"
                                {{ old('kategori') == 'SK Pangkat/Golongan' ? 'selected' : '' }}>
                                SK Pangkat/Golongan
                            </option>

                            <option value="SK Jabatan" {{ old('kategori') == 'SK Jabatan' ? 'selected' : '' }}>
                                SK Jabatan
                            </option>

                            <option value="SKP/Penilaian Kinerja"
                                {{ old('kategori') == 'SKP/Penilaian Kinerja' ? 'selected' : '' }}>
                                SKP/Penilaian Kinerja
                            </option>

                            <option value="Ijazah" {{ old('kategori') == 'Ijazah' ? 'selected' : '' }}>
                                Ijazah
                            </option>

                            <option value="Transkrip Nilai" {{ old('kategori') == 'Transkrip Nilai' ? 'selected' : '' }}>
                                Transkrip Nilai
                            </option>

                            <option value="Sertifikat" {{ old('kategori') == 'Sertifikat' ? 'selected' : '' }}>
                                Sertifikat
                            </option>

                            <option value="Dokumen Angka Kredit"
                                {{ old('kategori') == 'Dokumen Angka Kredit' ? 'selected' : '' }}>
                                Dokumen Angka Kredit
                            </option>

                            <option value="Dokumen Lainnya" {{ old('kategori') == 'Dokumen Lainnya' ? 'selected' : '' }}>
                                Dokumen Lainnya
                            </option>

                        </select>

                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Nomor Dokumen --}}
                    <div class="form-group">

                        <label for="nomor_dokumen">
                            Nomor Dokumen
                        </label>

                        <input type="text" name="nomor_dokumen" id="nomor_dokumen"
                            class="form-control @error('nomor_dokumen') is-invalid @enderror"
                            value="{{ old('nomor_dokumen') }}" placeholder="Contoh: 123/UN40/KP/2020">

                        @error('nomor_dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Tanggal Dokumen --}}
                    <div class="form-group">

                        <label for="tanggal_dokumen">
                            Tanggal Dokumen
                        </label>

                        <input type="date" name="tanggal_dokumen" id="tanggal_dokumen"
                            class="form-control @error('tanggal_dokumen') is-invalid @enderror"
                            value="{{ old('tanggal_dokumen') }}">

                        @error('tanggal_dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- File --}}
                    <div class="form-group">

                        <label for="file">
                            File Dokumen <span class="text-danger">*</span>
                        </label>

                        <input type="file" name="file" id="file"
                            class="form-control-file @error('file') is-invalid @enderror" required>

                        <small class="form-text text-muted">
                            Format: PDF, JPG, JPEG, PNG, DOC, DOCX.
                            Maksimal 2 MB.
                        </small>

                        @error('file')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Keterangan --}}
                    <div class="form-group">

                        <label for="keterangan">
                            Keterangan
                        </label>

                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan tambahan">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Tombol --}}
                    <div class="mt-4">

                        <a href="{{ route('pegawai.dokumen.index', $pegawai->id) }}" class="btn btn-secondary">

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
