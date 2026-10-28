<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            // File materi paparan PDF / PPT / PPTX
            $table->string('materi')->nullable()->after('foto');

            // Menyimpan beberapa foto galeri dalam bentuk JSON
            $table->json('galeri')->nullable()->after('materi');

        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {

            $table->dropColumn([
                'materi',
                'galeri',
            ]);

        });
    }
};