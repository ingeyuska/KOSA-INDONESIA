<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AlumniInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlumniActivationController extends Controller
{
    /**
     * Halaman aktivasi dari link unik
     */
    public function show($token)
    {
        $invitation = AlumniInvitation::where('token', $token)
            ->where('used', false)
            ->first();

        if (!$invitation) {
            return view('frontend.alumni.activation.invalid');
        }

        return view(
            'frontend.alumni.activation.confirm',
            compact('invitation')
        );
    }

    /**
     * Konfirmasi identitas alumni
     */
    public function confirm(Request $request, $token)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'konfirmasi' => ['required', 'accepted'],
        ]);

        $invitation = AlumniInvitation::where('token', $token)
            ->where('used', false)
            ->firstOrFail();

        // Normalisasi email
        $emailRequest = strtolower(trim($request->email));
        $emailInvitation = strtolower(trim($invitation->email));

        if ($emailRequest !== $emailInvitation) {
            return back()
                ->withErrors([
                    'email' => 'Email tidak sesuai dengan data alumni.'
                ])
                ->withInput();
        }

        // Pastikan data Alumni Existing memang ada
        $alumni = Alumni::whereRaw(
            'LOWER(email) = ?',
            [$emailInvitation]
        )->first();

        if (!$alumni) {
            return back()->withErrors([
                'email' => 'Data Alumni Existing tidak ditemukan.'
            ]);
        }

        // Jika sudah aktif
        if ($alumni->status === 'aktif') {
            return back()->withErrors([
                'email' => 'Data alumni ini sudah aktif. Silakan login.'
            ]);
        }

        return redirect()
            ->route('alumni.activation.password', $token);
    }

    /**
     * Membuat akun alumni
     */
    public function activate(Request $request, $token)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
            'persetujuan_data' => [
                'required',
            ],
        ]);

        $invitation = AlumniInvitation::where('token', $token)
            ->where('used', false)
            ->firstOrFail();

        $email = strtolower(trim($invitation->email));

        /*
        |--------------------------------------------------------------------------
        | Cari data Alumni Existing
        |--------------------------------------------------------------------------
        */

        $alumni = Alumni::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();

        if (!$alumni) {
            return back()->withErrors([
                'email' => 'Data Alumni Existing tidak ditemukan.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan belum aktif
        |--------------------------------------------------------------------------
        */

        if ($alumni->status === 'aktif' || $alumni->user_id !== null) {
            return back()->withErrors([
                'email' => 'Data alumni ini sudah memiliki akun aktif.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek email User
        |--------------------------------------------------------------------------
        */

        $existingUser = User::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();

        if ($existingUser) {
            return back()->withErrors([
                'email' => 'Email alumni sudah memiliki akun.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Alumni ID
        |--------------------------------------------------------------------------
        */

        do {
            $alumniId = 'A-' . str_pad(
                random_int(0, 99999),
                5,
                '0',
                STR_PAD_LEFT
            );
        } while (
            Alumni::where('alumni_id', $alumniId)->exists()
        );

        /*
        |--------------------------------------------------------------------------
        | Buat User + Hubungkan ke Alumni Existing
        |--------------------------------------------------------------------------
        */

        $user = DB::transaction(function () use (
            $request,
            $invitation,
            $alumni,
            $email,
            $alumniId
        ) {

            /*
            |--------------------------------------------------------------------------
            | Buat User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'nama' => $alumni->nama,
                'email' => $email,
                'no_hp' => $alumni->nomor_hp,
                'password' => Hash::make($request->password),
                'role' => 'alumni',
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE Alumni Existing
            |--------------------------------------------------------------------------
            */

            $alumni->update([
                'user_id' => $user->id,
                'alumni_id' => $alumniId,
                'status' => 'aktif',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Tandai invitation sudah digunakan
            |--------------------------------------------------------------------------
            */

            $invitation->update([
                'used' => true,
                'activated_at' => now(),
                'token' => null,
            ]);

            return $user;
        });

        /*
        |--------------------------------------------------------------------------
        | Login otomatis
        |--------------------------------------------------------------------------
        */

        auth()->login($user);

        /*
        |--------------------------------------------------------------------------
        | Redirect ke Lengkapi Profil
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('alumni.profile')
            ->with(
                'success',
                'Akun berhasil diaktifkan. Alumni ID Anda adalah ' . $alumniId
            );
    }

    /**
     * Halaman buat password
     */
    public function password($token)
    {
        $invitation = AlumniInvitation::where('token', $token)
            ->where('used', false)
            ->first();

        if (!$invitation) {
            return view('frontend.alumni.activation.invalid');
        }

        $alumni = Alumni::whereRaw(
            'LOWER(email) = ?',
            [strtolower(trim($invitation->email))]
        )->first();

        if (!$alumni) {
            return view('frontend.alumni.activation.invalid');
        }

        if ($alumni->status === 'aktif') {
            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun alumni ini sudah aktif. Silakan login.'
                );
        }

        return view(
            'frontend.alumni.activation.password',
            compact('invitation', 'alumni')
        );
    }
}
