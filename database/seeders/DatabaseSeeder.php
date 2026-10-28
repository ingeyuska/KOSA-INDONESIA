<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProgramSeeder::class,
            AlumniSeeder::class,
            AchievementSeeder::class,
            EventSeeder::class,
            CeritaAlumniSeeder::class,
            UniversitasSeeder::class,
            ]);
    }
}