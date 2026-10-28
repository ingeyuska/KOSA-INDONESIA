<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\CeritaAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CeritaAlumniController extends Controller
{
    /**
     * Menampilkan daftar cerita alumni.
     */
    public function index()
    {
        $ceritaAlumnis = CeritaAlumni::with('alumni')
            ->latest()
            ->get();

        return view(
            'backend.v_cerita_alumni.index',
            compact('ceritaAlumnis')
        );
    }

    /**
     * Menampilkan form tambah.
     */
    public function create()
    {
        $alumnis = Alumni::orderBy('nama')->get();

        return view(
            'backend.v_cerita_alumni.create',
            compact('alumnis')
        );
    }

    /**
     * Menyimpan cerita baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumni_id' => 'required|exists:alumni,id',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cerita' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'alumni_id.required' => 'Alumni wajib dipilih.',
            'alumni_id.exists' => 'Alumni yang dipilih tidak valid.',
            'foto.required' => 'Foto alumni wajib diupload.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'cerita.required' => 'Cerita alumni wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        $fotoPath = $request->file('foto')
            ->store('cerita-alumni', 'public');

        CeritaAlumni::create([
            'alumni_id' => $request->alumni_id,
            'foto' => $fotoPath,
            'cerita' => $request->cerita,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.cerita-alumni.index')
            ->with('success', 'Cerita alumni berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(CeritaAlumni $ceritaAlumni)
{
    $ceritaAlumni->load('alumni');

    return view(
        'backend.v_cerita_alumni.edit',
        compact('ceritaAlumni')
    );
}

    /**
     * Memperbarui cerita alumni.
     */
    public function update(
    Request $request,
    CeritaAlumni $ceritaAlumni
) {
    $request->validate([
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'cerita' => 'required|string',
        'status' => 'required|boolean',
    ], [
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
        'foto.max' => 'Ukuran foto maksimal 2 MB.',
        'cerita.required' => 'Cerita alumni wajib diisi.',
        'status.required' => 'Status wajib dipilih.',
    ]);

    $fotoPath = $ceritaAlumni->foto;

    if ($request->hasFile('foto')) {

        if ($ceritaAlumni->foto) {
            Storage::disk('public')
                ->delete($ceritaAlumni->foto);
        }

        $fotoPath = $request->file('foto')
            ->store('cerita-alumni', 'public');
    }

    $ceritaAlumni->update([
        'alumni_id' => $ceritaAlumni->alumni_id,
        'foto' => $fotoPath,
        'cerita' => $request->cerita,
        'status' => 1,
    ]);

    return redirect()
        ->route('admin.cerita-alumni.index')
        ->with('success', 'Cerita alumni berhasil diperbarui.');
}

    /**
     * Menghapus cerita alumni.
     */
    public function destroy(CeritaAlumni $ceritaAlumni)
    {
        if ($ceritaAlumni->foto) {
            Storage::disk('public')
                ->delete($ceritaAlumni->foto);
        }

        $ceritaAlumni->delete();

        return redirect()
            ->route('admin.cerita-alumni.index')
            ->with('success', 'Cerita alumni berhasil dihapus.');
    }
}