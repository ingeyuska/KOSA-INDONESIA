<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::create([
            'nama_program' => 'KOICA Training',
            'jenis' => 'training',
            'tahun' => 2024,
            'universitas' => 'Korea University',
            'bidang_keilmuan' => 'social_science',
            'deskripsi' => 'Program training KOICA.',
        ]);

        Program::create([
            'nama_program' => 'Master Development Studies',
            'jenis' => 'master',
            'tahun' => 2023,
            'universitas' => 'Seoul National University',
            'bidang_keilmuan' => 'social_science',
            'deskripsi' => 'Program pendidikan Master.',
        ]);

        Program::create([
            'nama_program' => 'PhD Engineering',
            'jenis' => 'phd',
            'tahun' => 2022,
            'universitas' => 'KAIST',
            'bidang_keilmuan' => 'stem',
            'deskripsi' => 'Program pendidikan PhD bidang Engineering.',
        ]);
    }
}