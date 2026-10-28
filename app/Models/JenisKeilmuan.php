<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKeilmuan extends Model
{
    protected $table = 'jenis_keilmuans';

    protected $fillable = [
        'nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}