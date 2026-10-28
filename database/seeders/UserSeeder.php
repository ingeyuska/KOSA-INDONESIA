<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // SUPER ADMIN
        // =====================================================

        User::updateOrCreate(
            ['email' => 'superadmin@kosa.com'],
            [
                'nama' => 'Super Admin KOSA',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'member_id' => null,
                'status' => 'aktif',
            ]
        );


        // =====================================================
        // ADMIN / PENGURUS INTI
        // =====================================================

        User::updateOrCreate(
            ['email' => 'admin@kosa.com'],
            [
                'nama' => 'Admin KOSA',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'member_id' => null,
                'status' => 'aktif',
            ]
        );


        // =====================================================
        // MANAJEMEN KOICA
        // =====================================================

        User::updateOrCreate(
            ['email' => 'manager@kosa.com'],
            [
                'nama' => 'Manajemen KOICA',
                'password' => Hash::make('password'),
                'role' => 'manajemen',
                'member_id' => null,
                'status' => 'aktif',
            ]
        );


        // =====================================================
        // ALUMNI
        // =====================================================

        User::updateOrCreate(
            ['email' => 'budi@gmail.com'],
            [
                'nama' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'alumni',
                'member_id' => 'A-00001',
                'status' => 'aktif',
            ]
        );


        // =====================================================
        // MEMBER / MASYARAKAT
        // =====================================================

        User::updateOrCreate(
            ['email' => 'member@kosa.com'],
            [
                'nama' => 'Masyarakat KOSA',
                'password' => Hash::make('password'),
                'role' => 'member',
                'member_id' => 'G-00001',
                'status' => 'aktif',
            ]
        );
    }
}