<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->unsignedTinyInteger('tracer_progress')
                ->default(0)
                ->after('status');

            $table->enum('tracer_status', [
                'draft',
                'submitted',
                'verified'
            ])
                ->default('draft')
                ->after('tracer_progress');

            $table->timestamp('tracer_submitted_at')
                ->nullable()
                ->after('tracer_status');

        });
    }

    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'tracer_progress',
                'tracer_status',
                'tracer_submitted_at',
            ]);

        });
    }
};