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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();

            // Relasi dengan user
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Identitas
            $table->string('nip')->unique();
            $table->string('nidn_nidk')->nullable();
            $table->string('nama_lengkap');
            $table->string('foto')->nullable();

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ]);

            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');

            $table->enum('status_perkawinan', [
                'Menikah',
                'Bercerai'
            ])->nullable();

            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();

            // Kepegawaian
            $table->enum('jenis_pegawai', [
                'Dosen',
                'Tenaga Kependidikan'
            ]);

            $table->string('status_kepegawaian')->nullable();
            $table->date('tmt')->nullable();

            // Master data
            $table->foreignId('unit_kerja_id')
                ->nullable()
                ->constrained('unit_kerjas')
                ->nullOnDelete();

            $table->foreignId('jabatan_id')
                ->nullable()
                ->constrained('jabatans')
                ->nullOnDelete();

            // Pendidikan dan jabatan fungsional
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('jabatan_fungsional')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
