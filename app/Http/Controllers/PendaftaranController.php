<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * ==========================================================
     * PENDAFTARAN UMUM
     * ==========================================================
     */

    public function create(Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        return view(
            'frontend.member.event.daftar',
            compact('event')
        );
    }


    public function store(Request $request, Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        $validated = $request->validate([
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'no_whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'instansi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $sudahDaftar = Pendaftaran::where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->exists();

        if ($sudahDaftar) {
            return redirect()
                ->route('event.show', $event->slug)
                ->with(
                    'warning',
                    'Anda sudah terdaftar pada event ini.'
                );
        }

        $validated['event_id'] = $event->id;
        $validated['hadir'] = false;

        Pendaftaran::create($validated);

        return redirect()
            ->route('event.show', $event->slug)
            ->with(
                'success',
                'Pendaftaran event berhasil dikirim.'
            );
    }


    /**
     * ==========================================================
     * PENDAFTARAN MEMBER
     * ==========================================================
     */

    public function createMember(Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        return view(
            'frontend.member.event.daftar',
            compact('event')
        );
    }


    public function storeMember(Request $request, Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        $user = auth()->user();

        $validated = $request->validate([
            'no_whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'instansi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $sudahDaftar = Pendaftaran::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()
                ->route('member.event.show', $event->slug)
                ->with(
                    'warning',
                    'Anda sudah terdaftar pada event ini.'
                );
        }

        Pendaftaran::create([
            'event_id'      => $event->id,
            'user_id'       => $user->id,
            'nama_lengkap'  => $user->nama,
            'email'         => $user->email,
            'no_whatsapp'   => $validated['no_whatsapp'],
            'instansi'      => $validated['instansi'] ?? null,
            'keterangan'    => $validated['keterangan'] ?? null,
            'hadir'         => false,
        ]);

        return redirect()
            ->route('member.event.show', $event->slug)
            ->with(
                'success',
                'Pendaftaran event berhasil dikirim.'
            );
    }


    /**
     * ==========================================================
     * PENDAFTARAN EVENT ALUMNI
     * ==========================================================
     */

    public function createAlumni(Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        return view(
            'frontend.alumni.event.daftar',
            compact('event')
        );
    }


    public function storeAlumni(Request $request, Event $event)
    {
        if (!$event->pendaftaran_aktif) {
            abort(404);
        }

        $user = auth()->user();

        $validated = $request->validate([
            'no_whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'instansi' => [
                'nullable',
                'string',
                'max:255',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $sudahDaftar = Pendaftaran::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()
                ->route('alumni.event.show', $event->slug)
                ->with(
                    'warning',
                    'Anda sudah terdaftar pada event ini.'
                );
        }

        Pendaftaran::create([
            'event_id'      => $event->id,
            'user_id'       => $user->id,
            'nama_lengkap'  => $user->nama,
            'email'         => $user->email,
            'no_whatsapp'   => $validated['no_whatsapp'],
            'instansi'      => $validated['instansi'] ?? null,
            'keterangan'    => $validated['keterangan'] ?? null,
            'hadir'         => false,
        ]);

        return redirect()
            ->route('alumni.event.show', $event->slug)
            ->with(
                'success',
                'Pendaftaran event berhasil dikirim.'
            );
    }


    /**
     * ==========================================================
     * ADMIN - DAFTAR PENDAFTAR EVENT
     * ==========================================================
     */

    public function index(Event $event)
    {
        $pendaftarans = Pendaftaran::with([
            'user.alumni',
            'user.memberProfile'
        ])
            ->where('event_id', $event->id)
            ->latest()
            ->get();

        return view(
            'backend.v_event.pendaftar',
            compact(
                'event',
                'pendaftarans'
            )
        );
    }


    /**
     * ==========================================================
     * ADMIN - TANDAI HADIR
     * ==========================================================
     */

    public function hadir(Pendaftaran $pendaftaran)
    {
        $pendaftaran->update([
            'hadir' => true,
        ]);

        return back()->with(
            'success',
            'Peserta berhasil ditandai hadir.'
        );
    }
}