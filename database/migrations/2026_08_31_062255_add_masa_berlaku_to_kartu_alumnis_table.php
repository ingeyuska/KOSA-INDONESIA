<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartu_alumnis', function (Blueprint $table) {

            if (!Schema::hasColumn('kartu_alumnis', 'tanggal_terbit')) {
                $table->date('tanggal_terbit')
                    ->nullable()
                    ->after('nomor_kartu');
            }

            if (!Schema::hasColumn('kartu_alumnis', 'tanggal_berlaku_sampai')) {
                $table->date('tanggal_berlaku_sampai')
                    ->nullable()
                    ->after('tanggal_terbit');
            }

        });
    }

    public function down(): void
    {
        Schema::table('kartu_alumnis', function (Blueprint $table) {

            if (Schema::hasColumn('kartu_alumnis', 'tanggal_berlaku_sampai')) {
                $table->dropColumn('tanggal_berlaku_sampai');
            }

            if (Schema::hasColumn('kartu_alumnis', 'tanggal_terbit')) {
                $table->dropColumn('tanggal_terbit');
            }

        });
    }
};