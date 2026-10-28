<?php

namespace App\Exports;

use App\Models\Alumni;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return Alumni::query()
            ->orderBy('nama')
            ->get([
                'id',
                'nama',
                'email',
                'jenis_kelamin',
                'angkatan',
                'jurusan',
                'pekerjaan',
                'domisili',
                'pendidikan',
                'institusi',
                'alamat_kantor',
                'telepon_kantor',
                'nomor_hp',
                'status',
            ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Jenis Kelamin',
            'Angkatan',
            'Jurusan',
            'Pekerjaan',
            'Domisili',
            'Pendidikan',
            'Institusi',
            'Alamat Kantor',
            'Telepon Kantor',
            'Nomor HP',
            'Status',
        ];
    }
}