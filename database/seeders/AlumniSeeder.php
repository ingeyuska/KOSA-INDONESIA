<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\User;
use App\Models\Program;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'budi@gmail.com')->first();

        $program = Program::where(
            'nama_program',
            'KOICA Training'
        )->first();

        Alumni::create([
            'user_id' => $user->id,
            'program_id' => $program->id,
            'gender' => 'Laki-laki',
            'position' => 'Manager',
            'institution' => 'PT ABC Indonesia',
            'office_address' => 'Jakarta',
            'office_phone' => '0211234567',
            'mobile_phone' => '08123456789',
            'pendidikan' => 'S1 Sistem Informasi',
            'status' => 'active',
        ]);
    }
}