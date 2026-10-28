@extends('frontend.alumni.layouts.app')

@section('title', 'Kartu Alumni - KOSA Indonesia')

@section('content')

<div class="container py-5">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">KARTU ALUMNI</h2>
        <p class="text-muted mb-0">
            Kartu identitas resmi alumni KOSA Indonesia
        </p>
    </div>


    {{-- =====================================================
        BELUM ADA KARTU
    ====================================================== --}}
    @if(!$kartu)

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <div class="icon-status">
                    <i class="bi bi-person-vcard"></i>
                </div>

                <h4 class="fw-bold mt-3">
                    Kartu Alumni Belum Tersedia
                </h4>

                <p class="text-muted">
                    Anda belum memiliki Kartu Alumni.
                </p>

                <a href="{{ route('alumni.tracer') }}"
                   class="btn btn-primary px-4">

                    <i class="bi bi-pencil-square"></i>
                    Isi Tracer Alumni

                </a>

            </div>
        </div>


    {{-- =====================================================
        KARTU TIDAK AKTIF
    ====================================================== --}}
    @elseif($kartu->status === 'tidak_aktif')

        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">

                <div class="icon-status text-danger">
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                <h3 class="fw-bold text-danger mt-3">
                    Kartu Alumni Tidak Aktif
                </h3>

                <p class="text-muted">
                    Masa berlaku Kartu Alumni Anda telah berakhir.
                </p>

                <div class="alert alert-warning mx-auto"
                     style="max-width: 600px;">

                    <i class="bi bi-info-circle"></i>

                    Untuk mengaktifkan kembali Kartu Alumni,
                    silakan mengisi dan submit
                    <strong>Tracer Alumni</strong> terlebih dahulu.

                </div>

                <p class="mb-4">
                    Masa berlaku berakhir pada:
                    <strong>
                        {{ $kartu->tanggal_berlaku_sampai
                            ? $kartu->tanggal_berlaku_sampai->format('d F Y')
                            : '-' }}
                    </strong>
                </p>

                <a href="{{ route('alumni.tracer') }}"
                   class="btn btn-primary px-4">

                    <i class="bi bi-pencil-square"></i>
                    Isi Tracer Alumni

                </a>

            </div>
        </div>


    {{-- =====================================================
        KARTU AKTIF
    ====================================================== --}}
    @else

        {{-- KARTU --}}
        <div class="alumni-card mx-auto">

            {{-- HEADER KARTU --}}
            <div class="card-header-alumni">

                <div class="logo-area">
                    KOSA
                </div>

                <div>
                    <div class="card-title">
                        KARTU ALUMNI
                    </div>

                    <div class="card-subtitle">
                        KOSA INDONESIA
                    </div>
                </div>

            </div>


            {{-- ISI KARTU --}}
            <div class="card-content">

                {{-- FOTO --}}
                <div class="photo-area">

                    @if($alumni->user && $alumni->user->foto)

                        <img
                            src="{{ asset('storage/' . $alumni->user->foto) }}"
                            alt="Foto Alumni"
                        >

                    @else

                        <div class="photo-placeholder">
                            <i class="bi bi-person"></i>
                        </div>

                    @endif

                </div>


                {{-- DATA ALUMNI --}}
                <div class="alumni-info">

                    <div class="info-row">
                        <span>Nama</span>
                        <strong>
                            {{ $alumni->user->nama ?? '-' }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>ID Anggota</span>
                        <strong>
                            {{ $alumni->user->member_id ?? '-' }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Nomor Kartu</span>
                        <strong>
                            {{ $kartu->nomor_kartu }}
                        </strong>
                    </div>

                    <div class="info-row">
                        <span>Status</span>
                        <strong class="status-active">
                            AKTIF
                        </strong>
                    </div>

                </div>

            </div>


            {{-- FOOTER KARTU --}}
            <div class="card-footer-alumni">

                <div>
                    <small>
                        Berlaku sampai
                    </small>

                    <strong>
                        {{ $kartu->tanggal_berlaku_sampai
                            ? $kartu->tanggal_berlaku_sampai->format('d F Y')
                            : '-' }}
                    </strong>
                </div>

                <div class="valid-badge">
                    AKTIF
                </div>

            </div>

        </div>


        {{-- INFORMASI --}}
        <div class="text-center mt-4">

            <p class="text-muted mb-3">
                Kartu Alumni aktif sampai
                <strong>
                    {{ $kartu->tanggal_berlaku_sampai
                        ? $kartu->tanggal_berlaku_sampai->format('d F Y')
                        : '-' }}
                </strong>
            </p>

            <a href="{{ route('alumni.kartu.download') }}"
               class="btn btn-primary px-4">

                <i class="bi bi-download"></i>
                Download Kartu

            </a>

        </div>

    @endif

</div>


{{-- =====================================================
    STYLE
====================================================== --}}
<style>

    .icon-status {
        font-size: 60px;
        color: #0d6efd;
    }


    /* =========================================
       KARTU ALUMNI
    ========================================= */

    .alumni-card {

        width: 760px;
        max-width: 100%;

        min-height: 430px;

        border-radius: 20px;

        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                #0d6efd,
                #084298
            );

        color: white;

        box-shadow:
            0 15px 40px rgba(0,0,0,.18);

        position: relative;

    }


    /* =========================================
       HEADER
    ========================================= */

    .card-header-alumni {

        display: flex;

        align-items: center;

        gap: 18px;

        padding: 28px 35px;

        border-bottom:
            1px solid rgba(255,255,255,.25);

    }


    .logo-area {

        width: 60px;
        height: 60px;

        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(255,255,255,.15);

        font-size: 20px;
        font-weight: 800;

    }


    .card-title {

        font-size: 25px;

        font-weight: 800;

        letter-spacing: 1px;

    }


    .card-subtitle {

        font-size: 13px;

        opacity: .8;

        letter-spacing: 2px;

    }


    /* =========================================
       CONTENT
    ========================================= */

    .card-content {

        display: flex;

        gap: 35px;

        padding: 35px;

        align-items: center;

    }


    /* FOTO */

    .photo-area {

        width: 145px;
        height: 175px;

        flex-shrink: 0;

        border-radius: 12px;

        overflow: hidden;

        background: rgba(255,255,255,.2);

        border:
            3px solid rgba(255,255,255,.6);

    }


    .photo-area img {

        width: 100%;
        height: 100%;

        object-fit: cover;

    }


    .photo-placeholder {

        width: 100%;
        height: 100%;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 70px;

        color: rgba(255,255,255,.7);

    }


    /* DATA */

    .alumni-info {

        flex: 1;

    }


    .info-row {

        display: flex;

        justify-content: space-between;

        gap: 20px;

        padding: 13px 0;

        border-bottom:
            1px solid rgba(255,255,255,.18);

    }


    .info-row span {

        opacity: .75;

    }


    .info-row strong {

        text-align: right;

    }


    .status-active {

        color: #b9f6ca;

    }


    /* =========================================
       FOOTER
    ========================================= */

    .card-footer-alumni {

        display: flex;

        justify-content: space-between;

        align-items: center;

        padding: 20px 35px;

        background:
            rgba(0,0,0,.15);

    }


    .card-footer-alumni small {

        display: block;

        opacity: .7;

        margin-bottom: 3px;

    }


    .valid-badge {

        padding: 8px 18px;

        border-radius: 30px;

        background: #198754;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 1px;

    }


    /* =========================================
       MOBILE
    ========================================= */

    @media(max-width: 768px) {

        .alumni-card {

            min-height: auto;

        }


        .card-content {

            flex-direction: column;

            text-align: center;

        }


        .alumni-info {

            width: 100%;

        }


        .info-row {

            flex-direction: column;

            gap: 4px;

        }


        .info-row strong {

            text-align: center;

        }


        .card-header-alumni {

            padding: 20px;

        }


        .card-content {

            padding: 25px 20px;

        }


        .card-footer-alumni {

            padding: 18px 20px;

        }

    }

</style>

@endsection