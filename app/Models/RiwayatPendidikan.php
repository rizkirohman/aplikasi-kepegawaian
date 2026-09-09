<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikans';

    protected $fillable = [
        'pegawai_id',
        'jenjang',
        'program_studi',
        'perguruan_tinggi',
        'tahun_lulus',
        'gelar',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }
}
