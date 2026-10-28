<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniInvitation extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_hp',
        'token',
        'used',
        'activated_at',
    ];

    protected $casts = [
        'used' => 'boolean',
        'activated_at' => 'datetime',
    ];
}