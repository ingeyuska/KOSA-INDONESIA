<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'tanggal',
        'waktu',
        'lokasi',
        'foto',
        'materi',
        'galeri',
        'status',
        'pendaftaran_aktif',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'galeri' => 'array',
        'pendaftaran_aktif' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | STATUS OTOMATIS
    |--------------------------------------------------------------------------
    */

    public function getStatusOtomatisAttribute()
    {
        if (!$this->tanggal) {
            return 'akan_datang';
        }

        if ($this->tanggal->lt(Carbon::today())) {
            return 'selesai';
        }

        return 'akan_datang';
    }


    /*
    |--------------------------------------------------------------------------
    | CEK EVENT SUDAH SELESAI
    |--------------------------------------------------------------------------
    */

    public function getIsSelesaiAttribute()
    {
        if (!$this->tanggal) {
            return false;
        }

        return $this->tanggal->lt(Carbon::today());
    }


    /*
    |--------------------------------------------------------------------------
    | CEK EVENT AKAN DATANG
    |--------------------------------------------------------------------------
    */

    public function getIsAkanDatangAttribute()
    {
        if (!$this->tanggal) {
            return true;
        }

        return $this->tanggal->gte(Carbon::today());
    }


    public function testimonis(): HasMany
    {
        return $this->hasMany(Testimoni::class);
    }
      protected static function boot()
{
    parent::boot();

    static::creating(function ($event) {
        $event->slug = Str::slug($event->judul);
    });

    static::updating(function ($event) {
        if ($event->isDirty('judul')) {
            $event->slug = Str::slug($event->judul);
        }
    });
}
}