<?php

namespace Database\Seeders;

use App\Models\Foto;
use Illuminate\Database\Seeder;

class FotoSeeder extends Seeder
{
    public function run(): void
    {
        Foto::create([
            'judul' => 'Temu Alumni KOSA 2026',
            'file_foto' => 'foto-1.jpg',
            'deskripsi' => 'Dokumentasi kegiatan temu alumni KOSA.',
            'tanggal' => '2026-09-20',
            'status' => 'published',
        ]);

        Foto::create([
            'judul' => 'Kegiatan Sosial Alumni',
            'file_foto' => 'foto-2.jpg',
            'deskripsi' => 'Dokumentasi kegiatan sosial bersama alumni KOSA.',
            'tanggal' => '2026-08-01',
            'status' => 'published',
        ]);

        Foto::create([
            'judul' => 'Rapat Pengurus KOSA',
            'file_foto' => 'foto-3.jpg',
            'deskripsi' => 'Dokumentasi rapat pengurus alumni KOSA.',
            'tanggal' => '2026-08-05',
            'status' => 'draft',
        ]);
    }
}