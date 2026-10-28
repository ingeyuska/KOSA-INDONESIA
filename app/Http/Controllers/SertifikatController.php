<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class SertifikatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GENERATE SERTIFIKAT
    |--------------------------------------------------------------------------
    */

    public function generate(Pendaftaran $pendaftaran)
    {
        if (!$pendaftaran->hadir) {
            return back()->with(
                'warning',
                'Sertifikat hanya dapat dibuat untuk peserta yang hadir.'
            );
        }

        if (!$pendaftaran->sertifikat_nomor) {

            $nomor = 'KOSA/SERT/' .
                now()->format('m/Y') .
                '/' .
                str_pad(
                    $pendaftaran->id,
                    4,
                    '0',
                    STR_PAD_LEFT
                );

            $pendaftaran->update([
                'sertifikat_nomor' => $nomor,
                'sertifikat_diterbitkan_at' => now(),
            ]);
        }

        return redirect()->route(
            'admin.event.sertifikat.show',
            $pendaftaran->id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SERTIFIKAT ADMIN
    |--------------------------------------------------------------------------
    */

    public function show(Pendaftaran $pendaftaran)
    {
        if (!$pendaftaran->hadir) {
            abort(403);
        }

        if (!$pendaftaran->sertifikat_nomor) {
            abort(404, 'Sertifikat belum diterbitkan.');
        }

        $pendaftaran->load('event');

        return view(
            'backend.v_sertifikat.show',
            compact('pendaftaran')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SERTIFIKAT ALUMNI
    |--------------------------------------------------------------------------
    */

    public function indexAlumni()
    {
        $user = auth()->user();

        $sertifikats = $user->pendaftarans()
            ->with('event')
            ->whereNotNull('sertifikat_nomor')
            ->where('sertifikat_nomor', '!=', '')
            ->latest('sertifikat_diterbitkan_at')
            ->get();

        return view(
            'frontend.alumni.sertifikat',
            compact('sertifikats')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SERTIFIKAT MEMBER
    |--------------------------------------------------------------------------
    */

    public function indexMember()
    {
        $user = auth()->user();

        $sertifikats = $user->pendaftarans()
            ->with('event')
            ->whereNotNull('sertifikat_nomor')
            ->where('sertifikat_nomor', '!=', '')
            ->latest('sertifikat_diterbitkan_at')
            ->get();

        return view(
            'frontend.member.sertifikat',
            compact('sertifikats')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD SERTIFIKAT
    |--------------------------------------------------------------------------
    */

    public function download(Pendaftaran $pendaftaran)
    {
        if (!$pendaftaran->hadir) {
            abort(403, 'Peserta belum dinyatakan hadir.');
        }

        if (!$pendaftaran->sertifikat_nomor) {
            abort(404, 'Sertifikat belum diterbitkan.');
        }

        $pendaftaran->load('event');

        $pdf = Pdf::loadView(
            'frontend.sertifikat.pdf',
            compact('pendaftaran')
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download(
            'Sertifikat-' .
            Str::slug($pendaftaran->nama_lengkap) .
            '.pdf'
        );
    }
    public function downloadMember(Pendaftaran $pendaftaran)
{
    // Pastikan sertifikat milik member yang sedang login
    if ($pendaftaran->user_id !== auth()->id()) {
        abort(403, 'Anda tidak memiliki akses ke sertifikat ini.');
    }

    // Pastikan peserta hadir
    if (!$pendaftaran->hadir) {
        abort(403, 'Peserta belum dinyatakan hadir.');
    }

    // Pastikan sertifikat sudah diterbitkan
    if (!$pendaftaran->sertifikat_nomor) {
        abort(404, 'Sertifikat belum diterbitkan.');
    }

    $pendaftaran->load('event');

    $pdf = Pdf::loadView(
        'frontend.sertifikat.pdf',
        compact('pendaftaran')
    );

    $pdf->setPaper('a4', 'landscape');

    return $pdf->download(
        'Sertifikat-' .
        Str::slug($pendaftaran->nama_lengkap) .
        '.pdf'
    );
}
public function showMember(Pendaftaran $pendaftaran)
{
    if ($pendaftaran->user_id !== auth()->id()) {
        abort(403, 'Anda tidak memiliki akses ke sertifikat ini.');
    }

    if (!$pendaftaran->hadir) {
        abort(403, 'Peserta belum dinyatakan hadir.');
    }

    if (!$pendaftaran->sertifikat_nomor) {
        abort(404, 'Sertifikat belum diterbitkan.');
    }

    $pendaftaran->load('event');

    $pdf = Pdf::loadView(
        'frontend.sertifikat.pdf',
        compact('pendaftaran')
    );

    $pdf->setPaper('a4', 'landscape');

    return $pdf->stream(
        'Sertifikat-' .
        Str::slug($pendaftaran->nama_lengkap) .
        '.pdf'
    );
}
/*
|--------------------------------------------------------------------------
| LIHAT SERTIFIKAT ALUMNI
|--------------------------------------------------------------------------
*/

public function showAlumni(Pendaftaran $pendaftaran)
{
    // Pastikan sertifikat milik Alumni yang sedang login
    if ($pendaftaran->user_id !== auth()->id()) {
        abort(403, 'Anda tidak memiliki akses ke sertifikat ini.');
    }

    // Pastikan peserta hadir
    if (!$pendaftaran->hadir) {
        abort(403, 'Peserta belum dinyatakan hadir.');
    }

    // Pastikan sertifikat sudah diterbitkan
    if (!$pendaftaran->sertifikat_nomor) {
        abort(404, 'Sertifikat belum diterbitkan.');
    }

    $pendaftaran->load('event');

    $pdf = Pdf::loadView(
        'frontend.sertifikat.pdf',
        compact('pendaftaran')
    );

    $pdf->setPaper('a4', 'landscape');

    return $pdf->stream(
        'Sertifikat-' .
        Str::slug($pendaftaran->nama_lengkap) .
        '.pdf'
    );
}
}