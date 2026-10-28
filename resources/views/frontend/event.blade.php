@extends('frontend.v_layouts.app')

@section('title', 'Event - KOSA Indonesia')

@section('content')

{{-- =========================================================
     START PAGE BANNER
========================================================= --}}

<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Event
            </h1>

            <p>
                Kegiatan dan acara KOSA Indonesia
            </p>

        </div>

    </div>

</section>

{{-- =========================================================
     START EVENT
========================================================= --}}

<section class="blog_area section-padding">

    <div class="container">

        {{-- =====================================================
             SEARCH EVENT
        ====================================================== --}}

        <div class="event-search-wrapper">

            <div class="event-search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="eventSearch"
                    placeholder="Cari event..."
                    autocomplete="off"
                >

            </div>

        </div>


        {{-- =====================================================
             TAB EVENT
        ====================================================== --}}

        <div class="event-tab-wrapper">

            <div class="event-tabs">

                <button
                    type="button"
                    class="event-tab active"
                    data-tab="akan-datang"
                >
                    Akan Datang
                </button>

                <button
                    type="button"
                    class="event-tab"
                    data-tab="terlaksana"
                >
                    Terlaksana
                </button>

            </div>

        </div>


        {{-- =====================================================
             TAB AKAN DATANG
        ====================================================== --}}

        <div
            id="akan-datang"
            class="event-tab-content active"
        >

            <div class="row">

                @php

                    $akanDatang = $events->filter(function ($event) {

                        if (!$event->tanggal) {
                            return false;
                        }

                        return !$event->tanggal->lt(
                            \Carbon\Carbon::today()
                        );

                    });

                @endphp


                @forelse($akanDatang as $event)

                    <div
                        class="col-lg-4 col-md-6 col-sm-12 mb-4 event-item"
                        data-title="{{ strtolower($event->judul) }}"
                    >

                        <div class="event-card">

                            {{-- =================================================
                                 FOTO EVENT
                            ================================================== --}}

                            <div class="event-card-image">

                                @if($event->foto)

                                    <img
                                        src="{{ asset('storage/' . $event->foto) }}"
                                        alt="{{ $event->judul }}"
                                    >

                                @else

                                    <div class="event-no-image">

                                        <span>
                                            Tidak ada foto
                                        </span>

                                    </div>

                                @endif


                                {{-- STATUS --}}

                                <span class="event-card-status status-upcoming">

                                    Akan Datang

                                </span>

                            </div>


                            {{-- =================================================
                                 ISI EVENT
                            ================================================== --}}

                            <div class="event-card-body">

                                {{-- JUDUL --}}

                                <h2>
                                    {{ $event->judul }}
                                </h2>


                                {{-- TANGGAL --}}

                                <div class="event-info">

                                    <i class="fa-regular fa-calendar"></i>

                                    <span>

                                        {{ $event->tanggal
                                            ? $event->tanggal->translatedFormat('d F Y')
                                            : '-' }}

                                    </span>

                                </div>


                                {{-- WAKTU --}}

                                @if($event->waktu)

                                    <div class="event-info">

                                        <i class="fa-regular fa-clock"></i>

                                        <span>
                                            {{ $event->waktu }}
                                        </span>

                                    </div>

                                @endif


                                {{-- LOKASI --}}

                                @if($event->lokasi)

                                    <div class="event-info">

                                        <i class="fa-solid fa-location-dot"></i>

                                        <span>
                                            {{ $event->lokasi }}
                                        </span>

                                    </div>

                                @endif


                                {{-- DESKRIPSI --}}

                                @if($event->deskripsi)

                                    <div class="event-description">

                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($event->deskripsi),
                                            90
                                        ) }}

                                    </div>

                                @endif


                                {{-- =================================================
                                     BUTTON
                                ================================================== --}}

                                <div class="event-card-buttons">

                                    {{-- =========================================
                                         PENDAFTARAN
                                    ========================================== --}}

                                    @if($event->pendaftaran_aktif)

                                       <a
                                            href="{{ route('register', ['event' => $event->slug]) }}"
                                            class="event-button"
                                            >
                                                <i class="fa-solid fa-user-plus"></i>
                                                Link Pendaftaran
                                            </a>

                                    @else

                                        <span
                                            class="event-button event-button-disabled"
                                        >

                                            <i class="fa-solid fa-user-plus"></i>

                                            Pendaftaran Belum Tersedia

                                        </span>

                                    @endif


                                    {{-- =========================================
                                         DETAIL / GALERI
                                    ========================================== --}}

                                    <a
                                        href="{{ route('event.show', $event->slug) }}"
                                        class="event-button"
                                    >

                                        <i class="fa-regular fa-images"></i>

                                        Lihat Galeri

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>


                @empty

                    <div class="col-12 text-center">

                        <div class="event-empty">

                            <i class="fa-regular fa-calendar-xmark"></i>

                            <p>
                                Belum ada event yang akan datang.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- =====================================================
             TAB TERLAKSANA
        ====================================================== --}}

        <div
            id="terlaksana"
            class="event-tab-content"
        >

            <div class="row">

                @php

                    $terlaksana = $events->filter(function ($event) {

                        if (!$event->tanggal) {
                            return false;
                        }

                        return $event->tanggal->lt(
                            \Carbon\Carbon::today()
                        );

                    });

                @endphp


                @forelse($terlaksana as $event)

                    <div
                        class="col-lg-4 col-md-6 col-sm-12 mb-4 event-item"
                        data-title="{{ strtolower($event->judul) }}"
                    >

                        <div class="event-card">

                            {{-- =================================================
                                 FOTO EVENT
                            ================================================== --}}

                            <div class="event-card-image">

                                @if($event->foto)

                                    <img
                                        src="{{ asset('storage/' . $event->foto) }}"
                                        alt="{{ $event->judul }}"
                                    >

                                @else

                                    <div class="event-no-image">

                                        <span>
                                            Tidak ada foto
                                        </span>

                                    </div>

                                @endif


                                {{-- STATUS --}}

                                <span class="event-card-status status-finished">

                                    Selesai

                                </span>

                            </div>


                            {{-- =================================================
                                 ISI EVENT
                            ================================================== --}}

                            <div class="event-card-body">

                                {{-- JUDUL --}}

                                <h2>
                                    {{ $event->judul }}
                                </h2>


                                {{-- TANGGAL --}}

                                <div class="event-info">

                                    <i class="fa-regular fa-calendar"></i>

                                    <span>

                                        {{ $event->tanggal
                                            ? $event->tanggal->translatedFormat('d F Y')
                                            : '-' }}

                                    </span>

                                </div>


                                {{-- WAKTU --}}

                                @if($event->waktu)

                                    <div class="event-info">

                                        <i class="fa-regular fa-clock"></i>

                                        <span>
                                            {{ $event->waktu }}
                                        </span>

                                    </div>

                                @endif


                                {{-- LOKASI --}}

                                @if($event->lokasi)

                                    <div class="event-info">

                                        <i class="fa-solid fa-location-dot"></i>

                                        <span>
                                            {{ $event->lokasi }}
                                        </span>

                                    </div>

                                @endif


                                {{-- DESKRIPSI --}}

                                @if($event->deskripsi)

                                    <div class="event-description">

                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($event->deskripsi),
                                            90
                                        ) }}

                                    </div>

                                @endif


                                {{-- =================================================
                                     BUTTON
                                ================================================== --}}

                                <div class="event-card-buttons">

                                    {{-- LIHAT GALERI --}}

                                <a
                                    href="{{ route('event.show', $event->slug) }}#galeri"
                                    class="event-button"
                                >
                                    <i class="fa-regular fa-images"></i>
                                    Lihat Galeri
                                </a>


                                    {{-- MATERI PAPARAN --}}

                                    @if($event->materi)

                                        <a
                                            href="{{ asset('storage/' . $event->materi) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="event-button" >

                                            <i class="fa-solid fa-file-lines"></i>

                                            Materi Paparan

                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                @empty

                    <div class="col-12 text-center">

                        <div class="event-empty">

                            <i class="fa-regular fa-calendar-xmark"></i>

                            <p>
                                Belum ada event yang terlaksana.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- =====================================================
             SEARCH TIDAK DITEMUKAN
        ====================================================== --}}

        <div
            id="eventSearchEmpty"
            class="event-search-empty"
            style="display:none;"
        >

            <i class="fa-solid fa-magnifying-glass"></i>

            <p>
                Event yang dicari tidak ditemukan.
            </p>

        </div>

    </div>

</section>

{{-- =========================================================
     STYLE
========================================================= --}}

<style>

/* =========================================================
   SEARCH
========================================================= */

.event-search-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 45px;
}

.event-search-box {
    width: 100%;
    max-width: 510px;
    height: 42px;
    border: 1px solid #d7dee7;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding: 0 14px;
    background: #fff;
}

.event-search-box i {
    color: #5f7896;
    margin-right: 12px;
}

.event-search-box input {
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    font-size: 14px;
    color: #333;
}

.event-search-box input::placeholder {
    color: #71839a;
}


/* =========================================================
   TAB
========================================================= */

.event-tab-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 70px;
}

.event-tabs {
    display: flex;
    background: #e9edf3;
    padding: 4px;
    border-radius: 10px;
}

.event-tab {
    border: none;
    background: transparent;
    padding: 8px 16px;
    border-radius: 7px;
    color: #60758f;
    font-size: 14px;
    cursor: pointer;
    transition: 0.2s;
}

.event-tab:hover {
    color: #092d54;
}

.event-tab.active {
    background: #fff;
    color: #092d54;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
}


/* =========================================================
   TAB CONTENT
========================================================= */

.event-tab-content {
    display: none;
}

.event-tab-content.active {
    display: block;
}


/* =========================================================
   EVENT CARD
========================================================= */

.event-card {
    background: #fff;
    border: 1px solid #dce3ea;
    border-radius: 12px;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.10);
}


/* =========================================================
   FOTO EVENT
========================================================= */

.event-card-image {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.event-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

.event-no-image {
    width: 100%;
    height: 100%;
    background: #f3f3f3;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
}


/* =========================================================
   STATUS
========================================================= */

.event-card-status {
    position: absolute;
    top: 12px;
    left: 14px;
    background: #fff;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.12);
}

.status-upcoming {
    color: #2c7aff;
}

.status-finished {
    color: #666;
}


/* =========================================================
   CARD BODY
========================================================= */

.event-card-body {
    padding: 24px;
}

.event-card-body h2 {
    font-family: Georgia, serif;
    font-size: 20px;
    line-height: 1.4;
    color: #08294d;
    margin: 0 0 14px;
    font-weight: 700;
}


/* =========================================================
   EVENT INFO
========================================================= */

.event-info {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    color: #627b98;
    font-size: 14px;
}

.event-info i {
    width: 15px;
    text-align: center;
    color: #627b98;
}


/* =========================================================
   DESKRIPSI
========================================================= */

.event-description {
    color: #627b98;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 14px;
}


/* =========================================================
   BUTTON
========================================================= */

.event-card-buttons {
    display: flex;
    gap: 8px;
    margin-top: 16px;
}

.event-button {
    flex: 1;
    min-height: 38px;
    padding: 8px 10px;
    border: 1px solid #d8e0e8;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    color: #182d45;
    font-size: 14px;
    background: #fff;
    text-align: center;
    text-decoration: none;
    transition:
        background 0.2s ease,
        color 0.2s ease,
        border-color 0.2s ease;
}

.event-button:hover {
    color: #092d54;
    background: #f5f8fb;
    border-color: #bfcbd8;
    text-decoration: none;
}


/* =========================================================
   PENDAFTARAN TIDAK AKTIF
========================================================= */

.event-button-disabled {
    color: #9aa6b2;
    background: #f8f9fa;
    cursor: default;
}

.event-button-disabled:hover {
    color: #9aa6b2;
    background: #f8f9fa;
    border-color: #d8e0e8;
}


/* =========================================================
   EMPTY
========================================================= */

.event-empty {
    text-align: center;
    padding: 50px 20px;
    color: #777;
}

.event-empty i {
    font-size: 40px;
    margin-bottom: 15px;
}

.event-empty p {
    margin: 0;
}


/* =========================================================
   SEARCH EMPTY
========================================================= */

.event-search-empty {
    text-align: center;
    padding: 40px 20px;
    color: #777;
}

.event-search-empty i {
    font-size: 35px;
    margin-bottom: 10px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .event-search-box {
        max-width: 100%;
    }

    .event-card-body {
        padding: 20px;
    }

    .event-card-body h2 {
        font-size: 19px;
    }

}

@media (max-width: 480px) {

    .event-card-buttons {
        flex-direction: column;
    }

    .event-button {
        width: 100%;
    }

}

</style>


{{-- =========================================================
     SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tabs =
        document.querySelectorAll('.event-tab');

    const contents =
        document.querySelectorAll('.event-tab-content');

    const searchInput =
        document.getElementById('eventSearch');

    const searchEmpty =
        document.getElementById('eventSearchEmpty');


    /* =====================================================
       TAB
    ====================================================== */

    tabs.forEach(function(button) {

        button.addEventListener('click', function() {

            const tab =
                this.getAttribute('data-tab');


            /* RESET ACTIVE TAB */

            tabs.forEach(function(btn) {

                btn.classList.remove('active');

            });


            contents.forEach(function(content) {

                content.classList.remove('active');

            });


            /* AKTIFKAN TAB */

            this.classList.add('active');


            const target =
                document.getElementById(tab);


            if (target) {

                target.classList.add('active');

            }


            /* SEARCH ULANG */

            filterEvents();

        });

    });


    /* =====================================================
       SEARCH
    ====================================================== */

    if (searchInput) {

        searchInput.addEventListener('input', function() {

            filterEvents();

        });

    }


    /* =====================================================
       FILTER EVENT
    ====================================================== */

    function filterEvents() {

        if (!searchInput) {
            return;
        }


        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();


        const activeTab =
            document.querySelector(
                '.event-tab-content.active'
            );


        if (!activeTab) {
            return;
        }


        const items =
            activeTab.querySelectorAll(
                '.event-item'
            );


        let visibleCount = 0;


        items.forEach(function(item) {

            const text =
                item.innerText.toLowerCase();


            if (text.includes(keyword)) {

                item.style.display = '';

                visibleCount++;

            } else {

                item.style.display = 'none';

            }

        });


        /* =================================================
           HASIL SEARCH
        ================================================== */

        if (
            keyword !== '' &&
            visibleCount === 0
        ) {

            searchEmpty.style.display = 'block';

        } else {

            searchEmpty.style.display = 'none';

        }

    }

});

</script>

@endsection