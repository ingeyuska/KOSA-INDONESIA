@extends('frontend.v_layouts.app')

@section('title', 'Video Kegiatan - KOSA Indonesia')

@section('content')

{{-- =========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">

    <div class="container">

        <div class="kosa-page-banner-content text-center">

            <h1>
                Video Kegiatan
            </h1>

            <p>
                Dokumentasi video kegiatan KOSA Indonesia
            </p>

        </div>

    </div>

</section>

<br><br>
{{-- =========================
    START VIDEO
========================= --}}
<section class="kosa-video-section">

    <div class="container">

        {{-- <div class="section-title text-center">

            <span class="kosa-section-subtitle">
                KOSA Indonesia
            </span>

            <h2>
                Video Kegiatan
            </h2>

            <p>
                Dokumentasi berbagai kegiatan KOSA Indonesia.
            </p>

        </div> --}}


        <div class="row">

            @forelse($videos as $video)

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

                    <div class="kosa-video-card">

                        {{-- =========================
                            THUMBNAIL
                        ========================= --}}
                        <div class="kosa-video-thumbnail">

                            @php

                                $videoUrl = trim($video->url_video);

                                $videoId = null;

                                /*
                                |--------------------------------------------------------------------------
                                | YOUTUBE SHORT URL
                                | https://youtu.be/VIDEO_ID?si=xxxxx
                                |--------------------------------------------------------------------------
                                */
                                if (preg_match(
                                    '/youtu\.be\/([^?&]+)/',
                                    $videoUrl,
                                    $matches
                                )) {

                                    $videoId = $matches[1];

                                }

                                /*
                                |--------------------------------------------------------------------------
                                | YOUTUBE WATCH URL
                                | https://www.youtube.com/watch?v=VIDEO_ID
                                |--------------------------------------------------------------------------
                                */
                                elseif (preg_match(
                                    '/youtube\.com\/watch\?v=([^&]+)/',
                                    $videoUrl,
                                    $matches
                                )) {

                                    $videoId = $matches[1];

                                }

                                /*
                                |--------------------------------------------------------------------------
                                | YOUTUBE EMBED URL
                                | https://www.youtube.com/embed/VIDEO_ID
                                |--------------------------------------------------------------------------
                                */
                                elseif (preg_match(
                                    '/youtube\.com\/embed\/([^?&]+)/',
                                    $videoUrl,
                                    $matches
                                )) {

                                    $videoId = $matches[1];

                                }

                            @endphp


                            @if($videoId)

                                {{-- THUMBNAIL YOUTUBE --}}
                                <img
                                    src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                    alt="{{ $video->judul }}"
                                    class="kosa-video-thumbnail-img"
                                    loading="lazy"
                                >


                                {{-- OVERLAY --}}
                                <div class="kosa-video-overlay"></div>


                                {{-- PLAY BUTTON --}}
                                <a
                                    href="{{ $video->url_video }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="kosa-video-play"
                                    aria-label="Putar {{ $video->judul }}"
                                >

                                    <i class="fa-solid fa-play"></i>

                                </a>

                            @else

                                <div class="kosa-video-thumbnail-default">

                                    <i class="ti-video-camera"></i>

                                    <span>
                                        Thumbnail tidak tersedia
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- =========================
                            CONTENT
                        ========================= --}}
                        <div class="kosa-video-content">

                            <h3>
                                {{ $video->judul }}
                            </h3>


                            @if($video->deskripsi)

                                <p>
                                    {{ Str::limit(
                                        strip_tags($video->deskripsi),
                                        150
                                    ) }}
                                </p>

                            @endif


                            @if($video->tanggal)

                                <span class="kosa-video-date">

                                    {{ $video->tanggal->format('d M Y') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i
                            class="ti-video-camera"
                            style="font-size: 45px;">
                        </i>

                        <p class="mt-3">
                            Belum ada video kegiatan.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- =========================
    END VIDEO
========================= --}}

@endsection