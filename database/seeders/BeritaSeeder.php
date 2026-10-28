<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul' => 'Temu Alumni KOSA 2026',
            'slug' => 'temu-alumni-kosa-2026',
            'isi' => 'KOSA akan menyelenggarakan kegiatan temu alumni untuk mempererat silaturahmi dan membangun jaringan antar alumni.',
            'gambar' => null,
            'status' => 'published',
            'tanggal_publish' => '2026-08-10 09:00:00',
        ]);

        Berita::create([
            'judul' => 'Program Kerja Alumni KOSA',
            'slug' => 'program-kerja-alumni-kosa',
            'isi' => 'Pengurus alumni KOSA mempersiapkan berbagai program kerja yang ditujukan untuk meningkatkan hubungan dan kontribusi alumni.',
            'gambar' => null,
            'status' => 'published',
            'tanggal_publish' => '2026-08-12 10:00:00',
        ]);

        Berita::create([
            'judul' => 'Persiapan Kegiatan Alumni',
            'slug' => 'persiapan-kegiatan-alumni',
            'isi' => 'Persiapan kegiatan alumni KOSA yang akan dilaksanakan dalam waktu dekat.',
            'gambar' => null,
            'status' => 'draft',
            'tanggal_publish' => null,
        ]);
    }
}