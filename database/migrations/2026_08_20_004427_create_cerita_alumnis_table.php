<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cerita_alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('program')->nullable();
            $table->string('foto')->nullable();
            $table->text('cerita');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cerita_alumni');
    }
};