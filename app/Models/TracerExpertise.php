<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TracerExpertise extends Model
{
    protected $table = 'tracer_expertises';

    protected $fillable = [
        'alumni_id',
        'nama_expertise',
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(
            Alumni::class,
            'alumni_id'
        );
    }
}