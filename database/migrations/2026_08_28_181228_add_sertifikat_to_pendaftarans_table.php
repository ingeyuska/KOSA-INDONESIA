<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {

            $table->string('sertifikat_nomor')
                ->nullable()
                ->unique()
                ->after('hadir');

            $table->timestamp('sertifikat_diterbitkan_at')
                ->nullable()
                ->after('sertifikat_nomor');

        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {

            $table->dropColumn([
                'sertifikat_nomor',
                'sertifikat_diterbitkan_at'
            ]);

        });
    }
};