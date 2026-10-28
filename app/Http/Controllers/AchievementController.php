<?php

namespace App\Http\Controllers;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $alumni = Auth::user()->alumni;

        $achievements = $alumni
            ? $alumni->achievements()->latest('tahun')->get()
            : collect();

        return view('frontend.achievement', compact(
            'alumni',
            'achievements'
        ));
    }
}