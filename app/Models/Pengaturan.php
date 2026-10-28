<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = [
        'nama_kosa',
        'logo',
        'favicon',
        'deskripsi',
        'telepon',
        'whatsapp',
        'email',
        'alamat',
        'instagram',
        'facebook',
        'youtube',
        'linkedin',
        'pesan_ketua',
        'visi',
        'misi',
        'deskripsi_footer',
        'copyright',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}