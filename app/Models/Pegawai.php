<?php

namespace App\Models;

use App\Models\RiwayatJabatan;
use App\Models\RiwayatPangkat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawais';

    protected $fillable = [
        'user_id',
        'nip',
        'nidn_nidk',
        'nama_lengkap',
        'foto',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'alamat',
        'no_hp',
        'email',
        'jenis_pegawai',
        'status_kepegawaian',
        'tmt',
        'unit_kerja_id',
        'jabatan_id',
        'pendidikan_terakhir',
        'jabatan_fungsional',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tmt' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function riwayatPendidikan(): HasMany
    {
        return $this->hasMany(RiwayatPendidikan::class);
    }

    public function riwayatPangkat(): HasMany
    {
        return $this->hasMany(RiwayatPangkat::class);
    }

    public function riwayatJabatan(): HasMany
    {
        return $this->hasMany(RiwayatJabatan::class);
    }

    public function dokumen(): HasMany
    {
        return $this->hasMany(DokumenPegawai::class);
    }
}
