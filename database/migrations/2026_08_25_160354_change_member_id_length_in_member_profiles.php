<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE member_profiles
            MODIFY member_id VARCHAR(7) UNIQUE
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE member_profiles
            MODIFY member_id VARCHAR(6) UNIQUE
        ");
    }
};