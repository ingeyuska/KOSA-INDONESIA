<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            // Consent
            $table->boolean('bersedia_mentor')
                ->default(false)
                ->after('tracer_status');

            $table->boolean('bersedia_narasumber')
                ->default(false)
                ->after('bersedia_mentor');

            $table->boolean('bersedia_expert')
                ->default(false)
                ->after('bersedia_narasumber');

            $table->boolean('bersedia_kolaborasi_sosial')
                ->default(false)
                ->after('bersedia_expert');

            $table->boolean('bersedia_dihubungi')
                ->default(false)
                ->after('bersedia_kolaborasi_sosial');

            // Networking & Contribution
            $table->text('topik_mentoring')
                ->nullable()
                ->after('bersedia_dihubungi');

            $table->json('tag_expertise')
                ->nullable()
                ->after('topik_mentoring');

            $table->json('jenis_kolaborasi')
                ->nullable()
                ->after('tag_expertise');

            $table->json('area_kontribusi')
                ->nullable()
                ->after('jenis_kolaborasi');
        });
    }

    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {

            $table->dropColumn([
                'bersedia_mentor',
                'bersedia_narasumber',
                'bersedia_expert',
                'bersedia_kolaborasi_sosial',
                'bersedia_dihubungi',
                'topik_mentoring',
                'tag_expertise',
                'jenis_kolaborasi',
                'area_kontribusi',
            ]);
        });
    }
};