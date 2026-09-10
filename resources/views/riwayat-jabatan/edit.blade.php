@extends('layouts.app')

@section('title', 'Edit Riwayat Jabatan')

@section('content')

    <div class="container-fluid">

        {{-- Judul --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Edit Riwayat Jabatan</h1>
                <p class="mb-0 text-muted">
                    Perbarui riwayat jabatan pegawai
                </p>
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

                    <div class="col-md-6 mb-3">
                        <strong>NIP</strong>
                        <div>{{ $pegawai->nip }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Nama Lengkap</strong>
                        <div>{{ $pegawai->nama_lengkap }}</div>
                    </div>

                </div>

            </div>
        </div>


        {{-- Form Edit --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Edit Riwayat Jabatan
                </h6>
            </div>

            <div class="card-body">

                <form
                    action="{{ route('pegawai.riwayat-jabatan.update', [$pegawai->id, $riwayatJabatan->id]) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    {{-- Jabatan --}}
                    <div class="form-group">
                        <label for="jabatan">
                            Jabatan <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="jabatan" id="jabatan"
                            class="form-control @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', $riwayatJabatan->jabatan) }}">

                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Unit Kerja --}}
                    <div class="form-group">
                        <label for="unit_kerja">
                            Unit Kerja
                        </label>

                        <input type="text" name="unit_kerja" id="unit_kerja"
                            class="form-control @error('unit_kerja') is-invalid @enderror"
                            value="{{ old('unit_kerja', $riwayatJabatan->unit_kerja) }}">

                        @error('unit_kerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- TMT --}}
                    <div class="form-group">
                        <label for="tmt">
                            TMT <span class="text-danger">*</span>
                        </label>

                        <input type="date" name="tmt" id="tmt"
                            class="form-control @error('tmt') is-invalid @enderror"
                            value="{{ old('tmt', optional($riwayatJabatan->tmt)->format('Y-m-d')) }}">

                        @error('tmt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Nomor SK --}}
                    <div class="form-group">
                        <label for="nomor_sk">
                            Nomor SK
                        </label>

                        <input type="text" name="nomor_sk" id="nomor_sk"
                            class="form-control @error('nomor_sk') is-invalid @enderror"
                            value="{{ old('nomor_sk', $riwayatJabatan->nomor_sk) }}">

                        @error('nomor_sk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Tanggal SK --}}
                    <div class="form-group">
                        <label for="tanggal_sk">
                            Tanggal SK
                        </label>

                        <input type="date" name="tanggal_sk" id="tanggal_sk"
                            class="form-control @error('tanggal_sk') is-invalid @enderror"
                            value="{{ old('tanggal_sk', optional($riwayatJabatan->tanggal_sk)->format('Y-m-d')) }}">

                        @error('tanggal_sk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Dokumen SK Lama --}}
                    <div class="form-group">

                        <label>Dokumen SK Saat Ini</label>

                        <div class="mb-2">

                            @if ($riwayatJabatan->dokumen_sk)
                                <span class="badge badge-success">
                                    Dokumen tersedia
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    Belum ada dokumen
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- Dokumen SK Baru --}}
                    <div class="form-group">

                        <label for="dokumen_sk">
                            Ganti Dokumen SK
                        </label>

                        <input type="file" name="dokumen_sk" id="dokumen_sk"
                            class="form-control-file @error('dokumen_sk') is-invalid @enderror"
                            accept=".pdf,.jpg,.jpeg,.png">

                        <small class="form-text text-muted">
                            Kosongkan jika tidak ingin mengganti dokumen.
                            Format PDF, JPG, JPEG, PNG. Maksimal 2 MB.
                        </small>

                        @error('dokumen_sk')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Tombol --}}
                    <div class="mt-4">

                        <a href="{{ route('pegawai.riwayat-jabatan.index', $pegawai->id) }}"
                            class="btn btn-secondary">

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
