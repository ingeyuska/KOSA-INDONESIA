<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            // =========================
            // PROFILE / DOMISILI
            // =========================

            $table->text('alamat_lengkap')
                ->nullable()
                ->after('domisili');

            $table->string('provinsi')
                ->nullable()
                ->after('alamat_lengkap');

            $table->string('kabupaten_kota')
                ->nullable()
                ->after('provinsi');

            $table->string('kecamatan')
                ->nullable()
                ->after('kabupaten_kota');

            // =========================
            // KONTAK / PROFIL PROFESIONAL
            // =========================

            $table->string('linkedin')
                ->nullable()
                ->after('nomor_hp');

            $table->string('website')
                ->nullable()
                ->after('linkedin');

            // =========================
            // PEKERJAAN
            // =========================

            $table->string('level_jabatan')
                ->nullable()
                ->after('jabatan');

            $table->string('eselon')
                ->nullable()
                ->after('level_jabatan');

            $table->string('unit_kerja')
                ->nullable()
                ->after('eselon');

            $table->string('status_kepegawaian')
                ->nullable()
                ->after('unit_kerja');

        });
    }

    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'alamat_lengkap',
                'provinsi',
                'kabupaten_kota',
                'kecamatan',
                'linkedin',
                'website',
                'level_jabatan',
                'eselon',
                'unit_kerja',
                'status_kepegawaian',
            ]);

        });
    }
};