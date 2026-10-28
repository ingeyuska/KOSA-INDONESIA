<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index()
    {
        $aktivitas = Aktivitas::latest('tanggal')->get();

        return view('backend.v_aktivitas.index', compact('aktivitas'));
    }

    public function create()
    {
        return view('backend.v_aktivitas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('aktivitas', 'public');
        }

        Aktivitas::create($data);

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    public function edit(Aktivitas $aktivita)
    {
        return view('backend.v_aktivitas.edit', compact('aktivita'));
    }

    public function update(Request $request, Aktivitas $aktivita)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('aktivitas', 'public');
        }

        $aktivita->update($data);

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function destroy(Aktivitas $aktivita)
    {
        $aktivita->delete();

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}