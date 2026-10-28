<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_activities', function (Blueprint $table) {

            $table->id();

            $table->foreignId('alumni_id')
                ->constrained('alumnis')
                ->cascadeOnDelete();

            $table->string('jenis_kegiatan');

            $table->string('nama_kegiatan');

            $table->string('peran')
                ->nullable();

            $table->string('penyelenggara')
                ->nullable();

            $table->year('tahun')
                ->nullable();

            $table->text('deskripsi')
                ->nullable();

            $table->string('bukti')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_activities');
    }
};