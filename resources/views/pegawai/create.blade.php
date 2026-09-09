@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Judul halaman --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pegawai</h1>

            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Form --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Data Pegawai
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    {{-- ============================= --}}
                    {{-- DATA IDENTITAS --}}
                    {{-- ============================= --}}

                    <h5 class="font-weight-bold text-primary mb-3">
                        Data Identitas
                    </h5>

                    <div class="row">

                        {{-- Nama --}}
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                value="{{ old('nama_lengkap') }}">

                            @error('nama_lengkap')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NIP --}}
                        <div class="col-md-6 mb-3">
                            <label for="nip">NIP <span class="text-danger">*</span></label>

                            <input type="text" name="nip" id="nip"
                                class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">

                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NIDN/NIDK --}}
                        <div class="col-md-6 mb-3">
                            <label for="nidn_nidk">NIDN/NIDK</label>

                            <input type="text" name="nidn_nidk" id="nidn_nidk"
                                class="form-control @error('nidn_nidk') is-invalid @enderror"
                                value="{{ old('nidn_nidk') }}">

                            @error('nidn_nidk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="col-md-6 mb-3">
                            <label for="foto">Foto</label>

                            <input type="file" name="foto" id="foto"
                                class="form-control @error('foto') is-invalid @enderror" accept="image/*">

                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror">

                                <option value="">-- Pilih Jenis Kelamin --</option>

                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Status Perkawinan --}}
                        <div class="col-md-6 mb-3">
                            <label for="status_perkawinan">
                                Status Perkawinan
                            </label>

                            <select name="status_perkawinan" id="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror">

                                <option value="">-- Pilih Status --</option>

                                <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>
                                    Menikah
                                </option>

                                <option value="Bercerai" {{ old('status_perkawinan') == 'Bercerai' ? 'selected' : '' }}>
                                    Bercerai
                                </option>

                            </select>

                            @error('status_perkawinan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>

                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir') }}">
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir') }}">

                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-12 mb-3">
                            <label for="alamat">Alamat</label>

                            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{ old('alamat') }}</textarea>
                        </div>

                        {{-- No HP --}}
                        <div class="col-md-6 mb-3">
                            <label for="no_hp">No. HP</label>

                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                value="{{ old('no_hp') }}">
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>

                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <hr>

                    {{-- ============================= --}}
                    {{-- DATA KEPEGAWAIAN --}}
                    {{-- ============================= --}}

                    <h5 class="font-weight-bold text-primary mb-3">
                        Data Kepegawaian
                    </h5>

                    <div class="row">

                        {{-- Jenis Pegawai --}}
                        <div class="col-md-6 mb-3">
                            <label for="jenis_pegawai">
                                Jenis Pegawai <span class="text-danger">*</span>
                            </label>

                            <select name="jenis_pegawai" id="jenis_pegawai"
                                class="form-control @error('jenis_pegawai') is-invalid @enderror">

                                <option value="">-- Pilih Jenis Pegawai --</option>

                                <option value="Dosen" {{ old('jenis_pegawai') == 'Dosen' ? 'selected' : '' }}>
                                    Dosen
                                </option>

                                <option value="Tenaga Kependidikan"
                                    {{ old('jenis_pegawai') == 'Tenaga Kependidikan' ? 'selected' : '' }}>
                                    Tenaga Kependidikan
                                </option>

                            </select>

                            @error('jenis_pegawai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Status Kepegawaian --}}
                        <div class="col-md-6 mb-3">
                            <label for="status_kepegawaian">
                                Status Kepegawaian
                            </label>

                            <input type="text" name="status_kepegawaian" id="status_kepegawaian" class="form-control"
                                value="{{ old('status_kepegawaian') }}" placeholder="Contoh: PNS, PPPK, Non-ASN">
                        </div>

                        {{-- TMT --}}
                        <div class="col-md-6 mb-3">
                            <label for="tmt">TMT Kepegawaian</label>

                            <input type="date" name="tmt" id="tmt" class="form-control"
                                value="{{ old('tmt') }}">
                        </div>

                        {{-- Unit Kerja --}}
                        <div class="col-md-6 mb-3">
                            <label for="unit_kerja_id">Unit Kerja</label>

                            <select name="unit_kerja_id" id="unit_kerja_id"
                                class="form-control @error('unit_kerja_id') is-invalid @enderror">

                                <option value="">-- Pilih Unit Kerja --</option>

                                @foreach ($unitKerjas as $unitKerja)
                                    <option value="{{ $unitKerja->id }}"
                                        {{ old('unit_kerja_id') == $unitKerja->id ? 'selected' : '' }}>
                                        {{ $unitKerja->nama_unit_kerja }}
                                    </option>
                                @endforeach

                            </select>

                            @error('unit_kerja_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="col-md-6 mb-3">
                            <label for="jabatan_id">Jabatan</label>

                            <select name="jabatan_id" id="jabatan_id"
                                class="form-control @error('jabatan_id') is-invalid @enderror">

                                <option value="">-- Pilih Jabatan --</option>

                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}"
                                        {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach

                            </select>

                            @error('jabatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pendidikan --}}
                        <div class="col-md-6 mb-3">
                            <label for="pendidikan_terakhir">
                                Pendidikan Terakhir
                            </label>

                            <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control">

                                <option value="">-- Pilih Pendidikan --</option>

                                <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>
                                    SMA
                                </option>

                                <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>

                                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>

                                <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>
                                    S2
                                </option>

                                <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>
                                    S3
                                </option>

                            </select>
                        </div>

                        {{-- Jabatan Fungsional --}}
                        <div class="col-md-6 mb-3">
                            <label for="jabatan_fungsional">
                                Jabatan Fungsional
                            </label>

                            <select name="jabatan_fungsional" id="jabatan_fungsional" class="form-control">

                                <option value="">-- Pilih Jabatan Fungsional --</option>

                                <option value="Asisten Ahli"
                                    {{ old('jabatan_fungsional') == 'Asisten Ahli' ? 'selected' : '' }}>
                                    Asisten Ahli
                                </option>

                                <option value="Lektor" {{ old('jabatan_fungsional') == 'Lektor' ? 'selected' : '' }}>
                                    Lektor
                                </option>

                                <option value="Lektor Kepala"
                                    {{ old('jabatan_fungsional') == 'Lektor Kepala' ? 'selected' : '' }}>
                                    Lektor Kepala
                                </option>

                                <option value="Profesor" {{ old('jabatan_fungsional') == 'Profesor' ? 'selected' : '' }}>
                                    Profesor
                                </option>

                            </select>
                        </div>

                    </div>

                    <hr>

                    {{-- Tombol --}}
                    <div class="text-right">

                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
