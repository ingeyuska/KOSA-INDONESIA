<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * ==========================================================
     * DAFTAR SEMUA USER
     * ==========================================================
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('backend.v_user.index', compact('users'));
    }


    /**
     * ==========================================================
     * DAFTAR ADMIN
     * ==========================================================
     */
    public function admin()
    {
        $users = User::whereIn('role', [
            'admin',
            'super_admin'
        ])
        ->latest()
        ->get();

        return view(
            'backend.v_user.admin',
            compact('users')
        );
    }


    /**
     * ==========================================================
     * DAFTAR MANAJEMEN KOICA
     * ==========================================================
     */
    public function manajemen()
    {
        $users = User::where('role', 'manajemen')
            ->latest()
            ->get();

        return view(
            'backend.v_user.manajemen',
            compact('users')
        );
    }


    /**
     * ==========================================================
     * DAFTAR ALUMNI
     * ==========================================================
     */
    public function alumni()
    {
        $users = User::where('role', 'alumni')
            ->latest()
            ->get();

        return view(
            'backend.v_user.alumni',
            compact('users')
        );
    }


    /**
     * ==========================================================
     * DAFTAR MEMBER / MASYARAKAT
     * ==========================================================
     */
    public function member()
    {
        $users = User::where('role', 'member')
            ->latest()
            ->get();

        return view(
            'backend.v_user.member',
            compact('users')
        );
    }


    /**
     * ==========================================================
     * FORM TAMBAH USER
     * ==========================================================
     */
    public function create()
    {
        return view('backend.v_user.create');
    }


    /**
     * ==========================================================
     * SIMPAN USER
     * ==========================================================
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'string',
                'min:6'
            ],

            'role' => [
                'required',
                'in:admin,super_admin,manajemen,alumni,member'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20'
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'bio' => [
                'nullable',
                'string'
            ],

            'status' => [
                'required',
                'in:aktif,tidak_aktif'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GENERATE MEMBER ID
        |--------------------------------------------------------------------------
        |
        | Alumni    = A-XXXXX
        | Member    = G-XXXXX
        |
        | Manajemen dan Admin tidak mendapatkan member_id.
        |
        */

        do {

            if ($data['role'] === 'alumni') {

                $memberId = 'A-' . str_pad(
                    random_int(0, 99999),
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            } elseif ($data['role'] === 'member') {

                $memberId = 'G-' . str_pad(
                    random_int(0, 99999),
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            } else {

                $memberId = null;
            }

        } while (
            $memberId &&
            User::where('member_id', $memberId)->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        $data['password'] = Hash::make(
            $data['password']
        );


        /*
        |--------------------------------------------------------------------------
        | MEMBER ID
        |--------------------------------------------------------------------------
        */

        $data['member_id'] = $memberId;


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('users', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER
        |--------------------------------------------------------------------------
        */

        User::create($data);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT SESUAI ROLE
        |--------------------------------------------------------------------------
        */

        if ($data['role'] === 'alumni') {

            return redirect()
                ->route('admin.users.alumni')
                ->with(
                    'success',
                    'Alumni berhasil ditambahkan.'
                );
        }


        if ($data['role'] === 'member') {

            return redirect()
                ->route('admin.users.member')
                ->with(
                    'success',
                    'Member berhasil ditambahkan.'
                );
        }


        if ($data['role'] === 'manajemen') {

            return redirect()
                ->route('admin.users.manajemen')
                ->with(
                    'success',
                    'Manajemen KOICA berhasil ditambahkan.'
                );
        }


        if (
            $data['role'] === 'admin' ||
            $data['role'] === 'super_admin'
        ) {

            return redirect()
                ->route('admin.users.admin')
                ->with(
                    'success',
                    'Admin berhasil ditambahkan.'
                );
        }


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    /**
     * ==========================================================
     * FORM EDIT USER
     * ==========================================================
     */
    public function edit(User $user)
    {
        return view(
            'backend.v_user.edit',
            compact('user')
        );
    }


    /**
     * ==========================================================
     * UPDATE USER
     * ==========================================================
     */
    public function update(
        Request $request,
        User $user
    ) {

        $data = $request->validate([

            'nama' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id
            ],

            'password' => [
                'nullable',
                'string',
                'min:6'
            ],

            'role' => [
                'required',
                'in:admin,super_admin,manajemen,alumni,member'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20'
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'bio' => [
                'nullable',
                'string'
            ],

            'status' => [
                'required',
                'in:aktif,tidak_aktif'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!empty($data['password'])) {

            $data['password'] = Hash::make(
                $data['password']
            );

        } else {

            unset($data['password']);
        }


        /*
        |--------------------------------------------------------------------------
        | MEMBER ID
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $data['role'],
                ['alumni', 'member']
            )
            && empty($user->member_id)
        ) {

            do {

                $prefix =
                    $data['role'] === 'alumni'
                    ? 'A-'
                    : 'G-';

                $memberId = $prefix . str_pad(
                    random_int(0, 99999),
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            } while (
                User::where(
                    'member_id',
                    $memberId
                )->exists()
            );


            $data['member_id'] = $memberId;
        }


        /*
        |--------------------------------------------------------------------------
        | KALAU ROLE BUKAN ALUMNI / MEMBER
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $data['role'],
                ['admin', 'super_admin', 'manajemen']
            )
        ) {

            $data['member_id'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            if ($user->foto) {

                Storage::disk('public')
                    ->delete($user->foto);
            }


            $data['foto'] = $request
                ->file('foto')
                ->store('users', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $user->update($data);


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }


    /**
     * ==========================================================
     * HAPUS USER
     * ==========================================================
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Akun yang sedang digunakan tidak dapat dihapus.'
                );
        }


        if ($user->foto) {

            Storage::disk('public')
                ->delete($user->foto);
        }


        $user->delete();


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }


    /**
     * ==========================================================
     * FORM TAMBAH ADMIN
     * ==========================================================
     */
    public function createAdmin()
    {
        return view(
            'backend.v_user.create',
            [
                'role' => 'admin'
            ]
        );
    }


    /**
     * ==========================================================
     * FORM TAMBAH MANAJEMEN
     * ==========================================================
     */
    public function createManajemen()
    {
        return view(
            'backend.v_user.create',
            [
                'role' => 'manajemen'
            ]
        );
    }


    /**
     * ==========================================================
     * FORM TAMBAH ALUMNI
     * ==========================================================
     */
    public function createAlumni()
    {
        return view(
            'backend.v_user.create',
            [
                'role' => 'alumni'
            ]
        );
    }


    /**
     * ==========================================================
     * FORM TAMBAH MEMBER
     * ==========================================================
     */
    public function createMember()
    {
        return view(
            'backend.v_user.create',
            [
                'role' => 'member'
            ]
        );
    }
}