<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TracerAchievement extends Model
{
    protected $table = 'tracer_achievements';

    protected $fillable = [
        'alumni_id',
        'nama_pencapaian',
        'jenis_pencapaian',
        'bidang',
        'penyelenggara',
        'tahun',
        'deskripsi',
        'bukti',
        'link_publikasi',
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