<?php

namespace App\Console\Commands;

use App\Models\AlumniInvitation;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportAlumniInvitation extends Command
{
    protected $signature = 'alumni:invitation';

    protected $description = 'Membuat invitation alumni existing';

    public function handle()
    {
        $data = [
            [
                'nama_lengkap' => 'Alumni Contoh 1',
                'email' => 'alumni1@example.com',
                'no_hp' => '08123456789',
            ],

            [
                'nama_lengkap' => 'Alumni Contoh 2',
                'email' => 'alumni2@example.com',
                'no_hp' => '08123456788',
            ],
        ];

        foreach ($data as $alumni) {

            AlumniInvitation::updateOrCreate(
                [
                    'email' => $alumni['email'],
                ],
                [
                    'nama_lengkap' => $alumni['nama_lengkap'],
                    'no_hp' => $alumni['no_hp'],
                    'token' => Str::random(64),
                    'used' => false,
                ]
            );
        }

        $this->info('Invitation alumni berhasil dibuat.');

        return Command::SUCCESS;
    }
}