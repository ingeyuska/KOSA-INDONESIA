<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();

           $table->string('nama_program');
            $table->enum('jenis', [
                'short_course',
                'master',
                'phd',
                'training'
            ]);

            $table->year('tahun')->nullable();

            $table->string('universitas')->nullable();

            $table->enum('bidang_keilmuan', [
                'social_science',
                'stem'
            ])->nullable();

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};