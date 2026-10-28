<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            $table->text('deskripsi')->nullable();

            $table->date('tanggal');

            $table->time('waktu')->nullable();

            $table->string('lokasi')->nullable();

            $table->string('foto')->nullable();

            $table->enum('status', [
                'akan_datang',
                'berlangsung',
                'selesai'
            ])->default('akan_datang');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};