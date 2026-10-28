<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Visitor;
use App\Models\Pengaturan;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DATA UNTUK LAYOUT FRONTEND
        |--------------------------------------------------------------------------
        */

        View::composer('frontend.v_layouts.*', function ($view) {

            /*
            |--------------------------------------------------------------------------
            | PENGATURAN KOSA
            |--------------------------------------------------------------------------
            */

            $pengaturan = Pengaturan::first();


            /*
            |--------------------------------------------------------------------------
            | STATISTIK PENGUNJUNG
            |--------------------------------------------------------------------------
            */

            $totalPengunjung = Visitor::count();

            $pengunjungHariIni = Visitor::whereDate(
                'visit_date',
                Carbon::today()
            )->count();

            $pengunjungBulanIni = Visitor::whereYear(
                'visit_date',
                Carbon::now()->year
            )
            ->whereMonth(
                'visit_date',
                Carbon::now()->month
            )
            ->count();

            $pengunjungBulanLalu = Visitor::whereYear(
                'visit_date',
                Carbon::now()->subMonth()->year
            )
            ->whereMonth(
                'visit_date',
                Carbon::now()->subMonth()->month
            )
            ->count();


            /*
            |--------------------------------------------------------------------------
            | PERSENTASE PENGUNJUNG
            |--------------------------------------------------------------------------
            */

            if ($pengunjungBulanLalu > 0) {

                $persentasePengunjung = round(
                    (
                        ($pengunjungBulanIni - $pengunjungBulanLalu)
                        / $pengunjungBulanLalu
                    ) * 100
                );

            } else {

                $persentasePengunjung = 0;

            }


            /*
            |--------------------------------------------------------------------------
            | KIRIM DATA KE VIEW
            |--------------------------------------------------------------------------
            */

            $view->with([

                // Pengaturan KOSA
                'pengaturan' => $pengaturan,

                // Statistik pengunjung
                'totalPengunjung' => $totalPengunjung,
                'pengunjungHariIni' => $pengunjungHariIni,
                'pengunjungBulanIni' => $pengunjungBulanIni,
                'persentasePengunjung' => $persentasePengunjung,

            ]);

        });
    }
}
