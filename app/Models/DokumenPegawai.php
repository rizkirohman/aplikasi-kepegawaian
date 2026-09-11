<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenPegawai extends Model
{
    protected $table = 'dokumen_pegawais';

    protected $fillable = [
        'pegawai_id',
        'nama_dokumen',
        'kategori',
        'nomor_dokumen',
        'tanggal_dokumen',
        'file',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }
}
