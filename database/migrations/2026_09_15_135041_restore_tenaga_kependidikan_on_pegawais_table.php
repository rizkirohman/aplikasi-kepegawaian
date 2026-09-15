<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Izinkan sementara kedua nilai
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tendik',
                'Tenaga Kependidikan'
            ])->change();
        });

        // Kembalikan data Tendik menjadi Tenaga Kependidikan
        DB::table('pegawais')
            ->where('jenis_pegawai', 'Tendik')
            ->update([
                'jenis_pegawai' => 'Tenaga Kependidikan'
            ]);

        // Hapus nilai Tendik dari enum
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tenaga Kependidikan'
            ])->change();
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tenaga Kependidikan',
                'Tendik'
            ])->change();
        });

        DB::table('pegawais')
            ->where('jenis_pegawai', 'Tenaga Kependidikan')
            ->update([
                'jenis_pegawai' => 'Tendik'
            ]);

        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tendik'
            ])->change();
        });
    }
};