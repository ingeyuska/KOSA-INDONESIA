<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManajemenProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('backend.v_manajemen.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('backend.v_manajemen.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->nama = $data['nama'];
        $user->no_hp = $data['no_hp'] ?? null;
        $user->bio = $data['bio'] ?? null;

        if ($request->hasFile('foto')) {
            $user->foto = $request->file('foto')
                ->store('profile', 'public');
        }

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()
            ->route('manajemen.profile.index')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}