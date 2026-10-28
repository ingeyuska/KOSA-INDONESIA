<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TracerActivity extends Model
{
    protected $table = 'tracer_activities';

    protected $fillable = [
        'alumni_id',
        'jenis_kegiatan',
        'nama_kegiatan',
        'peran',
        'penyelenggara',
        'tahun',
        'deskripsi',
        'bukti',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(
            Alumni::class,
            'alumni_id'
        );
    }
}