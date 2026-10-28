<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Berita;
use App\Models\Event;
use App\Models\CeritaAlumni;
use App\Models\Pengurus;
use App\Models\Tentang;
use App\Models\Banner;
use App\Models\Pengaturan;
use App\Models\Visitor;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // =========================
        // STATISTIK ALUMNI
        // =========================

        $totalAlumni = Alumni::count();

        $totalDegree = Alumni::where('program', 'Degree')->count();

        $totalShortCourse = Alumni::where('program', 'Short Course')->count();

        $totalPengunjung = Visitor::count();


        // =========================
        // BANNER
        // =========================

        $banners = Banner::where('status', 'aktif')
            ->orderBy('urutan', 'asc')
            ->get();


        // =========================
        // STATISTIK PENGUNJUNG
        // =========================

        $pengunjungHariIni = Visitor::whereDate(
            'visit_date',
            Carbon::today()
        )->count();

        $pengunjungBulanIni = Visitor::whereYear(
            'visit_date',
            Carbon::now()->year
        )->whereMonth(
            'visit_date',
            Carbon::now()->month
        )->count();

        $pengunjungBulanLalu = Visitor::whereYear(
            'visit_date',
            Carbon::now()->subMonth()->year
        )->whereMonth(
            'visit_date',
            Carbon::now()->subMonth()->month
        )->count();

        if ($pengunjungBulanLalu > 0) {

            $persentasePengunjung = round(
                (($pengunjungBulanIni - $pengunjungBulanLalu)
                    / $pengunjungBulanLalu) * 100
            );

        } else {

            $persentasePengunjung = 0;

        }


        // =========================
        // BERITA
        // =========================

        $beritas = Berita::where('status', 'published')
            ->orderByDesc('tanggal_publish')
            ->take(3)
            ->get();


        // =========================
        // EVENT
        // =========================

        $events = Event::where(
            'tanggal',
            '>=',
            now()->toDateString()
        )
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();


        // =========================
        // CERITA ALUMNI
        // =========================

        $ceritaAlumnis = CeritaAlumni::with('alumni')
            ->where('status', true)
            ->latest()
            ->take(3)
            ->get();


        // =========================
        // PENGURUS KOSA
        // =========================

        $pengurus = Pengurus::where('status', true)
            ->orderBy('urutan', 'asc')
            ->get();


        // =========================
        // KETUA KOSA
        // =========================

        $ketua = Pengurus::where('status', true)
            ->orderBy('urutan', 'asc')
            ->first();


        // =========================
        // TENTANG KOSA
        // =========================

        $tentang = Tentang::latest()->first();


        // =========================
        // PENGATURAN WEBSITE
        // =========================

        $pengaturan = Pengaturan::first();


        // =========================
        // KIRIM KE BERANDA
        // =========================

        return view('frontend.index', compact(
            'totalAlumni',
            'totalDegree',
            'totalShortCourse',
            'banners',

            // STATISTIK PENGUNJUNG
            'totalPengunjung',
            'pengunjungHariIni',
            'pengunjungBulanIni',
            'persentasePengunjung',

            // DATA BERANDA
            'beritas',
            'events',
            'ceritaAlumnis',
            'pengurus',
            'ketua',
            'tentang',
            'pengaturan'
        ));
    }
}