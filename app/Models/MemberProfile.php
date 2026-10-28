<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberProfile extends Model
{
    protected $table = 'member_profiles';

    protected $fillable = [
        'user_id',
        'member_id',
        'pekerjaan',
        'domisili',
        'alamat',
        'no_hp',
        'perusahaan',
        'instansi',
        'informasi_kosa',
    ];

    protected $casts = [
        'informasi_kosa' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}