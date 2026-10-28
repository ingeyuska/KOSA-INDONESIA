<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tentangs';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
    ];
}