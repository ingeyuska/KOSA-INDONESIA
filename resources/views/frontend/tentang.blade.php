@extends('frontend.v_layouts.app')

@section('title', 'Tentang KOSA - KOSA Indonesia')

@section('content')

{{-- =========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>Tentang</h1>

            <p>KOSA Indonesia dan organisasi</p>

        </div>

    </div>

</section>


{{-- =========================
    TENTANG KOSA
========================= --}}
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

                        <span class="kosa-section-subtitle">
                            Tentang Kami
                        </span>

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

@endsection