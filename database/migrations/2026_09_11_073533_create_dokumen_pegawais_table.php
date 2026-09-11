<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen_pegawais', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pegawai_id')
                ->constrained('pegawais')
                ->cascadeOnDelete();

            $table->string('nama_dokumen');

            $table->string('kategori');

            $table->string('nomor_dokumen')
                ->nullable();

            $table->date('tanggal_dokumen')
                ->nullable();

            $table->string('file');

            $table->text('keterangan')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pegawais');
    }
};
