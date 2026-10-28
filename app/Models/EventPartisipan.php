<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $table = 'event_participant';

    protected $fillable = [
        'event_id',
        'alumni_id',
        'status',
        'tgl_daftar',
    ];

    protected $casts = [
        'tgl_daftar' => 'datetime',
    ];

    // Peserta terhubung ke satu event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Peserta terhubung ke satu alumni
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}