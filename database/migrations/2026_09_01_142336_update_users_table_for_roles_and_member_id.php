<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan email_verified_at jika belum ada
        if (!Schema::hasColumn('users', 'email_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('email_verified_at')
                    ->nullable()
                    ->after('password');
            });
        }

        // Update role
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'super_admin',
                'admin',
                'manajemen',
                'alumni',
                'member',
            ])->default('member')->change();
        });
    }

    public function down(): void
    {
        // Kembalikan role lama
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'alumni',
            ])->default('alumni')->change();
        });

        // Hapus email_verified_at jika ada
        if (Schema::hasColumn('users', 'email_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('email_verified_at');
            });
        }
    }
};