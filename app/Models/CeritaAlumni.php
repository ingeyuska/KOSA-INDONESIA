<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CeritaAlumni extends Model
{
    protected $table = 'cerita_alumni';

    protected $fillable = [
        'alumni_id',
        'foto',
        'cerita',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}