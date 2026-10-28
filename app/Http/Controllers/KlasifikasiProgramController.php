<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiProgram;
use Illuminate\Http\Request;

class KlasifikasiProgramController extends Controller
{
    public function index()
    {
        $klasifikasiPrograms = KlasifikasiProgram::latest()->get();

        return view(
            'backend.v_klasifikasi_program.index',
            compact('klasifikasiPrograms')
        );
    }

    public function create()
    {
        return view('backend.v_klasifikasi_program.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        KlasifikasiProgram::create($data);

        return redirect()
            ->route('admin.klasifikasi-program.index')
            ->with('success', 'Klasifikasi program berhasil ditambahkan.');
    }

    public function edit(KlasifikasiProgram $klasifikasiProgram)
    {
        return view(
            'backend.v_klasifikasi_program.edit',
            compact('klasifikasiProgram')
        );
    }

    public function update(
        Request $request,
        KlasifikasiProgram $klasifikasiProgram
    ) {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        $klasifikasiProgram->update($data);

        return redirect()
            ->route('admin.klasifikasi-program.index')
            ->with('success', 'Klasifikasi program berhasil diperbarui.');
    }

    public function destroy(KlasifikasiProgram $klasifikasiProgram)
    {
        $klasifikasiProgram->delete();

        return redirect()
            ->route('admin.klasifikasi-program.index')
            ->with('success', 'Klasifikasi program berhasil dihapus.');
    }
}