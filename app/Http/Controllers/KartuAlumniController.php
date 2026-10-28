<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KartuAlumniController extends Controller
{
    /**
     * =========================================================
     * TAMPILKAN KARTU ALUMNI
     * =========================================================
     */
    public function show()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Cari data alumni berdasarkan user_id
        |--------------------------------------------------------------------------
        */

        $alumni = Alumni::where('user_id', $user->id)->first();

        /*
        |--------------------------------------------------------------------------
        | Fallback berdasarkan email
        |--------------------------------------------------------------------------
        */

        if (!$alumni) {
            $alumni = Alumni::where(
                'email',
                $user->email
            )->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Data alumni tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil kartu alumni
        |--------------------------------------------------------------------------
        */

        $kartu = $alumni->kartuAlumni;

        /*
        |--------------------------------------------------------------------------
        | Jika kartu belum dibuat
        |--------------------------------------------------------------------------
        */

        if (!$kartu) {
            return view(
                'frontend.kartu-alumni',
                compact(
                    'user',
                    'alumni',
                    'kartu'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek masa berlaku
        |--------------------------------------------------------------------------
        */

        if (
            !$kartu->tanggal_berlaku_sampai ||
            Carbon::today()->greaterThan(
                Carbon::parse(
                    $kartu->tanggal_berlaku_sampai
                )
            )
        ) {
            $kartu->update([
                'status' => 'tidak_aktif',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Tetap tampilkan kartu
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.kartu-alumni',
            compact(
                'user',
                'alumni',
                'kartu'
            )
        );
    }


    /**
     * =========================================================
     * DOWNLOAD / CETAK KARTU
     * =========================================================
     */
    public function download()
    {
        $user = Auth::user();

        $alumni = Alumni::where(
            'user_id',
            $user->id
        )->first();

        if (!$alumni) {
            $alumni = Alumni::where(
                'email',
                $user->email
            )->first();
        }

        if (!$alumni) {
            return back()->with(
                'error',
                'Data alumni belum ditemukan.'
            );
        }

        $kartu = $alumni->kartuAlumni;

        if (!$kartu) {
            return back()->with(
                'error',
                'Kartu Alumni belum tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek masa berlaku
        |--------------------------------------------------------------------------
        */

        if (
            !$kartu->tanggal_berlaku_sampai ||
            Carbon::today()->greaterThan(
                Carbon::parse(
                    $kartu->tanggal_berlaku_sampai
                )
            )
        ) {
            $kartu->update([
                'status' => 'tidak_aktif',
            ]);

            return back()->with(
                'error',
                'Kartu Alumni telah kedaluwarsa.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Cek status
        |--------------------------------------------------------------------------
        */

        if ($kartu->status !== 'aktif') {
            return back()->with(
                'error',
                'Kartu Alumni tidak aktif.'
            );
        }

        return view(
            'frontend.kartu-alumni-download',
            compact(
                'user',
                'alumni',
                'kartu'
            )
        );
    }
}

