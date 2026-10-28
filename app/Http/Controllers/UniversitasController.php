<?php

namespace App\Http\Controllers;

use App\Models\Universitas;
use Illuminate\Http\Request;

class UniversitasController extends Controller
{
    /**
     * Menampilkan daftar universitas
     */
    public function index()
    {
        $universitas = Universitas::orderBy('nama_universitas', 'asc')
            ->get();

        return view(
            'backend.v_universitas.index',
            compact('universitas')
        );
    }


    /**
     * Form tambah universitas
     */
    public function create()
    {
        return view('backend.v_universitas.create');
    }


    /**
     * Menyimpan universitas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_universitas' => [
                'required',
                'string',
                'max:255',
                'unique:universitas,nama_universitas',
            ],
        ], [
            'nama_universitas.required' =>
                'Nama universitas wajib diisi.',

            'nama_universitas.unique' =>
                'Nama universitas sudah terdaftar.',
        ]);

        Universitas::create([
            'nama_universitas' => $request->nama_universitas,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()
            ->route('admin.universitas.index')
            ->with(
                'success',
                'Universitas berhasil ditambahkan.'
            );
    }


    /**
     * Form edit universitas
     */
    public function edit(Universitas $universita)
    {
        return view(
            'backend.v_universitas.edit',
            compact('universita')
        );
    }


    /**
     * Update universitas
     */
    public function update(
        Request $request,
        Universitas $universita
    ) {
        $request->validate([
            'nama_universitas' => [
                'required',
                'string',
                'max:255',
                'unique:universitas,nama_universitas,' . $universita->id,
            ],
        ], [
            'nama_universitas.required' =>
                'Nama universitas wajib diisi.',

            'nama_universitas.unique' =>
                'Nama universitas sudah terdaftar.',
        ]);

        $universita->update([
            'nama_universitas' => $request->nama_universitas,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()
            ->route('admin.universitas.index')
            ->with(
                'success',
                'Universitas berhasil diperbarui.'
            );
    }


    /**
     * Menghapus universitas
     */
    public function destroy(Universitas $universita)
    {
        // Cek apakah universitas masih digunakan oleh alumni
        if ($universita->alumnis()->exists()) {

            return redirect()
                ->route('admin.universitas.index')
                ->with(
                    'error',
                    'Universitas tidak dapat dihapus karena masih digunakan oleh data alumni.'
                );
        }

        $universita->delete();

        return redirect()
            ->route('admin.universitas.index')
            ->with(
                'success',
                'Universitas berhasil dihapus.'
            );
    }
}