@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- Judul halaman --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Laporan Pegawai
            </h1>
        </div>

        {{-- Card Laporan --}}
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex justify-content-between align-items-center">

                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Laporan Pegawai
                </h6>

                <span class="badge badge-primary">
                    Total: {{ $pegawais->count() }} Pegawai
                </span>

            </div>

            <div class="card-body">


                {{-- Form Pencarian dan Filter --}}
                <form action="{{ route('laporan.pegawai') }}" method="GET" class="mb-4">
                    <div class="form-row align-items-end">

                        {{-- Pencarian --}}
                        <div class="col-md-3 mb-2">
                            <label for="search">Cari Pegawai</label>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Nama, NIP, atau NIDN/NIDK" value="{{ request('search') }}">
                        </div>

                        {{-- Jenis Pegawai --}}
                        <div class="col-md-2 mb-2">
                            <label for="jenis_pegawai">Jenis Pegawai</label>
                            <select name="jenis_pegawai" id="jenis_pegawai" class="form-control">
                                <option value="">Semua Jenis</option>
                                <option value="Dosen" {{ request('jenis_pegawai') == 'Dosen' ? 'selected' : '' }}>
                                    Dosen
                                </option>
                                <option value="Tenaga Kependidikan"
                                    {{ request('jenis_pegawai') == 'Tenaga Kependidikan' ? 'selected' : '' }}>
                                    Tendik
                                </option>
                            </select>
                        </div>

                        {{-- Unit Kerja --}}
                        <div class="col-md-2 mb-2">
                            <label for="unit_kerja_id">Unit Kerja</label>
                            <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">
                                <option value="">Semua Unit Kerja</option>
                                @foreach ($unitKerjas as $unitKerja)
                                    <option value="{{ $unitKerja->id }}"
                                        {{ request('unit_kerja_id') == $unitKerja->id ? 'selected' : '' }}>
                                        {{ $unitKerja->nama_unit_kerja }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status Kepegawaian --}}
                        <div class="col-md-2 mb-2">
                            <label for="status_kepegawaian">Status Kepegawaian</label>
                            <select name="status_kepegawaian" id="status_kepegawaian" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="CPNS" {{ request('status_kepegawaian') == 'CPNS' ? 'selected' : '' }}>
                                    CPNS
                                </option>

                                <option value="PNS" {{ request('status_kepegawaian') == 'PNS' ? 'selected' : '' }}>
                                    PNS
                                </option>

                                <option value="CPT" {{ request('status_kepegawaian') == 'CPT' ? 'selected' : '' }}>
                                    CPT
                                </option>

                                <option value="PT" {{ request('status_kepegawaian') == 'PT' ? 'selected' : '' }}>
                                    PT
                                </option>

                                <option value="PTT" {{ request('status_kepegawaian') == 'PTT' ? 'selected' : '' }}>
                                    PTT
                                </option>
                            </select>
                        </div>

                        {{-- Status Pegawai --}}
                        <div class="col-md-2 mb-2">
                            <label for="status_pegawai">Status Pegawai</label>
                            <select name="status_pegawai" id="status_pegawai" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="Aktif" {{ request('status_pegawai') == 'Aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="Pensiun" {{ request('status_pegawai') == 'Pensiun' ? 'selected' : '' }}>
                                    Pensiun
                                </option>
                                <option value="Nonaktif" {{ request('status_pegawai') == 'Nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>
                        </div>

                        {{-- Tombol Aksi (Mendekat ke Field Status) --}}
                        <div class="col-auto mb-2 pl-0">
                            <button type="submit" class="btn btn-primary mr-0">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('laporan.pegawai') }}" class="btn btn-secondary">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>

                    </div>
                </form>

                <hr>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIP</th>
                                <th>Jenis Pegawai</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th>Status Kepegawaian</th>
                                <th>Status Pegawai</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($pegawais as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $pegawai->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ $pegawai->nip }}
                                    </td>

                                    <td>
                                        {{ str_replace('Tenaga Kependidikan', 'Tendik', $pegawai->jenis_pegawai) }}
                                    </td>

                                    <td>
                                        {{ $pegawai->unitKerja->nama_unit_kerja ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pegawai->jabatan->nama_jabatan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pegawai->status_kepegawaian ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pegawai->status_pegawai ?? '-' }}
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data pegawai.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
