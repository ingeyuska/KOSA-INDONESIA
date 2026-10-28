<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Berita;
use App\Models\Aktivitas;
use App\Models\Event;
use App\Models\PesanKontak;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAlumni = Alumni::count();
        $jumlahBerita = Berita::count();
        $jumlahAktivitas = Aktivitas::count();
        $jumlahEvent = Event::count();
        $jumlahPesanBaru = PesanKontak::where('status', 'baru')->count();

        return view('backend.v_Dashboard.index', compact(
            'jumlahAlumni',
            'jumlahBerita',
            'jumlahAktivitas',
            'jumlahPesanBaru',
            'jumlahEvent'
        ));
    }
}