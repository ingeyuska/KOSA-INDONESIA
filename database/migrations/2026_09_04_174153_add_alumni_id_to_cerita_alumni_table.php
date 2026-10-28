<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // alumni_id sudah terlanjur dibuat pada percobaan migration sebelumnya.
        // Jadi di sini kita hanya memastikan kolom tersebut ada.

        // Hapus kolom lama jika masih ada
        if (Schema::hasColumn('cerita_alumni', 'nama')) {
            Schema::table('cerita_alumni', function (Blueprint $table) {
                $table->dropColumn('nama');
            });
        }

        if (Schema::hasColumn('cerita_alumni', 'program')) {
            Schema::table('cerita_alumni', function (Blueprint $table) {
                $table->dropColumn('program');
            });
        }

        // Tambahkan foreign key hanya jika belum ada
        Schema::table('cerita_alumni', function (Blueprint $table) {
            $table->foreign('alumni_id')
                ->references('id')
                ->on('alumnis')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cerita_alumni', function (Blueprint $table) {
            $table->dropForeign(['alumni_id']);

            $table->string('nama')->nullable()->after('id');
            $table->string('program')->nullable()->after('nama');

            $table->dropColumn('alumni_id');
        });
    }
};