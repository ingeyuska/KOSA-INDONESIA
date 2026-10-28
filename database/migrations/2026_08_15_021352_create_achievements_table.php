<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();

            // Achievement milik alumni
            $table->foreignId('alumni_id')
                ->constrained('alumni')
                ->cascadeOnDelete();

            $table->string('judul');

            $table->text('deskripsi')->nullable();

            $table->string('penyelenggara')->nullable();

            $table->year('tahun')->nullable();

            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};