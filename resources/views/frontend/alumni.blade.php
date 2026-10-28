@extends('frontend.v_layouts.app')

@section('title', 'Alumni - KOSA Indonesia')

@section('content')

{{-- =========================
    START PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Alumni KOSA Indonesia
            </h1>

            <p>
                Jejaring alumni KOSA Indonesia
            </p>

        </div>

    </div>

</section>
{{-- =========================
    END PAGE BANNER
========================= --}}


{{-- =========================
    START ALUMNI
========================= --}}
<section class="kosa-alumni-page">

    <div class="container">

        <div class="section-title text-center">

            <span class="kosa-section-subtitle">
                KOSA Indonesia
            </span>

            <h2>
                Jejaring Alumni
            </h2>

            <p>
                Kenali alumni KOSA Indonesia dari berbagai
                program dan bidang keahlian.
            </p>

        </div>


        <div class="row mt-4">

            @forelse($alumni as $item)

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="kosa-alumni-card">

                        {{-- FOTO --}}
                        <div class="kosa-alumni-photo">

                            @if($item->foto)

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama ?? 'Alumni' }}"
                                >

                            @else

                                <div class="kosa-alumni-no-photo">
                                    <i class="ti-user"></i>
                                </div>

                            @endif

                        </div>


                        {{-- DATA --}}
                        <div class="kosa-alumni-content">

                            <h3>
                                {{ $item->nama ?? '-' }}
                            </h3>


                            @if($item->program)

                                <span class="kosa-alumni-program">
                                    {{ $item->program }}
                                </span>

                            @endif


                            @if($item->jurusan)

                                <p>
                                    <i class="ti-book"></i>
                                    {{ $item->jurusan }}
                                </p>

                            @endif


                            @if($item->pekerjaan)

                                <p>
                                    <i class="ti-briefcase"></i>
                                    {{ $item->pekerjaan }}
                                </p>

                            @endif


                            @if($item->domisili)

                                <p>
                                    <i class="ti-location-pin"></i>
                                    {{ $item->domisili }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="ti-user"
                           style="font-size:50px;">
                        </i>

                        <h4 class="mt-3">
                            Belum ada data alumni
                        </h4>

                        <p class="text-muted">
                            Data alumni akan ditampilkan di sini.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>
{{-- =========================
    END ALUMNI
========================= --}}

@endsection