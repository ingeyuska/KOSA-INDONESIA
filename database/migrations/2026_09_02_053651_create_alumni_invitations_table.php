<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_invitations', function (Blueprint $table) {

            $table->id();

            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();

            // Token untuk link aktivasi unik
            $table->string('token', 100)->unique();

            // Apakah sudah digunakan
            $table->boolean('used')->default(false);

            // Waktu aktivasi
            $table->timestamp('activated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_invitations');
    }
};