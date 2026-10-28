<?php

namespace App\Http\Controllers;

use App\Models\ProgramMaster;
use Illuminate\Http\Request;

class ProgramMasterController extends Controller
{
    public function index()
    {
        $programs = ProgramMaster::latest()->get();

        return view(
            'backend.v_programmaster.index',
            compact('programs')
        );
    }

    public function create()
    {
        return view('backend.v_programmaster.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        ProgramMaster::create($data);

        return redirect()
            ->route('admin.program-master.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(ProgramMaster $programMaster)
    {
        return view(
            'backend.v_programmaster.edit',
            [
                'program' => $programMaster
            ]
        );
    }

    public function update(
        Request $request,
        ProgramMaster $programMaster
    ) {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        $programMaster->update($data);

        return redirect()
            ->route('admin.program-master.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(ProgramMaster $programMaster)
    {
        $programMaster->delete();

        return redirect()
            ->route('admin.program-master.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}