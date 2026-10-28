<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'super_admin',
                'manager',
                'alumni',
                'member'
            )
            NOT NULL
            DEFAULT 'alumni'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'admin',
                'super_admin',
                'alumni',
                'member'
            )
            NOT NULL
            DEFAULT 'alumni'
        ");
    }
};