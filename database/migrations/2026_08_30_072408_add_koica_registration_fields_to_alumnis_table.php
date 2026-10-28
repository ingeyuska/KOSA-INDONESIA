<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            if (!Schema::hasColumn('alumnis', 'jenis_program')) {
                $table->string('jenis_program')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'judul_program')) {
                $table->string('judul_program')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'tahun_masuk')) {
                $table->year('tahun_masuk')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'tahun_lulus')) {
                $table->year('tahun_lulus')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'jenjang')) {
                $table->string('jenjang')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'gelar')) {
                $table->string('gelar')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'kategori')) {
                $table->string('kategori')->nullable();
            }

            if (!Schema::hasColumn('alumnis', 'tahun_penyelenggaraan')) {
                $table->year('tahun_penyelenggaraan')->nullable();
            }
        });
    }

    public function down(): void
    {
        $columns = [
            'jenis_program',
            'judul_program',
            'tahun_masuk',
            'tahun_lulus',
            'jenjang',
            'gelar',
            'kategori',
            'tahun_penyelenggaraan',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('alumnis', $column)) {
                Schema::table('alumnis', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};