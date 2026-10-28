<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumni;
use App\Models\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\AlumniInvitation;
use App\Models\MemberVerification;
use App\Mail\MemberVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * ==========================================================
     * FORM REGISTER ALUMNI
     * ==========================================================
     */
    public function registerAlumni()
    {
        return view('frontend.register.register-alumni');
    }


    /**
     * ==========================================================
     * REGISTER ALUMNI EXISTING
     * Cek email → generate link aktivasi unik
     * ==========================================================
     */
    public function storeAlumni(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI EMAIL
        |--------------------------------------------------------------------------
        */

        $email = strtolower(trim($validated['email']));


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH EMAIL SUDAH MENJADI AKUN
        |--------------------------------------------------------------------------
        */

        $existingUser = User::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();

        if ($existingUser) {

            return back()
                ->withErrors([
                    'email' =>
                        'Email tersebut sudah memiliki akun. Silakan login.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | CEK DATA ALUMNI EXISTING KOSA
        |--------------------------------------------------------------------------
        */

        $alumni = Alumni::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();


        /*
        |--------------------------------------------------------------------------
        | EMAIL TIDAK TERDAFTAR
        |--------------------------------------------------------------------------
        */

        if (!$alumni) {

            return back()
                ->withErrors([
                    'email' =>
                        'Email Anda belum terdaftar sebagai Alumni Existing KOSA Indonesia.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | DATA SUDAH AKTIF
        |--------------------------------------------------------------------------
        */

        if ($alumni->status === 'aktif') {

            return back()
                ->withErrors([
                    'email' =>
                        'Data alumni ini sudah aktif. Silakan login menggunakan akun Anda.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE TOKEN AKTIVASI
        |--------------------------------------------------------------------------
        */

        $token = Str::random(64);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN TOKEN KE ALUMNI INVITATION
        |
        | Invitation digunakan sebagai penghubung proses aktivasi.
        |--------------------------------------------------------------------------
        */

        AlumniInvitation::updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'nama_lengkap' =>
                    $alumni->nama,

                'no_hp' =>
                    $alumni->nomor_hp,

                'token' =>
                    $token,

                'used' =>
                    false,

                'activated_at' =>
                    null,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE HALAMAN KONFIRMASI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'alumni.activation.show',
                $token
            )
            ->with(
                'success',
                'Data alumni ditemukan. Silakan lanjutkan proses aktivasi akun.'
            );
    }


    /**
     * ==========================================================
     * REGISTER MEMBER / MASYARAKAT
     *
     * ID     : G-XXXXX
     * ROLE   : member
     * STATUS : tidak_aktif sampai email dikonfirmasi
     *
     * INFORMASI KOSA:
     * Bisa memilih lebih dari satu pilihan.
     * ==========================================================
     */
    public function storeMember(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA MEMBER
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------
            | DATA AKUN
            |--------------------------------------------------------------
            */

            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],


            /*
            |--------------------------------------------------------------
            | DATA PROFIL
            |--------------------------------------------------------------
            */

            'pekerjaan' => [
                'required',
                'string',
                'max:255',
            ],

            'domisili' => [
                'required',
                'string',
                'max:255',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'no_hp' => [
                'required',
                'string',
                'max:30',
            ],

            'perusahaan' => [
                'nullable',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------
            | INFORMASI YANG DIINGINKAN DARI KOSA
            |
            | Karena Blade menggunakan:
            |
            | name="informasi_kosa[]"
            |
            | maka data diterima sebagai ARRAY.
            |--------------------------------------------------------------
            */

            'informasi_kosa' => [
                'required',
                'array',
                'min:1',
            ],

            'informasi_kosa.*' => [
                'string',
                'max:255',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI EMAIL
        |--------------------------------------------------------------------------
        */

        $email = strtolower(
            trim($validated['email'])
        );


        /*
        |--------------------------------------------------------------------------
        | GENERATE MEMBER ID
        |
        | Format:
        | G-XXXXX
        |
        | Contoh:
        | G-01234
        | G-58321
        |--------------------------------------------------------------------------
        */

        do {

            $memberId = 'G-' . str_pad(
                random_int(0, 99999),
                5,
                '0',
                STR_PAD_LEFT
            );

        } while (
            MemberProfile::where(
                'member_id',
                $memberId
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | GENERATE TOKEN VERIFIKASI EMAIL
        |--------------------------------------------------------------------------
        */

        $token = Str::random(64);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER + MEMBER PROFILE + VERIFICATION
        |
        | Menggunakan transaction agar apabila salah satu proses gagal,
        | seluruh data dibatalkan.
        |--------------------------------------------------------------------------
        */

        $user = DB::transaction(function () use (
            $validated,
            $email,
            $memberId,
            $token
        ) {

            /*
            |--------------------------------------------------------------
            | USER
            |--------------------------------------------------------------
            */

            $user = User::create([

                'nama' =>
                    $validated['nama'],

                'email' =>
                    $email,

                'password' =>
                    Hash::make($validated['password']),

                'role' =>
                    'member',

                /*
                | Belum aktif sebelum email dikonfirmasi
                */
                'status' =>
                    'tidak_aktif',

                'no_hp' =>
                    $validated['no_hp'],
            ]);


            /*
            |--------------------------------------------------------------
            | MEMBER PROFILE
            |--------------------------------------------------------------
            */

            MemberProfile::create([

                'user_id' =>
                    $user->id,

                'member_id' =>
                    $memberId,

                'pekerjaan' =>
                    $validated['pekerjaan'],

                'domisili' =>
                    $validated['domisili'],

                'alamat' =>
                    $validated['alamat'],

                'no_hp' =>
                    $validated['no_hp'],

                'perusahaan' =>
                    $validated['perusahaan'] ?? null,

                /*
                |----------------------------------------------------------
                | INFORMASI KOSA
                |
                | Array akan disimpan sebagai JSON.
                |
                | Contoh:
                | [
                |     "Seminar",
                |     "Informasi Beasiswa S2 / S3 KOICA",
                |     "Gathering dan Networking"
                | ]
                |----------------------------------------------------------
                */

                'informasi_kosa' =>
                    json_encode(
                        $validated['informasi_kosa'],
                        JSON_UNESCAPED_UNICODE
                    ),
            ]);


            /*
            |--------------------------------------------------------------
            | MEMBER VERIFICATION
            |--------------------------------------------------------------
            */

            MemberVerification::create([

                'user_id' =>
                    $user->id,

                'token' =>
                    $token,

                /*
                | Link berlaku selama 24 jam
                */
                'expires_at' =>
                    now()->addHours(24),
            ]);


            /*
            |--------------------------------------------------------------
            | KEMBALIKAN USER
            |--------------------------------------------------------------
            */

            return $user;
        });


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA VERIFICATION
        |--------------------------------------------------------------------------
        */

        $verification = MemberVerification::where(
            'user_id',
            $user->id
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | KIRIM EMAIL VERIFIKASI
        |--------------------------------------------------------------------------
        */

        Mail::to(
            $user->email
        )->send(
            new MemberVerificationMail(
                $verification
            )
        );


        /*
        |--------------------------------------------------------------------------
        | HALAMAN SUKSES REGISTRASI
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.register.register-success',
            [
                'user' => $user,
            ]
        );
    }
}