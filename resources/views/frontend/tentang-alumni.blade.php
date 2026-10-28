@extends('frontend.v_layouts.app')

@section('title', 'Tentang Alumni - KOSA Indonesia')

@section('content')

{{-- =========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Tentang Alumni
            </h1>

            <p>
                Jejaring Alumni KOSA Indonesia
            </p>

        </div>

    </div>

</section>


{{-- =========================
    START INFORMASI
========================= --}}
<section class="kosa-statistik-info">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6 col-md-6 col-sm-12">

                <div class="kosa-statistik-info-content">

                    <span class="kosa-section-subtitle">
                        Tentang Alumni
                    </span>

                    <h2>
                        Jejaring Alumni KOSA Indonesia
                    </h2>

                    <p>
                        Alumni KOSA Indonesia berasal dari berbagai
                        latar belakang bidang keahlian dan program
                        pengembangan kapasitas.
                    </p>

                    <p>
                        Keberagaman tersebut menjadi kekuatan dalam
                        membangun jejaring, berbagi pengalaman,
                        dan menciptakan kolaborasi yang bermanfaat.
                    </p>

                </div>

            </div>


            <div class="col-lg-6 col-md-6 col-sm-12">

                <div class="kosa-statistik-info-box">

                    <div class="kosa-info-item">
                        <i class="ti-check"></i>
                        <span>Jejaring alumni nasional</span>
                    </div>

                    <div class="kosa-info-item">
                        <i class="ti-check"></i>
                        <span>Berbagai bidang keahlian</span>
                    </div>

                    <div class="kosa-info-item">
                        <i class="ti-check"></i>
                        <span>Program Degree</span>
                    </div>

                    <div class="kosa-info-item">
                        <i class="ti-check"></i>
                        <span>Program Short Course</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- =========================
    END INFORMASI
========================= --}}
@endsection