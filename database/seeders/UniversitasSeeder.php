<?php

namespace Database\Seeders;

use App\Models\Universitas;
use Illuminate\Database\Seeder;

class UniversitasSeeder extends Seeder
{
    public function run(): void
    {
        $universitas = [
            'Ewha Womans University',
            'Dongseo University',
            'Ajou University',
            'Daejeon University',
            'Dong-A University',
            'Chonnam National University',
            'Chungbuk National University',
            'Duksung Women’s University',
            'Chung-Ang University',
            'Busan University of Foreign Studies',
            'Chungnam National University',
            'Daegu University',
            'Dongguk University',

            'Hanyang University',
            'Gyeongsang National University',
            'Hankuk University of Foreign Studies',
            'Hoseo University',
            'Hannam University',

            'Inha University',
            'Konyang University',
            'Keimyung University',
            'Jeonbuk National University',
            'Inje University',
            'Korea University',
            'Kookmin University',
            'Jeju National University',
            'Kangwon National University',
            'Konkuk University',
            'Kongju National University',
            'Korea University of Technology and Education (KOREATECH)',

            'Pukyong National University',
            'Osan University',
            'Kyung Hee University',
            'Pusan National University',
            'Kyungpook National University',
            'Kyungbok University',
            'Korea Maritime and Ocean University',
            'Pai Chai University',

            'Sookmyung Women’s University',
            'Sungkyunkwan University',
            'University of Seoul',
            'Seoul National University of Science and Technology',
            'Sun Moon University',
            'Sungshin Women’s University',
            'Soonchunhyang University',
            'Seokyeong University',
            'Shinhan University',
            'Yeungnam University',
            'Sogang University',
            'Sunchon National University',
            'TECH University of Korea',
            'Silla University',
            'Yeungjin University',
            'Seoul National University',
            'Yonsei University',
            'Semyung University',
            'Ulsan National Institute of Science and Technology (UNIST)',
        ];

        foreach ($universitas as $nama) {
            Universitas::create([
                'nama_universitas' => $nama,
                'aktif' => true,
            ]);
        }
    }
}