@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">
            Riwayat Aktivitas
        </h1>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Aktivitas Pengguna
                </h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengguna</th>
                                <th>Aktivitas</th>
                                <th>Modul</th>
                                <th>Deskripsi</th>
                                <th>IP Address</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($auditLogs as $index => $log)
                                <tr>
                                    <td>
                                        {{ $auditLogs->firstItem() + $index }}
                                    </td>

                                    <td>
                                        {{ $log->user->name ?? 'User tidak tersedia' }}
                                    </td>

                                    <td>
                                        @if ($log->action === 'create')
                                            <span class="badge badge-success">
                                                Create
                                            </span>
                                        @elseif ($log->action === 'update')
                                            <span class="badge badge-warning">
                                                Update
                                            </span>
                                        @elseif ($log->action === 'delete')
                                            <span class="badge badge-danger">
                                                Delete
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                {{ ucfirst($log->action) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $log->module }}
                                    </td>

                                    <td>
                                        {{ $log->description }}
                                    </td>

                                    <td>
                                        {{ $log->ip_address ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $log->created_at->format('d-m-Y H:i:s') }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada aktivitas.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $auditLogs->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection
