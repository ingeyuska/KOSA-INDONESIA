@extends('frontend.v_layouts.app')

@section('title', 'Visi & Misi - KOSA Indonesia')

@section('content')

{{-- =========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>Maksud & Tujuan</h1>

            <p>
                Maksud & Tujuan KOSA Indonesia
            </p>

        </div>

    </div>

</section>


{{-- =========================
    VISI & MISI
========================= --}}
<section class="kosa-visimisi-section">

    <div class="container">

        {{-- JUDUL --}}
        <div class="section-title text-center">

            <h1>
                Maksud & Tujuan
            </h1>

        </div>


        <div class="row">

            {{-- =========================
                VISI
            ========================= --}}
            <div class="col-lg-7 col-md-6 col-sm-12">

                <div class="kosa-visi-card">

                    <div class="kosa-visimisi-icon">
                        <i class="ti-eye"></i>
                    </div>

                    <h3>
                        Maksud & Tujuan
                    </h3>

                    @if($pengaturan && $pengaturan->visi)

                        <p>
                            {!! nl2br(e($pengaturan->visi)) !!}
                        </p>

                    @else

                        <p>
                            Visi KOSA Indonesia belum tersedia.
                        </p>

                    @endif

                </div>

            </div>


            {{-- =========================
                MISI
            ========================= --}}
            <div class="col-lg-5 col-md-6 col-sm-12">

                <div class="kosa-misi-card">

                    <div class="kosa-visimisi-icon">
                        <i class="ti-target"></i>
                    </div>

                    <h3>
                        Fungsi
                    </h3>

                    @if($pengaturan && $pengaturan->misi)

                        <div class="kosa-misi-text">
                            {!! nl2br(e($pengaturan->misi)) !!}
                        </div>

                    @else

                        <p>
                            Misi KOSA Indonesia belum tersedia.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>

@endsection