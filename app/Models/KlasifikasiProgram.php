<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiProgram extends Model
{
    protected $table = 'klasifikasi_programs';

    protected $fillable = [
        'nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}