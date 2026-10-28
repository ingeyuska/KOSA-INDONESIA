<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    /**
     * Menampilkan daftar pengurus.
     */
    public function index()
    {
        $pengurus = Pengurus::orderBy('urutan', 'asc')
            ->latest()
            ->get();

        return view(
            'backend.v_pengurus.index',
            compact('pengurus')
        );
    }


    /**
     * Menampilkan form tambah pengurus.
     */
    public function create()
    {
        return view('backend.v_pengurus.create');
    }


    /**
     * Menyimpan pengurus baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'status.required' => 'Status wajib dipilih.',
        ]);


        // =========================
        // UPLOAD FOTO
        // =========================

        $fotoPath = null;

        if ($request->hasFile('foto')) {

            $fotoPath = $request->file('foto')
                ->store('pengurus', 'public');
        }


        // =========================
        // SIMPAN DATA
        // =========================

        Pengurus::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'urutan' => $request->urutan,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan.');
    }


    /**
     * Menampilkan form edit.
     */
    public function edit(Pengurus $pengurus)
    {
        return view(
            'backend.v_pengurus.edit',
            compact('pengurus')
        );
    }


    /**
     * Memperbarui pengurus.
     */
    public function update(
        Request $request,
        Pengurus $pengurus
    ) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'status.required' => 'Status wajib dipilih.',
        ]);


        // =========================
        // FOTO LAMA
        // =========================

        $fotoPath = $pengurus->foto;


        // =========================
        // FOTO BARU
        // =========================

        if ($request->hasFile('foto')) {

            if ($pengurus->foto) {

                Storage::disk('public')
                    ->delete($pengurus->foto);
            }


            $fotoPath = $request->file('foto')
                ->store('pengurus', 'public');
        }


        // =========================
        // UPDATE
        // =========================

        $pengurus->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'urutan' => $request->urutan,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diperbarui.');
    }


    /**
     * Menghapus pengurus.
     */
    public function destroy(Pengurus $pengurus)
    {
        // Hapus foto
        if ($pengurus->foto) {

            Storage::disk('public')
                ->delete($pengurus->foto);
        }


        // Hapus data
        $pengurus->delete();


        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil dihapus.');
    }
}