@extends('frontend.alumni.layouts.app')

@section('title', 'Dashboard Alumni - KOSA Indonesia')

@section('content')

<section class="kosa-alumni-dashboard">

    <div class="container">

        {{-- =====================================================
            WELCOME
        ====================================================== --}}

        <div class="kosa-dashboard-welcome">

            <div>

                <span class="kosa-dashboard-label">
                    PORTAL ALUMNI
                </span>

                <h1>
                    Selamat datang,
                    <strong>
                        {{ Auth::user()->nama ?? 'Alumni' }}
                    </strong>
                </h1>

                <p>
                    Kelola profil alumni, ikuti kegiatan KOSA,
                    dan tetap terhubung dengan jaringan alumni KOSA Indonesia.
                </p>

            </div>


            <div class="kosa-alumni-id">

                <span>ID ALUMNI</span>

                <strong>
                    {{ Auth::user()->alumni?->alumni_id ?? 'A-XXXXX' }}
                </strong>

            </div>

        </div>


        {{-- =====================================================
            STATISTIK
        ====================================================== --}}

        <div class="row kosa-dashboard-statistics">


            {{-- PROFIL --}}

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="kosa-dashboard-card">

                    <div class="kosa-dashboard-card-icon">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div>

                        <span>
                            Kelengkapan Profil
                        </span>

                        <strong>
                            {{ $profileProgress }}%
                        </strong>

                    </div>

                </div>

            </div>


            {{-- EVENT --}}

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="kosa-dashboard-card">

                    <div class="kosa-dashboard-card-icon">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <div>

                        <span>
                            Event Diikuti
                        </span>

                        <strong>
                            {{ $jumlahEvent }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- SERTIFIKAT --}}

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="kosa-dashboard-card">

                    <div class="kosa-dashboard-card-icon">

                        <i class="fa-solid fa-certificate"></i>

                    </div>

                    <div>

                        <span>
                            Sertifikat
                        </span>

                        <strong>
                            {{ $jumlahSertifikat }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            PENGINGAT EVENT
        ====================================================== --}}

        @if($eventPengingat->count() > 0)

            <div class="kosa-event-reminder">


                {{-- HEADER --}}

                <div class="kosa-event-reminder-header">

                    <div class="kosa-event-reminder-heading">

                        <div class="kosa-event-reminder-icon">

                            <i class="fa-solid fa-bell"></i>

                        </div>


                        <div>

                            <span>
                                PENGINGAT EVENT
                            </span>

                            <h3>
                                Event Anda
                            </h3>

                            <p>
                                Anda sudah terdaftar pada event
                                yang akan segera berlangsung.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('alumni.event') }}"
                        class="kosa-event-see-all"
                    >

                        Lihat Semua Event

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>



                {{-- LIST EVENT --}}

                @foreach($eventPengingat as $pendaftaran)

                    @php

                        $event = $pendaftaran->event;

                        if (!$event) {
                            continue;
                        }

                        $tanggalEvent = \Carbon\Carbon::parse(
                            $event->tanggal
                        )->startOfDay();

                        $hariLagi = now()
                            ->startOfDay()
                            ->diffInDays(
                                $tanggalEvent,
                                false
                            );

                    @endphp


                    <div class="kosa-event-reminder-item">


                        {{-- FOTO EVENT --}}

                        <div class="kosa-event-reminder-image">

                            @if($event->foto)

                                <img
                                    src="{{ asset('storage/' . $event->foto) }}"
                                    alt="{{ $event->judul }}"
                                >

                            @else

                                <div class="kosa-event-no-image">

                                    <i class="fa-solid fa-calendar-days"></i>

                                </div>

                            @endif

                        </div>



                        {{-- INFORMASI EVENT --}}

                        <div class="kosa-event-reminder-info">

                            <h4>
                                {{ $event->judul }}
                            </h4>


                            <div class="kosa-event-meta">

                                <span>

                                    <i class="fa-regular fa-calendar"></i>

                                    {{ $tanggalEvent->translatedFormat('d F Y') }}

                                </span>


                                @if($event->waktu)

                                    <span>

                                        <i class="fa-regular fa-clock"></i>

                                        {{ $event->waktu }}

                                    </span>

                                @endif


                                @if($event->lokasi)

                                    <span>

                                        <i class="fa-solid fa-location-dot"></i>

                                        {{ $event->lokasi }}

                                    </span>

                                @endif

                            </div>


                            <div class="kosa-event-registered">

                                <i class="fa-solid fa-check"></i>

                                Anda sudah terdaftar

                            </div>

                        </div>



                        {{-- COUNTDOWN --}}

                        <div class="kosa-event-reminder-right">


                            <div class="kosa-event-countdown">

                                <div class="kosa-event-countdown-icon">

                                    @if($hariLagi == 0)

                                        <i class="fa-solid fa-bolt"></i>

                                    @else

                                        <i class="fa-regular fa-clock"></i>

                                    @endif

                                </div>


                                <div>

                                    @if($hariLagi == 0)

                                        <strong>
                                            Hari ini
                                        </strong>

                                        <small>
                                            Event berlangsung hari ini
                                        </small>


                                    @elseif($hariLagi == 1)

                                        <strong>
                                            Besok
                                        </strong>

                                        <small>
                                            Jangan lupa persiapkan diri
                                        </small>


                                    @else

                                        <strong>
                                            {{ $hariLagi }} hari lagi
                                        </strong>

                                        <small>
                                            Jangan lupa siapkan diri
                                        </small>

                                    @endif

                                </div>

                            </div>



                            {{-- TOMBOL --}}

                            <a
                                href="{{ route('alumni.event') }}"
                                class="kosa-event-detail-button"
                            >

                                Lihat Event

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif



        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}

        <div class="row">


            {{-- =================================================
                PROFIL ALUMNI
            ================================================== --}}

            <div class="col-lg-8 mb-4">

                <div class="kosa-dashboard-panel">


                    <div class="kosa-panel-header">

                        <div>

                            <span>
                                PROFIL ALUMNI
                            </span>

                            <h3>
                                Lengkapi Data Alumni
                            </h3>

                        </div>

                        <i class="fa-solid fa-id-card"></i>

                    </div>



                    {{-- PROGRESS --}}

                    <div class="kosa-profile-progress">

                        <div class="kosa-progress-top">

                            <span>
                                Kelengkapan data
                            </span>

                            <strong>
                                {{ $profileProgress }}%
                            </strong>

                        </div>


                        <div class="kosa-progress">

                            <div
                                class="kosa-progress-bar"
                                style="width: {{ $profileProgress }}%;"
                            ></div>

                        </div>

                    </div>



                    <p class="kosa-panel-description">

                        Lengkapi data diri dan informasi alumni KOICA
                        untuk mendapatkan profil alumni yang lebih lengkap.

                    </p>



                    <a
                        href="{{ route('alumni.profile') }}"
                        class="kosa-dashboard-button"
                    >

                        Lengkapi Data Diri

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </div>



            {{-- =================================================
                MENU CEPAT
            ================================================== --}}

            <div class="col-lg-4 mb-4">

                <div class="kosa-dashboard-panel kosa-quick-menu">


                    <div class="kosa-panel-header">

                        <div>

                            <span>
                                MENU ALUMNI
                            </span>

                            <h3>
                                Akses Cepat
                            </h3>

                        </div>

                    </div>



                    {{-- DATA DIRI --}}

                    <a href="{{ route('alumni.profile') }}">

                        <span>

                            <i class="fa-solid fa-user"></i>

                            Data Diri

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>



                    {{-- TRACER --}}

                    <a href="{{ route('alumni.tracer') }}">

                        <span>

                            <i class="fa-solid fa-chart-line"></i>

                            Tracer Alumni

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>



                    {{-- CERITA ALUMNI --}}

                    <a href="{{ route('alumni.cerita') }}">

                        <span>

                            <i class="fa-solid fa-comment-dots"></i>

                            Cerita Saya

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>



                    {{-- EVENT --}}

                    <a href="{{ route('alumni.event') }}">

                        <span>

                            <i class="fa-solid fa-calendar-days"></i>

                            Event

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>



                    {{-- SERTIFIKAT --}}

                    <a
                        href="{{ route('alumni.sertifikat') }}"
                        class="{{ request()->routeIs('alumni.sertifikat*') ? 'active' : '' }}"
                    >

                        <span>

                            <i class="fa-solid fa-certificate"></i>

                            Sertifikat

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>



                    {{-- NETWORKING --}}

                    <a href="{{ route('alumni.contribution') }}">

                        <span>

                            <i class="fa-solid fa-handshake"></i>

                            Networking & Kontribusi

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>

                </div>

            </div>

        </div>



        {{-- =====================================================
            INFORMASI
        ====================================================== --}}

        <div class="kosa-dashboard-info">

            <div class="kosa-dashboard-info-icon">

                <i class="fa-solid fa-circle-info"></i>

            </div>


            <div>

                <strong>
                    Tetap terhubung dengan KOSA Indonesia
                </strong>

                <p>

                    Ikuti berbagai kegiatan, informasi, dan
                    kesempatan networking bersama alumni KOSA Indonesia.

                </p>

            </div>

        </div>

    </div>

</section>



<style>

/* =========================================================
   DASHBOARD
========================================================= */

.kosa-alumni-dashboard {

    padding: 60px 0 80px;

    background: #f5f8fc;

    min-height: calc(100vh - 126px);

}


/* =========================================================
   WELCOME
========================================================= */

.kosa-dashboard-welcome {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 42px 46px;

    margin-bottom: 30px;

    border-radius: 18px;

    background: #0d2b52;

    color: #fff;

    box-shadow:
        0 12px 35px rgba(13,43,82,.12);

}


.kosa-dashboard-label {

    display: block;

    margin-bottom: 10px;

    color: rgba(255,255,255,.65);

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1.6px;

}


.kosa-dashboard-welcome h1 {

    margin: 0 0 10px;

    color: #fff;

    font-size: 32px;

    font-weight: 400;

    line-height: 1.3;

}


.kosa-dashboard-welcome h1 strong {

    font-weight: 700;

}


.kosa-dashboard-welcome p {

    margin: 0;

    color: rgba(255,255,255,.75);

    font-size: 14px;

}


.kosa-alumni-id {

    min-width: 165px;

    padding: 18px 24px;

    border-radius: 13px;

    background: rgba(255,255,255,.10);

    text-align: center;

}


.kosa-alumni-id span {

    display: block;

    margin-bottom: 5px;

    color: rgba(255,255,255,.65);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

}


.kosa-alumni-id strong {

    color: #fff;

    font-size: 21px;

}


/* =========================================================
   STATISTICS
========================================================= */

.kosa-dashboard-statistics {

    margin-bottom: 10px;

}


.kosa-dashboard-card {

    height: 114px;

    display: flex;

    align-items: center;

    gap: 20px;

    padding: 25px;

    border-radius: 15px;

    background: #fff;

    box-shadow:
        0 7px 25px rgba(31,45,61,.06);

}


.kosa-dashboard-card-icon {

    width: 54px;

    height: 54px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: #edf3f9;

    color: #0d2b52;

    font-size: 20px;

}


.kosa-dashboard-card span {

    display: block;

    margin-bottom: 3px;

    color: #7b8794;

    font-size: 13px;

}


.kosa-dashboard-card strong {

    display: block;

    color: #172b4d;

    font-size: 25px;

    font-weight: 700;

}


/* =========================================================
   EVENT REMINDER
========================================================= */

.kosa-event-reminder {

    margin-bottom: 30px;

    padding: 26px;

    border-radius: 15px;

    background: #fff;

    border: 1px solid #e3edf7;

    box-shadow:
        0 7px 25px rgba(31,45,61,.06);

}


.kosa-event-reminder-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 20px;

}


.kosa-event-reminder-heading {

    display: flex;

    align-items: center;

    gap: 14px;

}


.kosa-event-reminder-icon {

    width: 48px;

    height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: #edf5ff;

    color: #0d6efd;

    font-size: 19px;

}


.kosa-event-reminder-heading span {

    display: block;

    margin-bottom: 4px;

    color: #8a96a5;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

}


.kosa-event-reminder-heading h3 {

    margin: 0;

    color: #172b4d;

    font-size: 21px;

    font-weight: 700;

}


.kosa-event-reminder-heading p {

    margin: 4px 0 0;

    color: #7b8794;

    font-size: 12px;

}


.kosa-event-see-all {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    color: #0d6efd !important;

    font-size: 12px;

    font-weight: 600;

    text-decoration: none !important;

}


.kosa-event-see-all:hover {

    color: #0d2b52 !important;

}


/* =========================================================
   EVENT ITEM
========================================================= */

.kosa-event-reminder-item {

    display: grid;

    grid-template-columns: 190px 1fr 300px;

    align-items: center;

    gap: 20px;

    padding: 12px;

    margin-bottom: 12px;

    border: 1px solid #dce9f6;

    border-radius: 12px;

    background: #fbfdff;

    transition: .2s;

}


.kosa-event-reminder-item:last-child {

    margin-bottom: 0;

}


.kosa-event-reminder-item:hover {

    border-color: #c8dced;

    box-shadow:
        0 5px 18px rgba(13,43,82,.05);

}


/* =========================================================
   EVENT IMAGE
========================================================= */

.kosa-event-reminder-image {

    width: 190px;

    height: 105px;

    overflow: hidden;

    border-radius: 9px;

    background: #edf3f9;

}


.kosa-event-reminder-image img {

    width: 100%;

    height: 100%;

    display: block;

    object-fit: cover;

}


.kosa-event-no-image {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #8ca3bc;

    font-size: 28px;

}


/* =========================================================
   EVENT INFORMATION
========================================================= */

.kosa-event-reminder-info h4 {

    margin: 0 0 10px;

    color: #172b4d;

    font-size: 16px;

    font-weight: 700;

    line-height: 1.4;

}


.kosa-event-meta {

    display: flex;

    flex-wrap: wrap;

    gap: 12px;

    margin-bottom: 11px;

}


.kosa-event-meta span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #718096;

    font-size: 11px;

}


.kosa-event-meta i {

    color: #0d2b52;

}


.kosa-event-registered {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 11px;

    border-radius: 20px;

    background: #e7f8ed;

    color: #18a957;

    font-size: 11px;

    font-weight: 600;

}


.kosa-event-registered i {

    font-size: 9px;

}


/* =========================================================
   COUNTDOWN
========================================================= */

.kosa-event-reminder-right {

    display: flex;

    flex-direction: column;

    gap: 10px;

}


.kosa-event-countdown {

    display: flex;

    align-items: center;

    gap: 11px;

    padding: 12px 14px;

    border-radius: 10px;

    background: #fff5e9;

}


.kosa-event-countdown-icon {

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 50%;

    color: #e4811b;

    background: #fff;

}


.kosa-event-countdown-icon i {

    font-size: 15px;

}


.kosa-event-countdown strong {

    display: block;

    margin-bottom: 2px;

    color: #df7911;

    font-size: 14px;

}


.kosa-event-countdown small {

    display: block;

    color: #c98745;

    font-size: 10px;

    line-height: 1.4;

}


/* =========================================================
   EVENT BUTTON
========================================================= */

.kosa-event-detail-button {

    min-height: 37px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 8px 14px;

    border: 1px solid #0d6efd;

    border-radius: 8px;

    background: #fff;

    color: #0d6efd !important;

    font-size: 11px;

    font-weight: 600;

    text-decoration: none !important;

    transition: .2s;

}


.kosa-event-detail-button:hover {

    background: #0d6efd;

    color: #fff !important;

}


/* =========================================================
   PANEL
========================================================= */

.kosa-dashboard-panel {

    height: 100%;

    padding: 30px;

    border-radius: 15px;

    background: #fff;

    box-shadow:
        0 7px 25px rgba(31,45,61,.06);

}


.kosa-panel-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 27px;

}


.kosa-panel-header span {

    display: block;

    margin-bottom: 5px;

    color: #8a96a5;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

}


.kosa-panel-header h3 {

    margin: 0;

    color: #172b4d;

    font-size: 21px;

    font-weight: 700;

}


.kosa-panel-header > i {

    color: #d9e1eb;

    font-size: 29px;

}


/* =========================================================
   PROGRESS
========================================================= */

.kosa-progress-top {

    display: flex;

    justify-content: space-between;

    margin-bottom: 10px;

    color: #66758a;

    font-size: 13px;

}


.kosa-progress-top strong {

    color: #0d2b52;

}


.kosa-progress {

    height: 8px;

    overflow: hidden;

    border-radius: 10px;

    background: #e9eef4;

}


.kosa-progress-bar {

    height: 100%;

    border-radius: 10px;

    background: #0d2b52;

}


.kosa-panel-description {

    margin: 23px 0;

    color: #7b8794;

    font-size: 13px;

    line-height: 1.7;

}


/* =========================================================
   BUTTON
========================================================= */

.kosa-dashboard-button {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    padding: 12px 20px;

    border-radius: 8px;

    background: #0d2b52;

    color: #fff !important;

    font-size: 13px;

    font-weight: 600;

    text-decoration: none !important;

    transition: .2s;

}


.kosa-dashboard-button:hover {

    background: #163f70;

    transform: translateY(-1px);

}


/* =========================================================
   QUICK MENU
========================================================= */

.kosa-quick-menu {

    padding-bottom: 10px;

}


.kosa-quick-menu .kosa-panel-header {

    margin-bottom: 8px;

}


.kosa-quick-menu > a {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 15px 4px;

    border-bottom: 1px solid #edf0f4;

    color: #344054;

    text-decoration: none;

    font-size: 13px;

    transition: .2s;

}


.kosa-quick-menu > a:last-child {

    border-bottom: none;

}


.kosa-quick-menu > a span {

    display: flex;

    align-items: center;

    gap: 11px;

}


.kosa-quick-menu > a span i {

    width: 20px;

    color: #0d2b52;

    text-align: center;

}


.kosa-quick-menu > a > i {

    color: #aab4c0;

    font-size: 10px;

}


.kosa-quick-menu > a:hover {

    color: #0d2b52;

}


/* =========================================================
   INFORMATION
========================================================= */

.kosa-dashboard-info {

    display: flex;

    align-items: center;

    gap: 16px;

    padding: 21px 25px;

    border-radius: 15px;

    background: #fff;

    box-shadow:
        0 7px 25px rgba(31,45,61,.05);

}


.kosa-dashboard-info-icon {

    width: 44px;

    height: 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border-radius: 10px;

    background: #edf3f9;

    color: #0d2b52;

}


.kosa-dashboard-info strong {

    display: block;

    margin-bottom: 3px;

    color: #172b4d;

    font-size: 14px;

}


.kosa-dashboard-info p {

    margin: 0;

    color: #7b8794;

    font-size: 12px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .kosa-event-reminder-item {

        grid-template-columns: 160px 1fr 240px;

    }


    .kosa-event-reminder-image {

        width: 160px;

        height: 95px;

    }

}


@media (max-width: 991px) {

    .kosa-dashboard-welcome {

        padding: 35px;

    }


    .kosa-event-reminder-item {

        grid-template-columns: 150px 1fr;

    }


    .kosa-event-reminder-right {

        grid-column: 1 / -1;

        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 12px;

    }

}


@media (max-width: 767px) {

    .kosa-alumni-dashboard {

        padding: 35px 0 60px;

    }


    .kosa-dashboard-welcome {

        flex-direction: column;

        align-items: flex-start;

        gap: 25px;

        padding: 30px;

    }


    .kosa-alumni-id {

        width: 100%;

    }


    .kosa-dashboard-welcome h1 {

        font-size: 25px;

    }


    .kosa-dashboard-card {

        height: auto;

        min-height: 105px;

    }


    /* EVENT MOBILE */

    .kosa-event-reminder {

        padding: 18px;

    }


    .kosa-event-reminder-header {

        align-items: flex-start;

    }


    .kosa-event-see-all {

        display: none;

    }


    .kosa-event-reminder-item {

        display: flex;

        flex-direction: column;

        align-items: stretch;

    }


    .kosa-event-reminder-image {

        width: 100%;

        height: 150px;

    }


    .kosa-event-reminder-right {

        display: flex;

        flex-direction: column;

    }


    .kosa-event-reminder-heading p {

        font-size: 11px;

    }


    .kosa-event-reminder-info h4 {

        font-size: 15px;

    }

}

</style>

@endsection