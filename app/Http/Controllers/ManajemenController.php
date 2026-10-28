<?php

namespace App\Http\Controllers;

class ManajemenController extends Controller
{
    public function dashboard()
    {
        return view('backend.v_manajemen.dashboard');
    }
}