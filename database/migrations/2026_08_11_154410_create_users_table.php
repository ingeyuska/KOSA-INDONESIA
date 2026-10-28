<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');

            // Hak akses
            $table->enum('role', ['admin', 'alumni'])
                ->default('alumni');

            // Profil
            $table->string('no_hp', 20)->nullable();
            $table->string('foto')->nullable();
            $table->text('bio')->nullable();

            // Status akun
            $table->enum('status', ['aktif', 'tidak_aktif'])
                ->default('aktif');

            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};