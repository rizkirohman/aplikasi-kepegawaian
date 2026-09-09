@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div>
                <h1 class="h3 mb-1 text-gray-800">
                    Tambah Riwayat Pendidikan
                </h1>

                <p class="mb-0 text-muted">
                    {{ $pegawai->nama_lengkap }}
                    <br>
                    NIP. {{ $pegawai->nip }}
                </p>
            </div>

            <a href="{{ route('pegawai.riwayat-pendidikan.index', $pegawai->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>


        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Riwayat Pendidikan
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('pegawai.riwayat-pendidikan.store', $pegawai->id) }}" method="POST">

                    @csrf

                    <div class="row">

                        {{-- Jenjang --}}
                        <div class="col-md-6 mb-3">

                            <label for="jenjang">
                                Jenjang <span class="text-danger">*</span>
                            </label>

                            <select name="jenjang" id="jenjang"
                                class="form-control @error('jenjang') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Jenjang --
                                </option>

                                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>
                                    SMA
                                </option>

                                <option value="D3" {{ old('jenjang') == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>

                                <option value="S1" {{ old('jenjang') == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>

                                <option value="S2" {{ old('jenjang') == 'S2' ? 'selected' : '' }}>
                                    S2
                                </option>

                                <option value="S3" {{ old('jenjang') == 'S3' ? 'selected' : '' }}>
                                    S3
                                </option>

                            </select>

                            @error('jenjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Program Studi --}}
                        <div class="col-md-6 mb-3">

                            <label for="program_studi">
                                Program Studi <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="program_studi" id="program_studi"
                                class="form-control @error('program_studi') is-invalid @enderror"
                                value="{{ old('program_studi') }}">

                            @error('program_studi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Perguruan Tinggi --}}
                        <div class="col-md-6 mb-3">

                            <label for="perguruan_tinggi">
                                Perguruan Tinggi <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="perguruan_tinggi" id="perguruan_tinggi"
                                class="form-control @error('perguruan_tinggi') is-invalid @enderror"
                                value="{{ old('perguruan_tinggi') }}">

                            @error('perguruan_tinggi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Tahun Lulus --}}
                        <div class="col-md-6 mb-3">

                            <label for="tahun_lulus">
                                Tahun Lulus
                            </label>

                            <input type="number" name="tahun_lulus" id="tahun_lulus"
                                class="form-control @error('tahun_lulus') is-invalid @enderror"
                                value="{{ old('tahun_lulus') }}" min="1900" max="{{ date('Y') }}">

                            @error('tahun_lulus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Gelar --}}
                        <div class="col-md-6 mb-3">

                            <label for="gelar">
                                Gelar
                            </label>

                            <input type="text" name="gelar" id="gelar"
                                class="form-control @error('gelar') is-invalid @enderror" value="{{ old('gelar') }}"
                                placeholder="Contoh: S.Kom., M.Pd., Dr.">

                            @error('gelar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <hr>


                    <div class="text-right">

                        <a href="{{ route('pegawai.riwayat-pendidikan.index', $pegawai->id) }}" class="btn btn-secondary">
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
