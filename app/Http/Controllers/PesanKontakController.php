<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::latest()->get();

        return view('backend.v_pesankontak.index', compact('pesan'));
    }

    public function create()
    {
        $pengaturan = Pengaturan::first();

        return view('frontend.kontak', compact('pengaturan'));
    }

    public function show(PesanKontak $pesanKontak)
    {
        return view('backend.v_pesankontak.show', compact('pesanKontak'));
    }

    public function updateStatus(Request $request, PesanKontak $pesanKontak)
    {
        $data = $request->validate([
            'status' => 'required|in:baru,dibaca,dibalas',
        ]);

        $pesanKontak->update($data);

        return redirect()
            ->route('admin.pesan-kontak.index')
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function destroy(PesanKontak $pesanKontak)
    {
        $pesanKontak->delete();

        return redirect()
            ->route('admin.pesan-kontak.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'subjek' => $data['subjek'],
            'pesan' => $data['pesan'],
            'status' => 'baru',
        ]);

        return redirect()
            ->route('kontak')
            ->with('success', 'Pesan berhasil dikirim. Terima kasih telah menghubungi KOSA Indonesia.');
    }
}