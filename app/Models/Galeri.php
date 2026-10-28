<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
    'judul',
    'slug',
    'deskripsi',
    'tanggal',
    'status',
];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function foto(): HasMany
    {
        return $this->hasMany(GaleriFoto::class, 'galeri_id');
    }
}