@extends('frontend.alumni.layouts.app')

@section('title', $event->judul . ' - Portal Alumni KOSA Indonesia')

@section('content')

<section class="kosa-alumni-dashboard">

    <div class="container">

        {{-- HEADER --}}
        <div class="kosa-dashboard-welcome">

            <div>

                <span class="kosa-dashboard-label">
                    PORTAL ALUMNI
                </span>

                <h1>
                    {{ $event->judul }}
                </h1>

                <p>
                    Detail kegiatan KOSA Indonesia.
                </p>

            </div>

        </div>


        {{-- DETAIL EVENT --}}
        <div class="kosa-dashboard-panel">

            {{-- FOTO --}}
            @if($event->foto)

                <div style="margin-bottom:25px;">

                    <img
                        src="{{ asset('storage/' . $event->foto) }}"
                        alt="{{ $event->judul }}"
                        style="
                            width:100%;
                            max-height:400px;
                            object-fit:cover;
                            border-radius:14px;
                        "
                    >

                </div>

            @endif


            {{-- TANGGAL --}}
            <div style="margin-bottom:15px;">

                <span style="
                    color:#8a96a5;
                    font-size:12px;
                    font-weight:700;
                ">
                    TANGGAL EVENT
                </span>

                <div style="
                    color:#172b4d;
                    font-size:15px;
                    font-weight:600;
                    margin-top:5px;
                ">

                    {{ \Carbon\Carbon::parse($event->tanggal)->format('d F Y') }}

                    @if($event->waktu)
                        • {{ $event->waktu }}
                    @endif

                </div>

            </div>


            {{-- LOKASI --}}
            @if($event->lokasi)

                <div style="margin-bottom:20px;">

                    <span style="
                        color:#8a96a5;
                        font-size:12px;
                        font-weight:700;
                    ">
                        LOKASI
                    </span>

                    <div style="
                        color:#344054;
                        font-size:14px;
                        margin-top:5px;
                    ">

                        <i class="fa-solid fa-location-dot"></i>

                        {{ $event->lokasi }}

                    </div>

                </div>

            @endif


            {{-- DESKRIPSI --}}
            <div style="margin-bottom:25px;">

                <span style="
                    color:#8a96a5;
                    font-size:12px;
                    font-weight:700;
                ">
                    DESKRIPSI
                </span>

                <div style="
                    color:#66758a;
                    font-size:14px;
                    line-height:1.8;
                    margin-top:8px;
                ">

                    {!! nl2br(e($event->deskripsi)) !!}

                </div>

            </div>


            {{-- TOMBOL --}}
            <div style="
                display:flex;
                gap:10px;
                flex-wrap:wrap;
            ">

                @if($event->pendaftaran_aktif)

                    <a
                        href="{{ route('alumni.event.daftar', $event->slug) }}"
                        class="kosa-dashboard-button"
                    >

                        <i class="fa-solid fa-calendar-check"></i>

                        Daftar Event

                    </a>

                @endif


                <a
                    href="{{ route('alumni.event') }}"
                    class="kosa-dashboard-button"
                    style="
                        background:#edf3f9;
                        color:#0d2b52 !important;
                    "
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    Kembali ke Event

                </a>

            </div>

        </div>

    </div>

</section>

@endsection