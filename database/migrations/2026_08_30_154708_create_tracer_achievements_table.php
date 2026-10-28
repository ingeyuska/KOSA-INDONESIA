<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_achievements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('alumni_id')
                ->constrained('alumnis')
                ->cascadeOnDelete();

            $table->string('nama_pencapaian');

            $table->string('jenis_pencapaian')
                ->nullable();

            $table->string('bidang')
                ->nullable();

            $table->string('penyelenggara')
                ->nullable();

            $table->year('tahun')
                ->nullable();

            $table->text('deskripsi')
                ->nullable();

            $table->string('bukti')
                ->nullable();

            $table->string('link_publikasi')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_achievements');
    }
};