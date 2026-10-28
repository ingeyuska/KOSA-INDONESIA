@extends('frontend.alumni.layouts.app')

@section('title', 'Event - Portal ALUMNI KOSA Indonesia')

@section('content')

<section class="kosa-alumni-dashboard">

    <div class="container">

        {{-- HEADER --}}
        <div class="kosa-dashboard-welcome">
            <div>
                <span class="kosa-dashboard-label">
                    PORTAL AlUMNI
                </span>

                <h1>
                    Event KOSA Indonesia
                </h1>

                <p>
                    Temukan dan ikuti berbagai kegiatan KOSA Indonesia.
                </p>
            </div>
        </div>


        {{-- =====================================================
    DAFTAR EVENT
====================================================== --}}

<div class="row">

    @forelse($events as $event)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="kosa-event-card">

                {{-- =========================
                    FOTO EVENT
                ========================== --}}
                @if($event->foto)

                    <img
                        src="{{ asset('storage/' . $event->foto) }}"
                        alt="{{ $event->judul }}">

                @else

                    <div class="kosa-event-no-image">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>

                @endif


                {{-- =========================
                    CONTENT EVENT
                ========================== --}}
                <div class="kosa-event-card-body">

                    {{-- TANGGAL --}}
                    <span class="kosa-event-date">
                        {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                    </span>


                    {{-- JUDUL --}}
                    <h3>
                        {{ $event->judul }}
                    </h3>


                    {{-- DESKRIPSI --}}
                    <p>
                        {{ Str::limit($event->deskripsi, 100) }}
                    </p>


                    {{-- =========================
                        DETAIL EVENT
                    ========================== --}}
                    @if($event->slug)

                        <a
                            href="{{ route('alumni.event.show', $event->slug) }}"
                            class="kosa-dashboard-button">

                            Lihat Event

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    @else

                        <span class="kosa-event-no-slug">
                            Detail event belum tersedia
                        </span>

                    @endif

                </div>

            </div>

        </div>

    @empty

        {{-- =========================
            TIDAK ADA EVENT
        ========================== --}}

        <div class="col-12">

            <div class="kosa-dashboard-panel text-center">

                <i
                    class="fa-solid fa-calendar-xmark"
                    style="font-size:40px;color:#d9e1eb;">
                </i>

                <h3 style="margin-top:15px;">
                    Belum Ada Event
                </h3>

                <p>
                    Saat ini belum tersedia event KOSA Indonesia.
                </p>

            </div>

        </div>

    @endforelse

</div>

    </div>

</section>


<style>

.kosa-event-card {
    height: 100%;
    overflow: hidden;

    border-radius: 14px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.06);

    transition: 0.2s;
}

.kosa-event-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 10px 30px rgba(31, 45, 61, 0.10);
}

.kosa-event-card img {
    width: 100%;
    height: 190px;

    object-fit: cover;

    display: block;
}

.kosa-event-no-image {
    width: 100%;
    height: 190px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #edf3f9;

    color: #0d2b52;

    font-size: 40px;
}

.kosa-event-card-body {
    padding: 22px;
}

.kosa-event-date {
    display: block;

    margin-bottom: 8px;

    color: #0d2b52;

    font-size: 12px;
    font-weight: 700;
}

.kosa-event-card h3 {
    margin: 0 0 10px;

    color: #172b4d;

    font-size: 18px;
    font-weight: 700;
}

.kosa-event-card p {
    min-height: 45px;

    margin-bottom: 18px;

    color: #7b8794;

    font-size: 13px;

    line-height: 1.6;
}

</style>

@endsection