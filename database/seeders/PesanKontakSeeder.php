<?php

namespace Database\Seeders;

use App\Models\PesanKontak;
use Illuminate\Database\Seeder;

class PesanKontakSeeder extends Seeder
{
    public function run(): void
    {
        PesanKontak::create([
            'nama' => 'Andi Pratama',
            'email' => 'andi@gmail.com',
            'subjek' => 'Informasi Kegiatan Alumni',
            'pesan' => 'Halo, saya ingin mengetahui informasi kegiatan alumni KOSA yang akan datang.',
            'status' => 'baru',
        ]);

        PesanKontak::create([
            'nama' => 'Siti Rahma',
            'email' => 'siti@gmail.com',
            'subjek' => 'Pertanyaan Tentang Alumni',
            'pesan' => 'Saya ingin mendapatkan informasi mengenai kegiatan dan program alumni KOSA.',
            'status' => 'dibaca',
        ]);

        PesanKontak::create([
            'nama' => 'Dimas Saputra',
            'email' => 'dimas@gmail.com',
            'subjek' => 'Kerja Sama Kegiatan',
            'pesan' => 'Kami ingin mengajukan kerja sama untuk kegiatan alumni KOSA.',
            'status' => 'dibalas',
        ]);
    }
}