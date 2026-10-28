<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kartu_alumnis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('alumni_id')
                ->constrained('alumnis')
                ->cascadeOnDelete();

            $table->string('nomor_kartu')->unique();

            $table->enum('status', [
                'aktif',
                'tidak_aktif'
            ])->default('aktif');

            $table->string('file_kartu')->nullable();

            $table->timestamps();

            $table->unique('alumni_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kartu_alumnis');
    }
};