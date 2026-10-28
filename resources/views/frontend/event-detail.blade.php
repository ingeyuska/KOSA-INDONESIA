@extends('frontend.v_layouts.app')

@section('title', $event->judul . ' - Kosa Indonesia')

@section('content')

<!-- START EVENT DETAIL -->
<section class="blog_area section-padding">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9 col-md-10 col-sm-12">

                <!-- JUDUL -->
                <div class="section-title text-center">

                    <h4>Event KOSA Indonesia</h4>

                    <h1>{{ $event->judul }}</h1>

                </div>


                <!-- FOTO -->
                @if($event->foto)

                    <div class="event-detail-image">

                        <img
                            src="{{ asset('storage/' . $event->foto) }}"
                            alt="{{ $event->judul }}">

                    </div>

                @endif


                <!-- INFORMASI EVENT -->
                <div class="event-info">

                    @if($event->tanggal)

                        <div class="event-info-item">

                            <i class="fa-regular fa-calendar"></i>

                            <div>

                                <strong>Tanggal</strong>

                                <p>
                                    {{ $event->tanggal->translatedFormat('d F Y') }}
                                </p>

                            </div>

                        </div>

                    @endif


                    @if($event->waktu)

                        <div class="event-info-item">

                            <i class="fa-regular fa-clock"></i>

                            <div>

                                <strong>Waktu</strong>

                                <p>
                                    {{ $event->waktu }}
                                </p>

                            </div>

                        </div>

                    @endif


                    @if($event->lokasi)

                        <div class="event-info-item">

                            <i class="fa-solid fa-location-dot"></i>

                            <div>

                                <strong>Lokasi</strong>

                                <p>
                                    {{ $event->lokasi }}
                                </p>

                            </div>

                        </div>

                    @endif

                </div>


                <!-- DESKRIPSI -->
                @if($event->deskripsi)

                    <div class="event-detail-content">

                        <h3>Tentang Event</h3>

                        {!! $event->deskripsi !!}

                    </div>

                @endif

{{-- =====================================================
    GALERI EVENT
====================================================== --}}

@if($event->galeri && count($event->galeri) > 0)

    <div class="event-gallery" id="galeri">

        <div class="event-gallery-header">

            <h3>
                Galeri Kegiatan
            </h3>

            <p>
                Dokumentasi kegiatan {{ $event->judul }}
            </p>

        </div>

        <div class="event-gallery-grid">

            @foreach($event->galeri as $foto)

                <div class="event-gallery-item">

                    <a
                        href="{{ asset('storage/' . $foto) }}"
                        target="_blank"
                    >
                        <img
                            src="{{ asset('storage/' . $foto) }}"
                            alt="Galeri {{ $event->judul }}"
                        >
                    </a>

                </div>

            @endforeach

        </div>

    </div>

@endif



               {{-- =====================================================
    MATERI / PAPARAN EVENT
    HANYA MUNCUL JIKA EVENT SUDAH SELESAI
====================================================== --}}

@if($event->status === 'selesai' && $event->materi)

    <div class="event-material">

        <button
            type="button"
            class="event-material-button"
            onclick="toggleMateri()"
        >

            <div class="event-material-button-left">

                <div class="event-material-icon">

                    <i class="fa-solid fa-file-lines"></i>

                </div>

                <div>

                    <h3>
                        Materi / Paparan
                    </h3>

                    <p>
                        Materi yang disampaikan pada kegiatan ini
                    </p>

                </div>

            </div>


            <i
                id="materiArrow"
                class="fa-solid fa-chevron-down"
            ></i>

        </button>


        {{-- ISI MATERI --}}
        <div
            id="materiContent"
            class="event-material-content"
        >

            {!! $event->materi !!}

        </div>

    </div>

@endif

                <!-- KEMBALI -->
                <div class="text-center mt-4">

                    <a
                        href="{{ route('event') }}"
                        class="cta"
                    >

                        <span>
                            Kembali ke Event
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- END EVENT DETAIL -->


<style>

/* =========================================================
   FOTO EVENT
========================================================= */

.event-detail-image {

    width: 100%;
    margin-bottom: 30px;
    text-align: center;

}


.event-detail-image img {

    width: 100%;
    max-height: 500px;
    object-fit: cover;
    object-position: center;
    border-radius: 8px;
    display: block;

}


/* =========================================================
   INFORMASI EVENT
========================================================= */

.event-info {

    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;

}


.event-info-item {

    flex: 1 1 200px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 18px;
    background: #f8f9fa;
    border-radius: 8px;

}


.event-info-item > i {

    font-size: 22px;
    color: #2c7aff;
    margin-top: 3px;

}


.event-info-item strong {

    display: block;
    margin-bottom: 5px;

}


.event-info-item p {

    margin: 0;
    color: #666;

}


/* =========================================================
   DESKRIPSI
========================================================= */

.event-detail-content {

    font-size: 16px;
    line-height: 1.8;
    color: #555;

}


.event-detail-content h3 {

    margin-bottom: 15px;
    font-size: 24px;

}


.event-detail-content p {

    margin-bottom: 15px;

}


.event-detail-content img {

    max-width: 100%;
    height: auto;

}


/* =========================================================
   MATERI / PAPARAN
========================================================= */

.event-material {

    margin-top: 40px;
    padding: 28px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e1e6ec;

}


.event-material-header {

    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;

}


.event-material-icon {

    width: 48px;
    height: 48px;
    min-width: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #e8f1ff;
    color: #2c7aff;

    border-radius: 10px;

}


.event-material-icon i {

    font-size: 21px;

}


.event-material-header h3 {

    margin: 0 0 4px;
    font-size: 24px;
    color: #08294d;

}


.event-material-header p {

    margin: 0;
    color: #71839a;
    font-size: 14px;

}


.event-material-content {

    background: #fff;
    padding: 25px;

    border-radius: 8px;

    color: #555;
    font-size: 16px;
    line-height: 1.8;

}


.event-material-content p {

    margin-bottom: 15px;

}


.event-material-content img {

    max-width: 100%;
    height: auto;
    display: block;
    margin: 15px auto;

}


.event-material-content ul,
.event-material-content ol {

    margin-bottom: 20px;

}


.event-material-content a {

    color: #2c7aff;
    text-decoration: underline;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .event-detail-image img {

        max-height: 350px;

    }


    .event-info {

        display: block;

    }


    .event-info-item {

        margin-bottom: 12px;

    }


    .event-material {

        padding: 20px;

    }


    .event-material-header h3 {

        font-size: 21px;

    }


    .event-material-content {

        padding: 18px;

    }

}
/* =========================================================
   GALERI EVENT
========================================================= */

.event-gallery {

    margin-top: 40px;

}


.event-gallery-header {

    margin-bottom: 20px;

}


.event-gallery-header h3 {

    margin-bottom: 5px;
    font-size: 24px;
    color: #08294d;

}


.event-gallery-header p {

    margin: 0;
    color: #71839a;
    font-size: 14px;

}


.event-gallery-grid {

    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;

}


.event-gallery-item {

    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 8px;

}


.event-gallery-item a {

    display: block;
    width: 100%;
    height: 100%;

}


.event-gallery-item img {

    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;

    transition: transform .3s ease;

}


.event-gallery-item:hover img {

    transform: scale(1.05);

}

</style>

@endsection