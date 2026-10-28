<?php

namespace App\Http\Controllers;

use App\Models\CeritaAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniCeritaController extends Controller
{
    /**
     * Menampilkan halaman Cerita Saya.
     */
    public function index()
    {
        $alumni = Auth::user()->alumni;

        $ceritaAlumni = CeritaAlumni::where(
            'alumni_id',
            $alumni->id
        )->first();

        return view(
            'frontend.alumni.cerita',
            compact('alumni', 'ceritaAlumni')
        );
    }

    /**
     * Menyimpan cerita dari alumni.
     */
    public function store(Request $request)
    {
        $alumni = Auth::user()->alumni;

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cerita' => 'required|string',
        ], [
            'foto.required' => 'Foto cerita wajib diupload.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'cerita.required' => 'Cerita alumni wajib diisi.',
        ]);

        $fotoPath = $request->file('foto')
            ->store('cerita-alumni', 'public');

        CeritaAlumni::create([
            'alumni_id' => $alumni->id,
            'foto' => $fotoPath,
            'cerita' => $request->cerita,
            'status' => false,
        ]);

        return redirect()
            ->route('alumni.cerita')
            ->with(
                'success',
                'Cerita berhasil dikirim dan menunggu persetujuan admin.'
            );
    }
}