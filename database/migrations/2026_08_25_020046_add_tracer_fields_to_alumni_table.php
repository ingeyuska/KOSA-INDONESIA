<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->enum('status_pekerjaan', [
                'bekerja',
                'belum_bekerja',
                'wirausaha',
                'melanjutkan_pendidikan'
            ])->nullable();

            $table->string('bidang_pekerjaan')->nullable();

            $table->string('perusahaan')->nullable();

            $table->string('jabatan')->nullable();

            $table->string('lokasi_pekerjaan')->nullable();

            $table->year('tahun_mulai')->nullable();

            $table->string('pendidikan_terakhir')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'status_pekerjaan',
                'bidang_pekerjaan',
                'perusahaan',
                'jabatan',
                'lokasi_pekerjaan',
                'tahun_mulai',
                'pendidikan_terakhir',
            ]);

        });
    }
};