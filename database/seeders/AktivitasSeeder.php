<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    public function run(): void
    {
        Aktivitas::create([
            'judul' => 'Kegiatan Sosial Alumni KOSA',
            'deskripsi' => 'Kegiatan sosial bersama alumni KOSA sebagai bentuk kepedulian dan kebersamaan.',
            'gambar' => null,
            'tanggal' => '2026-08-01',
            'status' => 'published',
        ]);

        Aktivitas::create([
            'judul' => 'Rapat Pengurus Alumni KOSA',
            'deskripsi' => 'Rapat koordinasi pengurus untuk membahas program kerja alumni KOSA.',
            'gambar' => null,
            'tanggal' => '2026-08-05',
            'status' => 'published',
        ]);

        Aktivitas::create([
            'judul' => 'Persiapan Program Alumni',
            'deskripsi' => 'Persiapan kegiatan dan program alumni KOSA yang akan datang.',
            'gambar' => null,
            'tanggal' => '2026-08-20',
            'status' => 'draft',
        ]);
    }
}