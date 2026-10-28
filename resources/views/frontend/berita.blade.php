@extends('frontend.v_layouts.app')

@section('title', 'Berita - Kosa Indonesia')

@section('content')

{{-- =========================================================
    PAGE BANNER
========================================================= --}}
<section class="kosa-page-banner">
    <div class="container">
        <div class="kosa-page-banner-content text-center">

            <span class="kosa-news-banner-label">
                KOSA INDONESIA
            </span>

            <h1>
                Berita
            </h1>

            <p>
                Informasi dan berita terbaru KOSA Indonesia
            </p>

        </div>
    </div>
</section>


{{-- =========================================================
    BERITA
========================================================= --}}
<section class="kosa-news-page">

    <div class="container">

        {{-- SECTION HEADER --}}
        <div class="kosa-news-section-header text-center">

            <span class="kosa-news-section-label">
                INFORMASI TERKINI
            </span>

            <h2>
                Berita KOSA Indonesia
            </h2>

            <p>
                Temukan berbagai informasi, kegiatan, dan kabar terbaru
                seputar KOSA Indonesia.
            </p>

        </div>


        {{-- GRID BERITA --}}
        <div class="row g-4">

            @forelse($berita as $item)

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <a href="{{ route('berita.show', $item->slug) }}"
                       class="kosa-news-card-link">

                        <article class="kosa-news-card">

                            {{-- FOTO --}}
                            <div class="kosa-news-card-image">

                                @if($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->judul }}"
                                    >

                                @else

                                    <div class="kosa-news-no-image">
                                        <i class="fa-regular fa-image"></i>
                                        <span>Belum ada foto</span>
                                    </div>

                                @endif


                                {{-- TANGGAL --}}
                                <div class="kosa-news-date">

                                    <i class="fa-regular fa-calendar"></i>

                                    <span>
                                        {{ $item->tanggal_publish
                                            ? \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y')
                                            : '-' }}
                                    </span>

                                </div>

                            </div>


                            {{-- CONTENT --}}
                            <div class="kosa-news-card-content">

                                <h3>
                                    {{ $item->judul }}
                                </h3>


                                @if($item->isi)

                                    <p>
                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($item->isi),
                                            120
                                        ) }}
                                    </p>

                                @endif


                                {{-- READ MORE --}}
                                <div class="kosa-news-read">

                                    <span>
                                        Baca Selengkapnya
                                    </span>

                                    <i class="fa-solid fa-arrow-right"></i>

                                </div>

                            </div>

                        </article>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="kosa-news-empty">

                        <div class="kosa-news-empty-icon">
                            <i class="fa-regular fa-newspaper"></i>
                        </div>

                        <h3>
                            Belum Ada Berita
                        </h3>

                        <p>
                            Belum ada berita yang dipublikasikan saat ini.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($berita->hasPages())

            <div class="kosa-news-pagination">

                {{ $berita->links() }}

            </div>

        @endif

    </div>

</section>


<style>

/* =========================================================
   PAGE BANNER
========================================================= */

.kosa-news-banner-label {
    display: inline-block;
    margin-bottom: 10px;
    color: #d9ecff;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
}


/* =========================================================
   NEWS PAGE
========================================================= */

.kosa-news-page {
    padding: 90px 0 100px;
    background: #f7f9fc;
}


/* =========================================================
   SECTION HEADER
========================================================= */

.kosa-news-section-header {
    max-width: 720px;
    margin: 0 auto 50px;
}

.kosa-news-section-label {
    display: inline-block;
    margin-bottom: 12px;

    color: #087df5;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.8px;
}

.kosa-news-section-header h2 {
    margin: 0 0 14px;

    color: #092e61;
    font-size: 36px;
    line-height: 1.25;
    font-weight: 750;
}

.kosa-news-section-header p {
    margin: 0;

    color: #718096;
    font-size: 15px;
    line-height: 1.8;
}


/* =========================================================
   CARD LINK
========================================================= */

.kosa-news-card-link {
    display: block;

    height: 100%;

    color: inherit;
    text-decoration: none;
}


/* =========================================================
   CARD
========================================================= */

.kosa-news-card {
    height: 100%;

    overflow: hidden;

    background: #ffffff;

    border: 1px solid #edf1f6;
    border-radius: 18px;

    box-shadow:
        0 8px 25px rgba(15, 40, 80, 0.06);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}

.kosa-news-card-link:hover .kosa-news-card {

    transform: translateY(-8px);

    border-color: #d9eaff;

    box-shadow:
        0 18px 40px rgba(15, 40, 80, 0.12);
}


/* =========================================================
   IMAGE
========================================================= */

.kosa-news-card-image {
    position: relative;

    width: 100%;
    height: 235px;

    overflow: hidden;

    background: #edf2f7;
}

.kosa-news-card-image img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: cover;

    transition: transform 0.55s ease;
}

.kosa-news-card-link:hover
.kosa-news-card-image img {
    transform: scale(1.06);
}


/* =========================================================
   NO IMAGE
========================================================= */

.kosa-news-no-image {
    width: 100%;
    height: 100%;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    gap: 8px;

    background:
        linear-gradient(
            135deg,
            #eef5fc,
            #f7f9fc
        );

    color: #94a3b8;
}

.kosa-news-no-image i {
    font-size: 32px;
}

.kosa-news-no-image span {
    font-size: 13px;
}


/* =========================================================
   DATE
========================================================= */

.kosa-news-date {

    position: absolute;

    left: 15px;
    bottom: 15px;

    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 8px 12px;

    border-radius: 8px;

    background: rgba(255, 255, 255, 0.94);

    color: #092e61;

    font-size: 12px;
    font-weight: 700;

    box-shadow:
        0 5px 15px rgba(0, 0, 0, 0.08);
}

.kosa-news-date i {
    color: #087df5;
}


/* =========================================================
   CONTENT
========================================================= */

.kosa-news-card-content {

    min-height: 205px;

    display: flex;
    flex-direction: column;

    padding: 25px 25px 23px;
}

.kosa-news-card-content h3 {

    margin: 0 0 13px;

    color: #092e61;

    font-size: 20px;
    line-height: 1.4;
    font-weight: 700;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;

    overflow: hidden;

    transition: color 0.25s ease;
}

.kosa-news-card-link:hover
.kosa-news-card-content h3 {
    color: #087df5;
}


.kosa-news-card-content p {

    margin: 0;

    color: #718096;

    font-size: 14px;
    line-height: 1.7;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;

    overflow: hidden;
}


/* =========================================================
   READ MORE
========================================================= */

.kosa-news-read {

    margin-top: auto;
    padding-top: 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    color: #087df5;

    font-size: 13px;
    font-weight: 700;
}

.kosa-news-read i {

    display: flex;

    width: 30px;
    height: 30px;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #eaf3ff;

    font-size: 11px;

    transition:
        background 0.25s ease,
        color 0.25s ease,
        transform 0.25s ease;
}

.kosa-news-card-link:hover
.kosa-news-read i {

    background: #087df5;
    color: #ffffff;

    transform: translateX(3px);
}


/* =========================================================
   EMPTY
========================================================= */

.kosa-news-empty {

    max-width: 550px;

    margin: 20px auto 0;

    padding: 60px 30px;

    text-align: center;

    background: #ffffff;

    border: 1px solid #edf1f6;
    border-radius: 18px;
}

.kosa-news-empty-icon {

    width: 70px;
    height: 70px;

    margin: 0 auto 18px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #eaf3ff;

    color: #087df5;

    font-size: 28px;
}

.kosa-news-empty h3 {

    margin-bottom: 8px;

    color: #092e61;

    font-size: 22px;
    font-weight: 700;
}

.kosa-news-empty p {

    margin: 0;

    color: #718096;

    font-size: 14px;
}


/* =========================================================
   PAGINATION
========================================================= */

.kosa-news-pagination {

    display: flex;
    justify-content: center;

    margin-top: 55px;
}

.kosa-news-pagination nav {
    display: flex;
    justify-content: center;
}

.kosa-news-pagination .pagination {

    display: flex;

    align-items: center;

    gap: 7px;

    margin: 0;

    padding: 0;

    list-style: none;
}

.kosa-news-pagination .page-item {
    margin: 0;
}

.kosa-news-pagination .page-link {

    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid #e2e8f0;
    border-radius: 9px !important;

    background: #ffffff;

    color: #64748b;

    font-size: 13px;
    font-weight: 600;

    box-shadow: none;

    transition: all 0.25s ease;
}

.kosa-news-pagination .page-link:hover {

    background: #eaf3ff;

    border-color: #cfe5ff;

    color: #087df5;
}

.kosa-news-pagination .page-item.active .page-link {

    background: #087df5;

    border-color: #087df5;

    color: #ffffff;

    box-shadow:
        0 6px 15px rgba(8, 125, 245, 0.20);
}

.kosa-news-pagination .page-item.disabled .page-link {

    background: #f8fafc;

    color: #cbd5e1;

    border-color: #edf1f6;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .kosa-news-page {
        padding: 70px 0 80px;
    }

    .kosa-news-section-header h2 {
        font-size: 32px;
    }

    .kosa-news-card-image {
        height: 220px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .kosa-news-page {
        padding: 60px 0 70px;
    }

    .kosa-news-section-header {
        margin-bottom: 35px;
    }

    .kosa-news-section-header h2 {
        font-size: 28px;
    }

    .kosa-news-section-header p {
        font-size: 14px;
    }

    .kosa-news-card-image {
        height: 230px;
    }

    .kosa-news-card-content {
        min-height: 190px;
        padding: 22px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 400px) {

    .kosa-news-section-header h2 {
        font-size: 25px;
    }

    .kosa-news-card-image {
        height: 210px;
    }

    .kosa-news-card-content h3 {
        font-size: 18px;
    }

}

</style>

@endsection