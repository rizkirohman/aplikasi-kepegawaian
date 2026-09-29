<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'admin_sdm',
                'pimpinan',
                'pegawai'
            )
            NOT NULL
            DEFAULT 'pegawai'
            AFTER password
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'pimpinan',
                'pegawai'
            )
            NOT NULL
            DEFAULT 'pegawai'
            AFTER password
        ");
    }
};