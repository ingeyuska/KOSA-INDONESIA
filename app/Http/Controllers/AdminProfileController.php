<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    /**
     * Menampilkan profile admin yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        return view('backend.v_profile.index', compact('user'));
    }

    /**
     * Form edit profile admin.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('backend.v_profile.edit', compact('user'));
    }

    /**
     * Update profile admin.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'no_hp' => 'nullable|string|max:20',

            'foto' => 'nullable|image|max:2048',

            'bio' => 'nullable|string',

            /*
            |--------------------------------------------------------------------------
            | PASSWORD
            |--------------------------------------------------------------------------
            */

            'password' => 'nullable|string|min:8',

            'password_confirmation' => [
                'nullable',
                'required_with:password',
                'same:password',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request
                ->file('foto')
                ->store('users', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Password
        |--------------------------------------------------------------------------
        */

        if (!empty($data['password'])) {

            $data['password'] = Hash::make($data['password']);

        } else {

            // Password kosong = jangan ubah password lama
            unset($data['password']);
        }

        /*
        |--------------------------------------------------------------------------
        | Jangan simpan password_confirmation
        |--------------------------------------------------------------------------
        */

        unset($data['password_confirmation']);

        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $user->update($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}