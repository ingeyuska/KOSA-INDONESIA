<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();

            // Terhubung dengan akun login
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Program yang diikuti
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('programs')
                ->nullOnDelete();

            // Data pribadi
            $table->enum('gender', [
                'Laki-laki',
                'Perempuan'
            ])->nullable();

            // Data pekerjaan
            $table->string('position')->nullable();
            $table->string('institution')->nullable();
            $table->text('office_address')->nullable();
            $table->string('office_phone', 20)->nullable();

            // Nomor pribadi
            $table->string('mobile_phone', 20)->nullable();

            // Data tambahan
            $table->text('pendidikan')->nullable();

            // Status data alumni
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};