<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Alumni;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $alumni = Alumni::first();

        if (!$alumni) {
            return;
        }

        Achievement::create([
            'alumni_id' => $alumni->id,
            'judul' => 'Best Participant KOICA Training',
            'deskripsi' => 'Mendapatkan penghargaan sebagai peserta terbaik dalam program pelatihan.',
            'penyelenggara' => 'KOICA',
            'tahun' => 2024,
            'foto' => null,
        ]);

        Achievement::create([
            'alumni_id' => $alumni->id,
            'judul' => 'Outstanding Alumni',
            'deskripsi' => 'Penghargaan atas kontribusi dan prestasi alumni.',
            'penyelenggara' => 'KOSA',
            'tahun' => 2025,
            'foto' => null,
        ]);
    }
}