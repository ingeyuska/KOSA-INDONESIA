<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * ==========================================================
     * PROFILE MEMBER
     * ==========================================================
     */
    public function profile()
    {
        $user = Auth::user();

        $profile = $user->memberProfile;

        return view(
            'frontend.member.profile',
            compact('user', 'profile')
        );
    }


    /**
     * ==========================================================
     * UPDATE PROFILE MEMBER
     * ==========================================================
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'pekerjaan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'domisili' => [
                'nullable',
                'string',
                'max:255',
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:500',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'perusahaan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'informasi_kosa' => [
                'nullable',
                'array',
            ],

            'informasi_kosa.*' => [
                'string',
                'max:255',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL MEMBER PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = $user->memberProfile;

        /*
        | Jika belum ada profile, buat baru.
        */

        if (!$profile) {

            $profile = new MemberProfile();

            $profile->user_id = $user->id;

            /*
            | Member ID seharusnya sudah dibuat saat registrasi.
            | Tidak dibuat ulang di sini.
            */
        }


        /*
        |--------------------------------------------------------------------------
        | DATA PROFILE
        |--------------------------------------------------------------------------
        */

        $profile->pekerjaan =
            $request->input('pekerjaan');

        $profile->domisili =
            $request->input('domisili');

        $profile->alamat =
            $request->input('alamat');

        $profile->no_hp =
            $request->input('no_hp');

        $profile->perusahaan =
            $request->input('perusahaan');


        /*
        |--------------------------------------------------------------------------
        | INFORMASI KOSA
        |
        | Checkbox dikirim sebagai:
        |
        | informasi_kosa[]
        |
        | Contoh:
        |
        | [
        |     "Seminar",
        |     "Gathering dan Networking"
        | ]
        |
        | Kemudian disimpan sebagai JSON.
        |--------------------------------------------------------------------------
        */

        $informasiKosa = $request->input(
            'informasi_kosa',
            []
        );

        $profile->informasi_kosa = json_encode(
            $informasiKosa,
            JSON_UNESCAPED_UNICODE
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $profile->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('member.profile')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /**
     * ==========================================================
     * MEMBER DASHBOARD
     * ==========================================================
     */
    public function dashboard()
    {
        $user = Auth::user();

        $memberProfile = $user->memberProfile;


        /*
        |--------------------------------------------------------------------------
        | CEK PROFILE
        |--------------------------------------------------------------------------
        */

        if (!$memberProfile) {

            abort(
                404,
                'Data member tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG KELENGKAPAN PROFILE
        |--------------------------------------------------------------------------
        */

        $fields = [
            'pekerjaan',
            'domisili',
            'alamat',
            'no_hp',
            'perusahaan',
            'informasi_kosa',
        ];

        $terisi = 0;


        foreach ($fields as $field) {

            /*
            |--------------------------------------------------------------
            | INFORMASI KOSA
            |
            | Karena disimpan dalam JSON, kita cek isi array-nya.
            |--------------------------------------------------------------
            */

            if ($field === 'informasi_kosa') {

                $informasiKosa = json_decode(
                    $memberProfile->informasi_kosa,
                    true
                );

                if (
                    is_array($informasiKosa) &&
                    count($informasiKosa) > 0
                ) {
                    $terisi++;
                }

                continue;
            }


            /*
            |--------------------------------------------------------------
            | FIELD BIASA
            |--------------------------------------------------------------
            */

            if (
                !is_null($memberProfile->{$field}) &&
                trim((string) $memberProfile->{$field}) !== ''
            ) {
                $terisi++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HITUNG PERSENTASE
        |--------------------------------------------------------------------------
        */

        $profileProgress = round(
            ($terisi / count($fields)) * 100
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PENDAFTARAN EVENT MEMBER
        |--------------------------------------------------------------------------
        */

        $pendaftaranEvent = $user->pendaftarans()
            ->with('event')
            ->whereHas('event')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH EVENT YANG SUDAH DIDAFTARKAN
        |--------------------------------------------------------------------------
        */

        $jumlahEvent =
            $pendaftaranEvent->count();


        /*
        |--------------------------------------------------------------------------
        | JUMLAH SERTIFIKAT
        |--------------------------------------------------------------------------
        */

        $jumlahSertifikat = $user->pendaftarans()
            ->whereNotNull('sertifikat_nomor')
            ->where(
                'sertifikat_nomor',
                '!=',
                ''
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | EVENT TERDEKAT YANG SUDAH DIDAFTARKAN
        |--------------------------------------------------------------------------
        */

        $upcomingEvent = $pendaftaranEvent
            ->filter(function ($pendaftaran) {

                if (!$pendaftaran->event) {
                    return false;
                }

                if (!$pendaftaran->event->tanggal) {
                    return false;
                }

                return Carbon::parse(
                    $pendaftaran->event->tanggal
                )
                    ->startOfDay()
                    ->gte(
                        now()->startOfDay()
                    );
            })
            ->sortBy(function ($pendaftaran) {

                return $pendaftaran->event->tanggal;

            })
            ->first();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.member.dashboard',
            compact(
                'user',
                'memberProfile',
                'profileProgress',
                'jumlahEvent',
                'jumlahSertifikat',
                'pendaftaranEvent',
                'upcomingEvent'
            )
        );
    }


    /**
     * ==========================================================
     * FORM UBAH PASSWORD
     * ==========================================================
     */
    public function editPassword()
    {
        return view(
            'frontend.member.password'
        );
    }


    /**
     * ==========================================================
     * UPDATE PASSWORD
     * ==========================================================
     */
    public function updatePassword(Request $request)
    {
        $request->validate(
            [
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
            ],
            [
                'current_password.required' =>
                    'Password lama wajib diisi.',

                'password.required' =>
                    'Password baru wajib diisi.',

                'password.min' =>
                    'Password baru minimal 8 karakter.',

                'password.confirmed' =>
                    'Konfirmasi password tidak sesuai.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PASSWORD BARU
        |--------------------------------------------------------------------------
        */

        Auth::user()->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'member.password.edit'
            )
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }


    /**
     * ==========================================================
     * EVENT YANG SUDAH DIIKUTI / DIDAFTARKAN MEMBER
     * ==========================================================
     */
    public function registeredMember()
    {
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | AMBIL PENDAFTARAN EVENT
        |--------------------------------------------------------------------------
        */

        $pendaftarans = Pendaftaran::with('event')
            ->where(
                'user_id',
                $user->id
            )
            ->whereHas('event')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | HALAMAN EVENT TERDAFTAR
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.member.event.event-registered',
            compact('pendaftarans')
        );
    }
}