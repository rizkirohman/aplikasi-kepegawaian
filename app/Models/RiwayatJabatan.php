<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatJabatan extends Model
{
    protected $table = 'riwayat_jabatans';

    protected $fillable = [
        'pegawai_id',
        'jabatan',
        'unit_kerja',
        'tmt',
        'nomor_sk',
        'tanggal_sk',
        'dokumen_sk',
    ];

    protected $casts = [
        'tmt' => 'date',
        'tanggal_sk' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }
}
