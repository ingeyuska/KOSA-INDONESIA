<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();

        return view('backend.v_berita.index', compact('berita'));
    }

    public function create()
    {
        return view('backend.v_berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
        ]);

        // Buat slug
        $slug = Str::slug($data['judul']);
        $originalSlug = $slug;
        $count = 1;

        // Pastikan slug tidak duplikat
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        // Upload gambar cover
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $beritum)
    {
        return view('backend.v_berita.edit', [
            'berita' => $beritum
        ]);
    }

   public function update(Request $request, Berita $beritum)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
        ]);

        // Buat slug
        $slug = Str::slug($data['judul']);
        $originalSlug = $slug;
        $count = 1;

        // Cek slug berita lain, bukan berita yang sedang diedit
        while (
            Berita::where('slug', $slug)
                ->where('id', '!=', $beritum->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        $beritum->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

      /**
     * Upload gambar dari CKEditor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('upload')
            ->store('berita', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
    /**
 * Halaman berita frontend
 */
public function indexFrontend()
{
    $berita = Berita::where('status', 'published')
        ->orderByDesc('created_at')
        ->paginate(6);

    return view('frontend.berita', compact('berita'));
}


/**
 * Detail berita frontend
 */
public function showFrontend(Berita $berita)
{
    abort_if($berita->status !== 'published', 404);

    return view('frontend.berita-detail', compact('berita'));
}
}