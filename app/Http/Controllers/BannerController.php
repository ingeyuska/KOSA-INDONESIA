<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Menampilkan daftar banner
     */
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();

        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Form tambah banner
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Simpan banner
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $foto = $request->file('foto')->store('banners', 'public');

        Banner::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
            'urutan' => $request->urutan,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Form edit banner
     */
    public function edit(Banner $banner)
    {
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update banner
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan,
            'status' => $request->status,
        ];

        // Jika admin mengganti foto
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($banner->foto && Storage::disk('public')->exists($banner->foto)) {
                Storage::disk('public')->delete($banner->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Hapus banner
     */
    public function destroy(Banner $banner)
    {
        if ($banner->foto && Storage::disk('public')->exists($banner->foto)) {
            Storage::disk('public')->delete($banner->foto);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}