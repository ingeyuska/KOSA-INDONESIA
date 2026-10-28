<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_organizations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('alumni_id')
                ->constrained('alumnis')
                ->cascadeOnDelete();

            $table->string('nama_organisasi');

            $table->string('jabatan')
                ->nullable();

            $table->string('tingkat_organisasi')
                ->nullable();

            $table->year('tahun_mulai')
                ->nullable();

            $table->year('tahun_selesai')
                ->nullable();

            $table->text('deskripsi')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_organizations');
    }
};