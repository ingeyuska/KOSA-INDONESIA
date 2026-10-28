<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TracerOrganization;
use App\Models\TracerActivity;
use App\Models\TracerAchievement;
use App\Models\TracerExpertise;
use App\Models\DigitalAlumniCard;
// use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * ==========================================================
     * PROFILE ALUMNI
     * ==========================================================
     */

    public function index()
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        return view(
            'frontend.alumni.profile',
            compact('user', 'alumni')
        );
    }


    public function edit()
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        return view(
            'frontend.alumni.profile',
            compact('user', 'alumni')
        );
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni tidak ditemukan.'
            );
        }

        $data = $request->validate([

            'pekerjaan' => [
                'nullable',
                'string',
                'max:255'
            ],

            'institusi' => [
                'nullable',
                'string',
                'max:255'
            ],

            'domisili' => [
                'nullable',
                'string',
                'max:255'
            ],

            'nomor_hp' => [
                'nullable',
                'string',
                'max:30'
            ],

            'pendidikan' => [
                'nullable',
                'string',
                'max:255'
            ],

        ]);

        $alumni->update($data);

        return redirect()
            ->route('alumni.profile')
            ->with(
                'success',
                'Profil alumni berhasil diperbarui.'
            );
    }


/**
 * ==========================================================
 * TRACER ALUMNI
 * ==========================================================
 */

public function tracer()
{
    $user = Auth::user();

    $alumni = $user->alumni;

    if (!$alumni) {
        return redirect()
            ->route('alumni.profile')
            ->with(
                'error',
                'Data alumni tidak ditemukan.'
            );
    }

    // Ambil data organisasi
    $organizations = TracerOrganization::where(
        'alumni_id',
        $alumni->id
    )
        ->latest()
        ->get();

    // Ambil data kegiatan perkuliahan
    $activities = TracerActivity::where(
        'alumni_id',
        $alumni->id
    )
        ->latest()
        ->get();

    // Ambil data pencapaian
    $achievements = TracerAchievement::where(
        'alumni_id',
        $alumni->id
    )
        ->latest()
        ->get();

    // Ambil data expertise
    $expertises = TracerExpertise::where(
        'alumni_id',
        $alumni->id
    )
        ->latest()
        ->get();

    // Hitung progress tracer
    $progress = $this->calculateTracerProgress(
        $alumni,
        $organizations,
        $activities,
        $achievements,
        $expertises
    );

    return view(
        'frontend.tracer-alumni',
        compact(
            'user',
            'alumni',
            'organizations',
            'activities',
            'achievements',
            'expertises',
            'progress'
        )
    );
}


/**
 * ==========================================================
 * UPDATE TRACER UTAMA
 * ==========================================================
 */

public function updateTracer(Request $request)
{
  $user = auth()->user();

    $alumni = $user->alumni;

    if (!$alumni) {
        return back()->with('error', 'Data alumni tidak ditemukan.');
    }

    $validated = $request->validate([
        'email' => 'nullable|email',
        'nomor_hp' => 'nullable|string|max:30',
        'provinsi' => 'nullable|string|max:100',
        'kabupaten_kota' => 'nullable|string|max:100',
        'kecamatan' => 'nullable|string|max:100',
        'alamat_lengkap' => 'nullable|string',

        'status_pekerjaan' => 'nullable|string',
        'bidang_pekerjaan' => 'nullable|string|max:255',
        'perusahaan' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'level_jabatan' => 'nullable|string',
        'eselon' => 'nullable|string|max:100',
        'unit_kerja' => 'nullable|string|max:255',
        'status_kepegawaian' => 'nullable|string',
        'lokasi_pekerjaan' => 'nullable|string|max:255',
        'tahun_mulai' => 'nullable|integer',
        'pendidikan_terakhir' => 'nullable|string|max:100',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Update data alumni
    |--------------------------------------------------------------------------
    */

    $alumni->update([
        'nomor_hp' => $validated['nomor_hp'] ?? null,
        'provinsi' => $validated['provinsi'] ?? null,
        'kabupaten_kota' => $validated['kabupaten_kota'] ?? null,
        'kecamatan' => $validated['kecamatan'] ?? null,
        'alamat_lengkap' => $validated['alamat_lengkap'] ?? null,

        'status_pekerjaan' => $validated['status_pekerjaan'] ?? null,
        'bidang_pekerjaan' => $validated['bidang_pekerjaan'] ?? null,
        'perusahaan' => $validated['perusahaan'] ?? null,
        'jabatan' => $validated['jabatan'] ?? null,
        'level_jabatan' => $validated['level_jabatan'] ?? null,
        'eselon' => $validated['eselon'] ?? null,
        'unit_kerja' => $validated['unit_kerja'] ?? null,
        'status_kepegawaian' => $validated['status_kepegawaian'] ?? null,
        'lokasi_pekerjaan' => $validated['lokasi_pekerjaan'] ?? null,
        'tahun_mulai' => $validated['tahun_mulai'] ?? null,
        'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Update email user
    |--------------------------------------------------------------------------
    */

    if (!empty($validated['email'])) {
        $user->update([
            'email' => $validated['email'],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Tentukan step berikutnya
    |--------------------------------------------------------------------------
    */

    $nextStep = (int) $request->input('next_step', 1);

    return redirect()
        ->route('alumni.tracer')
        ->with('success', 'Data berhasil disimpan.')
        ->with('tracer_step', $nextStep);
}


/**
 * ==========================================================
 * TAMBAH PENGALAMAN ORGANISASI
 * ==========================================================
 */

public function storeOrganization(Request $request)
{
    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni tidak ditemukan.'
        );
    }

    $data = $request->validate([

        'nama_organisasi' => [
            'required',
            'string',
            'max:255'
        ],

        'jabatan' => [
            'nullable',
            'string',
            'max:255'
        ],

        'tingkat_organisasi' => [
            'nullable',
            'string',
            'max:255'
        ],

        'tahun_mulai' => [
            'nullable',
            'integer'
        ],

        'tahun_selesai' => [
            'nullable',
            'integer'
        ],

        'deskripsi' => [
            'nullable',
            'string'
        ],

    ]);

    $data['alumni_id'] = $alumni->id;

    TracerOrganization::create($data);

    $this->updateProgress($alumni);

    return back()->with(
        'success',
        'Pengalaman organisasi berhasil ditambahkan.'
    );
}


/**
 * ==========================================================
 * TAMBAH KEGIATAN PERKULIAHAN
 * ==========================================================
 */

public function storeActivity(Request $request)
{
    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni tidak ditemukan.'
        );
    }

    $data = $request->validate([

        'jenis_kegiatan' => [
            'required',
            'string',
            'max:255'
        ],

        'nama_kegiatan' => [
            'required',
            'string',
            'max:255'
        ],

        'peran' => [
            'nullable',
            'string',
            'max:255'
        ],

        'penyelenggara' => [
            'nullable',
            'string',
            'max:255'
        ],

        'tahun' => [
            'nullable',
            'integer'
        ],

        'deskripsi' => [
            'nullable',
            'string'
        ],

    ]);

    $data['alumni_id'] = $alumni->id;

    TracerActivity::create($data);

    $this->updateProgress($alumni);

    return back()->with(
        'success',
        'Pengalaman selama perkuliahan berhasil ditambahkan.'
    );
}


/**
 * ==========================================================
 * TAMBAH PENCAPAIAN PROFESIONAL
 * ==========================================================
 */

public function storeAchievement(Request $request)
{
    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni tidak ditemukan.'
        );
    }

    $data = $request->validate([

        'nama_pencapaian' => [
            'required',
            'string',
            'max:255'
        ],

        'jenis_pencapaian' => [
            'nullable',
            'string',
            'max:255'
        ],

        'bidang' => [
            'nullable',
            'string',
            'max:255'
        ],

        'penyelenggara' => [
            'nullable',
            'string',
            'max:255'
        ],

        'tahun' => [
            'nullable',
            'integer'
        ],

        'deskripsi' => [
            'nullable',
            'string'
        ],

    ]);

    $data['alumni_id'] = $alumni->id;

    TracerAchievement::create($data);

    $this->updateProgress($alumni);

    return back()->with(
        'success',
        'Pencapaian profesional berhasil ditambahkan.'
    );
}


/**
 * ==========================================================
 * TAMBAH EXPERTISE
 * ==========================================================
 */

public function storeExpertise(Request $request)
{
    $user = Auth::user();

    $alumni = $user->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni tidak ditemukan.'
        );
    }

    $data = $request->validate([
        'nama_expertise' => [
            'required',
            'string',
            'max:255'
        ],
    ]);

    // Cek expertise yang sama
    $sudahAda = TracerExpertise::where(
        'alumni_id',
        $alumni->id
    )
        ->where(
            'nama_expertise',
            $data['nama_expertise']
        )
        ->exists();

    if ($sudahAda) {
        return back()->with(
            'error',
            'Expertise tersebut sudah ditambahkan.'
        );
    }

    $data['alumni_id'] = $alumni->id;

    TracerExpertise::create($data);

    $this->updateProgress($alumni);

    return redirect()
        ->route('alumni.tracer')
        ->with(
            'success',
            'Expertise berhasil ditambahkan.'
        )
        ->with(
            'tracer_step',
            6
        );
}


/**
 * ==========================================================
 * SUBMIT TRACER
 * ==========================================================
 */

public function submitTracer()
{
    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni tidak ditemukan.'
        );
    }

    // Hitung progress terbaru
    $progress = $this->updateProgress($alumni);

    // Tidak boleh submit jika belum lengkap
    if ($progress < 100) {
        return back()->with(
            'error',
            'Tracer belum lengkap. Lengkapi Profile Diri, Pekerjaan, dan Pendidikan Terakhir terlebih dahulu.'
        );
    }

    DB::transaction(function () use ($alumni) {

        // Submit tracer
        $alumni->update([
            'tracer_progress' => 100,
            'tracer_status' => 'submitted',
            'tracer_submitted_at' => now(),
        ]);

        // Buat Digital Alumni Card
        DigitalAlumniCard::firstOrCreate(
            [
                'alumni_id' => $alumni->id,
            ],
            [
                'nomor_kartu' =>
                    'KOSA-' .
                    date('Y') .
                    '-' .
                    str_pad(
                        $alumni->id,
                        5,
                        '0',
                        STR_PAD_LEFT
                    ),

                'tanggal_terbit' => now(),

                'status' => 'active',
            ]
        );
    });

    return redirect()
        ->route('alumni.tracer')
        ->with(
            'success',
            'Tracer berhasil disubmit. Digital Alumni Card berhasil dibuat.'
        );
}


/**
 * ==========================================================
 * HITUNG PROGRESS TRACER
 * ==========================================================
 *
 * BAGIAN WAJIB:
 *
 * 1. Profile Diri
 * 2. Pekerjaan
 * 3. Pendidikan Terakhir
 *
 * BAGIAN OPSIONAL:
 *
 * 4. Organisasi
 * 5. Kegiatan Perkuliahan
 * 6. Pencapaian
 * 7. Expertise
 *
 */

private function calculateTracerProgress(
    $alumni,
    $organizations,
    $activities,
    $achievements,
    $expertises
) {
    $total = 3;
    $filled = 0;

    /*
    |--------------------------------------------------------------------------
    | 1. PROFILE DIRI
    |--------------------------------------------------------------------------
    */

    if (
        !empty($alumni->nomor_hp) &&
        !empty($alumni->alamat_lengkap) &&
        !empty($alumni->provinsi) &&
        !empty($alumni->kabupaten_kota) &&
        !empty($alumni->kecamatan)
    ) {
        $filled++;
    }

    /*
    |--------------------------------------------------------------------------
    | 2. PEKERJAAN
    |--------------------------------------------------------------------------
    */

    if (!empty($alumni->status_pekerjaan)) {
        $filled++;
    }

    /*
    |--------------------------------------------------------------------------
    | 3. PENDIDIKAN TERAKHIR
    |--------------------------------------------------------------------------
    */

    if (!empty($alumni->pendidikan_terakhir)) {
        $filled++;
    }

    /*
    |--------------------------------------------------------------------------
    | DATA OPSIONAL
    |--------------------------------------------------------------------------
    |
    | Organisasi
    | Kegiatan Perkuliahan
    | Pencapaian
    | Expertise
    |
    | Tidak mempengaruhi progress.
    |--------------------------------------------------------------------------
    */

    return (int) (($filled / $total) * 100);
}


/**
 * ==========================================================
 * UPDATE PROGRESS
 * ==========================================================
 */

private function updateProgress($alumni)
{
    $organizations = $alumni->tracerOrganizations;

    $activities = $alumni->tracerActivities;

    $achievements = $alumni->tracerAchievements;

    $expertises = $alumni->tracerExpertises;

    $progress = $this->calculateTracerProgress(
        $alumni,
        $organizations,
        $activities,
        $achievements,
        $expertises
    );

    $alumni->update([
        'tracer_progress' => $progress
    ]);

    return $progress;
}

}