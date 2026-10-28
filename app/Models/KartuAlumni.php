<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuAlumni extends Model
{
    protected $table = 'kartu_alumnis';

    protected $fillable = [
        'alumni_id',
        'nomor_kartu',
        'tanggal_terbit',
        'tanggal_berlaku_sampai',
        'status',
        'file_kartu',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
            'tanggal_berlaku_sampai' => 'date',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE ALUMNI
    |--------------------------------------------------------------------------
    */

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(
            Alumni::class,
            'alumni_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CEK KARTU MASIH BERLAKU
    |--------------------------------------------------------------------------
    */

    public function isAktif(): bool
    {
        return $this->status === 'aktif'
            && $this->tanggal_berlaku_sampai
            && !$this->tanggal_berlaku_sampai->isPast();
    }
}