@extends('layouts.app')

@section('title', 'Edit Dokumen Kepegawaian')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Edit Dokumen Kepegawaian
                </h1>

                <p class="mb-0 text-muted">
                    Perbarui dokumen kepegawaian pegawai
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
                    Form Edit Dokumen
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


                <form action="{{ route('pegawai.dokumen.update', [$pegawai->id, $dokumen->id]) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    {{-- Pegawai --}}
                    <div class="form-group">

                        <label for="pegawai_id">
                            Pegawai <span class="text-danger">*</span>
                        </label>

                        <select name="pegawai_id" id="pegawai_id"
                            class="form-control @error('pegawai_id') is-invalid @enderror" required>

                            @foreach ($pegawais as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pegawai_id', $dokumen->pegawai_id) == $item->id ? 'selected' : '' }}>

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
                            value="{{ old('nama_dokumen', $dokumen->nama_dokumen) }}" required>

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

                            <option value="SK Pengangkatan"
                                {{ old('kategori', $dokumen->kategori) == 'SK Pengangkatan' ? 'selected' : '' }}>
                                SK Pengangkatan
                            </option>

                            <option value="SK Pangkat/Golongan"
                                {{ old('kategori', $dokumen->kategori) == 'SK Pangkat/Golongan' ? 'selected' : '' }}>
                                SK Pangkat/Golongan
                            </option>

                            <option value="SK Jabatan"
                                {{ old('kategori', $dokumen->kategori) == 'SK Jabatan' ? 'selected' : '' }}>
                                SK Jabatan
                            </option>

                            <option value="SKP/Penilaian Kinerja"
                                {{ old('kategori', $dokumen->kategori) == 'SKP/Penilaian Kinerja' ? 'selected' : '' }}>
                                SKP/Penilaian Kinerja
                            </option>

                            <option value="Ijazah" {{ old('kategori', $dokumen->kategori) == 'Ijazah' ? 'selected' : '' }}>
                                Ijazah
                            </option>

                            <option value="Transkrip Nilai"
                                {{ old('kategori', $dokumen->kategori) == 'Transkrip Nilai' ? 'selected' : '' }}>
                                Transkrip Nilai
                            </option>

                            <option value="Sertifikat"
                                {{ old('kategori', $dokumen->kategori) == 'Sertifikat' ? 'selected' : '' }}>
                                Sertifikat
                            </option>

                            <option value="Dokumen Angka Kredit"
                                {{ old('kategori', $dokumen->kategori) == 'Dokumen Angka Kredit' ? 'selected' : '' }}>
                                Dokumen Angka Kredit
                            </option>

                            <option value="Dokumen Lainnya"
                                {{ old('kategori', $dokumen->kategori) == 'Dokumen Lainnya' ? 'selected' : '' }}>
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
                            value="{{ old('nomor_dokumen', $dokumen->nomor_dokumen) }}">

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
                            value="{{ old('tanggal_dokumen', optional($dokumen->tanggal_dokumen)->format('Y-m-d')) }}">

                        @error('tanggal_dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- File Lama --}}
                    <div class="form-group">

                        <label>
                            File Dokumen Saat Ini
                        </label>

                        <div>

                            @if ($dokumen->file)
                                <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-file"></i>
                                    Lihat File Saat Ini

                                </a>
                            @else
                                <span class="text-muted">
                                    Tidak ada file.
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- File Baru --}}
                    <div class="form-group">

                        <label for="file">
                            Ganti File Dokumen
                        </label>

                        <input type="file" name="file" id="file"
                            class="form-control-file @error('file') is-invalid @enderror">

                        <small class="form-text text-muted">

                            Kosongkan jika tidak ingin mengganti file.
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
                            class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan tambahan">{{ old('keterangan', $dokumen->keterangan) }}</textarea>

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
                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
