<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Pegawai;

class AuditLogObserver
{
    public function created(Pegawai $pegawai): void
    {
        $this->log(
            'create',
            'Pegawai',
            'Menambahkan data pegawai: ' . $pegawai->nama_lengkap
        );
    }

    public function updated(Pegawai $pegawai): void
    {
        $this->log(
            'update',
            'Pegawai',
            'Mengubah data pegawai: ' . $pegawai->nama_lengkap
        );
    }

    public function deleted(Pegawai $pegawai): void
    {
        $this->log(
            'delete',
            'Pegawai',
            'Menghapus data pegawai: ' . $pegawai->nama_lengkap
        );
    }

    public function log(
        string $action,
        string $module,
        string $description
    ): void {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}