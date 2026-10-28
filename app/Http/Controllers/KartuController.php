<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KartuController extends Controller
{
    /**
     * =========================================================
     * KARTU KEANGGOTAAN ALUMNI
     * =========================================================
     */
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Ambil alumni berdasarkan user_id
        |--------------------------------------------------------------------------
        */
        $alumni = Alumni::where('user_id', $user->id)->first();

        /*
        |--------------------------------------------------------------------------
        | Jika belum terhubung dengan user_id,
        | cari berdasarkan email
        |--------------------------------------------------------------------------
        */
        if (!$alumni) {
            $alumni = Alumni::where('email', $user->email)->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil kartu alumni
        |--------------------------------------------------------------------------
        */
        $kartu = $alumni?->kartuAlumni;

        /*
        |--------------------------------------------------------------------------
        | Tampilkan halaman kartu
        |--------------------------------------------------------------------------
        */
        return view(
            'frontend.kartu.index',
            compact(
                'user',
                'alumni',
                'kartu'
            )
        );
    }


    /**
     * =========================================================
     * VERIFIKASI KARTU ALUMNI
     * =========================================================
     */
    public function verifikasi($id_anggota)
    {
        /*
        |--------------------------------------------------------------------------
        | Cari alumni berdasarkan ID anggota
        |--------------------------------------------------------------------------
        */
        $alumni = Alumni::where(
            'alumni_id',
            $id_anggota
        )->first();


        /*
        |--------------------------------------------------------------------------
        | Jika ID tidak ditemukan
        |--------------------------------------------------------------------------
        */
        if (!$alumni) {

            return view(
                'frontend.kartu.verifikasi',
                [
                    'alumni' => null,
                    'kartu' => null,
                    'aktif' => false,
                ]
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
        | Cek status kartu
        |--------------------------------------------------------------------------
        */
        $aktif = false;

        if ($kartu) {

            $aktif =
                $kartu->status === 'aktif' &&
                $kartu->tanggal_berlaku_sampai &&
                Carbon::today()->lte(
                    Carbon::parse(
                        $kartu->tanggal_berlaku_sampai
                    )
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Tampilkan halaman verifikasi
        |--------------------------------------------------------------------------
        */
        return view(
            'frontend.kartu.verifikasi',
            [
                'alumni' => $alumni,
                'kartu' => $kartu,
                'aktif' => $aktif,
            ]
        );
    }
}

