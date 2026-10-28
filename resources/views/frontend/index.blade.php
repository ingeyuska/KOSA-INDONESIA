@extends('frontend.v_layouts.app')

@section('title', 'Beranda - KOSA Indonesia')

@section('content')

{{-- =========================================================
    CSS KHUSUS HOMEPAGE
========================================================= --}}

<style>

/* =========================================================
   KOSA HOME STATISTICS
   RESPONSIVE : DESKTOP - TABLET - MOBILE
========================================================= */

.kosa-home-statistics {
    position: relative;
    width: 100%;
    padding: 70px 0;
    background: linear-gradient(
        180deg,
        #f4f9fc 0%,
        #ffffff 100%
    );
    box-sizing: border-box;
    overflow: visible;
}


/* =========================================================
   CONTAINER
========================================================= */

.kosa-home-statistics .container {
    width: 100%;
    box-sizing: border-box;
}


/* =========================================================
   ROW
========================================================= */

.kosa-home-statistics .row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -15px;
    margin-right: -15px;
}


/* =========================================================
   COLUMN
========================================================= */

.kosa-home-statistics .row > [class*="col-"] {
    display: flex;
    padding-left: 15px;
    padding-right: 15px;
    box-sizing: border-box;
}


/* =========================================================
   CARD STATISTIK
========================================================= */

.kosa-home-stat-card {
    position: relative;

    width: 100%;
    min-height: 220px;

    margin-bottom: 30px;
    padding: 30px 25px;

    border-radius: 18px;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    text-align: center;

    box-sizing: border-box;

    overflow: hidden;

    border: 1px solid rgba(255,255,255,0.7);

    box-shadow:
        0 12px 30px rgba(0, 74, 118, 0.10);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
}


/* =========================================================
   WARNA CARD
========================================================= */

.kosa-home-statistics
.row > [class*="col-"]:nth-child(1)
.kosa-home-stat-card {

    background:
        linear-gradient(
            135deg,
            #e9f6ff 0%,
            #d5edfc 100%
        );

}


.kosa-home-statistics
.row > [class*="col-"]:nth-child(2)
.kosa-home-stat-card {

    background:
        linear-gradient(
            135deg,
            #eef4ff 0%,
            #dce8ff 100%
        );

}


.kosa-home-statistics
.row > [class*="col-"]:nth-child(3)
.kosa-home-stat-card {

    background:
        linear-gradient(
            135deg,
            #eaf9f7 0%,
            #d8f1ed 100%
        );

}


/* =========================================================
   DEKORASI CARD
========================================================= */

.kosa-home-stat-card::before {

    content: "";

    position: absolute;

    width: 130px;
    height: 130px;

    border-radius: 50%;

    background: rgba(255,255,255,0.35);

    top: -55px;
    right: -45px;

}


.kosa-home-stat-card::after {

    content: "";

    position: absolute;

    width: 90px;
    height: 90px;

    border-radius: 50%;

    background: rgba(255,255,255,0.25);

    bottom: -40px;
    left: -35px;

}


/* =========================================================
   HOVER
========================================================= */

.kosa-home-stat-card:hover {

    transform: translateY(-6px);

    box-shadow:
        0 18px 38px rgba(0, 74, 118, 0.16);

}


/* =========================================================
   ICON
========================================================= */

.kosa-home-stat-icon {

    position: relative;
    z-index: 2;

    width: 62px;
    height: 62px;

    min-width: 62px;
    min-height: 62px;

    margin: 0 auto 14px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    box-sizing: border-box;

    flex-shrink: 0;

    background: #ffffff;

    color: #0788c5;

    box-shadow:
        0 7px 18px rgba(0, 74, 118, 0.10);
}


/* ICON FONT */

.kosa-home-stat-icon span {

    font-size: 24px;

    line-height: 1;

}


/* =========================================================
   NUMBER
========================================================= */

.kosa-home-stat-card h2 {

    position: relative;
    z-index: 2;

    display: block;

    width: 100%;

    height: auto;

    min-height: 0;

    max-height: none;

    margin: 0 0 7px;

    padding: 0;

    color: #064a76;

    font-size: 36px;

    font-weight: 800;

    line-height: 1.2;

    text-align: center;

    overflow: visible;

    box-sizing: border-box;

}


/* =========================================================
   LABEL
========================================================= */

.kosa-home-stat-card p {

    position: relative;
    z-index: 2;

    display: block;

    width: 100%;

    height: auto;

    min-height: 0;

    max-height: none;

    margin: 0;

    padding: 0;

    color: #315b73;

    font-size: 15px;

    font-weight: 600;

    line-height: 1.5;

    text-align: center;

    overflow: visible;

    box-sizing: border-box;

}


/* =========================================================
   LINK
========================================================= */

.kosa-home-stat-card a {

    position: relative;
    z-index: 2;

    display: inline-block;

    width: auto;

    height: auto;

    min-height: 0;

    max-height: none;

    margin-top: 11px;

    padding: 0;

    color: #0788c5;

    font-size: 13px;

    font-weight: 700;

    line-height: 1.4;

    text-align: center;

    text-decoration: none;

    overflow: visible;

    box-sizing: border-box;

    transition: color 0.2s ease;

}


.kosa-home-stat-card a:hover {

    color: #064a76;

    text-decoration: underline;

}


/* =========================================================
   LAPTOP / TABLET BESAR
========================================================= */

@media (max-width: 1199px) {

    .kosa-home-statistics {

        padding: 60px 0;

    }

    .kosa-home-stat-card {

        min-height: 210px;

        padding: 27px 20px;

    }

    .kosa-home-stat-card h2 {

        font-size: 34px;

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .kosa-home-statistics {

        padding: 55px 0;

    }

    .kosa-home-statistics .row {

        margin-left: -10px;
        margin-right: -10px;

    }

    .kosa-home-statistics .row > [class*="col-"] {

        padding-left: 10px;
        padding-right: 10px;

    }

    .kosa-home-stat-card {

        min-height: 205px;

        padding: 25px 15px;

        border-radius: 16px;

    }

    .kosa-home-stat-icon {

        width: 58px;
        height: 58px;

        min-width: 58px;
        min-height: 58px;

    }

    .kosa-home-stat-card h2 {

        font-size: 32px;

    }

}


/* =========================================================
   TABLET KECIL / HP LANDSCAPE
========================================================= */

@media (max-width: 767px) {

    .kosa-home-statistics {

        width: 100%;

        padding: 45px 15px !important;

        box-sizing: border-box;

        overflow: visible !important;

    }


    /* CONTAINER */

    .kosa-home-statistics .container {

        width: 100% !important;

        padding-left: 0 !important;
        padding-right: 0 !important;

        box-sizing: border-box !important;

    }


    /* ROW */

    .kosa-home-statistics .row {

        width: 100% !important;

        margin-left: 0 !important;
        margin-right: 0 !important;

        display: flex !important;

        flex-direction: column !important;

        flex-wrap: nowrap !important;

        gap: 15px !important;

    }


    /* COLUMN */

    .kosa-home-statistics .row > [class*="col-"] {

        width: 100% !important;

        max-width: 100% !important;

        flex: 0 0 100% !important;

        padding-left: 0 !important;
        padding-right: 0 !important;

        margin: 0 !important;

        display: block !important;

        box-sizing: border-box !important;

    }


    /* =====================================================
       CARD MOBILE
    ===================================================== */

    .kosa-home-stat-card {

        position: relative;

        width: 100% !important;

        height: auto !important;

        min-height: 190px !important;

        max-height: none !important;

        margin: 0 !important;

        padding: 25px 15px !important;

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        text-align: center !important;

        box-sizing: border-box !important;

        overflow: hidden !important;

        transform: none !important;

    }


    .kosa-home-stat-card:hover {

        transform: none !important;

    }


    /* =====================================================
       ICON MOBILE
    ===================================================== */

    .kosa-home-stat-icon {

        width: 56px !important;

        height: 56px !important;

        min-width: 56px !important;
        min-height: 56px !important;

        max-width: 56px !important;
        max-height: 56px !important;

        margin: 0 auto 10px !important;

        flex-shrink: 0 !important;

        box-sizing: border-box !important;

    }


    .kosa-home-stat-icon span {

        font-size: 21px !important;

        line-height: 1 !important;

    }


    /* =====================================================
       NUMBER MOBILE
    ===================================================== */

    .kosa-home-stat-card h2 {

        display: block !important;

        width: 100% !important;

        height: auto !important;

        min-height: 0 !important;

        max-height: none !important;

        margin: 0 0 5px !important;

        padding: 0 !important;

        font-size: 30px !important;

        font-weight: 800 !important;

        line-height: 1.2 !important;

        text-align: center !important;

        overflow: visible !important;

        box-sizing: border-box !important;

    }


    /* =====================================================
       LABEL MOBILE
    ===================================================== */

    .kosa-home-stat-card p {

        display: block !important;

        width: 100% !important;

        height: auto !important;

        min-height: 0 !important;

        max-height: none !important;

        margin: 0 !important;

        padding: 0 !important;

        font-size: 14px !important;

        font-weight: 600 !important;

        line-height: 1.5 !important;

        text-align: center !important;

        overflow: visible !important;

        box-sizing: border-box !important;

    }


    /* =====================================================
       LINK MOBILE
    ===================================================== */

    .kosa-home-stat-card a {

        display: inline-block !important;

        width: auto !important;

        height: auto !important;

        min-height: 0 !important;

        max-height: none !important;

        margin: 10px 0 0 !important;

        padding: 0 !important;

        font-size: 13px !important;

        line-height: 1.4 !important;

        text-align: center !important;

        white-space: normal !important;

        overflow: visible !important;

        box-sizing: border-box !important;

    }

}


/* =========================================================
   HP KECIL
   <= 380px
========================================================= */

@media (max-width: 380px) {

    .kosa-home-statistics {

        padding: 40px 12px !important;

    }


    .kosa-home-statistics .row {

        gap: 12px !important;

    }


    .kosa-home-stat-card {

        min-height: 185px !important;

        padding: 22px 12px !important;

        border-radius: 15px !important;

    }


    .kosa-home-stat-icon {

        width: 52px !important;

        height: 52px !important;

        min-width: 52px !important;

        min-height: 52px !important;

        max-width: 52px !important;

        max-height: 52px !important;

        margin-bottom: 9px !important;

    }


    .kosa-home-stat-icon span {

        font-size: 20px !important;

    }


    .kosa-home-stat-card h2 {

        font-size: 28px !important;

    }


    .kosa-home-stat-card p {

        font-size: 13px !important;

    }


    .kosa-home-stat-card a {

        font-size: 12px !important;

    }

}


/* =========================================================
   HP SANGAT KECIL
   <= 340px
========================================================= */

@media (max-width: 340px) {

    .kosa-home-statistics {

        padding-left: 10px !important;
        padding-right: 10px !important;

    }


    .kosa-home-stat-card {

        min-height: 180px !important;

        padding: 20px 10px !important;

    }


    .kosa-home-stat-icon {

        width: 50px !important;
        height: 50px !important;

        min-width: 50px !important;
        min-height: 50px !important;

        max-width: 50px !important;
        max-height: 50px !important;

    }


    .kosa-home-stat-card h2 {

        font-size: 27px !important;

    }


    .kosa-home-stat-card p {

        font-size: 12.5px !important;

    }


    .kosa-home-stat-card a {

        font-size: 12px !important;

    }

}

</style>

{{-- =========================================================
    START HERO / SLIDER
========================================================= --}}

<section id="home" class="home_bg kosa-hero">

    {{-- SLIDER BACKGROUND --}}
    <div class="kosa-hero-slider">

        @forelse($banners as $banner)

            <div
                class="kosa-hero-slide {{ $loop->first ? 'active' : '' }}"
                style="background-image: url('{{ asset('storage/' . $banner->foto) }}');">
            </div>

        @empty

            {{-- Jika belum ada banner dari admin --}}
            <div
                class="kosa-hero-slide active"
                style="background-image: url('{{ asset('frontend/assets/images/banner/banner1.png') }}');">
            </div>

        @endforelse

    </div>


    {{-- OVERLAY --}}
    <div class="kosa-hero-overlay"></div>


    {{-- CONTENT --}}
    <div class="container kosa-hero-container">

        <div class="row align-items-center">

            <div class="col-lg-7 col-md-8 col-sm-12">

                <div class="kosa-hero-content">

                    <span class="kosa-hero-subtitle">
                        KOICA Scholarship Alumni
                    </span>

                    <h1>
                        KOSA Indonesia
                    </h1>

                    <p>
                        Wadah alumni penerima beasiswa dan pelatihan
                        Pemerintah Korea Selatan melalui program KOICA.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    END HERO / SLIDER
========================================================= --}}


{{-- =========================================================
    START STATISTIK
========================================================= --}}

<section class="kosa-home-statistics">

    <div class="container">

        <div class="row">

            {{-- ALUMNI TERDAFTAR --}}
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="kosa-home-stat-card">

                    <div class="kosa-home-stat-icon">
                        <span class="ti-user"></span>
                    </div>

                    <h2>
                        {{ $totalAlumni }}
                    </h2>

                    <p>
                        Alumni Terdaftar
                    </p>

                    <a href="{{ route('statistik') }}">
                        Lihat Selengkapnya
                    </a>

                </div>

            </div>


            {{-- PROGRAM DEGREE --}}
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="kosa-home-stat-card">

                    <div class="kosa-home-stat-icon">
                        <span class="ti-medall-alt"></span>
                    </div>

                    <h2>
                        {{ $totalDegree }}
                    </h2>

                    <p>
                        Alumni Program Degree
                    </p>

                    <a href="{{ route('statistik') }}">
                        Lihat Selengkapnya
                    </a>

                </div>

            </div>


            {{-- PROGRAM SHORT COURSE --}}
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="kosa-home-stat-card">

                    <div class="kosa-home-stat-icon">
                        <span class="ti-book"></span>
                    </div>

                    <h2>
                        {{ $totalShortCourse }}
                    </h2>

                    <p>
                        Alumni Program Short Course
                    </p>

                    <a href="{{ route('statistik') }}">
                        Lihat Selengkapnya
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
    END STATISTIK
========================================================= --}}


{{-- =========================================================
    START CARI ALUMNI
========================================================= --}}

<section class="kosa-alumni-search">

    <div class="container">

        <div class="kosa-alumni-search-header">

            <span class="search-badge">
                Alumni KOSA Indonesia
            </span>

            <h2>
                Cari Data Alumni
            </h2>

            <p>
                Temukan informasi alumni KOSA Indonesia berdasarkan
                nama, Alumni ID, program, atau tahun kelulusan.
            </p>

        </div>


        <form
            action="{{ route('alumni.cari') }}"
            method="GET"
            class="kosa-alumni-search-form"
        >

            <div class="search-input-wrapper">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, Alumni ID, program..."
                    autocomplete="off"
                    required
                >

            </div>


            <button type="submit">

                <i class="fa-solid fa-magnifying-glass"></i>

                Cari Alumni

            </button>

        </form>

    </div>

</section>


{{-- =========================================================
    START TENTANG KOSA
========================================================= --}}

<section class="kosa-about-section">

    <div class="container">

        @if($tentang)

            <div class="row align-items-center">

                {{-- FOTO TENTANG --}}
                <div class="col-lg-5 col-md-6 col-sm-12">

                    <div class="kosa-about-image">

                        @if($tentang->foto)

                            <img
                                src="{{ asset('storage/' . $tentang->foto) }}"
                                alt="{{ $tentang->judul }}"
                                class="img-fluid">

                        @else

                            <img
                                src="{{ asset('frontend/assets/images/about/about-kosa.jpg') }}"
                                alt="Tentang KOSA Indonesia"
                                class="img-fluid">

                        @endif

                    </div>

                </div>


                {{-- ISI TENTANG --}}
                <div class="col-lg-7 col-md-6 col-sm-12">

                    <div class="kosa-about-content">

                        <h2>
                            {{ $tentang->judul }}
                        </h2>

                        <div class="kosa-about-description">

                            {!! nl2br(e($tentang->deskripsi)) !!}

                        </div>

                    </div>

                </div>

            </div>

        @else

            <div class="text-center py-5">

                <span class="kosa-section-subtitle">
                    Tentang Kami
                </span>

                <h2>
                    Tentang KOSA Indonesia
                </h2>

                <p>
                    Data Tentang KOSA Indonesia belum tersedia.
                </p>

            </div>

        @endif

    </div>

</section>


{{-- =========================================================
    END TENTANG KOSA
========================================================= --}}


{{-- =========================================================
    START MESSAGE CHAIRWOMAN
========================================================= --}}

<section class="kosa-chairwoman-section">

    <div class="container">

        <div class="row align-items-center">

            {{-- FOTO KETUA --}}
            <div class="col-lg-5 col-md-5 col-sm-12">

                <div class="kosa-chairwoman-image">

                    @if($ketua && $ketua->foto)

                        <img
                            src="{{ asset('storage/' . $ketua->foto) }}"
                            alt="{{ $ketua->nama }}"
                        >

                    @else

                        <img
                            src="{{ asset('frontend/assets/images/about/chairwoman.jpg') }}"
                            alt="Ketua KOSA Indonesia"
                        >

                    @endif

                </div>

            </div>


            {{-- PESAN KETUA --}}
            <div class="col-lg-7 col-md-7 col-sm-12">

                <div class="kosa-chairwoman-content">

                    <span class="kosa-section-subtitle">
                        Pesan Ketua
                    </span>

                    <h2>

                        Selamat Datang di

                        {{ $pengaturan?->nama_kosa ?? 'KOSA Indonesia' }}

                    </h2>


                    @if($pengaturan && $pengaturan->pesan_ketua)

                        <p>

                            {!! nl2br(e($pengaturan->pesan_ketua)) !!}

                        </p>

                    @else

                        <p>

                            Selamat datang di KOSA Indonesia.
                            Bersama kita membangun jejaring alumni
                            yang aktif dan memberikan manfaat bagi masyarakat.

                        </p>

                    @endif


                    {{-- IDENTITAS KETUA --}}
                    <div class="kosa-chairwoman-name">

                        <h4>
                            {{ $ketua?->nama ?? 'Ketua KOSA Indonesia' }}
                        </h4>

                        <span>
                            {{ $ketua?->jabatan ?? 'Ketua KOSA Indonesia' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    END MESSAGE CHAIRWOMAN
========================================================= --}}


{{-- =========================================================
    START BERITA
========================================================= --}}

<section class="kosa-news-section">

    <div class="container">

        {{-- JUDUL SECTION --}}
        <div class="section-title text-center">

            <h1>
                Berita
            </h1>

            <p style="font-size: 20px;">
                Informasi dan kabar terbaru seputar KOSA Indonesia.
            </p>

        </div>


        {{-- DATA BERITA --}}
        <div class="row">

            @forelse($beritas as $berita)

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="kosa-news-card">

                        {{-- FOTO BERITA --}}
                        <div class="kosa-news-image">

                            @if($berita->gambar)

                                <img
                                    src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
                                >

                            @else

                                <img
                                    src="{{ asset('frontend/assets/images/blog/news-default.jpg') }}"
                                    alt="Berita KOSA Indonesia">

                            @endif

                        </div>


                        {{-- KONTEN BERITA --}}
                        <div class="kosa-news-content">

                            {{-- TANGGAL --}}
                            <span class="kosa-news-date">

                                @if($berita->tanggal_publish)

                                    {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}

                                @endif

                            </span>


                            {{-- JUDUL --}}
                            <h3>
                                {{ $berita->judul }}
                            </h3>


                            {{-- ISI --}}
                            @if($berita->isi)

                                <p>
                                    {{ Str::limit(strip_tags($berita->isi), 120) }}
                                </p>

                            @endif


                            {{-- DETAIL --}}
                            <a
                                href="{{ route('berita.show', $berita->slug) }}"
                                class="kosa-news-link">

                                Selengkapnya

                                <span>→</span>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <p>
                            Belum ada berita KOSA Indonesia.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- TOMBOL SEMUA BERITA --}}
        <div class="text-center kosa-news-button">

            <a
                href="{{ route('berita') }}"
                class="cta kosa-btn-primary">

                <span>
                    Lihat Semua Berita
                </span>

                <svg width="13px" height="10px" viewBox="0 0 13 10">

                    <path d="M1,5 L11,5"></path>

                    <polyline points="8 1 12 5 8 9"></polyline>

                </svg>

            </a>

        </div>

    </div>

</section>


{{-- =========================================================
    END BERITA
========================================================= --}}


{{-- =========================================================
    START EVENT & KEGIATAN
========================================================= --}}

<section id="event" class="kosa-event-section">

    <div class="container">

        {{-- JUDUL --}}
        <div class="section-title text-center">

            <h1>
                Event & Kegiatan
            </h1>

            <p style="font-size: 19px;">

                Berbagai kegiatan dan acara yang diselenggarakan
                oleh KOSA Indonesia.

            </p>

        </div>


        <div class="row">

            @forelse($events as $event)

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="kosa-event-card">

                        {{-- FOTO EVENT --}}
                        <div class="kosa-event-image">

                            @if($event->foto)

                                <img
                                    src="{{ asset('storage/' . $event->foto) }}"
                                    alt="{{ $event->judul }}">

                            @else

                                <img
                                    src="{{ asset('frontend/assets/images/event/event-default.jpg') }}"
                                    alt="Event KOSA Indonesia">

                            @endif

                        </div>


                        {{-- KONTEN --}}
                        <div class="kosa-event-content">

                            {{-- STATUS --}}
                            @if($event->tanggal >= now()->toDateString())

                                <span class="kosa-event-status upcoming">
                                    Akan Datang
                                </span>

                            @else

                                <span class="kosa-event-status finished">
                                    Selesai
                                </span>

                            @endif


                            {{-- TANGGAL --}}
                            <span class="kosa-event-date">

                                <i class="fa-regular fa-calendar"></i>

                                {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}

                            </span>


                            {{-- NAMA EVENT --}}
                            <h3>
                                {{ $event->judul }}
                            </h3>


                            {{-- LOKASI --}}
                            @if($event->lokasi)

                                <p class="kosa-event-location">

                                    <i class="fa-solid fa-location-dot"></i>

                                    {{ $event->lokasi }}

                                </p>

                            @endif


                            {{-- DETAIL --}}
                            <a
                                href="{{ route('event.show', $event->slug) }}"
                                class="kosa-event-link">

                                Lihat Detail

                                <span>→</span>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center">

                        <p>
                            Belum ada event dan kegiatan KOSA Indonesia.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- SEMUA EVENT --}}
        <div class="text-center kosa-event-button">

            <a
                href="{{ route('event') }}"
                class="cta kosa-btn-primary">

                <span>
                    Lihat Semua Event
                </span>

                <svg width="13px" height="10px" viewBox="0 0 13 10">

                    <path d="M1,5 L11,5"></path>

                    <polyline points="8 1 12 5 8 9"></polyline>

                </svg>

            </a>

        </div>

    </div>

</section>


{{-- =========================================================
    END EVENT & KEGIATAN
========================================================= --}}


{{-- =========================================================
    START KONTAK DI BERANDA
========================================================= --}}

<section class="kosa-home-contact-section">

    <div class="container">

        <div class="row align-items-center">

            {{-- KONTEN --}}
            <div class="col-lg-7 col-md-7 col-sm-12">

                <div class="kosa-home-contact-content">

                    <span class="kosa-section-subtitle">
                        Hubungi Kami
                    </span>

                    <h2>
                        Mari Terhubung dengan KOSA Indonesia
                    </h2>

                    <p>

                        Memiliki pertanyaan, ingin berkolaborasi,
                        atau ingin mengetahui lebih lanjut tentang
                        KOSA Indonesia? Silakan hubungi kami.

                    </p>

                    <a
                        href="{{ route('kontak') }}"
                        class="cta kosa-btn-primary">

                        <span>
                            Hubungi Kami
                        </span>

                        <svg width="13px" height="10px" viewBox="0 0 13 10">

                            <path d="M1,5 L11,5"></path>

                            <polyline points="8 1 12 5 8 9"></polyline>

                        </svg>

                    </a>

                </div>

            </div>


            {{-- INFORMASI KONTAK --}}
            <div class="col-lg-5 col-md-5 col-sm-12">

                <div class="kosa-home-contact-info">

                    {{-- TELEPON --}}
                    <div class="kosa-home-contact-item">

                        <div class="kosa-home-contact-icon">

                            <i class="fa-solid fa-phone"></i>

                        </div>

                        <div>

                            <span>
                                Telepon
                            </span>

                            <p>
                                {{ $pengaturan?->telepon ?: '(+62) 812-1231-3840' }}
                            </p>

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="kosa-home-contact-item">

                        <div class="kosa-home-contact-icon">

                            <i class="fa-solid fa-envelope"></i>

                        </div>

                        <div>

                            <span>
                                Email
                            </span>

                            <p>
                                {{ $pengaturan?->email ?: 'inggg@gmail.com' }}
                            </p>

                        </div>

                    </div>


                    {{-- ALAMAT --}}
                    <div class="kosa-home-contact-item">

                        <div class="kosa-home-contact-icon">

                            <i class="fa-solid fa-location-dot"></i>

                        </div>

                        <div>

                            <span>
                                Alamat
                            </span>

                            <p>
                                {{ $pengaturan?->alamat ?: 'Indonesia' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    END KONTAK DI BERANDA
========================================================= --}}


{{-- =========================================================
    HERO SLIDER SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const slides =
        document.querySelectorAll('.kosa-hero-slide');

    /* Jika hanya 1 banner */
    if (slides.length <= 1) {
        return;
    }

    let currentSlide = 0;

    setInterval(function () {

        /* Hilangkan slide aktif */
        slides[currentSlide].classList.remove('active');

        /* Pindah ke slide berikutnya */
        currentSlide++;

        /* Kembali ke slide pertama */
        if (currentSlide >= slides.length) {

            currentSlide = 0;

        }

        /* Aktifkan slide berikutnya */
        slides[currentSlide].classList.add('active');

    }, 30000);

});

</script>

@endsection