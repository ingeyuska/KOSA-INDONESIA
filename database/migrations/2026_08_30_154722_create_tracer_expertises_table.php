<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_expertises', function (Blueprint $table) {

            $table->id();

            $table->foreignId('alumni_id')
                ->constrained('alumnis')
                ->cascadeOnDelete();

            $table->string('nama_expertise');

            $table->timestamps();

            $table->unique([
                'alumni_id',
                'nama_expertise'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_expertises');
    }
};