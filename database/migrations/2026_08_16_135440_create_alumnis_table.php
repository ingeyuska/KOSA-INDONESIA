<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Data alumni
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('email');

            $table->string('angkatan')->nullable();
            $table->string('jurusan')->nullable();

            $table->string('pekerjaan')->nullable();
            $table->string('domisili')->nullable();

            $table->string('jenis_kelamin')->nullable();
            $table->string('pendidikan')->nullable();

            $table->string('institusi')->nullable();
            $table->text('alamat_kantor')->nullable();

            $table->string('telepon_kantor')->nullable();
            $table->string('nomor_hp')->nullable();

            $table->enum('status', [
                    'aktif',
                    'tidak_aktif'
                ])->default('aktif');
                        $table->timestamps();
                    });
                }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};