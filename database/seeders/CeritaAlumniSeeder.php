<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CeritaAlumni;

class CeritaAlumniSeeder extends Seeder
{
    public function run(): void
    {
        CeritaAlumni::create([
            'nama' => 'Alumni KOSA',
            'program' => 'KOICA Degree Program',
            'foto' => null,
            'cerita' => 'Program KOICA memberikan saya pengalaman, pengetahuan, dan jaringan yang sangat berarti untuk pengembangan diri dan karier.',
            'status' => true,
        ]);

        CeritaAlumni::create([
            'nama' => 'Alumni KOSA',
            'program' => 'KOICA Short Course',
            'foto' => null,
            'cerita' => 'Bergabung dengan KOSA membuka kesempatan untuk bertemu dengan alumni dari berbagai bidang dan membangun kolaborasi baru.',
            'status' => true,
        ]);

        CeritaAlumni::create([
            'nama' => 'Alumni KOSA',
            'program' => 'KOICA Program',
            'foto' => null,
            'cerita' => 'Pengalaman mengikuti program KOICA menjadi salah satu langkah penting dalam perjalanan profesional dan kontribusi saya di Indonesia.',
            'status' => true,
        ]);
    }
}