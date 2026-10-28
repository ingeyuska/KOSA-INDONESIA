<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'tahun_program',
        'nama_program',
        'jenis',
        'jenjang',
        'deskripsi',
    ];

    // Satu program memiliki banyak alumni
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'program_id');
    }
}