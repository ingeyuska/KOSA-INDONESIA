@extends('frontend.v_layouts.app')

@section('title', 'Cerita Alumni - KOSA Indonesia')

@section('content')

{{-- =========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Cerita Alumni
            </h1>

            <p>
                Kisah dan pengalaman inspiratif alumni KOSA Indonesia
            </p>

        </div>

    </div>

</section>


{{-- =========================
    START CERITA ALUMNI
========================= --}}
<section class="kosa-alumni-story-section">

    <div class="container">

        {{-- DATA CERITA ALUMNI --}}
        <div class="row">

            @forelse($ceritaAlumnis as $cerita)

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div class="kosa-alumni-story-card">

                        {{-- =========================
                            FOTO CERITA ALUMNI
                        ========================= --}}
                        <div class="kosa-alumni-photo">

                            @if($cerita->foto)

                                <img
                                    src="{{ asset('storage/' . $cerita->foto) }}"
                                    alt="{{ $cerita->alumni->nama ?? 'Alumni KOSA Indonesia' }}"
                                >

                            @else

                                <img
                                    src="{{ asset('frontend/assets/images/alumni/alumni-default.jpg') }}"
                                    alt="Alumni KOSA Indonesia">

                            @endif

                        </div>


                        {{-- =========================
                            CERITA
                        ========================= --}}
                        <div class="kosa-alumni-story-content">

                            {{-- QUOTE --}}
                            <div class="kosa-quote">
                                "
                            </div>


                            {{-- ISI CERITA --}}
                            <p>
                                {{ Str::limit($cerita->cerita, 180) }}
                            </p>


                            {{-- NAMA ALUMNI --}}
                            <h4>
                                {{ $cerita->alumni->nama ?? '-' }}
                            </h4>


                            {{-- PROGRAM ALUMNI --}}
                            @if($cerita->alumni?->program)

                                <span>
                                    {{ $cerita->alumni->program }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <p>
                            Belum ada cerita alumni.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>
{{-- =========================
    END CERITA ALUMNI
========================= --}}

@endsection