<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // PROGRAM
        if (!Schema::hasTable('program_master')) {
            Schema::create('program_master', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }

        // KLASIFIKASI PROGRAM
        if (!Schema::hasTable('klasifikasi_programs')) {
            Schema::create('klasifikasi_programs', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }

        // JENIS KEILMUAN
        if (!Schema::hasTable('jenis_keilmuans')) {
            Schema::create('jenis_keilmuans', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_keilmuans');
        Schema::dropIfExists('klasifikasi_programs');
        Schema::dropIfExists('program_master');
    }
};