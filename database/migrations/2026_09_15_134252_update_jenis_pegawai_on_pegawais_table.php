<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum terlebih dahulu agar 'Tendik' diperbolehkan
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tendik',
                'Tenaga Kependidikan'
            ])->change();
        });

        // Ubah data lama
        DB::table('pegawais')
            ->where('jenis_pegawai', 'Tenaga Kependidikan')
            ->update(['jenis_pegawai' => 'Tendik']);

        // Hapus nilai lama dari enum
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tendik'
            ])->change();
        });
    }

    public function down(): void
    {
        // Izinkan kembali nilai lama
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tendik',
                'Tenaga Kependidikan'
            ])->change();
        });

        // Kembalikan data Tendik
        DB::table('pegawais')
            ->where('jenis_pegawai', 'Tendik')
            ->update(['jenis_pegawai' => 'Tenaga Kependidikan']);

        // Kembalikan enum seperti semula
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tenaga Kependidikan'
            ])->change();
        });
    }
};