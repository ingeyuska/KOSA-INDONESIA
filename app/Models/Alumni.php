<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\Universitas;
use App\Models\Achievement;
use App\Models\TracerOrganization;
use App\Models\TracerActivity;
use App\Models\TracerAchievement;
use App\Models\TracerExpertise;
use App\Models\KartuAlumni;

class Alumni extends Model
{
    protected $table = 'alumnis';

    protected $fillable = [

        'user_id',
        'alumni_id',

        // =====================================================
        // DATA DASAR
        // =====================================================

        'nama',
        'email',
        'foto',
        'angkatan',
        'jurusan',
        'fakultas',

        // =====================================================
        // DATA KOICA
        // =====================================================

        'program',
        'jenis_program',
        'judul_program',
        'universitas_id',
        'tahun_masuk',
        'tahun_lulus',
        'jenjang',
        'gelar',
        'kategori',
        'tahun_penyelenggaraan',
        'klasifikasi_program',

        // =====================================================
        // DATA LAIN
        // =====================================================

        'jenis_kelamin',
        'jenis_keilmuan',
        'pekerjaan',
        'institusi',
        'alamat_kantor',
        'telepon_kantor',
        'nomor_hp',
        'pendidikan',
        'domisili',
        'status',

        // =====================================================
        // TRACER - PROFILE DIRI
        // =====================================================

        'alamat_lengkap',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',

        // =====================================================
        // TRACER - KONTAK PROFESIONAL
        // =====================================================

        'linkedin',
        'website',

        // =====================================================
        // TRACER - PEKERJAAN
        // =====================================================

        'status_pekerjaan',
        'bidang_pekerjaan',
        'perusahaan',
        'jabatan',
        'level_jabatan',
        'eselon',
        'unit_kerja',
        'status_kepegawaian',
        'lokasi_pekerjaan',
        'tahun_mulai',
        'pendidikan_terakhir',

        // =====================================================
        // TRACER - STATUS
        // =====================================================

        'tracer_progress',
        'tracer_status',
        'tracer_submitted_at',

        // =====================================================
        // CONSENT & KONTRIBUSI ALUMNI
        // =====================================================

        'bersedia_mentor',
        'bersedia_narasumber',
        'bersedia_expert',
        'bersedia_kolaborasi_sosial',
        'bersedia_dihubungi',
        'topik_mentoring',
        'tag_expertise',
        'jenis_kolaborasi',
        'area_kontribusi',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'tahun_masuk' => 'integer',
            'tahun_lulus' => 'integer',
            'tahun_penyelenggaraan' => 'integer',
            'tahun_mulai' => 'integer',

            'tracer_progress' => 'integer',
            'tracer_submitted_at' => 'datetime',

            // =====================================================
            // CONSENT
            // =====================================================

            'bersedia_mentor' => 'boolean',
            'bersedia_narasumber' => 'boolean',
            'bersedia_expert' => 'boolean',
            'bersedia_kolaborasi_sosial' => 'boolean',
            'bersedia_dihubungi' => 'boolean',

            // =====================================================
            // NETWORKING
            // =====================================================

            'tag_expertise' => 'array',
            'jenis_kolaborasi' => 'array',
            'area_kontribusi' => 'array',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UNIVERSITAS
    |--------------------------------------------------------------------------
    */

    public function universitas(): BelongsTo
    {
        return $this->belongsTo(
            Universitas::class,
            'universitas_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACHIEVEMENT LAMA
    |--------------------------------------------------------------------------
    */

    public function achievements(): HasMany
    {
        return $this->hasMany(
            Achievement::class,
            'alumni_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TRACER ORGANISASI
    |--------------------------------------------------------------------------
    */

    public function tracerOrganizations(): HasMany
    {
        return $this->hasMany(
            TracerOrganization::class,
            'alumni_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TRACER KEGIATAN PERKULIAHAN
    |--------------------------------------------------------------------------
    */

    public function tracerActivities(): HasMany
    {
        return $this->hasMany(
            TracerActivity::class,
            'alumni_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TRACER ACHIEVEMENT
    |--------------------------------------------------------------------------
    */

    public function tracerAchievements(): HasMany
    {
        return $this->hasMany(
            TracerAchievement::class,
            'alumni_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TRACER EXPERTISE
    |--------------------------------------------------------------------------
    */

    public function tracerExpertises(): HasMany
    {
        return $this->hasMany(
            TracerExpertise::class,
            'alumni_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KARTU ALUMNI DIGITAL
    |--------------------------------------------------------------------------
    */

    public function kartuAlumni(): HasOne
    {
        return $this->hasOne(
            KartuAlumni::class,
            'alumni_id'
        );
    }
}