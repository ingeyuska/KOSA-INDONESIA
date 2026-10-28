<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('foto')
            ->latest('tanggal')
            ->get();

        return view('backend.v_galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('backend.v_galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:draft,published',

            'foto' => 'required|array|min:1',
            'foto.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | BUAT SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($data['judul']);
        $originalSlug = $slug;
        $count = 1;

        while (Galeri::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA GALERI
        |--------------------------------------------------------------------------
        */

        $galeri = Galeri::create([
            'judul' => $data['judul'],
            'slug' => $slug,
            'deskripsi' => $data['deskripsi'] ?? null,
            'tanggal' => $data['tanggal'] ?? null,
            'status' => $data['status'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO
        |--------------------------------------------------------------------------
        */

        foreach ($request->file('foto') as $file) {

            $path = $file->store('galeri', 'public');

            $galeri->foto()->create([
                'file_foto' => $path,
            ]);
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $galeri->load('foto');

        return view('backend.v_galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'required|in:draft,published',

            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($data['judul']);
        $originalSlug = $slug;
        $count = 1;

        while (
            Galeri::where('slug', $slug)
                ->where('id', '!=', $galeri->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA GALERI
        |--------------------------------------------------------------------------
        */

        $galeri->update([
            'judul' => $data['judul'],
            'slug' => $slug,
            'deskripsi' => $data['deskripsi'] ?? null,
            'tanggal' => $data['tanggal'] ?? null,
            'status' => $data['status'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAMBAH FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            foreach ($request->file('foto') as $file) {

                $path = $file->store('galeri', 'public');

                $galeri->foto()->create([
                    'file_foto' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->load('foto');

        foreach ($galeri->foto as $foto) {

            if (Storage::disk('public')->exists($foto->file_foto)) {
                Storage::disk('public')->delete($foto->file_foto);
            }
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    public function destroyFoto($id)
    {
        $foto = \App\Models\GaleriFoto::findOrFail($id);

        if (Storage::disk('public')->exists($foto->file_foto)) {
            Storage::disk('public')->delete($foto->file_foto);
        }

        $galeriId = $foto->galeri_id;

        $foto->delete();

        return redirect()
            ->route('admin.galeri.edit', $galeriId)
            ->with('success', 'Foto berhasil dihapus.');
    }

    public function show(Galeri $galeri)
    {
        $galeri->load('foto');

        return view(
            'backend.v_galeri.show',
            compact('galeri')
        );
    }

    public function showFrontend(Galeri $galeri)
    {
        $galeri->load('foto');

        return view(
            'frontend.galeri-detail',
            compact('galeri')
        );
    }
}