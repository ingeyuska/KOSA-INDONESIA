<?php

namespace App\Http\Controllers;

use App\Models\MemberVerification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MemberVerificationController extends Controller
{
    public function verify($token)
    {
        $verification = MemberVerification::with([
            'user',
            'user.memberProfile'
        ])
        ->where('token', $token)
        ->first();

        /*
        |--------------------------------------------------------------------------
        | TOKEN TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$verification) {
            return view('frontend.member.verifikasi.verification-invalid');
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH DIVERIFIKASI
        |--------------------------------------------------------------------------
        */

        if ($verification->verified_at) {
            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Akun Member Anda sudah dikonfirmasi. Silakan login.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TOKEN KADALUARSA
        |--------------------------------------------------------------------------
        */

        if (Carbon::now()->greaterThan($verification->expires_at)) {
            return view('frontend.member.verifikasi.verification-expired');
        }


        /*
        |--------------------------------------------------------------------------
        | USER TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$verification->user) {
            return view('frontend.member.verifikasi.verification-invalid');
        }


        /*
        |--------------------------------------------------------------------------
        | MEMBER PROFILE TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$verification->user->memberProfile) {
            return view('frontend.member.verifikasi.verification-invalid');
        }


        /*
        |--------------------------------------------------------------------------
        | AKTIFKAN AKUN
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($verification) {

            $verification->update([
                'verified_at' => now(),
            ]);

           $verification->user->update([
            'status' => 'aktif',
            'email_verified_at' => now(),
        ]);
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Akun Member berhasil dikonfirmasi. Member ID Anda adalah ' .
                $verification->user->memberProfile->member_id
            );
    }
}