@extends('frontend.v_layouts.app')

@section('title', $berita->judul . ' - KOSA Indonesia')

@section('content')

<style>

/* =========================================================
   BERITA DETAIL - KOSA MODERN
========================================================= */

.kosa-news-detail {
    padding: 90px 0 100px;
    background: #f7f9fc;
}

.kosa-news-detail .container {
    max-width: 1120px;
}

/* =========================================================
   HEADER
========================================================= */

.kosa-news-header {
    max-width: 900px;
    margin: 0 auto 42px;
    text-align: center;
}

.kosa-news-category {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 18px;
    margin-bottom: 18px;
    border-radius: 50px;
    background: #eaf3ff;
    color: #087df5;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .2px;
}

.kosa-news-header h1 {
    margin: 0 auto 18px;
    color: #092e61;
    font-size: 42px;
    line-height: 1.25;
    font-weight: 700;
    max-width: 850px;
}

.kosa-news-meta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
    color: #718096;
    font-size: 14px;
}

.kosa-news-meta span {
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.kosa-news-meta i {
    color: #087df5;
}

/* =========================================================
   ARTICLE
========================================================= */

.kosa-news-article {
    max-width: 1000px;
    margin: 0 auto;
    background: #ffffff;
    border: 1px solid #e9eef5;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(15, 40, 80, .07);
}

/* =========================================================
   GAMBAR UTAMA BERITA
========================================================= */

.kosa-news-image {
    width: 100%;
    height: 500px;
    background: #edf2f7;
    overflow: hidden;
    position: relative;
}

.kosa-news-image img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    transition: transform .5s ease;
}

.kosa-news-article:hover .kosa-news-image img {
    transform: scale(1.02);
}

/* =========================================================
   ISI BERITA
========================================================= */

.kosa-news-content {
    max-width: 850px;
    margin: 0 auto;
    padding: 45px 50px 35px;
}

.kosa-news-content p {
    margin: 0 0 20px;
    color: #52647a;
    font-size: 16px;
    line-height: 1.9;
}

.kosa-news-content h2 {
    margin: 35px 0 15px;
    color: #092e61;
    font-size: 27px;
    line-height: 1.35;
    font-weight: 700;
}

.kosa-news-content h3 {
    margin: 28px 0 13px;
    color: #092e61;
    font-size: 22px;
    font-weight: 700;
}

.kosa-news-content a {
    color: #087df5;
    font-weight: 600;
}

.kosa-news-content ul,
.kosa-news-content ol {
    margin: 20px 0;
    padding-left: 25px;
    color: #52647a;
    font-size: 16px;
    line-height: 1.9;
}

.kosa-news-content li {
    margin-bottom: 8px;
}

/* =========================================================
   GAMBAR DI DALAM ISI BERITA
========================================================= */

.kosa-news-content img {
    display: block;
    width: auto;
    max-width: 100%;
    height: auto;
    margin: 30px auto;
    border-radius: 14px;
    object-fit: contain;
}

/*
|--------------------------------------------------------------------------
| Jika editor menyimpan ukuran gambar terlalu besar
|--------------------------------------------------------------------------
*/

.kosa-news-content figure {
    max-width: 100%;
    margin: 30px auto;
}

.kosa-news-content figure img {
    max-width: 100%;
    height: auto;
}

/*
|--------------------------------------------------------------------------
| Link pembungkus gambar
|--------------------------------------------------------------------------
*/

.kosa-news-content a img {
    display: block;
    max-width: 100%;
    height: auto;
}

/* =========================================================
   BLOCKQUOTE
========================================================= */

.kosa-news-content blockquote {
    margin: 30px 0;
    padding: 20px 24px;
    border-left: 4px solid #087df5;
    border-radius: 0 12px 12px 0;
    background: #f3f8ff;
    color: #092e61;
    font-size: 17px;
    line-height: 1.7;
    font-style: italic;
}

/* =========================================================
   FOOTER
========================================================= */

.kosa-news-footer {
    max-width: 850px;
    margin: 0 auto;
    padding: 25px 50px 35px;
    border-top: 1px solid #edf1f5;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.kosa-news-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 19px;
    border-radius: 10px;
    background: #eaf3ff;
    color: #087df5;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all .25s ease;
}

.kosa-news-back:hover {
    background: #087df5;
    color: #ffffff;
    transform: translateX(-3px);
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .kosa-news-detail {
        padding: 75px 25px 85px;
    }

    .kosa-news-header h1 {
        font-size: 36px;
    }

    .kosa-news-image {
        height: 420px;
    }

    .kosa-news-content {
        padding: 38px 40px 30px;
    }

    .kosa-news-footer {
        padding-left: 40px;
        padding-right: 40px;
    }
}

@media (max-width: 767px) {

    .kosa-news-detail {
        padding: 60px 15px 70px;
    }

    .kosa-news-header {
        margin-bottom: 30px;
    }

    .kosa-news-category {
        padding: 7px 14px;
        font-size: 12px;
    }

    .kosa-news-header h1 {
        font-size: 28px;
        line-height: 1.3;
    }

    .kosa-news-meta {
        gap: 8px 14px;
        flex-wrap: wrap;
        font-size: 12px;
    }

    .kosa-news-article {
        border-radius: 17px;
    }

    .kosa-news-image {
        height: 260px;
    }

    .kosa-news-content {
        padding: 28px 22px 25px;
    }

    .kosa-news-content p {
        font-size: 14px;
        line-height: 1.8;
    }

    .kosa-news-content h2 {
        font-size: 23px;
    }

    .kosa-news-content h3 {
        font-size: 19px;
    }

    .kosa-news-content ul,
    .kosa-news-content ol {
        font-size: 14px;
    }

    .kosa-news-content img {
        width: 100%;
        height: auto;
        margin: 25px auto;
    }

    .kosa-news-footer {
        padding: 20px 22px 25px;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .kosa-news-back {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 380px) {

    .kosa-news-header h1 {
        font-size: 25px;
    }

    .kosa-news-image {
        height: 225px;
    }

    .kosa-news-content {
        padding: 25px 18px 22px;
    }
}

</style>


<section class="kosa-news-detail">

    <div class="container">

        {{-- =====================================================
             HEADER BERITA
        ====================================================== --}}

        <div class="kosa-news-header">

            <span class="kosa-news-category">
                Berita KOSA Indonesia
            </span>

            <h1>
                {{ $berita->judul }}
            </h1>

            @if($berita->tanggal_publish)

                <div class="kosa-news-meta">

                    <span>
                        <i class="ti-calendar"></i>

                        {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}

                    </span>

                </div>

            @endif

        </div>


        {{-- =====================================================
             ARTICLE
        ====================================================== --}}

        <article class="kosa-news-article">


            {{-- =================================================
                 GAMBAR UTAMA
            ================================================== --}}

            @if(!empty($berita->gambar))

                @php

                    $gambar = trim($berita->gambar);

                    if (
                        str_starts_with($gambar, 'http://') ||
                        str_starts_with($gambar, 'https://')
                    ) {

                        $gambarUrl = $gambar;

                    } elseif (str_starts_with($gambar, 'storage/')) {

                        $gambarUrl = asset($gambar);

                    } elseif (str_starts_with($gambar, '/storage/')) {

                        $gambarUrl = asset(ltrim($gambar, '/'));

                    } else {

                        $gambarUrl = asset(
                            'storage/' . ltrim($gambar, '/')
                        );

                    }

                @endphp


                <div class="kosa-news-image">

                    <img
                        src="{{ $gambarUrl }}"
                        alt="{{ $berita->judul }}"
                        loading="eager"
                    >

                </div>

            @endif


            {{-- =================================================
                 ISI BERITA
            ================================================== --}}

            <div class="kosa-news-content">

                {!! $berita->isi !!}

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="kosa-news-footer">

                <span>
                    Berita KOSA Indonesia
                </span>

                <a
                    href="{{ route('berita') }}"
                    class="kosa-news-back"
                >

                    <i class="ti-arrow-left"></i>

                    Kembali ke Berita

                </a>

            </div>


        </article>

    </div>

</section>

@endsection