<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Simpan testimoni peserta
     */
    public function store(Request $request, Event $event)
    {
        // Event harus sudah selesai
        if (!$event->tanggal || !$event->tanggal->lt(now()->startOfDay())) {
            return back()->with(
                'error',
                'Testimoni hanya dapat diberikan setelah event selesai.'
            );
        }

        $user = auth()->user();

        // Harus merupakan peserta yang hadir
        $peserta = Pendaftaran::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->where('hadir', true)
            ->exists();

        if (!$peserta) {
            return back()->with(
                'error',
                'Anda hanya dapat memberikan testimoni jika terdaftar dan hadir pada event ini.'
            );
        }

        // Cek apakah sudah pernah memberikan testimoni
        $sudahMemberikan = Testimoni::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahMemberikan) {
            return back()->with(
                'warning',
                'Anda sudah memberikan testimoni untuk event ini.'
            );
        }

        $validated = $request->validate([
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'komentar' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        Testimoni::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Testimoni berhasil dikirim dan menunggu persetujuan admin.'
        );
    }
}