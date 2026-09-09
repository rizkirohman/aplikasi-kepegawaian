<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPangkat extends Model
{
    protected $table = 'riwayat_pangkats';

    protected $fillable = [
        'pegawai_id',
        'pangkat',
        'golongan',
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
