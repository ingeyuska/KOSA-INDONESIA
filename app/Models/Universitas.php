<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    protected $table = 'universitas';

    protected $fillable = [
        'nama_universitas',
        'aktif',
    ];

    public function alumnis()
    {
        return $this->hasMany(Alumni::class, 'universitas_id');
    }
}