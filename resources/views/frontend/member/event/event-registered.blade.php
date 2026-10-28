@extends('frontend.member.layouts.app')

@section('title', 'Event Saya - KOSA Indonesia')

@section('content')

<section class="kosa-member-dashboard">

    <div class="container">

        {{-- HEADER --}}
        <div class="kosa-dashboard-welcome">

            <div>

                <span class="kosa-dashboard-label">
                    EVENT MEMBER
                </span>

                <h1>
                    Event Saya
                </h1>

                <p>
                    Daftar event yang sudah Anda daftarkan.
                </p>

            </div>

        </div>


        {{-- DAFTAR EVENT --}}
        @if($pendaftarans->count())

            <div class="row">

                @foreach($pendaftarans as $pendaftaran)

                    @php
                        $event = $pendaftaran->event;
                    @endphp

                    @if($event)

                        <div class="col-lg-6 mb-4">

                            <div class="kosa-member-event-card">

                                {{-- FOTO EVENT --}}
                                <div class="kosa-member-event-image">

                                    @if($event->foto)

                                        <img
                                            src="{{ asset('storage/' . $event->foto) }}"
                                            alt="{{ $event->judul }}"
                                        >

                                    @else

                                        <div class="kosa-member-event-image-empty">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>

                                    @endif

                                </div>


                                {{-- CONTENT --}}
                                <div class="kosa-member-event-content">

                                    <span class="kosa-member-event-status">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Sudah Terdaftar
                                    </span>


                                    <h3>
                                        {{ $event->judul }}
                                    </h3>


                                    <div class="kosa-member-event-info">

                                        @if($event->tanggal)

                                            <div>
                                                <i class="fa-regular fa-calendar"></i>

                                                {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                            </div>

                                        @endif


                                        @if($event->waktu)

                                            <div>
                                                <i class="fa-regular fa-clock"></i>

                                                {{ $event->waktu }}
                                            </div>

                                        @endif


                                        @if($event->lokasi)

                                            <div>
                                                <i class="fa-solid fa-location-dot"></i>

                                                {{ $event->lokasi }}
                                            </div>

                                        @endif

                                    </div>


                                    <a
                                        href="{{ route('member.event.show', $event->slug) }}"
                                        class="kosa-member-event-button"
                                    >
                                        Lihat Event

                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        @else

            {{-- KOSONG --}}
            <div class="kosa-member-event-empty">

                <div class="kosa-member-event-empty-icon">
                    <i class="fa-regular fa-calendar-xmark"></i>
                </div>

                <h3>
                    Belum Ada Event
                </h3>

                <p>
                    Anda belum mendaftar pada event apa pun.
                </p>

                <a
                    href="{{ route('member.event') }}"
                    class="kosa-member-event-button"
                >
                    Lihat Semua Event

                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        @endif

    </div>

</section>


<style>

.kosa-member-event-card {
    height: 100%;

    overflow: hidden;

    border-radius: 16px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.06);
}


.kosa-member-event-image {
    width: 100%;
    height: 210px;

    overflow: hidden;

    background: #edf3f9;
}


.kosa-member-event-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;
}


.kosa-member-event-image-empty {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #9aabc0;

    font-size: 45px;
}


.kosa-member-event-content {
    padding: 22px;
}


.kosa-member-event-status {
    display: inline-flex;
    align-items: center;

    gap: 7px;

    margin-bottom: 10px;

    color: #23845b;

    font-size: 12px;
    font-weight: 700;
}


.kosa-member-event-content h3 {
    margin: 0 0 16px;

    color: #172b4d;

    font-size: 19px;
    font-weight: 700;

    line-height: 1.4;
}


.kosa-member-event-info {
    display: flex;
    flex-direction: column;

    gap: 9px;

    margin-bottom: 20px;

    color: #718096;

    font-size: 13px;
}


.kosa-member-event-info div {
    display: flex;
    align-items: center;

    gap: 9px;
}


.kosa-member-event-info i {
    width: 16px;

    color: #1769e0;

    text-align: center;
}


.kosa-member-event-button {
    display: inline-flex;
    align-items: center;

    gap: 9px;

    padding: 10px 16px;

    border-radius: 8px;

    background: #0d2b52;

    color: #ffffff !important;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none !important;

    transition: 0.2s;
}


.kosa-member-event-button:hover {
    background: #1769e0;

    transform: translateY(-1px);
}


.kosa-member-event-empty {
    padding: 60px 30px;

    border-radius: 16px;

    background: #ffffff;

    box-shadow:
        0 6px 25px rgba(31, 45, 61, 0.06);

    text-align: center;
}


.kosa-member-event-empty-icon {
    margin-bottom: 15px;

    color: #9aabc0;

    font-size: 50px;
}


.kosa-member-event-empty h3 {
    margin-bottom: 8px;

    color: #172b4d;

    font-size: 20px;
}


.kosa-member-event-empty p {
    margin-bottom: 20px;

    color: #7b8794;

    font-size: 13px;
}

</style>

@endsection