<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN FRONTEND
    |--------------------------------------------------------------------------
    */

    // Halaman login Alumni / Member
    public function loginFrontend()
    {
        return view('frontend.login');
    }


    // Proses login Alumni / Member
    public function prosesLoginFrontend(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK EMAIL TERLEBIH DAHULU
        |--------------------------------------------------------------------------
        */

        $user = \App\Models\User::where('email', $data['email'])->first();

        // Email tidak ditemukan
        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email'));
        }

        // Password salah
        if (!Auth::validate([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email'));
        }

        /*
        |--------------------------------------------------------------------------
        | CEK STATUS AKUN
        |--------------------------------------------------------------------------
        */

        if ($user->status !== 'aktif') {
            return back()
                ->withErrors([
                    'email' => 'Akun Anda tidak aktif.',
                ])
                ->withInput($request->only('email'));
        }

        /*
        |--------------------------------------------------------------------------
        | CEK VERIFIKASI EMAIL
        |--------------------------------------------------------------------------
        */

        if (!$user->hasVerifiedEmail()) {

            return back()
                ->withErrors([
                    'email' => 'Email Anda belum diverifikasi. Silakan cek email Anda terlebih dahulu.',
                ])
                ->withInput($request->only('email'));
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        // Alumni
        if ($user->role === 'alumni') {
            return redirect()->route('alumni.dashboard');
        }

        // Member
        if ($user->role === 'member') {
            return redirect()->route('member.dashboard');
        }

        // Admin tidak boleh login melalui frontend
        Auth::logout();

        return back()
            ->withErrors([
                'email' => 'Silakan gunakan halaman login administrator.',
            ])
            ->withInput($request->only('email'));
    }


    /*
|--------------------------------------------------------------------------
| LOGIN ADMIN / SUPER ADMIN / MANAJEMEN
|--------------------------------------------------------------------------
*/

public function login()
{
    return view('backend.v_login.login');
}


public function prosesLogin(Request $request)
{
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'email' => $data['email'],
        'password' => $data['password'],
        'status' => 'aktif',
    ])) {

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | MANAJEMEN KOICA
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'manajemen') {
            return redirect()->route('manajemen.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE LAIN TIDAK BOLEH MASUK BACKEND
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        return back()
            ->withErrors([
                'email' => 'Akun tidak memiliki akses ke halaman administrator.',
            ])
            ->withInput($request->only('email'));
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password salah.',
        ])
        ->withInput($request->only('email'));
}


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}