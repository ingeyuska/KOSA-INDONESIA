@extends('frontend.member.layouts.app')

@section('title', 'Dashboard Member - KOSA Indonesia')

@section('content')

{{-- =========================================================
    DASHBOARD MEMBER KOSA
========================================================= --}}

<section class="kosa-member-dashboard">

    <div class="container">

        {{-- =====================================================
            WELCOME
        ====================================================== --}}

        <div class="kosa-dashboard-welcome">

            <div>

                <span class="kosa-dashboard-label">
                    PORTAL MEMBER
                </span>

                <h1>
                    Selamat datang,
                    <strong>{{ Auth::user()->nama }}</strong>
                </h1>

                <p>
                    Kelola profil alumni, ikuti kegiatan KOSA,
                    dan tetap terhubung dengan jaringan alumni.
                </p>

            </div>

            <div class="kosa-member-id">
                <span>ID MEMBER</span>

                <strong>
                    {{ Auth::user()->memberProfile?->member_id ?? 'G-XXXXX' }}
                </strong>
            </div>
        </div>


        {{-- =====================================================
            STATISTIK SINGKAT
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

                        <strong>{{ $profileProgress }}%</strong>

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
                            0
                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- =====================================================
            EVENT ANDA
        ====================================================== --}}

        <div class="kosa-event-panel mb-4">

            {{-- HEADER EVENT --}}
            <div class="kosa-event-header">

                <div class="kosa-event-title">

                    <div class="kosa-event-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>

                    <div>

                        <span>
                            PENGINGAT EVENT
                        </span>

                        <h2>
                            Event Anda
                        </h2>

                        <p>
                            Anda sudah terdaftar pada event yang akan segera berlangsung.
                        </p>

                    </div>

                </div>


                {{-- LIHAT SEMUA EVENT --}}
                <a
                    href="{{ route('member.event.registered') }}"
                    class="kosa-see-all"
                >
                    Lihat Semua Event
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            {{-- EVENT TERDEKAT --}}
            @if(isset($upcomingEvent) && $upcomingEvent)

                @php
                    $event = $upcomingEvent->event;
                @endphp

                @if($event)

                    <div class="kosa-event-content">

                        {{-- GAMBAR --}}
                        <div class="kosa-event-image">

                            @if($event->foto)

                                <img
                                    src="{{ asset('storage/' . $event->foto) }}"
                                    alt="{{ $event->judul }}"
                                >

                            @else

                                <div class="kosa-event-image-empty">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>

                            @endif

                        </div>


                        {{-- DETAIL --}}
                        <div class="kosa-event-detail">

                            <span class="kosa-event-status">
                                <i class="fa-solid fa-circle-check"></i>
                                Anda sudah terdaftar
                            </span>

                            <h3>
                                {{ $event->judul }}
                            </h3>


                            <div class="kosa-event-meta">

                                <span>
                                    <i class="fa-regular fa-calendar"></i>

                                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
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


                            <a
                                href="{{ route('member.event.show', $event->slug) }}"
                                class="kosa-event-button"
                            >
                                Lihat Event
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                @endif

            @else

                {{-- BELUM ADA EVENT --}}
                <div class="kosa-event-empty">

                    <div class="kosa-event-empty-icon">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>

                    <h4>
                        Belum Ada Event
                    </h4>

                    <p>
                        Anda belum terdaftar pada event yang akan datang.
                    </p>

                    <a
                        href="{{ route('member.event') }}"
                        class="kosa-event-button"
                    >
                        Lihat Event
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

            @endif

        </div>
        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}

        <div class="row">


            {{-- =================================================
                PROFIL
            ================================================== --}}

            <div class="col-lg-8 mb-4">

                <div class="kosa-dashboard-panel">

                    <div class="kosa-panel-header">

                        <div>

                            <span>
                                PROFIL MEMBER
                            </span>

                            <h3>
                                Lengkapi Data Member
                            </h3>

                        </div>

                        <i class="fa-solid fa-id-card"></i>

                    </div>


                    <div class="kosa-profile-progress">

                        <div class="kosa-progress-top">

                            <span>
                                Kelengkapan data
                            </span>

                            <strong>{{ $profileProgress }}%</strong>

                        </div>

                        <div class="kosa-progress">

                            <div
                                class="kosa-progress-bar"
                                style="width:{{ $profileProgress }}%;">
                            </div>

                        </div>

                    </div>


                    <p class="kosa-panel-description">

                        Lengkapi data diri dan informasi Anda
                        untuk mendapatkan pengalaman dan layanan Member KOSA Indonesia yang lebih lengkap.

                    </p>


                    <a
                        href="{{ route('member.profile') }}"
                        class="kosa-dashboard-button">
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
                                MENU MEMBER
                            </span>

                            <h3>
                                Akses Cepat
                            </h3>

                        </div>

                    </div>


                    <a href="{{ route('member.profile') }}">

                        <span>
                            <i class="fa-solid fa-user"></i>
                            Data Diri
                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>

                    <a href="{{ route('member.event') }}">

                        <span>
                            <i class="fa-solid fa-calendar-days"></i>
                            Join Event
                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </a>


                    <a href="#">

                        <span>
                            <i class="fa-solid fa-certificate"></i>
                            Sertifikat
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
                    kesempatan networking bersama alumni KOSA.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    STYLE DASHBOARD
========================================================= --}}

<style>

.kosa-member-dashboard {
    padding: 55px 0 80px;
    background: #f5f8fc;
    min-height: calc(100vh - 100px);
}


/* =========================================================
   WELCOME
========================================================= */

.kosa-dashboard-welcome {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 38px 42px;
    margin-bottom: 28px;

    border-radius: 18px;

    background: #0d2b52;

    color: #ffffff;

    box-shadow:
        0 12px 35px rgba(13, 43, 82, 0.12);
}


.kosa-dashboard-label {
    display: block;

    margin-bottom: 8px;

    color: rgba(255,255,255,0.65);

    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.5px;
}


.kosa-dashboard-welcome h1 {
    margin: 0 0 8px;

    color: #ffffff;

    font-size: 30px;
    font-weight: 400;
}


.kosa-dashboard-welcome h1 strong {
    font-weight: 700;
}


.kosa-dashboard-welcome p {
    margin: 0;

    color: rgba(255,255,255,0.75);

    font-size: 14px;
}


.kosa-member-id {
    min-width: 150px;

    padding: 16px 20px;

    border-radius: 12px;

    background: rgba(255,255,255,0.10);

    text-align: center;
}


.kosa-member-id span {
    display: block;

    margin-bottom: 4px;

    color: rgba(255,255,255,0.65);

    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
}


.kosa-member-id strong {
    color: #ffffff;

    font-size: 20px;
}


/* =========================================================
   STATISTIC CARDS
========================================================= */

.kosa-dashboard-statistics {
    margin-bottom: 10px;
}


.kosa-dashboard-card {
    height: 100%;

    display: flex;
    align-items: center;

    gap: 18px;

    padding: 24px;

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.06);
}


.kosa-dashboard-card-icon {
    width: 50px;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: #edf3f9;

    color: #0d2b52;

    font-size: 19px;
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

    font-size: 24px;
}


/* =========================================================
   PANEL
========================================================= */

.kosa-dashboard-panel {
    height: 100%;

    padding: 28px;

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.06);
}


.kosa-panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 25px;
}


.kosa-panel-header span {
    display: block;

    margin-bottom: 4px;

    color: #8a96a5;

    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
}


.kosa-panel-header h3 {
    margin: 0;

    color: #172b4d;

    font-size: 20px;
    font-weight: 700;
}


.kosa-panel-header > i {
    color: #d9e1eb;

    font-size: 28px;
}


/* =========================================================
   PROGRESS
========================================================= */

.kosa-progress-top {
    display: flex;
    justify-content: space-between;

    margin-bottom: 9px;

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
    margin: 22px 0;

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

    padding: 11px 18px;

    border-radius: 8px;

    background: #0d2b52;

    color: #ffffff !important;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none !important;

    transition: 0.2s;
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
    margin-bottom: 10px;
}


.kosa-quick-menu > a {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 13px 4px;

    border-bottom: 1px solid #edf0f4;

    color: #344054;

    text-decoration: none;

    font-size: 13px;
}


.kosa-quick-menu > a:last-child {
    border-bottom: none;
}


.kosa-quick-menu > a span {
    display: flex;
    align-items: center;

    gap: 10px;
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

    padding: 20px 24px;

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.05);
}


.kosa-dashboard-info-icon {
    width: 42px;
    height: 42px;

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

@media (max-width: 767px) {

    .kosa-dashboard-welcome {
        flex-direction: column;
        align-items: flex-start;

        gap: 25px;

        padding: 30px;
    }

    .kosa-member-id {
        width: 100%;
    }

}
/* =========================================================
   EVENT ANDA
========================================================= */

.kosa-event-panel {
    padding: 28px 30px;

    border: 1px solid #dbe5f0;
    border-radius: 22px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.05);
}


/* HEADER */

.kosa-event-header {
    display: flex;

    justify-content: space-between;
    align-items: center;

    gap: 30px;

    margin-bottom: 30px;
}


.kosa-event-title {
    display: flex;
    align-items: center;

    gap: 22px;
}


.kosa-event-icon {
    width: 76px;
    height: 76px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 17px;

    background: #edf4fc;

    color: #1769e0;

    font-size: 25px;
}


.kosa-event-title span {
    display: block;

    margin-bottom: 5px;

    color: #7890ad;

    font-size: 11px;
    font-weight: 800;

    letter-spacing: 2px;
}


.kosa-event-title h2 {
    margin: 0 0 5px;

    color: #0d2b52;

    font-size: 32px;
    font-weight: 700;
}


.kosa-event-title p {
    margin: 0;

    color: #71839b;

    font-size: 15px;
}


/* LIHAT SEMUA */

.kosa-see-all {
    display: inline-flex;
    align-items: center;

    gap: 10px;

    flex-shrink: 0;

    color: #1769e0;

    font-size: 14px;
    font-weight: 700;

    text-decoration: none;
}


.kosa-see-all:hover {
    color: #0d2b52;

    text-decoration: none;
}


.kosa-see-all i {
    font-size: 16px;
}


/* EVENT CONTENT */

.kosa-event-content {
    display: flex;

    gap: 25px;

    min-height: 230px;

    padding: 18px;

    border: 1px dashed #d8e2ee;
    border-radius: 18px;

    background: #fbfdff;
}


/* GAMBAR */

.kosa-event-image {
    width: 300px;

    min-height: 195px;

    flex-shrink: 0;

    overflow: hidden;

    border-radius: 14px;

    background: #edf3f9;
}


.kosa-event-image img {
    width: 100%;
    height: 100%;

    min-height: 195px;

    display: block;

    object-fit: cover;
}


.kosa-event-image-empty {
    width: 100%;
    height: 100%;
    min-height: 195px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #9aabc0;

    font-size: 45px;
}


/* DETAIL */

.kosa-event-detail {
    display: flex;

    flex-direction: column;

    justify-content: center;

    padding: 10px 10px 10px 0;
}


.kosa-event-status {
    display: inline-flex;
    align-items: center;

    gap: 7px;

    width: fit-content;

    margin-bottom: 12px;

    color: #23845b;

    font-size: 12px;
    font-weight: 700;
}


.kosa-event-status i {
    font-size: 11px;
}


.kosa-event-detail h3 {
    margin: 0 0 18px;

    color: #172b4d;

    font-size: 22px;
    font-weight: 700;

    line-height: 1.4;
}


/* META */

.kosa-event-meta {
    display: flex;

    flex-wrap: wrap;

    gap: 14px 25px;

    margin-bottom: 22px;
}


.kosa-event-meta span {
    display: flex;
    align-items: center;

    gap: 7px;

    color: #718096;

    font-size: 13px;
}


.kosa-event-meta i {
    color: #1769e0;
}


/* BUTTON */

.kosa-event-button {
    display: inline-flex;
    align-items: center;

    width: fit-content;

    gap: 9px;

    padding: 10px 17px;

    border-radius: 8px;

    background: #0d2b52;

    color: #ffffff !important;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none !important;

    transition: 0.2s;
}


.kosa-event-button:hover {
    background: #1769e0;

    color: #ffffff !important;

    transform: translateY(-1px);
}


/* EMPTY */

.kosa-event-empty {
    min-height: 220px;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    padding: 30px;

    border: 1px dashed #d8e2ee;
    border-radius: 18px;

    text-align: center;

    background: #fbfdff;
}


.kosa-event-empty-icon {
    margin-bottom: 12px;

    color: #9aabc0;

    font-size: 48px;
}


.kosa-event-empty h4 {
    margin: 0 0 7px;

    color: #52657d;

    font-size: 17px;
}


.kosa-event-empty p {
    margin: 0 0 18px;

    color: #8a98aa;

    font-size: 13px;
}


/* =========================================================
   EVENT RESPONSIVE
========================================================= */

@media (max-width: 767px) {

    .kosa-event-panel {
        padding: 22px;
    }


    .kosa-event-header {
        flex-direction: column;

        align-items: flex-start;

        gap: 18px;
    }


    .kosa-event-title {
        align-items: flex-start;

        gap: 15px;
    }


    .kosa-event-icon {
        width: 58px;
        height: 58px;

        border-radius: 14px;

        font-size: 20px;
    }


    .kosa-event-title h2 {
        font-size: 25px;
    }


    .kosa-event-title p {
        font-size: 13px;
    }


    .kosa-event-content {
        flex-direction: column;

        padding: 14px;
    }


    .kosa-event-image {
        width: 100%;
    }


    .kosa-event-detail {
        padding: 5px;
    }

}

</style>

@endsection
