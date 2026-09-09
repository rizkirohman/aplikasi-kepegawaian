@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Pegawai</h1>

            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Edit Data Pegawai
                </h6>
            </div>

            <div class="card-body">

                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- DATA IDENTITAS --}}
                    <h5 class="font-weight-bold text-primary mb-3">
                        Data Identitas
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="nip">
                                NIP <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nip" id="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                value="{{ old('nip', $pegawai->nip) }}">

                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nidn_nidk">NIDN/NIDK</label>

                            <input type="text" name="nidn_nidk" id="nidn_nidk" class="form-control"
                                value="{{ old('nidn_nidk', $pegawai->nidn_nidk) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}">

                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="foto">Foto</label>

                            @if ($pegawai->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" width="100"
                                        class="img-thumbnail">
                                </div>
                            @endif

                            <input type="file" name="foto" id="foto"
                                class="form-control @error('foto') is-invalid @enderror" accept="image/*">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti foto.
                            </small>

                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror">

                                <option value="">-- Pilih Jenis Kelamin --</option>

                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status_perkawinan">Status Perkawinan</label>

                            <select name="status_perkawinan" id="status_perkawinan" class="form-control">

                                <option value="">-- Pilih Status --</option>

                                <option value="Menikah"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>
                                    Menikah
                                </option>

                                <option value="Bercerai"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Bercerai' ? 'selected' : '' }}>
                                    Bercerai
                                </option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>

                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_lahir">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir', optional($pegawai->tanggal_lahir)->format('Y-m-d')) }}">

                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="alamat">Alamat</label>

                            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{ old('alamat', $pegawai->alamat) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="no_hp">No. HP</label>

                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                value="{{ old('no_hp', $pegawai->no_hp) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email">Email</label>

                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $pegawai->email) }}">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <hr>

                    {{-- DATA KEPEGAWAIAN --}}
                    <h5 class="font-weight-bold text-primary mb-3">
                        Data Kepegawaian
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="jenis_pegawai">
                                Jenis Pegawai <span class="text-danger">*</span>
                            </label>

                            <select name="jenis_pegawai" id="jenis_pegawai"
                                class="form-control @error('jenis_pegawai') is-invalid @enderror">

                                <option value="">-- Pilih Jenis Pegawai --</option>

                                <option value="Dosen"
                                    {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'Dosen' ? 'selected' : '' }}>
                                    Dosen
                                </option>

                                <option value="Tenaga Kependidikan"
                                    {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'Tenaga Kependidikan' ? 'selected' : '' }}>
                                    Tenaga Kependidikan
                                </option>

                            </select>

                            @error('jenis_pegawai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status_kepegawaian">
                                Status Kepegawaian
                            </label>

                            <input type="text" name="status_kepegawaian" id="status_kepegawaian" class="form-control"
                                value="{{ old('status_kepegawaian', $pegawai->status_kepegawaian) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tmt">TMT Kepegawaian</label>

                            <input type="date" name="tmt" id="tmt" class="form-control"
                                value="{{ old('tmt', optional($pegawai->tmt)->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="unit_kerja_id">Unit Kerja</label>

                            <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">

                                <option value="">-- Pilih Unit Kerja --</option>

                                @foreach ($unitKerjas as $unitKerja)
                                    <option value="{{ $unitKerja->id }}"
                                        {{ old('unit_kerja_id', $pegawai->unit_kerja_id) == $unitKerja->id ? 'selected' : '' }}>
                                        {{ $unitKerja->nama_unit_kerja }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jabatan_id">Jabatan</label>

                            <select name="jabatan_id" id="jabatan_id" class="form-control">

                                <option value="">-- Pilih Jabatan --</option>

                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}"
                                        {{ old('jabatan_id', $pegawai->jabatan_id) == $jabatan->id ? 'selected' : '' }}>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="pendidikan_terakhir">
                                Pendidikan Terakhir
                            </label>

                            <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control">

                                <option value="">-- Pilih Pendidikan --</option>

                                @foreach (['SMA', 'D3', 'S1', 'S2', 'S3'] as $pendidikan)
                                    <option value="{{ $pendidikan }}"
                                        {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == $pendidikan ? 'selected' : '' }}>
                                        {{ $pendidikan }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jabatan_fungsional">
                                Jabatan Fungsional
                            </label>

                            <select name="jabatan_fungsional" id="jabatan_fungsional" class="form-control">

                                <option value="">-- Pilih Jabatan Fungsional --</option>

                                @foreach (['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Profesor'] as $jabatanFungsional)
                                    <option value="{{ $jabatanFungsional }}"
                                        {{ old('jabatan_fungsional', $pegawai->jabatan_fungsional) == $jabatanFungsional ? 'selected' : '' }}>
                                        {{ $jabatanFungsional }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <hr>

                    <div class="text-right">

                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
