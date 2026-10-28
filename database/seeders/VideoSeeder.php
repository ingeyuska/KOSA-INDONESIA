<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        Video::create([
            'judul' => 'Temu Alumni KOSA 2026',
            'url_video' => 'https://www.youtube.com/watch?v=example1',
            'deskripsi' => 'Video dokumentasi kegiatan temu alumni KOSA.',
            'tanggal' => '2026-09-20',
            'status' => 'published',
        ]);

        Video::create([
            'judul' => 'Kegiatan Sosial Alumni KOSA',
            'url_video' => 'https://www.youtube.com/watch?v=example2',
            'deskripsi' => 'Video kegiatan sosial yang dilakukan oleh alumni KOSA.',
            'tanggal' => '2026-08-01',
            'status' => 'published',
        ]);

        Video::create([
            'judul' => 'Rapat Pengurus KOSA',
            'url_video' => 'https://www.youtube.com/watch?v=example3',
            'deskripsi' => 'Video dokumentasi rapat pengurus alumni KOSA.',
            'tanggal' => '2026-08-05',
            'status' => 'draft',
        ]);
    }
}