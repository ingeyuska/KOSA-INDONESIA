<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'visit_date',
        'visited_at',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visited_at' => 'datetime',
    ];
}