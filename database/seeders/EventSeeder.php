<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'judul' => 'Temu Alumni KOSA 2026',
            'deskripsi' => 'Kegiatan temu alumni KOSA untuk mempererat hubungan antar alumni.',
            'tanggal' => '2026-09-20',
            'waktu' => '09:00:00',
            'lokasi' => 'Jakarta',
            'foto' => null,
            'status' => 'akan_datang',
        ]);

        Event::create([
            'judul' => 'Seminar Alumni KOSA',
            'deskripsi' => 'Seminar dan sharing pengalaman bersama alumni KOSA.',
            'tanggal' => '2026-10-10',
            'waktu' => '10:00:00',
            'lokasi' => 'Jakarta',
            'foto' => null,
            'status' => 'akan_datang',
        ]);

        Event::create([
            'judul' => 'Gathering Alumni KOSA',
            'deskripsi' => 'Gathering alumni untuk membangun silaturahmi dan jaringan alumni.',
            'tanggal' => '2026-07-15',
            'waktu' => '13:00:00',
            'lokasi' => 'Bandung',
            'foto' => null,
            'status' => 'selesai',
        ]);
    }
}