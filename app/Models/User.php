<?php

namespace App\Models;

use App\Models\Alumni;
use App\Models\MemberProfile;
use App\Models\MemberVerification;
use App\Models\Pendaftaran;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'member_id',
        'status',
        'foto',
        'no_hp',
        'bio',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    public function alumni(): HasOne
    {
        return $this->hasOne(Alumni::class, 'user_id');
    }

    public function memberProfile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function memberVerification()
    {
        return $this->hasOne(MemberVerification::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }
}