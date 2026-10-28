<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMaster extends Model
{
    protected $table = 'program_master';

    protected $fillable = [
        'nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}