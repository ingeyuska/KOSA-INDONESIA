<?php

namespace App\Http\Controllers;

use App\Models\JenisKeilmuan;
use Illuminate\Http\Request;

class JenisKeilmuanController extends Controller
{
    public function index()
    {
        $jenisKeilmuans = JenisKeilmuan::latest()->get();

        return view(
            'backend.v_jeniskeilmuan.index',
            compact('jenisKeilmuans')
        );
    }

    public function create()
    {
        return view('backend.v_jeniskeilmuan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        JenisKeilmuan::create($data);

        return redirect()
            ->route('admin.jenis-keilmuan.index')
            ->with('success', 'Jenis keilmuan berhasil ditambahkan.');
    }

    public function edit(JenisKeilmuan $jenis_keilmuan)
    {
        return view(
            'backend.v_jeniskeilmuan.edit',
            compact('jenis_keilmuan')
        );
    }

    public function update(
        Request $request,
        JenisKeilmuan $jenis_keilmuan
    ) {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'aktif' => 'required|boolean',
        ]);

        $jenis_keilmuan->update($data);

        return redirect()
            ->route('admin.jenis-keilmuan.index')
            ->with('success', 'Jenis keilmuan berhasil diperbarui.');
    }

    public function destroy(JenisKeilmuan $jenis_keilmuan)
    {
        $jenis_keilmuan->delete();

        return redirect()
            ->route('admin.jenis-keilmuan.index')
            ->with('success', 'Jenis keilmuan berhasil dihapus.');
    }
}