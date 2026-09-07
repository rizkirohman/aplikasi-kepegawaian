<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitKerja extends Model
{
    protected $table = 'unit_kerjas';

    protected $fillable = [
        'nama_unit_kerja',
        'kode',
        'keterangan',
    ];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }
}
