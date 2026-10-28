<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {

            $table->id();

            $table->string('judul')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('foto');

            $table->integer('urutan')->default(1);

            $table->enum('status', [
                'aktif',
                'tidak_aktif'
            ])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};