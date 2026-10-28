@extends('frontend.v_layouts.app')

@section('title', 'Statistik Alumni KOSA Indonesia')

@section('content')

{{-- =========================================================
    PAGE BANNER
========================================================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Statistik Alumni
            </h1>

            <p>
                Data dan informasi alumni KOSA Indonesia
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
    MAIN STATISTIK
========================================================= --}}
<section class="kosa-statistik-page">

    <div class="container">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="kosa-statistik-header text-center">

            <div class="kosa-statistik-header-label">

                <i class="fa-solid fa-chart-pie"></i>

                DEMOGRAFI ALUMNI

            </div>


            <h1>
                Profil Alumni KOSA Indonesia
            </h1>


            <p>
                Data alumni berdasarkan jenis kelamin,
                klasifikasi program, universitas, dan
                bidang keilmuan.
            </p>

        </div>



        {{-- =====================================================
            STATISTIK UTAMA
        ====================================================== --}}
        <div class="kosa-main-statistics">


            {{-- =================================================
                ALUMNI TERDAFTAR
            ================================================== --}}
            <div class="kosa-main-stat-card">

                <div class="kosa-main-stat-icon alumni">

                    <i class="fa-solid fa-users"></i>

                </div>


                <div class="kosa-main-stat-content">

                    <span>
                        ALUMNI TERDAFTAR
                    </span>

                    <strong>
                        {{ number_format($totalAlumni, 0, ',', '.') }}
                    </strong>

                    <small>
                        Alumni KOSA Indonesia
                    </small>

                </div>

            </div>



            {{-- =================================================
                PROGRAM DEGREE
            ================================================== --}}
            <div class="kosa-main-stat-card">

                <div class="kosa-main-stat-icon degree">

                    <i class="fa-solid fa-medal"></i>

                </div>


                <div class="kosa-main-stat-content">

                    <span>
                        PROGRAM DEGREE
                    </span>

                    <strong>
                        {{ number_format($totalDegree, 0, ',', '.') }}
                    </strong>

                    <small>
                        Alumni Program Degree
                    </small>

                </div>

            </div>



            {{-- =================================================
                PROGRAM SHORT COURSE
            ================================================== --}}
            <div class="kosa-main-stat-card">

                <div class="kosa-main-stat-icon short-course">

                    <i class="fa-solid fa-book-open"></i>

                </div>


                <div class="kosa-main-stat-content">

                    <span>
                        PROGRAM SHORT COURSE
                    </span>

                    <strong>
                        {{ number_format($totalShortCourse, 0, ',', '.') }}
                    </strong>

                    <small>
                        Alumni Program Short Course
                    </small>

                </div>

            </div>

        </div>



        {{-- =====================================================
            SEARCH ALUMNI
        ====================================================== --}}
        <div class="kosa-search-box">


            <div class="kosa-search-info">

                <div class="kosa-search-icon">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </div>


                <div>

                    <span>
                        NETWORKING ALUMNI
                    </span>

                    <h2>
                        Cari Data Alumni
                    </h2>

                    <p>
                        Temukan alumni KOSA Indonesia berdasarkan
                        nama, program, institusi, angkatan,
                        atau jurusan.
                    </p>

                </div>

            </div>



            <form
                action="{{ route('alumni.cari') }}"
                method="GET"
                class="kosa-search-form"
            >

                <div class="kosa-search-input">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, program, institusi, angkatan..."
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



        {{-- =====================================================
            STATISTIK GRID
        ====================================================== --}}
        <div class="kosa-statistik-grid">



            {{-- =================================================
                1. JENIS KELAMIN
            ================================================== --}}
            <div class="kosa-stat-card">

                <div class="kosa-card-header">


                    <div class="kosa-card-title">

                        <div class="kosa-card-icon">

                            <i class="fa-solid fa-venus-mars"></i>

                        </div>


                        <div>

                            <span>
                                DEMOGRAFI
                            </span>

                            <h2>
                                Jenis Kelamin
                            </h2>

                        </div>

                    </div>


                    <div class="kosa-total-badge">

                        {{ number_format($totalAlumni, 0, ',', '.') }}

                        alumni terdata

                    </div>

                </div>



                @php

                    $laki = $berdasarkanGender->first(function ($item) {

                        return str_contains(
                            strtolower($item->jenis_kelamin),
                            'laki'
                        );

                    });


                    $perempuan = $berdasarkanGender->first(function ($item) {

                        return str_contains(
                            strtolower($item->jenis_kelamin),
                            'perempuan'
                        );

                    });


                    $totalLaki = $laki?->total ?? 0;

                    $totalPerempuan = $perempuan?->total ?? 0;


                    $persenLaki = $totalAlumni > 0
                        ? ($totalLaki / $totalAlumni) * 100
                        : 0;


                    $persenPerempuan = $totalAlumni > 0
                        ? ($totalPerempuan / $totalAlumni) * 100
                        : 0;

                @endphp



                <div class="kosa-gender-layout">


                    {{-- DONUT --}}
                    <div class="kosa-donut-wrapper">

                        <div
                            class="kosa-donut kosa-donut-gender"
                            style="
                                --male: {{ $persenLaki }}%;
                                --female: {{ $persenLaki + $persenPerempuan }}%;
                            "
                        >

                            <div class="kosa-donut-center">

                                <span>
                                    Total
                                </span>

                                <strong>
                                    {{ number_format($totalAlumni, 0, ',', '.') }}
                                </strong>

                                <small>
                                    alumni
                                </small>

                            </div>

                        </div>

                    </div>



                    {{-- DETAIL GENDER --}}
                    <div class="kosa-gender-details">


                        {{-- LAKI-LAKI --}}
                        <div class="kosa-gender-detail">

                            <div class="kosa-gender-detail-icon male">

                                <i class="fa-solid fa-person"></i>

                            </div>


                            <div class="kosa-gender-detail-content">

                                <span>
                                    Laki-laki
                                </span>

                                <strong>
                                    {{ number_format($totalLaki, 0, ',', '.') }}
                                </strong>

                                <small>
                                    ({{ number_format($persenLaki, 1, ',', '.') }}%)
                                </small>

                            </div>

                        </div>



                        {{-- PEREMPUAN --}}
                        <div class="kosa-gender-detail">

                            <div class="kosa-gender-detail-icon female">

                                <i class="fa-solid fa-person-dress"></i>

                            </div>


                            <div class="kosa-gender-detail-content">

                                <span>
                                    Perempuan
                                </span>

                                <strong>
                                    {{ number_format($totalPerempuan, 0, ',', '.') }}
                                </strong>

                                <small>
                                    ({{ number_format($persenPerempuan, 1, ',', '.') }}%)
                                </small>

                            </div>

                        </div>


                    </div>

                </div>



                <div class="kosa-card-note">

                    <i class="fa-solid fa-users"></i>

                    Perbandingan alumni laki-laki dan perempuan
                    berdasarkan data yang tercatat.

                </div>

            </div>




            {{-- =================================================
                2. KLASIFIKASI ALUMNI
            ================================================== --}}
            <div class="kosa-stat-card">

                {{-- HEADER --}}
                <div class="kosa-card-header">

                    <div class="kosa-card-title">

                        <div class="kosa-card-icon">

                            <i class="fa-solid fa-layer-group"></i>

                        </div>

                        <div>

                            <span>
                                PROGRAM
                            </span>

                            <h2>
                                Klasifikasi Alumni
                            </h2>

                        </div>

                    </div>

                    <div class="kosa-total-badge">

                        {{ number_format($totalAlumni, 0, ',', '.') }}

                        alumni terdata

                    </div>

                </div>


                @php

                    /*
                    |--------------------------------------------------------------------------
                    | DATA KLASIFIKASI
                    |--------------------------------------------------------------------------
                    */

                    $programColors = [
                        '#0ea5e9',
                        '#8b5cf6',
                        '#f59e0b',
                        '#10b981',
                    ];

                    $gradientParts = [];

                    $gradientStart = 0;

                    foreach ($berdasarkanKlasifikasi as $index => $program) {

                        $percent = $totalAlumni > 0
                            ? ($program->total / $totalAlumni) * 100
                            : 0;

                        $gradientEnd = $gradientStart + $percent;

                        $gradientParts[] =
                            $programColors[$index % count($programColors)]
                            . ' '
                            . $gradientStart
                            . '% '
                            . $gradientEnd
                            . '%';

                        $gradientStart = $gradientEnd;
                    }

                    $programGradient = count($gradientParts)
                        ? implode(', ', $gradientParts)
                        : '#e2e8f0 0% 100%';

                @endphp


                {{-- CONTENT --}}
                <div class="kosa-program-layout">


                    {{-- =========================================
                        PROGRAM ITEMS
                    ========================================== --}}
                    <div class="kosa-program-items">

                        @forelse($berdasarkanKlasifikasi as $index => $data)

                            @php

                                $programName = strtolower(
                                    trim($data->klasifikasi_program)
                                );


                                /*
                                |--------------------------------------------------------------------------
                                | DEFAULT
                                |--------------------------------------------------------------------------
                                */

                                $programClass = 'degree';

                                $programIcon = 'fa-award';


                                /*
                                |--------------------------------------------------------------------------
                                | SHORT COURSE
                                |--------------------------------------------------------------------------
                                */

                                if (str_contains($programName, 'short')) {

                                    $programClass = 'short';

                                    $programIcon = 'fa-book-open';

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | MASTER
                                |--------------------------------------------------------------------------
                                */

                                elseif (str_contains($programName, 'master')) {

                                    $programClass = 'master';

                                    $programIcon = 'fa-graduation-cap';

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | PHD
                                |--------------------------------------------------------------------------
                                */

                                elseif (
                                    str_contains($programName, 'phd') ||
                                    str_contains($programName, 'doctor')
                                ) {

                                    $programClass = 'phd';

                                    $programIcon = 'fa-user-graduate';

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | PERSENTASE
                                |--------------------------------------------------------------------------
                                */

                                $percentage = $totalAlumni > 0
                                    ? ($data->total / $totalAlumni) * 100
                                    : 0;

                            @endphp


                            <div class="kosa-program-item {{ $programClass }}">

                                {{-- ICON --}}
                                <div class="kosa-program-item-icon">

                                    <i class="fa-solid {{ $programIcon }}"></i>

                                </div>


                                {{-- NAMA PROGRAM --}}
                                <span>

                                    {{ $data->klasifikasi_program }}

                                </span>


                                {{-- JUMLAH --}}
                                <strong>

                                    {{ number_format(
                                        $data->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>


                                {{-- PERSENTASE --}}
                                <small>

                                    {{ number_format(
                                        $percentage,
                                        1,
                                        ',',
                                        '.'
                                    ) }}%

                                </small>

                            </div>

                        @empty

                            <div class="kosa-empty-data">

                                Belum ada data klasifikasi.

                            </div>

                        @endforelse

                    </div>


                    {{-- =========================================
                        DONUT
                    ========================================== --}}
                    <div class="kosa-program-donut-wrap">

                        <div
                            class="kosa-donut kosa-program-donut"
                            style="
                                background:
                                conic-gradient(
                                    {{ $programGradient }}
                                );
                            "
                        >

                            <div class="kosa-donut-center">

                                <span>
                                    Total
                                </span>

                                <strong>
                                    {{ number_format($totalAlumni, 0, ',', '.') }}
                                </strong>

                                <small>
                                    alumni
                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- NOTE --}}
                <div class="kosa-card-note">

                    <i class="fa-solid fa-lightbulb"></i>

                    Distribusi alumni berdasarkan klasifikasi
                    program pendidikan.

                </div>

            </div>




            {{-- =================================================
                3. UNIVERSITAS
            ================================================== --}}
            <div class="kosa-stat-card">

                <div class="kosa-card-header">

                    <div class="kosa-card-title">

                        <div class="kosa-card-icon">

                            <i class="fa-solid fa-building-columns"></i>

                        </div>

                        <div>

                            <span>
                                PENDIDIKAN
                            </span>

                            <h2>
                                Asal Universitas
                            </h2>

                        </div>

                    </div>

                    <div class="kosa-total-badge">

                        {{ $berdasarkanUniversitas->count() }}

                        universitas Degree

                    </div>

                </div>


                <div class="kosa-ranking-list">

                    @forelse(
                        $berdasarkanUniversitas->take(10)
                        as $index => $data
                    )

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | PERSENTASE UNIVERSITAS
                            |--------------------------------------------------------------------------
                            | Hanya berdasarkan jumlah alumni PROGRAM DEGREE.
                            |
                            | Short Course tidak ikut karena tidak memiliki
                            | data universitas.
                            */

                            $persentase = $totalDegree > 0
                                ? ($data->total / $totalDegree) * 100
                                : 0;

                        @endphp


                        <div class="kosa-ranking-item">

                            {{-- NOMOR --}}
                            <div class="kosa-ranking-number">

                                {{ $index + 1 }}

                            </div>


                            {{-- DATA UNIVERSITAS --}}
                            <div class="kosa-ranking-main">

                                <div class="kosa-ranking-top">

                                    <span
                                        title="{{ $data->institusi }}"
                                    >

                                        {{ $data->institusi }}

                                    </span>

                                    <strong>

                                        {{ number_format(
                                            $data->total,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </div>


                                {{-- PROGRESS BAR --}}
                                <div class="kosa-ranking-bar">

                                    <div
                                        style="
                                            width:
                                            {{ min($persentase, 100) }}%;
                                        "
                                    ></div>

                                </div>

                            </div>


                            {{-- PERSENTASE --}}
                            <small>

                                {{ number_format(
                                    $persentase,
                                    1,
                                    ',',
                                    '.'
                                ) }}%

                            </small>

                        </div>


                    @empty

                        <div class="kosa-empty-data">

                            Belum ada data universitas
                            Program Degree.

                        </div>

                    @endforelse

                </div>


                {{-- CATATAN --}}
                <div class="kosa-card-note">

                    <i class="fa-solid fa-building-columns"></i>

                    Menampilkan 10 universitas dengan jumlah
                    alumni Program Degree terbanyak.

                </div>

            </div>




            {{-- =================================================
                4. JENIS KEILMUAN
            ================================================== --}}
            <div class="kosa-stat-card">

                <div class="kosa-card-header">


                    <div class="kosa-card-title">

                        <div class="kosa-card-icon">

                            <i class="fa-solid fa-flask"></i>

                        </div>


                        <div>

                            <span>
                                BIDANG KEILMUAN
                            </span>

                            <h2>
                                Jenis Keilmuan
                            </h2>

                        </div>

                    </div>


                    <div class="kosa-total-badge">

                        {{ $berdasarkanKeilmuan->count() }}

                        bidang

                    </div>

                </div>



                <div class="kosa-field-grid">


                    @forelse($berdasarkanKeilmuan as $data)

                        @php

                            $keilmuan = strtolower(
                                trim(
                                    $data->jenis_keilmuan
                                )
                            );


                            $isStem = str_contains(
                                $keilmuan,
                                'stem'
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | PERSENTASE JENIS KEILMUAN
                            |--------------------------------------------------------------------------
                            | Tetap menggunakan TOTAL SELURUH ALUMNI.
                            | Bukan total Degree.
                            */

                            $persentase = $totalAlumni > 0
                                ? ($data->total / $totalAlumni) * 100
                                : 0;

                        @endphp


                        <div
                            class="
                                kosa-field-box
                                {{ $isStem ? 'stem' : 'social' }}
                            "
                        >

                            <div class="kosa-field-box-icon">

                                @if($isStem)

                                    <i
                                        class="fa-solid fa-atom"
                                    ></i>

                                @else

                                    <i
                                        class="fa-solid fa-people-group"
                                    ></i>

                                @endif

                            </div>


                            <div>

                                <span>

                                    {{ $data->jenis_keilmuan }}

                                </span>


                                <strong>

                                    {{ number_format(
                                        $data->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>


                                <small>

                                    {{ number_format(
                                        $persentase,
                                        1,
                                        ',',
                                        '.'
                                    ) }}%

                                </small>

                            </div>

                        </div>


                    @empty

                        <div class="kosa-empty-data">

                            Belum ada data bidang keilmuan.

                        </div>

                    @endforelse


                </div>



                <div class="kosa-card-note">

                    <i class="fa-solid fa-brain"></i>

                    Persebaran alumni berdasarkan bidang
                    keilmuan yang tercatat.

                </div>

            </div>


        </div>



        {{-- =====================================================
            CTA
        ====================================================== --}}
        <div class="kosa-statistik-cta">


            <div class="kosa-cta-icon">

                <i class="fa-solid fa-users"></i>

            </div>


            <div class="kosa-cta-content">

                <span>
                    KOSA INDONESIA
                </span>

                <h3>
                    Jadilah bagian dari komunitas alumni KOSA
                </h3>

                <p>
                    Daftarkan diri Anda dan terhubung dengan
                    alumni KOSA Indonesia lainnya.
                </p>

            </div>


            <a
                href="{{ route('register') }}"
                class="kosa-cta-button"
            >

                Daftar Sekarang

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>


    </div>

</section>



<style>

/* =========================================================
   PAGE BANNER
========================================================= */

.kosa-page-banner {
    position: relative;
    overflow: hidden;

    padding: 90px 0;

    background:
        linear-gradient(
            135deg,
            #075985 0%,
            #0284c7 55%,
            #0ea5e9 100%
        );
}

.kosa-page-banner::before {
    content: "";

    position: absolute;

    width: 360px;
    height: 360px;

    top: -190px;
    right: -80px;

    border-radius: 50%;

    background: rgba(255,255,255,.08);
}

.kosa-page-banner::after {
    content: "";

    position: absolute;

    width: 240px;
    height: 240px;

    left: -120px;
    bottom: -150px;

    border-radius: 50%;

    background: rgba(255,255,255,.06);
}

.kosa-page-banner-content {
    position: relative;

    z-index: 2;

    max-width: 760px;

    margin: auto;
}

.kosa-page-banner h1 {
    margin: 0 0 14px;

    color: #fff;

    font-size: 44px;
    line-height: 1.15;

    font-weight: 800;

    letter-spacing: -.8px;
}

.kosa-page-banner p {
    max-width: 650px;

    margin: auto;

    color: rgba(255,255,255,.88);

    font-size: 15px;

    line-height: 1.8;
}



/* =========================================================
   MAIN PAGE
========================================================= */

.kosa-statistik-page {
    padding: 55px 0 70px;
}



/* =========================================================
   HEADER
========================================================= */

.kosa-statistik-header {
    padding: 10px 20px 35px;

    text-align: center;
}

.kosa-statistik-header-label {
    display: inline-flex;

    align-items: center;

    gap: 9px;

    margin-bottom: 10px;

    color: #0284c7;

    font-size: 14px;

    font-weight: 800;

    letter-spacing: 1px;
}

.kosa-statistik-header-label i {
    font-size: 25px;
}

.kosa-statistik-header h1 {
    margin: 0 0 8px;

    color: #102a5c;

    font-size: 38px;

    font-weight: 800;
}

.kosa-statistik-header p {
    max-width: 650px;

    margin: auto;

    color: #54709c;

    font-size: 16px;

    line-height: 1.6;
}



/* =========================================================
   STATISTIK UTAMA
========================================================= */

.kosa-main-statistics {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 18px;

    margin-bottom: 25px;
}

.kosa-main-stat-card {
    display: flex;

    align-items: center;

    gap: 17px;

    padding: 22px 24px;

    border: 1px solid #e0ebf5;

    border-radius: 19px;

    background: #fff;

    box-shadow:
        0 7px 25px rgba(15,23,42,.055);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}

.kosa-main-stat-card:hover {
    transform: translateY(-2px);

    box-shadow:
        0 10px 30px rgba(15,23,42,.08);
}

.kosa-main-stat-icon {
    width: 58px;
    height: 58px;

    flex: 0 0 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    font-size: 23px;
}

.kosa-main-stat-icon.alumni {
    background: #e5f5ff;

    color: #0284c7;
}

.kosa-main-stat-icon.degree {
    background: #f0ecff;

    color: #7c3aed;
}

.kosa-main-stat-icon.short-course {
    background: #eaf7ff;

    color: #0ea5e9;
}

.kosa-main-stat-content {
    min-width: 0;
}

.kosa-main-stat-content span {
    display: block;

    margin-bottom: 3px;

    color: #0284c7;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;
}

.kosa-main-stat-content strong {
    display: block;

    color: #102a5c;

    font-size: 31px;

    font-weight: 800;

    line-height: 1.15;
}

.kosa-main-stat-content small {
    display: block;

    margin-top: 4px;

    color: #6480a7;

    font-size: 11px;
}



/* =========================================================
   SEARCH
========================================================= */

.kosa-search-box {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 35px;

    margin-bottom: 25px;

    padding: 25px 30px;

    border: 1px solid #dbeafe;

    border-radius: 20px;

    background:
        linear-gradient(
            135deg,
            #eff9ff,
            #f8fcff
        );

    box-shadow:
        0 7px 25px rgba(15,23,42,.05);
}

.kosa-search-info {
    display: flex;

    align-items: center;

    gap: 20px;

    min-width: 0;
}

.kosa-search-icon {
    width: 66px;
    height: 66px;

    flex: 0 0 66px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            #0284c7,
            #0ea5e9
        );

    color: #fff;

    font-size: 30px;

    box-shadow:
        0 8px 20px rgba(2,132,199,.20);
}

.kosa-search-info span {
    display: block;

    margin-bottom: 3px;

    color: #0284c7;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1px;
}

.kosa-search-info h2 {
    margin: 0 0 3px;

    color: #102a5c;

    font-size: 25px;

    font-weight: 800;
}

.kosa-search-info p {
    max-width: 500px;

    margin: 0;

    color: #54709c;

    font-size: 14px;

    line-height: 1.5;
}

.kosa-search-form {
    display: flex;

    align-items: center;

    gap: 10px;

    width: 55%;
}

.kosa-search-input {
    position: relative;

    flex: 1;
}

.kosa-search-input i {
    position: absolute;

    top: 50%;
    left: 18px;

    transform: translateY(-50%);

    color: #6480a7;

    font-size: 17px;

    pointer-events: none;
}

.kosa-search-input input {
    width: 100%;

    height: 54px;

    padding:
        0
        15px
        0
        48px;

    border: 1px solid #d5e4f2;

    border-radius: 11px;

    background: #fff;

    color: #1e293b;

    font-size: 14px;

    outline: none;

    transition: .2s ease;
}

.kosa-search-input input:focus {
    border-color: #0284c7;

    box-shadow:
        0 0 0 3px rgba(2,132,199,.08);
}

.kosa-search-form button {
    height: 54px;

    padding: 0 23px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border: none;

    border-radius: 11px;

    background: #0284c7;

    color: #fff;

    font-size: 13px;

    font-weight: 800;

    white-space: nowrap;

    cursor: pointer;

    transition: .2s ease;
}

.kosa-search-form button:hover {
    background: #036fa8;

    transform: translateY(-1px);
}



/* =========================================================
   STATISTIK GRID
========================================================= */

.kosa-statistik-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 24px;
}



/* =========================================================
   STAT CARD
========================================================= */

.kosa-stat-card {
    min-width: 0;

    padding: 25px;

    border: 1px solid #e0ebf5;

    border-radius: 21px;

    background: #fff;

    box-shadow:
        0 7px 25px rgba(15,23,42,.055);
}

.kosa-card-header {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 18px;

    margin-bottom: 24px;
}

.kosa-card-title {
    display: flex;

    align-items: center;

    gap: 15px;

    min-width: 0;
}

.kosa-card-icon {
    width: 50px;
    height: 50px;

    flex: 0 0 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #e5f5ff;

    color: #0284c7;

    font-size: 21px;
}

.kosa-card-title span {
    display: block;

    margin-bottom: 5px;

    color: #0284c7;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;
}

.kosa-card-title h2 {
    margin: 0;

    color: #102a5c;

    font-size: 24px;

    font-weight: 800;
}

.kosa-total-badge {
    flex-shrink: 0;

    padding: 10px 14px;

    border-radius: 999px;

    background: #eff8ff;

    color: #0284c7;

    font-size: 11px;

    font-weight: 800;

    white-space: nowrap;
}



/* =========================================================
   DONUT
========================================================= */

.kosa-gender-layout {
    display: flex;

    align-items: center;

    gap: 38px;
}

.kosa-donut-wrapper,
.kosa-program-donut-wrap {
    display: flex;

    align-items: center;

    justify-content: center;
}

.kosa-donut {
    position: relative;

    width: 170px;
    height: 170px;

    flex: 0 0 170px;

    border-radius: 50%;

    background:
        conic-gradient(
            #1599e5 0% var(--male),
            #f04d91 var(--male) var(--female),
            #e5edf5 var(--female) 100%
        );
}

.kosa-donut::before {
    content: "";

    position: absolute;

    inset: 25px;

    border-radius: 50%;

    background: #fff;
}

.kosa-program-donut {
    background: #e5edf5;
}

.kosa-donut-center {
    position: absolute;

    inset: 0;

    z-index: 2;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    text-align: center;
}

.kosa-donut-center span {
    color: #6480a7;

    font-size: 11px;
}

.kosa-donut-center strong {
    color: #102a5c;

    font-size: 24px;

    font-weight: 800;

    line-height: 1.2;
}

.kosa-donut-center small {
    color: #6480a7;

    font-size: 10px;
}



/* =========================================================
   GENDER DETAIL
========================================================= */

.kosa-gender-details {
    flex: 1;

    display: flex;

    flex-direction: column;

    gap: 27px;
}

.kosa-gender-detail {
    display: flex;

    align-items: center;

    gap: 14px;
}

.kosa-gender-detail-icon {
    width: 46px;
    height: 46px;

    flex: 0 0 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    font-size: 21px;
}

.kosa-gender-detail-icon.male {
    background: #e3f5ff;

    color: #168fdb;
}

.kosa-gender-detail-icon.female {
    background: #ffe5f1;

    color: #ed4b91;
}

.kosa-gender-detail-content {
    display: grid;

    grid-template-columns:
        auto auto;

    column-gap: 9px;

    align-items: baseline;
}

.kosa-gender-detail-content span {
    grid-column: 1 / -1;

    color: #3e5880;

    font-size: 13px;

    font-weight: 600;
}

.kosa-gender-detail-content strong {
    color: #102a5c;

    font-size: 25px;

    font-weight: 800;
}

.kosa-gender-detail-content small {
    color: #6480a7;

    font-size: 12px;
}



/* =========================================================
   KLASIFIKASI PROGRAM
========================================================= */

.kosa-program-layout {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        175px;

    gap: 25px;

    align-items: center;
}

.kosa-program-items {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 13px;
}

.kosa-program-item {
    min-height: 125px;

    padding: 18px;

    border-radius: 14px;

    text-align: center;

    background: #eef8ff;
}

.kosa-program-item.short {
    background: #eaf7ff;
}

.kosa-program-item.degree {
    background: #f0ecff;
}

.kosa-program-item.master {
    background: #fff5e6;
}

.kosa-program-item.phd {
    background: #e7f9f1;
}

.kosa-program-item-icon {
    margin-bottom: 7px;

    color: #0284c7;

    font-size: 22px;
}


/* DIPERBAIKI */
.kosa-program-item.degree .kosa-program-item-icon {
    color: #7c3aed;
}

.kosa-program-item.master .kosa-program-item-icon {
    color: #f59e0b;
}

.kosa-program-item.phd .kosa-program-item-icon {
    color: #059669;
}


.kosa-program-item span {
    display: block;

    color: #29476f;

    font-size: 12px;

    font-weight: 700;
}

.kosa-program-item strong {
    display: block;

    margin-top: 5px;

    color: #102a5c;

    font-size: 24px;

    font-weight: 800;
}

.kosa-program-item small {
    color: #6480a7;

    font-size: 10px;
}



/* =========================================================
   RANKING UNIVERSITAS
========================================================= */

.kosa-ranking-list {
    display: flex;

    flex-direction: column;

    gap: 13px;
}

.kosa-ranking-item {
    display: flex;

    align-items: center;

    gap: 11px;
}

.kosa-ranking-number {
    width: 33px;
    height: 33px;

    flex: 0 0 33px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #0284c7;

    color: #fff;

    font-size: 12px;

    font-weight: 800;
}

.kosa-ranking-main {
    flex: 1;

    min-width: 0;
}

.kosa-ranking-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    margin-bottom: 7px;
}

.kosa-ranking-top span {
    overflow: hidden;

    color: #29476f;

    font-size: 12px;

    font-weight: 600;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.kosa-ranking-top strong {
    flex-shrink: 0;

    color: #102a5c;

    font-size: 13px;

    font-weight: 800;
}

.kosa-ranking-item > small {
    width: 45px;

    flex: 0 0 45px;

    color: #6480a7;

    font-size: 10px;

    text-align: right;
}

.kosa-ranking-bar {
    width: 100%;

    height: 8px;

    overflow: hidden;

    border-radius: 999px;

    background: #e7eff6;
}

.kosa-ranking-bar div {
    height: 100%;

    border-radius: inherit;

    background:
        linear-gradient(
            90deg,
            #1599e5,
            #42b9e9
        );
}



/* =========================================================
   JENIS KEILMUAN
========================================================= */

.kosa-field-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;
}

.kosa-field-box {
    display: flex;

    align-items: center;

    gap: 15px;

    min-width: 0;

    padding: 21px;

    border-radius: 16px;

    background: #edf8ff;
}

.kosa-field-box.social {
    background: #f5efff;
}

.kosa-field-box-icon {
    width: 50px;
    height: 50px;

    flex: 0 0 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #dff1ff;

    color: #0284c7;

    font-size: 22px;
}


/* DIPERBAIKI */
.kosa-field-box.social .kosa-field-box-icon {
    background: #e9dcff;

    color: #8b5cf6;
}


.kosa-field-box span {
    display: block;

    color: #29476f;

    font-size: 12px;

    font-weight: 700;
}

.kosa-field-box strong {
    display: inline-block;

    margin-top: 3px;

    color: #102a5c;

    font-size: 26px;

    font-weight: 800;
}

.kosa-field-box small {
    margin-left: 5px;

    color: #6480a7;

    font-size: 11px;
}



/* =========================================================
   CARD NOTE
========================================================= */

.kosa-card-note {
    display: flex;

    align-items: center;

    gap: 11px;

    margin-top: 21px;

    padding: 14px 16px;

    border-radius: 11px;

    background: #eef8fd;

    color: #54709c;

    font-size: 11px;

    line-height: 1.5;
}

.kosa-card-note i {
    flex-shrink: 0;

    color: #0284c7;

    font-size: 16px;
}



/* =========================================================
   CTA
========================================================= */

.kosa-statistik-cta {
    display: flex;

    align-items: center;

    gap: 23px;

    margin-top: 24px;

    padding: 28px 32px;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            #087fbd,
            #0999dc
        );

    box-shadow:
        0 10px 30px rgba(2,132,199,.18);
}

.kosa-cta-icon {
    width: 60px;
    height: 60px;

    flex: 0 0 60px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: rgba(255,255,255,.95);

    color: #0284c7;

    font-size: 24px;
}

.kosa-cta-content {
    flex: 1;

    min-width: 0;
}

.kosa-cta-content > span {
    display: block;

    margin-bottom: 3px;

    color: rgba(255,255,255,.8);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;
}

.kosa-cta-content h3 {
    margin: 0 0 4px;

    color: #fff;

    font-size: 21px;

    font-weight: 800;
}

.kosa-cta-content p {
    margin: 0;

    color: rgba(255,255,255,.88);

    font-size: 12px;
}

.kosa-cta-button {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 23px;

    border-radius: 999px;

    background: #fff;

    color: #0284c7;

    font-size: 12px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

    transition: .2s ease;
}

.kosa-cta-button:hover {
    color: #036fa8;

    transform: translateY(-1px);
}



/* =========================================================
   EMPTY DATA
========================================================= */

.kosa-empty-data {
    display: flex;

    align-items: center;

    justify-content: center;

    min-height: 90px;

    color: #94a3b8;

    font-size: 13px;
}



/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .kosa-main-statistics {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }


    .kosa-search-box {
        flex-direction: column;

        align-items: stretch;
    }


    .kosa-search-form {
        width: 100%;
    }


    .kosa-statistik-grid {
        grid-template-columns: 1fr;
    }


    .kosa-program-layout {
        grid-template-columns:
            minmax(0, 1fr)
            180px;
    }

}



/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {


    /* PAGE */

    .kosa-statistik-page {
        padding: 35px 0 50px;
    }



    /* BANNER */

    .kosa-page-banner {
        padding: 65px 0;
    }

    .kosa-page-banner h1 {
        font-size: 32px;
    }

    .kosa-page-banner p {
        padding: 0 15px;

        font-size: 13px;
    }



    /* HEADER */

    .kosa-statistik-header {
        padding:
            5px
            15px
            28px;
    }

    .kosa-statistik-header-label {
        font-size: 12px;
    }

    .kosa-statistik-header-label i {
        font-size: 21px;
    }

    .kosa-statistik-header h1 {
        font-size: 29px;
    }

    .kosa-statistik-header p {
        font-size: 14px;
    }



    /* STATISTIK UTAMA */

    .kosa-main-statistics {
        grid-template-columns: 1fr;

        gap: 12px;

        margin-bottom: 20px;
    }

    .kosa-main-stat-card {
        padding: 19px 20px;
    }

    .kosa-main-stat-icon {
        width: 52px;
        height: 52px;

        flex-basis: 52px;

        font-size: 21px;
    }

    .kosa-main-stat-content strong {
        font-size: 27px;
    }



    /* SEARCH */

    .kosa-search-box {
        padding: 20px;
    }

    .kosa-search-info {
        align-items: flex-start;
    }

    .kosa-search-icon {
        width: 56px;
        height: 56px;

        flex-basis: 56px;

        font-size: 24px;
    }

    .kosa-search-info h2 {
        font-size: 22px;
    }

    .kosa-search-info p {
        font-size: 13px;
    }

    .kosa-search-form {
        flex-direction: column;
    }

    .kosa-search-input {
        width: 100%;
    }

    .kosa-search-form button {
        width: 100%;
    }



    /* CARD */

    .kosa-stat-card {
        padding: 20px;
    }

    .kosa-card-header {
        gap: 12px;

        margin-bottom: 20px;
    }

    .kosa-card-title {
        gap: 11px;
    }

    .kosa-card-icon {
        width: 44px;
        height: 44px;

        flex-basis: 44px;

        font-size: 19px;
    }

    .kosa-card-title h2 {
        font-size: 21px;
    }

    .kosa-total-badge {
        padding: 8px 10px;

        font-size: 9px;
    }



    /* GENDER */

    .kosa-gender-layout {
        flex-direction: column;

        gap: 25px;
    }

    .kosa-donut {
        width: 155px;
        height: 155px;

        flex-basis: 155px;
    }

    .kosa-gender-details {
        width: 100%;

        gap: 20px;
    }



    /* PROGRAM */

    .kosa-program-layout {
        grid-template-columns: 1fr;
    }

    .kosa-program-items {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .kosa-program-donut-wrap {
        margin-top: 10px;
    }



    /* RANKING */

    .kosa-ranking-top span {
        max-width: 100%;
    }



    /* FIELD */

    .kosa-field-grid {
        grid-template-columns: 1fr;
    }

    .kosa-field-box strong {
        font-size: 23px;
    }



    /* CTA */

    .kosa-statistik-cta {
        flex-direction: column;

        align-items: flex-start;

        padding: 23px;
    }

    .kosa-cta-content h3 {
        font-size: 19px;
    }

    .kosa-cta-button {
        width: 100%;
    }

}



/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {


    .kosa-main-stat-card {
        gap: 13px;

        padding: 17px;
    }


    .kosa-main-stat-icon {
        width: 48px;
        height: 48px;

        flex-basis: 48px;

        font-size: 19px;
    }


    .kosa-main-stat-content span {
        font-size: 9px;
    }


    .kosa-main-stat-content strong {
        font-size: 25px;
    }


    .kosa-main-stat-content small {
        font-size: 10px;
    }



    .kosa-card-header {
        align-items: flex-start;
    }


    .kosa-card-title h2 {
        font-size: 19px;
    }


    .kosa-total-badge {
        max-width: 105px;

        overflow: hidden;

        font-size: 8px;

        text-overflow: ellipsis;
    }



    .kosa-program-items {
        grid-template-columns: 1fr;
    }



    .kosa-ranking-top span {
        max-width: 170px;
    }


}

</style>

@endsection