<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TracerOrganization extends Model
{
    protected $table = 'tracer_organizations';

    protected $fillable = [
        'alumni_id',
        'nama_organisasi',
        'jabatan',
        'tingkat_organisasi',
        'tahun_mulai',
        'tahun_selesai',
        'deskripsi',
    ];

    protected $casts = [
        'tahun_mulai' => 'integer',
        'tahun_selesai' => 'integer',
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(
            Alumni::class,
            'alumni_id'
        );
    }
}