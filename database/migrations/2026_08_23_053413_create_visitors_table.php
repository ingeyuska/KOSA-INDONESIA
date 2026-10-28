<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {

            $table->id();

            // IP pengunjung
            $table->string('ip_address')->nullable();

            // Tanggal kunjungan
            $table->date('visit_date');

            // Waktu kunjungan
            $table->timestamp('visited_at')->nullable();

            $table->timestamps();

            // Mempercepat pencarian berdasarkan tanggal
            $table->index('visit_date');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};