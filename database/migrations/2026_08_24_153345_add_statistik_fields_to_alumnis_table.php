<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->string('fakultas')
                ->nullable()
                ->after('jurusan');

            $table->enum('jenis_keilmuan', [
                'Social Science',
                'STEM'
            ])
                ->nullable()
                ->after('fakultas');

            $table->enum('klasifikasi_program', [
                'Short Course',
                'Master',
                'PhD'
            ])
                ->nullable()
                ->after('program');

        });
    }

    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'fakultas',
                'jenis_keilmuan',
                'klasifikasi_program',
            ]);

        });
    }
};