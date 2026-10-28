@extends('frontend.v_layouts.app')

@section('title', $galeri->judul . ' - KOSA Indonesia')

@section('content')

<!-- START PAGE BANNER -->
<section class="page-banner">
    <div class="container">
        <div class="page-banner-content text-center">
            <h1>Detail Galeri</h1>
            <p>Kegiatan KOSA Indonesia</p>
        </div>
    </div>
</section>
<!-- END PAGE BANNER -->


<!-- START GALERI DETAIL -->
<section class="blog_area section-padding">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="galeri-detail">

                    {{-- JUDUL & INFORMASI --}}
                    <div class="galeri-detail-content">

                        <div class="text-center mb-4">

                            <h1>{{ $galeri->judul }}</h1>

                            {{-- TANGGAL --}}
                            @if($galeri->tanggal)

                                <div class="galeri-date">
                                    <i class="fa fa-calendar"></i>

                                    {{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}
                                </div>

                            @endif

                        </div>


                        {{-- FOTO GALERI --}}
                        @if($galeri->foto->count())

                            <div class="galeri-grid">

                                @foreach($galeri->foto as $foto)

                                    <div class="galeri-item">

                                        <img
                                            src="{{ asset('storage/' . $foto->file_foto) }}"
                                            alt="{{ $galeri->judul }}"
                                        >

                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- DESKRIPSI --}}
                        @if($galeri->deskripsi)

                            <div class="galeri-description">

                                <h3>Tentang Kegiatan</h3>

                                <p>
                                    {!! nl2br(e($galeri->deskripsi)) !!}
                                </p>

                            </div>

                        @endif


                        {{-- KEMBALI --}}
                        <div class="text-center mt-5">

                            <a
                                href="{{ route('galeri') }}"
                                class="cta"
                            >
                                <span>Kembali ke Galeri</span>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
<!-- END GALERI DETAIL -->


<style>

/* =========================
   GALERI DETAIL
========================= */

.galeri-detail {
    background: #fff;
}


/* =========================
   CONTENT
========================= */

.galeri-detail-content {
    padding: 10px 20px 30px;
}

.galeri-detail-content h1 {
    font-size: 36px;
    margin-bottom: 15px;
}


/* =========================
   TANGGAL
========================= */

.galeri-date {
    color: #777;
    font-size: 14px;
    margin-top: 8px;
}

.galeri-date i {
    margin-right: 6px;
}


/* =========================
   FOTO GALERI
========================= */

.galeri-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin: 30px 0;
}

.galeri-item {
    width: 100%;
    overflow: hidden;
    border-radius: 10px;
    background: #f8f9fa;
}

.galeri-item img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.3s ease;
}

.galeri-item:hover img {
    transform: scale(1.03);
}


/* =========================
   DESKRIPSI
========================= */

.galeri-description {
    margin-top: 35px;
}

.galeri-description h3 {
    margin-bottom: 15px;
}

.galeri-description p {
    line-height: 1.8;
    margin-bottom: 0;
}


/* =========================
   MOBILE
========================= */

@media (max-width: 767px) {

    .galeri-detail-content {
        padding: 5px 0 25px;
    }

    .galeri-detail-content h1 {
        font-size: 28px;
    }

    .galeri-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .galeri-item img {
        height: 250px;
    }

}

</style>

@endsection