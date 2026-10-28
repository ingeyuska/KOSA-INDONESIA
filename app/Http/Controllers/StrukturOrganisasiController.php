<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $struktur = StrukturOrganisasi::first();

        return view('backend.v_struktur_organisasi.index', compact('struktur'));
    }

    public function publicIndex()
    {
        $struktur = StrukturOrganisasi::first();

        return view('frontend.struktur-organisasi', compact('struktur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $struktur = StrukturOrganisasi::first();

        // Hapus gambar lama jika ada
        if ($struktur && $struktur->gambar) {
            Storage::disk('public')->delete($struktur->gambar);
        }

        // Upload gambar baru
        $gambarPath = $request->file('gambar')->store(
            'struktur-organisasi',
            'public'
        );

        // Jika belum ada data, buat baru
        if (!$struktur) {
            StrukturOrganisasi::create([
                'gambar' => $gambarPath,
            ]);
        } else {
            $struktur->update([
                'gambar' => $gambarPath,
            ]);
        }

        return redirect()
            ->route('admin.struktur-organisasi.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }
}