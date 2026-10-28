@extends('frontend.v_layouts.app')

@section('title', 'Pengurus - KOSA Indonesia')

@section('content')

{{-- =========================
PAGE BANNER
========================= --}}

<section class="kosa-page-banner">


<div class="container">

    <div class="kosa-page-banner-content text-center">

        <h1>Pengurus</h1>

        <p>
            Struktur Organisasi KOSA Indonesia
        </p>

    </div>

</div>


</section>

{{-- =========================
STRUKTUR ORGANISASI
========================= --}}

<section class="kosa-pengurus-section">


<div class="container">

    {{-- JUDUL --}}
    <div class="section-title text-center mb-4">

        <h1>
            Struktur Organisasi
        </h1>

    </div>


    {{-- GAMBAR STRUKTUR --}}
    @if($struktur && $struktur->gambar)

        <div class="text-center">

            <img 
                src="{{ asset('storage/' . $struktur->gambar) }}" 
                alt="Struktur Organisasi KOSA Indonesia" 
                class="img-fluid" 
                style="max-width: 850px; width: 100%; height: auto;" 
            >

        </div>

    @else

        <div class="text-center py-5">

            <p>
                Struktur organisasi KOSA Indonesia belum tersedia.
            </p>

        </div>

    @endif

</div>


</section>

@endsection
