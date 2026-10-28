@extends('frontend.v_layouts.app')

@section('title', 'Cari Alumni - KOSA Indonesia')

@section('content')

{{-- =====================================================
    PAGE BANNER
====================================================== --}}

<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>Pencarian Alumni</h1>

            <p>
                Temukan data alumni KOSA Indonesia
            </p>

        </div>

    </div>

</section>


{{-- =====================================================
    SEARCH
====================================================== --}}

<section class="kosa-search-result-section">

    <div class="container">

        {{-- =================================================
            SEARCH BOX
        ================================================== --}}

        <div class="kosa-search-box">

            <form
                action="{{ route('alumni.cari') }}"
                method="GET"
            >

                <div class="kosa-search-input">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama, program, institusi, angkatan..."
                        autocomplete="off"
                    >

                </div>

                <button type="submit">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Cari Alumni

                </button>

            </form>

        </div>


        {{-- =================================================
            HASIL PENCARIAN
        ================================================== --}}

        @if($search !== '')

            {{-- RESULT HEADING --}}

            <div class="kosa-search-result-heading">

                <div>

                    <span>
                        Hasil Pencarian
                    </span>

                    <h2>
                        "{{ $search }}"
                    </h2>

                </div>

                <div class="kosa-result-count">

                    {{ $alumni->total() }} Alumni

                </div>

            </div>


            {{-- =================================================
                HASIL ALUMNI
            ================================================== --}}

            @if($alumni->count() > 0)

                <div class="kosa-alumni-grid">

                    @foreach($alumni as $item)

                        <div class="kosa-alumni-card">

                            {{-- =================================
                                FOTO
                            ================================== --}}

                            <div class="kosa-alumni-photo">

                                @if($item->foto)

                                    <img
                                        src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->nama }}"
                                    >

                                @else

                                    <div class="kosa-alumni-photo-placeholder">

                                        <i class="fa-solid fa-user"></i>

                                    </div>

                                @endif


                                {{-- =================================
                                    VERIFIED BADGE
                                ================================== --}}

                                @if(
                                    $item->user &&
                                    $item->user->email_verified_at &&
                                    $item->tracer_progress >= 100
                                )

                                    <div class="kosa-verified-badge">

                                        <i class="fa-solid fa-circle-check"></i>

                                        <span>VERIFIED</span>

                                    </div>

                                @endif

                            </div>


                            {{-- =================================
                                DATA ALUMNI
                            ================================== --}}

                            <div class="kosa-alumni-info">

                                <h3>
                                    {{ $item->nama }}
                                </h3>


                                {{-- PROGRAM --}}

                                @if($item->program)

                                    <div class="kosa-alumni-detail">

                                        <i class="fa-solid fa-graduation-cap"></i>

                                        <span>
                                            {{ $item->program }}
                                        </span>

                                    </div>

                                @endif


                                {{-- INSTITUSI --}}

                                @if($item->institusi)

                                    <div class="kosa-alumni-detail">

                                        <i class="fa-solid fa-building-columns"></i>

                                        <span>
                                            {{ $item->institusi }}
                                        </span>

                                    </div>

                                @endif


                                {{-- ANGKATAN --}}

                                @if($item->angkatan)

                                    <div class="kosa-alumni-detail">

                                        <i class="fa-solid fa-calendar"></i>

                                        <span>
                                            Angkatan {{ $item->angkatan }}
                                        </span>

                                    </div>

                                @endif


                                {{-- JURUSAN --}}

                                @if($item->jurusan)

                                    <div class="kosa-alumni-detail">

                                        <i class="fa-solid fa-book"></i>

                                        <span>
                                            {{ $item->jurusan }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}

                <div class="kosa-alumni-pagination">

                    {{
                        $alumni
                            ->appends(request()->query())
                            ->onEachSide(1)
                            ->links('pagination::bootstrap-5')
                    }}

                </div>


            @else

                {{-- =================================================
                    TIDAK DITEMUKAN
                ================================================== --}}

                <div class="kosa-search-empty">

                    <div class="kosa-search-empty-icon">

                        <i class="fa-solid fa-user-slash"></i>

                    </div>

                    <h3>
                        Data alumni tidak ditemukan
                    </h3>

                    <p>
                        Tidak ada alumni aktif yang sesuai dengan
                        kata pencarian "{{ $search }}".
                    </p>

                    <a href="{{ route('alumni.statistik') }}">

                        <i class="fa-solid fa-arrow-left"></i>

                        Kembali ke Statistik Alumni

                    </a>

                </div>

            @endif


        @else

            {{-- =================================================
                BELUM ADA PENCARIAN
            ================================================== --}}

            <div class="kosa-search-empty">

                <div class="kosa-search-empty-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

                <h3>
                    Cari Alumni KOSA Indonesia
                </h3>

                <p>
                    Masukkan nama, program, institusi,
                    angkatan, atau jurusan untuk mencari alumni.
                </p>

            </div>

        @endif

    </div>

</section>


<style>

/* =========================================================
   SEARCH RESULT SECTION
========================================================= */

.kosa-search-result-section {
    padding: 70px 0;
    background: #f7faff;
}


/* =========================================================
   SEARCH BOX
========================================================= */

.kosa-search-box {
    max-width: 900px;
    margin: 0 auto 55px;
}

.kosa-search-box form {
    display: flex;
    gap: 12px;
}

.kosa-search-input {
    position: relative;
    flex: 1;
}

.kosa-search-input i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
}

.kosa-search-input input {
    width: 100%;
    height: 56px;

    border: 1px solid #dce4ee;
    border-radius: 12px;

    padding: 0 20px 0 48px;

    font-size: 15px;
    background: #fff;

    outline: none;
    box-sizing: border-box;
}

.kosa-search-input input:focus {
    border-color: #004f7f;
    box-shadow: 0 0 0 3px rgba(0, 79, 127, .10);
}

.kosa-search-box button {
    height: 56px;

    padding: 0 26px;

    border: none;
    border-radius: 12px;

    background: #004f7f;
    color: #fff;

    font-weight: 600;

    cursor: pointer;
    white-space: nowrap;

    transition: .2s ease;
}

.kosa-search-box button:hover {
    background: #003d63;
}


/* =========================================================
   RESULT HEADING
========================================================= */

.kosa-search-result-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 28px;
}

.kosa-search-result-heading span {
    display: block;

    font-size: 14px;
    color: #6b7280;

    margin-bottom: 5px;
}

.kosa-search-result-heading h2 {
    margin: 0;

    color: #123b5d;

    font-size: 28px;
    font-weight: 700;
}

.kosa-result-count {
    background: #e8f3fa;
    color: #004f7f;

    padding: 10px 17px;

    border-radius: 30px;

    font-weight: 600;
}


/* =========================================================
   ALUMNI GRID
========================================================= */

.kosa-alumni-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 24px;
}


/* =========================================================
   CARD
========================================================= */

.kosa-alumni-card {
    background: #fff;

    border-radius: 18px;
    overflow: hidden;

    border: 1px solid #e5ebf2;

    box-shadow:
        0 8px 25px rgba(15, 50, 80, .06);

    transition: .25s ease;
}

.kosa-alumni-card:hover {
    transform: translateY(-4px);

    box-shadow:
        0 15px 35px rgba(15, 50, 80, .11);
}


/* =========================================================
   FOTO
========================================================= */

.kosa-alumni-photo {
    position: relative;

    height: 220px;

    background: #edf4f8;

    overflow: hidden;
}

.kosa-alumni-photo img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;
}

.kosa-alumni-photo-placeholder {
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 65px;

    color: #a9bdcb;
}


/* =========================================================
   VERIFIED BADGE
========================================================= */

.kosa-verified-badge {
    position: absolute;

    top: 14px;
    right: 14px;

    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    background: #ffffff;

    color: #004f7f;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: .4px;

    box-shadow:
        0 4px 12px rgba(0, 0, 0, .15);

    z-index: 5;
}

.kosa-verified-badge i {
    font-size: 14px;
}


/* =========================================================
   INFO
========================================================= */

.kosa-alumni-info {
    padding: 22px;
}

.kosa-alumni-info h3 {
    margin: 0 0 17px;

    color: #123b5d;

    font-size: 20px;
    font-weight: 700;
}

.kosa-alumni-detail {
    display: flex;

    gap: 10px;

    align-items: flex-start;

    margin-bottom: 10px;

    color: #5f6f7d;

    font-size: 14px;
}

.kosa-alumni-detail i {
    width: 18px;

    color: #004f7f;

    margin-top: 2px;

    flex-shrink: 0;
}


/* =========================================================
   EMPTY
========================================================= */

.kosa-search-empty {
    max-width: 650px;

    margin: 40px auto;

    padding: 55px 30px;

    text-align: center;

    background: #fff;

    border-radius: 20px;

    border: 1px solid #e5ebf2;
}

.kosa-search-empty-icon {
    width: 75px;
    height: 75px;

    margin: 0 auto 20px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eaf4f9;

    color: #004f7f;

    font-size: 30px;
}

.kosa-search-empty h3 {
    color: #123b5d;

    margin-bottom: 10px;
}

.kosa-search-empty p {
    color: #6b7280;

    margin-bottom: 22px;
}

.kosa-search-empty a {
    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 11px 18px;

    border-radius: 10px;

    background: #004f7f;

    color: #fff;

    text-decoration: none;

    transition: .2s ease;
}

.kosa-search-empty a:hover {
    background: #003d63;
}


/* =========================================================
   PAGINATION
========================================================= */

.kosa-alumni-pagination {
    margin-top: 35px;

    width: 100%;
}


/* =========================================================
   PAGINATION DESKTOP
========================================================= */

.kosa-alumni-pagination nav {
    width: 100%;
}


/* Wrapper desktop */

.kosa-alumni-pagination nav > div.d-none.d-sm-flex {
    display: flex !important;

    flex-direction: column !important;

    align-items: center !important;

    justify-content: center !important;

    width: 100%;
}


/* Showing */

.kosa-alumni-pagination
nav > div.d-none.d-sm-flex
> div:first-child {

    order: 2;

    width: 100%;

    text-align: center;

    margin-top: 12px;
}

.kosa-alumni-pagination
nav > div.d-none.d-sm-flex
> div:first-child p {

    margin: 0 !important;

    text-align: center !important;

    font-size: 13px;

    color: #7a8794;
}


/* Nomor halaman */

.kosa-alumni-pagination
nav > div.d-none.d-sm-flex
> div:last-child {

    order: 1;

    width: 100%;

    display: flex !important;

    justify-content: center !important;
}

.kosa-alumni-pagination .pagination {
    margin: 0 auto !important;

    justify-content: center !important;
}


/* =========================================================
   SEMBUNYIKAN PAGINATION MOBILE DI DESKTOP
========================================================= */

.kosa-alumni-pagination
nav > div.d-sm-none {

    display: none !important;
}


/* =========================================================
   MOBILE PAGINATION
========================================================= */

@media (max-width: 575px) {

    .kosa-alumni-pagination
    nav > div.d-none.d-sm-flex {

        display: none !important;
    }

    .kosa-alumni-pagination
    nav > div.d-sm-none {

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        width: 100%;

        text-align: center;
    }

    .kosa-alumni-pagination
    nav > div.d-sm-none
    > div:first-child {

        margin-bottom: 12px;
    }

    .kosa-alumni-pagination
    nav > div.d-sm-none p {

        margin: 0 0 12px !important;

        font-size: 13px;

        color: #7a8794;
    }

    .kosa-alumni-pagination
    nav > div.d-sm-none
    > div:last-child {

        display: flex;

        justify-content: center;
    }

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .kosa-alumni-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 767px) {

    .kosa-search-box form {
        flex-direction: column;
    }

    .kosa-search-box button {
        width: 100%;
    }

    .kosa-search-result-heading {
        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }

    .kosa-alumni-grid {
        grid-template-columns: 1fr;
    }

    .kosa-alumni-photo {
        height: 240px;
    }

}

</style>

@endsection