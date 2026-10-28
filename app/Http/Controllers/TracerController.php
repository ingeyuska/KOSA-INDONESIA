<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KartuAlumni;
use Carbon\Carbon;
use App\Models\Alumni;
use App\Models\TracerOrganization;
use App\Models\TracerActivity;
use App\Models\TracerAchievement;
use App\Models\TracerExpertise;

class TracerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - DAFTAR TRACER ALUMNI
    |--------------------------------------------------------------------------
    */

    public function indexAdmin(Request $request)
    {
        $query = Alumni::with('user');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('status_pekerjaan', 'like', "%{$search}%")
                    ->orWhere('bidang_pekerjaan', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('lokasi_pekerjaan', 'like', "%{$search}%");

                $q->orWhereHas('user', function ($userQuery) use ($search) {

                    $userQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");

                });
            });
        }

        $alumnis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'backend.v_tracer.index',
            compact('alumnis')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - DETAIL TRACER
    |--------------------------------------------------------------------------
    */

    public function show(Alumni $alumni)
    {
        $alumni->load([
            'user',
        ]);

        $organizations = TracerOrganization::where(
            'alumni_id',
            $alumni->id
        )->get();

        $activities = TracerActivity::where(
            'alumni_id',
            $alumni->id
        )->get();

        $achievements = TracerAchievement::where(
            'alumni_id',
            $alumni->id
        )->get();

        $expertises = TracerExpertise::where(
            'alumni_id',
            $alumni->id
        )->get();

        return view(
            'backend.v_tracer.show',
            compact(
                'alumni',
                'organizations',
                'activities',
                'achievements',
                'expertises'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FRONTEND ALUMNI - HALAMAN TRACER
    |--------------------------------------------------------------------------
    */

   public function index(Request $request)
{
    $user = Auth::user();

    $alumni = $user->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni belum ditemukan.'
        );
    }

    $organizations = TracerOrganization::where(
        'alumni_id',
        $alumni->id
    )->get();

    $activities = TracerActivity::where(
        'alumni_id',
        $alumni->id
    )->get();

    $achievements = TracerAchievement::where(
        'alumni_id',
        $alumni->id
    )->get();

    $expertises = TracerExpertise::where(
        'alumni_id',
        $alumni->id
    )->get();

    $progress = $this->calculateProgress($alumni);

    // STEP AKTIF
    $step = (int) $request->get('step', 1);

    if ($step < 1 || $step > 4) {
        $step = 1;
    }

    return view(
        'frontend.tracer-alumni',
        compact(
            'alumni',
            'organizations',
            'activities',
            'achievements',
            'expertises',
            'progress',
            'step'
        )
    );
}


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE + PEKERJAAN
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $data = $request->validate([

            /*
            |--------------------------------------------------------------
            | PROFILE DIRI
            |--------------------------------------------------------------
            */

            'nomor_hp' => 'required|string|max:20',

            'alamat_lengkap' => 'required|string',

            'provinsi' => 'required|string|max:100',

            'kabupaten_kota' => 'required|string|max:100',

            'kecamatan' => 'required|string|max:100',


            /*
            |--------------------------------------------------------------
            | PEKERJAAN
            |--------------------------------------------------------------
            */

            'status_pekerjaan' => 'required|string|max:100',

            'bidang_pekerjaan' => 'required|string|max:255',

            'perusahaan' => 'required|string|max:255',

            'jabatan' => 'required|string|max:255',

            'level_jabatan' => 'required|string|max:100',

            'eselon' => 'nullable|string|max:100',

            'unit_kerja' => 'nullable|string|max:255',

            'status_kepegawaian' => 'required|string|max:100',

            'lokasi_pekerjaan' => 'required|string|max:255',

            'tahun_mulai' => 'required|integer',

            'pendidikan_terakhir' => 'required|string|max:100',

        ]);

       $alumni->update($data);

$progress = $this->calculateProgress($alumni);

$alumni->update([
    'tracer_progress' => $progress,
]);

return redirect()
    ->route('alumni.tracer')
    ->with('success', 'Data tracer berhasil disimpan.')
    ->with('tracer_step', 3);
}


    /*
    |--------------------------------------------------------------------------
    | ORGANISASI
    |--------------------------------------------------------------------------
    */

    public function organizationStore(Request $request)
    {
        $alumni = Auth::user()->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $validated = $request->validate([

            'nama_organisasi' => 'required|string|max:255',

            'jabatan' => 'nullable|string|max:255',

            'tingkat_organisasi' => 'nullable|string|max:100',

            'tahun_mulai' => 'nullable|integer',

            'tahun_selesai' => 'nullable|integer',

            'deskripsi' => 'nullable|string',

        ]);

        $validated['alumni_id'] = $alumni->id;

        TracerOrganization::create($validated);

        /*
        | Update progress
        */

        $this->updateProgress($alumni);

        return back()->with(
            'success',
            'Pengalaman organisasi berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KEGIATAN SELAMA PERKULIAHAN
    |--------------------------------------------------------------------------
    */

    public function activityStore(Request $request)
    {
        $alumni = Auth::user()->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $validated = $request->validate([

            'jenis_kegiatan' => 'required|string|max:100',

            'nama_kegiatan' => 'required|string|max:255',

            'peran' => 'nullable|string|max:255',

            'penyelenggara' => 'nullable|string|max:255',

            'tahun' => 'nullable|integer',

            'deskripsi' => 'nullable|string',

            'bukti' => 'nullable|string|max:255',

        ]);

        $validated['alumni_id'] = $alumni->id;

        TracerActivity::create($validated);

        /*
        | Update progress
        */

        $this->updateProgress($alumni);

        return back()->with(
            'success',
            'Pengalaman selama perkuliahan berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PENCAPAIAN / ACHIEVEMENT
    |--------------------------------------------------------------------------
    */

    public function achievementStore(Request $request)
    {
        $alumni = Auth::user()->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $validated = $request->validate([

            'nama_pencapaian' => 'required|string|max:255',

            'jenis_pencapaian' => 'nullable|string|max:100',

            'bidang' => 'nullable|string|max:255',

            'penyelenggara' => 'nullable|string|max:255',

            'tahun' => 'nullable|integer',

            'deskripsi' => 'nullable|string',

            'bukti' => 'nullable|string|max:255',

            'link_publikasi' => 'nullable|string|max:255',

        ]);

        $validated['alumni_id'] = $alumni->id;

        TracerAchievement::create($validated);

        /*
        | Update progress
        */

        $this->updateProgress($alumni);

        return back()->with(
            'success',
            'Pencapaian berhasil ditambahkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPERTISE
    |--------------------------------------------------------------------------
    */

    public function expertiseStore(Request $request)
    {
        $alumni = Auth::user()->alumni;

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $validated = $request->validate([

            'nama_expertise' => 'required|string|max:255',

        ]);

        $validated['alumni_id'] = $alumni->id;

        /*
        | Cegah expertise duplikat
        */

        $exists = TracerExpertise::where(
            'alumni_id',
            $alumni->id
        )
        ->where(
            'nama_expertise',
            $validated['nama_expertise']
        )
        ->exists();

        if ($exists) {

            return back()->with(
                'error',
                'Expertise tersebut sudah ditambahkan.'
            );
        }

        TracerExpertise::create($validated);

        /*
        | Update progress
        */

        $this->updateProgress($alumni);

        return back()->with(
            'success',
            'Expertise berhasil ditambahkan.'
        );
    }


  /*
|--------------------------------------------------------------------------
| SUBMIT TRACER
|--------------------------------------------------------------------------
*/

public function submit(Request $request)
{
    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return back()->with(
            'error',
            'Data alumni belum ditemukan.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG PROGRESS
    |--------------------------------------------------------------------------
    */

    $progress = $this->calculateProgress($alumni);

    /*
    |--------------------------------------------------------------------------
    | TRACER HARUS 100%
    |--------------------------------------------------------------------------
    */

    if ($progress < 100) {
        return back()
            ->with('error', 'Lengkapi seluruh data tracer terlebih dahulu.')
            ->with('tracer_step', 4);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT TRACER
    |--------------------------------------------------------------------------
    */

    $alumni->update([
        'tracer_progress' => 100,
        'tracer_status' => 'submitted',
        'tracer_submitted_at' => now(),
    ]);

    /*
    |--------------------------------------------------------------------------
    | ID ANGGOTA
    |--------------------------------------------------------------------------
    */

    $memberId = $alumni->alumni_id;

    if (!$memberId) {
        return back()->with(
            'error',
            'ID anggota belum tersedia.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | NOMOR KARTU
    |--------------------------------------------------------------------------
    */

    $nomorKartu = 'KOSA-' . $memberId;

    /*
    |--------------------------------------------------------------------------
    | MASA BERLAKU 1 TAHUN
    |--------------------------------------------------------------------------
    */

    $tanggalTerbit = Carbon::today();

    $tanggalBerlakuSampai = Carbon::today()->addYear();

    /*
    |--------------------------------------------------------------------------
    | BUAT / PERPANJANG KARTU
    |--------------------------------------------------------------------------
    */

    KartuAlumni::updateOrCreate(
        [
            'alumni_id' => $alumni->id,
        ],
        [
            'nomor_kartu' => $nomorKartu,
            'tanggal_terbit' => $tanggalTerbit,
            'tanggal_berlaku_sampai' => $tanggalBerlakuSampai,
            'status' => 'aktif',
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | SELESAI
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('alumni.tracer')
        ->with(
            'success',
            'Tracer berhasil disimpan. Kartu Alumni aktif sampai ' .
            $tanggalBerlakuSampai->format('d-m-Y') . '.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | HITUNG PROGRESS
    |--------------------------------------------------------------------------
    */
private function calculateProgress($alumni)
{
    /*
    |--------------------------------------------------------------------------
    | PROFIL DIRI
    |--------------------------------------------------------------------------
    */

    $profileFields = [
        'nomor_hp',
        'alamat_lengkap',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
    ];


    /*
    |--------------------------------------------------------------------------
    | PEKERJAAN
    |--------------------------------------------------------------------------
    */

    $jobFields = [
        'status_pekerjaan',
        'bidang_pekerjaan',
        'perusahaan',
        'jabatan',
        'level_jabatan',
        'status_kepegawaian',
        'lokasi_pekerjaan',
        'tahun_mulai',
        'pendidikan_terakhir',
    ];


    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL
    |--------------------------------------------------------------------------
    */

    $total = count($profileFields) + count($jobFields);

    $filled = 0;


    /*
    |--------------------------------------------------------------------------
    | HITUNG PROFIL
    |--------------------------------------------------------------------------
    */

    foreach ($profileFields as $field) {

        if (!empty($alumni->{$field})) {
            $filled++;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG PEKERJAAN
    |--------------------------------------------------------------------------
    */

    foreach ($jobFields as $field) {

        if (!empty($alumni->{$field})) {
            $filled++;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | PENGALAMAN
    |--------------------------------------------------------------------------
    | OPSIONAL:
    | - Organisasi
    | - Kegiatan
    | - Pencapaian
    |
    | Tidak dimasukkan ke progress.
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | EXPERTISE
    |--------------------------------------------------------------------------
    | WAJIB
    |--------------------------------------------------------------------------
    */

    $expertises = TracerExpertise::where(
        'alumni_id',
        $alumni->id
    )->exists();

    $total += 1;

    if ($expertises) {
        $filled++;
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG PERSENTASE
    |--------------------------------------------------------------------------
    */

    return $total > 0
        ? round(($filled / $total) * 100)
        : 0;
}

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROGRESS
    |--------------------------------------------------------------------------
    */

    private function updateProgress($alumni)
    {
        $progress = $this->calculateProgress($alumni);

        $alumni->update([
            'tracer_progress' => $progress,
        ]);

        return $progress;
    }
    public function indexManajemen()
{
    $alumni = \App\Models\Alumni::with('user')
        ->latest()
        ->get();

return view('backend.v_manajemen.tracer.index', compact('alumni'));
}

}