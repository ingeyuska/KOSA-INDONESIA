<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kartu_alumnis', function (Blueprint $table) {

            $table->date('tanggal_terbit')
                ->nullable()
                ->after('nomor_kartu');

            $table->date('tanggal_berlaku_sampai')
                ->nullable()
                ->after('tanggal_terbit');

            $table->enum('status', [
                'aktif',
                'tidak_aktif',
                'kedaluwarsa'
            ])
            ->default('aktif')
            ->change();
        });
    }

    public function down(): void
    {
        Schema::table('kartu_alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'tanggal_terbit',
                'tanggal_berlaku_sampai'
            ]);

            $table->enum('status', [
                'aktif',
                'tidak_aktif'
            ])
            ->default('aktif')
            ->change();
        });
    }
};