<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    /**
     * Menampilkan data Tentang KOSA
     */
    public function index()
    {
        $tentangs = Tentang::latest()->get();

        return view('backend.v_tentang.index', compact('tentangs'));
    }

    /**
     * Form tambah Tentang
     */
    public function create()
    {
        return view('backend.v_tentang.create');
    }

    /**
     * Simpan Tentang
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('tentang', 'public');
        }

        Tentang::create($data);

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Data Tentang KOSA berhasil ditambahkan.');
    }

    /**
     * Form edit Tentang
     */
    public function edit(Tentang $tentang)
    {
        return view('backend.v_tentang.edit', compact('tentang'));
    }

    /**
     * Update Tentang
     */
    public function update(Request $request, Tentang $tentang)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {

            if ($tentang->foto) {
                Storage::disk('public')->delete($tentang->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('tentang', 'public');
        }

        $tentang->update($data);

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Data Tentang KOSA berhasil diperbarui.');
    }

    /**
     * Hapus Tentang
     */
    public function destroy(Tentang $tentang)
    {
        if ($tentang->foto) {
            Storage::disk('public')->delete($tentang->foto);
        }

        $tentang->delete();

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Data Tentang KOSA berhasil dihapus.');
    }
}