<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftarans';

    protected $fillable = [
        'event_id',
        'user_id',
        'nama_lengkap',
        'email',
        'no_whatsapp',
        'instansi',
        'keterangan',
        'hadir',
        'sertifikat_nomor',
        'sertifikat_diterbitkan_at',
    ];

    protected $casts = [
        'hadir' => 'boolean',
        'sertifikat_diterbitkan_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}