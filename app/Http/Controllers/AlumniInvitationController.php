<?php

namespace App\Http\Controllers;

use App\Mail\AlumniActivationMail;
use App\Models\Alumni;
use App\Models\AlumniInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AlumniInvitationController extends Controller
{
    public function index()
    {
        $invitations = AlumniInvitation::latest()->get();

        return view(
            'backend.v_alumni_activation.index',
            compact('invitations')
        );
    }

    public function create()
    {
        return view('backend.v_alumni_activation.create');
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE DATA ALUMNI EXISTING
    |--------------------------------------------------------------------------
    */

    public function generate()
    {
        $alumnis = Alumni::whereNotNull('email')
            ->get();

        $jumlah = 0;

        foreach ($alumnis as $alumni) {

            // Jangan dibuat ulang kalau email sudah ada
            $invitation = AlumniInvitation::firstOrCreate(
                [
                    'email' => strtolower(trim($alumni->email)),
                ],
                [
                    'nama_lengkap' => $alumni->nama,
                    'no_hp' => $alumni->no_hp,
                    'used' => false,
                ]
            );

            if ($invitation->wasRecentlyCreated) {
                $jumlah++;
            }
        }

        return back()->with(
            'success',
            $jumlah . ' data alumni berhasil digenerate ke data aktivasi.'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:alumni_invitations,email'
            ],
            'no_hp' => ['nullable', 'string', 'max:30'],
        ]);

        AlumniInvitation::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => strtolower($validated['email']),
            'no_hp' => $validated['no_hp'] ?? null,
            'token' => null,
            'used' => false,
        ]);

        return redirect()
            ->route('admin.alumni.activation.index')
            ->with(
                'success',
                'Data alumni existing berhasil ditambahkan.'
            );
    }

    public function sendBulk(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:alumni_invitations,id'],
        ]);

        $invitations = AlumniInvitation::whereIn('id', $request->ids)
            ->where('used', false)
            ->get();

        $jumlah = 0;

        foreach ($invitations as $invitation) {

            $invitation->update([
                'token' => Str::random(64),
            ]);

            Mail::to($invitation->email)
                ->send(new AlumniActivationMail($invitation));

            $jumlah++;
        }

        return back()->with(
            'success',
            $jumlah . ' email aktivasi berhasil dikirim.'
        );
    }

    public function resend($id)
    {
        $invitation = AlumniInvitation::where('id', $id)
            ->where('used', false)
            ->firstOrFail();

        $invitation->update([
            'token' => Str::random(64),
        ]);

        Mail::to($invitation->email)
            ->send(new AlumniActivationMail($invitation));

        return back()->with(
            'success',
            'Email aktivasi berhasil dikirim ulang ke '
            . $invitation->email
        );
    }

    public function destroy($id)
    {
        $invitation = AlumniInvitation::findOrFail($id);

        $invitation->delete();

        return back()->with(
            'success',
            'Data alumni existing berhasil dihapus.'
        );
    }
    
}