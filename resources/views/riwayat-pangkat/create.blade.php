@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Tambah Riwayat Pangkat / Golongan
                </h1>

                <p class="mb-0 text-muted">
                    {{ $pegawai->nama_lengkap }}
                    <br>
                    NIP. {{ $pegawai->nip }}
                </p>
            </div>

            <a href="{{ route('pegawai.riwayat-pangkat.index', $pegawai->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>


        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Form Riwayat Pangkat / Golongan
                </h6>

            </div>

            <div class="card-body">

                <form action="{{ route('pegawai.riwayat-pangkat.store', $pegawai->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        {{-- Pangkat --}}
                        <div class="col-md-6 mb-3">

                            <label for="pangkat">
                                Pangkat <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="pangkat" id="pangkat"
                                class="form-control @error('pangkat') is-invalid @enderror" value="{{ old('pangkat') }}"
                                placeholder="Contoh: Pembina">

                            @error('pangkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Golongan --}}
                        <div class="col-md-6 mb-3">

                            <label for="golongan">
                                Golongan <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="golongan" id="golongan"
                                class="form-control @error('golongan') is-invalid @enderror" value="{{ old('golongan') }}"
                                placeholder="Contoh: IV/a">

                            @error('golongan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- TMT --}}
                        <div class="col-md-6 mb-3">

                            <label for="tmt">
                                TMT <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="tmt" id="tmt"
                                class="form-control @error('tmt') is-invalid @enderror" value="{{ old('tmt') }}">

                            @error('tmt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Nomor SK --}}
                        <div class="col-md-6 mb-3">

                            <label for="nomor_sk">
                                Nomor SK
                            </label>

                            <input type="text" name="nomor_sk" id="nomor_sk"
                                class="form-control @error('nomor_sk') is-invalid @enderror" value="{{ old('nomor_sk') }}"
                                placeholder="Contoh: 123/UN40/KP/2020">

                            @error('nomor_sk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Tanggal SK --}}
                        <div class="col-md-6 mb-3">

                            <label for="tanggal_sk">
                                Tanggal SK
                            </label>

                            <input type="date" name="tanggal_sk" id="tanggal_sk"
                                class="form-control @error('tanggal_sk') is-invalid @enderror"
                                value="{{ old('tanggal_sk') }}">

                            @error('tanggal_sk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Dokumen SK --}}
                        <div class="col-md-6 mb-3">

                            <label for="dokumen_sk">
                                Dokumen SK
                            </label>

                            <input type="file" name="dokumen_sk" id="dokumen_sk"
                                class="form-control @error('dokumen_sk') is-invalid @enderror">

                            <small class="text-muted">
                                PDF, JPG, JPEG, atau PNG. Maksimal 2 MB.
                            </small>

                            @error('dokumen_sk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <hr>

                    <div class="text-right">

                        <a href="{{ route('pegawai.riwayat-pangkat.index', $pegawai->id) }}" class="btn btn-secondary">

                            <i class="fas fa-times"></i>
                            Batal

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
