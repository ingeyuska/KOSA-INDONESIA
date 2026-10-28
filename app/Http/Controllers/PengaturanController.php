<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    /**
     * Menampilkan pengaturan KOSA
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();

        // Jika belum ada data, buat data kosong
        if (!$pengaturan) {
            $pengaturan = Pengaturan::create([
                'nama_kosa' => 'KOSA Indonesia',
            ]);
        }

        return view('backend.pengaturan.index', compact('pengaturan'));
    }

    /**
     * Form edit pengaturan
     */
    public function edit()
    {
        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            $pengaturan = Pengaturan::create([
                'nama_kosa' => 'KOSA Indonesia',
            ]);
        }

        return view('backend.pengaturan.edit', compact('pengaturan'));
    }

    /**
     * Update pengaturan
     */
    public function update(Request $request)
    {
        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            $pengaturan = new Pengaturan();
        }

       $request->validate([
            'nama_kosa' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:1024',
            'deskripsi' => 'nullable|string',
            'telepon' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'pesan_ketua' => 'nullable|string',

            'visi' => 'nullable|string',
            'misi' => 'nullable|string',

            'deskripsi_footer' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->except([
            'logo',
            'favicon',
        ]);

        // =========================
        // LOGO
        // =========================
        if ($request->hasFile('logo')) {

            if ($pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('pengaturan', 'public');
        }

        // =========================
        // FAVICON
        // =========================
        if ($request->hasFile('favicon')) {

            if ($pengaturan->favicon) {
                Storage::disk('public')->delete($pengaturan->favicon);
            }

            $data['favicon'] = $request->file('favicon')
                ->store('pengaturan', 'public');
        }

        $pengaturan->fill($data);
        $pengaturan->save();

        return redirect()
            ->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan KOSA berhasil diperbarui.');
    }
}