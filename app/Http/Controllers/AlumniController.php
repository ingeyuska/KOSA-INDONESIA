<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Alumni;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\KartuAlumni;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $alumni = Alumni::with('user')
            ->latest()
            ->get();

        return view(
            'backend.v_alumni.index',
            compact('alumni')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('backend.v_alumni.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:alumnis,email'
            ],

            'angkatan' =>
                'nullable|string|max:20',

            'jurusan' =>
                'nullable|string|max:255',

            'fakultas' =>
                'nullable|string|max:255',

            'program' =>
                'nullable|string|max:255',

            'klasifikasi_program' => [
                'nullable',
                'in:Short Course,Master,PhD'
            ],

            'jenis_kelamin' => [
                'nullable',
                'in:Laki-laki,Perempuan'
            ],

            'jenis_keilmuan' => [
                'nullable',
                'in:Social Science,STEM'
            ],

            'pekerjaan' =>
                'nullable|string|max:255',

            'institusi' =>
                'nullable|string|max:255',

            'alamat_kantor' =>
                'nullable|string',

            'telepon_kantor' =>
                'nullable|string|max:30',

            'no_hp' =>
                'nullable|string|max:30',

            'pendidikan' =>
                'nullable|string|max:255',

            'domisili' =>
                'nullable|string|max:255',

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);

        DB::transaction(function () use ($request, $data) {

            $alumniData = [

                'user_id' =>
                    null,

                'nama' =>
                    $data['nama'],

                'email' =>
                    strtolower(trim($data['email'])),

                'angkatan' =>
                    $data['angkatan'] ?? null,

                'jurusan' =>
                    $data['jurusan'] ?? null,

                'fakultas' =>
                    $data['fakultas'] ?? null,

                'program' =>
                    $data['program'] ?? null,

                'klasifikasi_program' =>
                    $data['klasifikasi_program'] ?? null,

                'jenis_kelamin' =>
                    $data['jenis_kelamin'] ?? null,

                'jenis_keilmuan' =>
                    $data['jenis_keilmuan'] ?? null,

                'pekerjaan' =>
                    $data['pekerjaan'] ?? null,

                'institusi' =>
                    $data['institusi'] ?? null,

                'alamat_kantor' =>
                    $data['alamat_kantor'] ?? null,

                'telepon_kantor' =>
                    $data['telepon_kantor'] ?? null,

                'nomor_hp' =>
                    $data['no_hp'] ?? null,

                'pendidikan' =>
                    $data['pendidikan'] ?? null,

                'domisili' =>
                    $data['domisili'] ?? null,

                /*
                | Alumni existing belum memiliki akun.
                | Tetap dicatat sebagai alumni.
                */
                'status' =>
                    'tidak_aktif',
            ];

            /*
            |--------------------------------------------------------------------------
            | FOTO
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('foto')) {

                $alumniData['foto'] =
                    $request
                        ->file('foto')
                        ->store('alumni', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | SIMPAN
            |--------------------------------------------------------------------------
            */

            Alumni::create($alumniData);
        });

        return redirect()
            ->route('admin.alumni.index')
            ->with(
                'success',
                'Data alumni existing berhasil ditambahkan. Status awal: Tidak Aktif.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Alumni $alumni)
    {
        $alumni->load('user');

        return view(
            'backend.v_alumni.edit',
            compact('alumni')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Alumni $alumni
    ) {

        $data = $request->validate([

            'nama' =>
                'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' .
                $alumni->user_id
            ],

            'password' =>
                'nullable|string|min:6',

            'angkatan' =>
                'nullable|string|max:20',

            'jurusan' =>
                'nullable|string|max:255',

            'fakultas' =>
                'nullable|string|max:255',

            'program' =>
                'nullable|string|max:255',

            'klasifikasi_program' => [
                'nullable',
                'in:Short Course,Master,PhD'
            ],

            'jenis_kelamin' => [
                'nullable',
                'in:Laki-laki,Perempuan'
            ],

            'jenis_keilmuan' => [
                'nullable',
                'in:Social Science,STEM'
            ],

            'pekerjaan' =>
                'nullable|string|max:255',

            'institusi' =>
                'nullable|string|max:255',

            'alamat_kantor' =>
                'nullable|string',

            'telepon_kantor' =>
                'nullable|string|max:30',

            'no_hp' =>
                'nullable|string|max:30',

            'pendidikan' =>
                'nullable|string|max:255',

            'domisili' =>
                'nullable|string|max:255',

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'status' => [
                'required',
                'in:aktif,tidak_aktif'
            ],
        ]);


        DB::transaction(function () use (
            $request,
            $alumni,
            $data
        ) {

            /*
            |--------------------------------------------------------------------------
            | UPDATE USER
            |--------------------------------------------------------------------------
            */

            $user = $alumni->user;

            if ($user) {

                $user->nama =
                    $data['nama'];

                $user->email =
                    $data['email'];

                if (!empty($data['password'])) {

                    $user->password =
                        Hash::make(
                            $data['password']
                        );
                }

                $user->save();
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE ALUMNI
            |--------------------------------------------------------------------------
            */

            $alumniData = [

                'nama' =>
                    $data['nama'],

                'email' =>
                    $data['email'],

                'angkatan' =>
                    $data['angkatan'] ?? null,

                'jurusan' =>
                    $data['jurusan'] ?? null,

                'fakultas' =>
                    $data['fakultas'] ?? null,

                'program' =>
                    $data['program'] ?? null,

                'klasifikasi_program' =>
                    $data['klasifikasi_program'] ?? null,

                'jenis_kelamin' =>
                    $data['jenis_kelamin'] ?? null,

                'jenis_keilmuan' =>
                    $data['jenis_keilmuan'] ?? null,

                'pekerjaan' =>
                    $data['pekerjaan'] ?? null,

                'institusi' =>
                    $data['institusi'] ?? null,

                'alamat_kantor' =>
                    $data['alamat_kantor'] ?? null,

                'telepon_kantor' =>
                    $data['telepon_kantor'] ?? null,

                'nomor_hp' =>
                    $data['no_hp'] ?? null,

                'pendidikan' =>
                    $data['pendidikan'] ?? null,

                'domisili' =>
                    $data['domisili'] ?? null,

                'status' =>
                    $data['status'],
            ];


            /*
            |--------------------------------------------------------------------------
            | FOTO BARU
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('foto')) {

                if ($alumni->foto) {

                    Storage::disk('public')
                        ->delete($alumni->foto);
                }

                $alumniData['foto'] =
                    $request
                        ->file('foto')
                        ->store('alumni', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            $alumni->update($alumniData);
        });


        return redirect()
            ->route('admin.alumni.index')
            ->with(
                'success',
                'Data alumni berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Alumni $alumni)
    {
        DB::transaction(function () use ($alumni) {

            if ($alumni->foto) {

                Storage::disk('public')
                    ->delete($alumni->foto);
            }

            $user = $alumni->user;

            $alumni->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.alumni.index')
            ->with(
                'success',
                'Data alumni berhasil dihapus.'
            );
    }


/*
|--------------------------------------------------------------------------
| STATISTIK ALUMNI FRONTEND
|--------------------------------------------------------------------------
*/

public function statistikFrontend()
{
    /*
    |--------------------------------------------------------------------------
    | TOTAL ALUMNI
    |--------------------------------------------------------------------------
    | Semua data pada tabel alumnis dihitung sebagai alumni.
    | Tidak dibatasi status aktif / tidak aktif.
    */

    $totalAlumni = Alumni::count();


    /*
    |--------------------------------------------------------------------------
    | STATUS ALUMNI
    |--------------------------------------------------------------------------
    */

    $alumniAktif = Alumni::where(
        'status',
        'aktif'
    )->count();

    $alumniTidakAktif = Alumni::where(
        'status',
        'tidak_aktif'
    )->count();


    /*
    |--------------------------------------------------------------------------
    | PROGRAM
    |--------------------------------------------------------------------------
    | - Alumni Terdaftar
    | - Program Degree
    | - Program Short Course
    */

    $totalDegree = Alumni::where(
        'program',
        'Degree'
    )->count();

    $totalShortCourse = Alumni::where(
        'program',
        'Short Course'
    )->count();


    /*
    |--------------------------------------------------------------------------
    | JENIS KELAMIN
    |--------------------------------------------------------------------------
    | Hanya data gender yang benar-benar terisi.
    | Data kosong tetap termasuk dalam totalAlumni.
    */

    $berdasarkanGender = Alumni::select(
        'jenis_kelamin',
        DB::raw('COUNT(*) as total')
    )
        ->whereNotNull('jenis_kelamin')
        ->where('jenis_kelamin', '!=', '')
        ->groupBy('jenis_kelamin')
        ->orderByDesc('total')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | KLASIFIKASI PROGRAM
    |--------------------------------------------------------------------------
    | Mengambil seluruh klasifikasi yang tersedia
    | pada database alumni.
    */

    $berdasarkanKlasifikasi = Alumni::select(
        'klasifikasi_program',
        DB::raw('COUNT(*) as total')
    )
        ->whereNotNull('klasifikasi_program')
        ->where('klasifikasi_program', '!=', '')
        ->groupBy('klasifikasi_program')
        ->orderByDesc('total')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | UNIVERSITAS / INSTITUSI
    |--------------------------------------------------------------------------
    | PENTING:
    |
    | Statistik universitas hanya mengambil ALUMNI DEGREE.
    |
    | Short Course tidak ikut dihitung karena tidak menggunakan
    | universitas sebagai dasar statistik ini.
    |
    | Contoh:
    | Universitas A = 50 alumni
    | Total Degree  = 299
    |
    | Persentase = 50 / 299 x 100
    |--------------------------------------------------------------------------
    */

    $berdasarkanUniversitas = Alumni::select(
        'institusi',
        DB::raw('COUNT(*) as total')
    )
        ->where('program', 'Degree')
        ->whereNotNull('institusi')
        ->where('institusi', '!=', '')
        ->groupBy('institusi')
        ->orderByDesc('total')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | JENIS KEILMUAN
    |--------------------------------------------------------------------------
    | Contoh:
    | - Social Science
    | - STEM
    */

    $berdasarkanKeilmuan = Alumni::select(
        'jenis_keilmuan',
        DB::raw('COUNT(*) as total')
    )
        ->whereNotNull('jenis_keilmuan')
        ->where('jenis_keilmuan', '!=', '')
        ->groupBy('jenis_keilmuan')
        ->orderByDesc('total')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | FAKULTAS
    |--------------------------------------------------------------------------
    */

    $berdasarkanFakultas = Alumni::select(
        'fakultas',
        DB::raw('COUNT(*) as total')
    )
        ->whereNotNull('fakultas')
        ->where('fakultas', '!=', '')
        ->groupBy('fakultas')
        ->orderByDesc('total')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | KIRIM DATA KE VIEW
    |--------------------------------------------------------------------------
    */

    return view(
        'frontend.statistik',
        compact(
            'totalAlumni',
            'alumniAktif',
            'alumniTidakAktif',
            'totalDegree',
            'totalShortCourse',
            'berdasarkanGender',
            'berdasarkanKlasifikasi',
            'berdasarkanUniversitas',
            'berdasarkanKeilmuan',
            'berdasarkanFakultas'
        )
    );
}

  /*
|--------------------------------------------------------------------------
| CARI ALUMNI FRONTEND
|--------------------------------------------------------------------------
|
| Route:
| /alumni/cari?search=...
|
*/

public function cariFrontend(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | AMBIL KATA PENCARIAN
    |--------------------------------------------------------------------------
    */

    $search = trim(
        $request->input('search', '')
    );


    /*
    |--------------------------------------------------------------------------
    | QUERY ALUMNI
    |--------------------------------------------------------------------------
    |
    | Tidak memakai where status = aktif.
    |
    | Semua data alumni yang tercatat tetap
    | dapat muncul dalam pencarian.
    |
    */

    $alumni = Alumni::query()
        ->with('user')

        ->when(
            $search !== '',
            function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $keyword = '%' . $search . '%';

                    $q->where(
                        'nama',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'email',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'program',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'institusi',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'angkatan',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'jurusan',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'fakultas',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'klasifikasi_program',
                        'LIKE',
                        $keyword
                    )

                    ->orWhere(
                        'jenis_keilmuan',
                        'LIKE',
                        $keyword
                    );
                });
            }
        )

        ->orderBy(
            'nama',
            'asc'
        )

        ->paginate(12)

        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    |
    | File yang memang ada di server:
    | resources/views/frontend/cari-alumni.blade.php
    |
    */

    return view(
        'frontend.cari-alumni',
        compact('alumni', 'search')
    );
}


    /*
    |--------------------------------------------------------------------------
    | CERITA ALUMNI
    |--------------------------------------------------------------------------
    */

    public function ceritaAlumni()
    {
        $ceritaAlumnis =
            \App\Models\CeritaAlumni::latest()
                ->get();

        return view(
            'frontend.cerita-alumni',
            compact('ceritaAlumnis')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    public function profile()
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        if (!$alumni) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data alumni belum ditemukan.'
                );
        }

        return view(
            'frontend.alumni.profile',
            compact(
                'user',
                'alumni'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NETWORKING & KONTRIBUSI ALUMNI
    |--------------------------------------------------------------------------
    */

    public function updateContribution(
        Request $request
    ) {

        $validated = $request->validate([

            'bersedia_mentor' => [
                'nullable',
                'boolean'
            ],

            'bersedia_narasumber' => [
                'nullable',
                'boolean'
            ],

            'bersedia_expert' => [
                'nullable',
                'boolean'
            ],

            'bersedia_kolaborasi_sosial' => [
                'nullable',
                'boolean'
            ],

            'bersedia_dihubungi' => [
                'nullable',
                'boolean'
            ],

            'topik_mentoring' => [
                'nullable',
                'string',
                'max:2000'
            ],

            'tag_expertise_text' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'jenis_kolaborasi' => [
                'nullable',
                'array'
            ],

            'jenis_kolaborasi.*' => [
                'string',
                'max:100'
            ],

            'area_kontribusi' => [
                'nullable',
                'array'
            ],

            'area_kontribusi.*' => [
                'string',
                'max:100'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA ALUMNI
        |--------------------------------------------------------------------------
        */

        $alumni = Auth::user()->alumni;

        if (!$alumni) {
            abort(
                404,
                'Data alumni tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TAG EXPERTISE
        |--------------------------------------------------------------------------
        */

        $tagExpertise = [];

        if (
            !empty(
                $validated['tag_expertise_text']
            )
        ) {

            $tagExpertise = collect(
                explode(
                    ',',
                    $validated['tag_expertise_text']
                )
            )
                ->map(
                    fn ($tag) => trim($tag)
                )
                ->filter()
                ->unique()
                ->values()
                ->toArray();
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $alumni->update([

            'bersedia_mentor' =>
                $request->boolean(
                    'bersedia_mentor'
                ),

            'bersedia_narasumber' =>
                $request->boolean(
                    'bersedia_narasumber'
                ),

            'bersedia_expert' =>
                $request->boolean(
                    'bersedia_expert'
                ),

            'bersedia_kolaborasi_sosial' =>
                $request->boolean(
                    'bersedia_kolaborasi_sosial'
                ),

            'bersedia_dihubungi' =>
                $request->boolean(
                    'bersedia_dihubungi'
                ),

            'topik_mentoring' =>
                $validated[
                    'topik_mentoring'
                ] ?? null,

            'tag_expertise' =>
                $tagExpertise,

            'jenis_kolaborasi' =>
                $validated[
                    'jenis_kolaborasi'
                ] ?? [],

            'area_kontribusi' =>
                $validated[
                    'area_kontribusi'
                ] ?? [],
        ]);


        return back()
            ->with(
                'success',
                'Preferensi kontribusi dan networking berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT
    |--------------------------------------------------------------------------
    */

    public function export()
    {
        return Excel::download(
            new AlumniExport,
            'data-alumni-kosa.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ALUMNI
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $user = Auth::user();

        $alumni = $user->alumni;

        if (!$alumni) {

            abort(
                404,
                'Data alumni tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | KELENGKAPAN PROFIL
        |--------------------------------------------------------------------------
        */

        $fields = [

            'nama',
            'email',
            'foto',
            'angkatan',
            'jurusan',
            'program',
            'jenis_program',
            'judul_program',
            'klasifikasi_program',
            'pekerjaan',
            'domisili',
            'alamat_lengkap',
            'provinsi',
            'kabupaten_kota',
            'nomor_hp',
            'pendidikan',
            'institusi',
        ];

        $terisi = 0;

        foreach ($fields as $field) {

            if (!empty($alumni->{$field})) {
                $terisi++;
            }
        }

        $profileProgress = round(
            ($terisi / count($fields)) * 100
        );


        /*
        |--------------------------------------------------------------------------
        | EVENT
        |--------------------------------------------------------------------------
        */

        $jumlahEvent = $user
            ->pendaftarans()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | SERTIFIKAT
        |--------------------------------------------------------------------------
        */

        $jumlahSertifikat = $user
            ->pendaftarans()
            ->whereNotNull(
                'sertifikat_nomor'
            )
            ->where(
                'sertifikat_nomor',
                '!=',
                ''
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PENGINGAT EVENT
        |--------------------------------------------------------------------------
        */

        $hariIni =
            now()->startOfDay();

        $limaHariLagi =
            now()
                ->startOfDay()
                ->addDays(5);

        $eventPengingat = $user
            ->pendaftarans()
            ->with('event')
            ->whereHas(
                'event',
                function ($query) use (
                    $hariIni,
                    $limaHariLagi
                ) {

                    $query
                        ->whereDate(
                            'tanggal',
                            '>=',
                            $hariIni
                        )
                        ->whereDate(
                            'tanggal',
                            '<=',
                            $limaHariLagi
                        );
                }
            )
            ->get()
            ->sortBy(
                function ($pendaftaran) {

                    return
                        $pendaftaran
                            ->event
                            ?->tanggal;
                }
            )
            ->values();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.alumni.dashboard',
            compact(
                'alumni',
                'profileProgress',
                'jumlahEvent',
                'jumlahSertifikat',
                'eventPengingat'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function updateProfile(
        Request $request
    ) {

        $user = Auth::user();

        $alumni = $user->alumni;

        if (!$alumni) {

            return back()
                ->with(
                    'error',
                    'Data alumni tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'nomor_hp' =>
                'nullable|string|max:30',

            'pekerjaan' =>
                'nullable|string|max:255',

            'institusi' =>
                'nullable|string|max:255',

            'domisili' =>
                'nullable|string|max:255',

            'alamat' =>
                'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $file =
                $request->file('foto');

            if ($alumni->foto) {

                Storage::disk('public')
                    ->delete(
                        $alumni->foto
                    );
            }

            $fotoPath =
                $file->store(
                    'profile',
                    'public'
                );

            $alumni->foto =
                $fotoPath;
        }


        /*
        |--------------------------------------------------------------------------
        | DATA PROFIL
        |--------------------------------------------------------------------------
        */

        $alumni->nomor_hp =
            $request->nomor_hp;

        $alumni->pekerjaan =
            $request->pekerjaan;

        $alumni->institusi =
            $request->institusi;

        $alumni->domisili =
            $request->domisili;

        $alumni->alamat_lengkap =
            $request->alamat;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $alumni->save();


        return back()
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PASSWORD
    |--------------------------------------------------------------------------
    */

    public function editPassword()
    {
        return view(
            'frontend.alumni.password'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(
        Request $request
    ) {

        $request->validate([

            'current_password' => [
                'required',

                function (
                    $attribute,
                    $value,
                    $fail
                ) {

                    if (
                        !Hash::check(
                            $value,
                            Auth::user()->password
                        )
                    ) {

                        $fail(
                            'Password lama tidak sesuai.'
                        );
                    }
                },
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

        ], [

            'current_password.required' =>
                'Password lama wajib diisi.',

            'password.required' =>
                'Password baru wajib diisi.',

            'password.min' =>
                'Password baru minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',
        ]);


        $user = Auth::user();

        $user->update([

            'password' =>
                Hash::make(
                    $request->password
                ),
        ]);


        return redirect()
            ->route(
                'alumni.password.edit'
            )
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }
}