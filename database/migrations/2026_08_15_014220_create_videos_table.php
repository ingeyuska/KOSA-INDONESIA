<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->string('url_video');
            $table->text('deskripsi')->nullable();

            $table->date('tanggal')->nullable();

            $table->enum('status', [
                'draft',
                'published'
            ])->default('published');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};