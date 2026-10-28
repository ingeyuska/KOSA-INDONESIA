blade
@extends('frontend.alumni.layouts.app')

@section('title', 'Kartu Keanggotaan Alumni')

@section('content')

<div class="kartu-page">

    <div class="kartu-wrapper">

        {{-- HEADER --}}
        <div class="kartu-header">

            <div>
                <div class="kosa-logo">
                    KOSA INDONESIA
                </div>

                <div class="kartu-title">
                    KARTU KEANGGOTAAN ALUMNI
                </div>
            </div>

        </div>


        {{-- CONTENT --}}
        <div class="kartu-content">

            <div class="kartu-data">

                <div class="data-row">
                    <span>Nama</span>
                    <b>:</b>
                    <strong>
                        {{ $alumni->nama ?? $user->nama ?? '-' }}
                    </strong>
                </div>

                <div class="data-row">
                    <span>ID Anggota</span>
                    <b>:</b>
                    <strong>
                        {{ $alumni->alumni_id ?? '-' }}
                    </strong>
                </div>

                <div class="data-row">
                    <span>Thn. Lulus</span>
                    <b>:</b>
                    <strong>
                        {{ $alumni->tahun_lulus ?? '-' }}
                    </strong>
                </div>

                <div class="data-row">
                    <span>Program Studi</span>
                    <b>:</b>
                    <strong>
                        {{ $alumni->jurusan ?? '-' }}
                    </strong>
                </div>

                <div class="data-row">
                    <span>Program</span>
                    <b>:</b>
                    <strong>
                        {{ $alumni->klasifikasi_program ?? '-' }}
                    </strong>
                </div>

            </div>


            {{-- QR --}}
            <div class="kartu-qr">

                @if(!empty($alumni->alumni_id))

                    @php

                        $verifikasiUrl = route(
                            'verifikasi.anggota',
                            [
                                'id_anggota' =>
                                    $alumni->alumni_id
                            ]
                        );

                        $qrUrl =
                            'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' .
                            urlencode($verifikasiUrl);

                    @endphp

                    <div class="qr-code">

                        <img
                            src="{{ $qrUrl }}"
                            alt="QR {{ $alumni->alumni_id }}"
                        >

                    </div>

                    <small>
                        Scan untuk verifikasi
                    </small>

                @else

                    <div class="qr-code qr-empty">
                        <strong>QR</strong>
                    </div>

                    <small>
                        ID anggota belum tersedia
                    </small>

                @endif

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="kartu-footer">

            <span>
                KOSA INDONESIA
            </span>

            <span>
                Kartu Keanggotaan Alumni
            </span>

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="kartu-actions">

        <button
            type="button"
            onclick="window.print()"
            class="btn-cetak"
        >
            <i class="fa-solid fa-print"></i>
            Cetak Kartu
        </button>

        <button
            type="button"
            onclick="window.history.back()"
            class="btn-kembali"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </button>

    </div>

</div>

@endsection


<style>

.kartu-page {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

.kartu-wrapper {
    width: 856px;
    height: 540px;
    max-width: 100%;
    margin: 40px auto;
    padding: 40px 50px;
    position: relative;
    overflow: hidden;

    border-radius: 22px;

    background:
        linear-gradient(
            135deg,
            #071d49,
            #123d7a,
            #0b2858
        );

    color: white;

    box-shadow:
        0 15px 40px
        rgba(0,0,0,.20);

    box-sizing: border-box;
}

.kartu-header {
    border-bottom:
        1px solid
        rgba(255,255,255,.25);

    padding-bottom: 20px;
}

.kosa-logo {
    font-size: 22px;
    font-weight: 800;
    letter-spacing: 1px;
}

.kartu-title {
    margin-top: 8px;
    font-size: 26px;
    font-weight: 700;
}

.kartu-content {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    height: 310px;
}

.kartu-data {
    width: 68%;
}

.data-row {
    display: grid;

    grid-template-columns:
        135px
        20px
        1fr;

    margin-bottom: 18px;

    font-size: 17px;
    line-height: 1.25;
}

.data-row span {
    font-weight: 500;
}

.data-row b {
    font-weight: 700;
}

.data-row strong {
    font-weight: 700;
    word-break: break-word;
}

.kartu-qr {
    width: 160px;
    text-align: center;
}

.qr-code {
    width: 140px;
    height: 140px;

    padding: 7px;

    margin: 0 auto 10px;

    background: white;

    border-radius: 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    box-sizing: border-box;
}

.qr-code img {
    width: 100%;
    height: 100%;

    display: block;

    object-fit: contain;
}

.qr-empty {
    color: #071d49;
    font-size: 28px;
    font-weight: 800;
}

.kartu-qr small {
    display: block;

    color: white;

    font-size: 11px;
}

.kartu-footer {
    position: absolute;

    left: 50px;
    right: 50px;
    bottom: 25px;

    display: flex;
    justify-content: space-between;

    font-size: 11px;
    letter-spacing: 1px;
}

.kartu-actions {
    text-align: center;
    margin: 20px auto;
}

.btn-cetak,
.btn-kembali {
    border: none;

    padding: 11px 25px;

    border-radius: 8px;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
}

.btn-cetak {
    background: #0d6efd;
    color: white;
}

.btn-kembali {
    background: #e9ecef;
    color: #071d49;
    margin-left: 8px;
}


/* =========================================================
   PRINT
========================================================= */

@media print {

    @page {
        size: 85.6mm 54mm;
        margin: 0;
    }

    html,
    body {
        width: 85.6mm !important;
        height: 54mm !important;

        margin: 0 !important;
        padding: 0 !important;

        overflow: hidden !important;

        background: white !important;
    }

    body * {
        visibility: hidden !important;
    }

    .kartu-wrapper,
    .kartu-wrapper * {
        visibility: visible !important;
    }

    .kartu-wrapper {

        position: absolute !important;

        left: 0 !important;
        top: 0 !important;

        width: 85.6mm !important;
        height: 54mm !important;

        margin: 0 !important;

        padding: 5mm !important;

        border-radius: 0 !important;

        box-shadow: none !important;

        background:
            linear-gradient(
                135deg,
                #071d49,
                #123d7a,
                #0b2858
            ) !important;

        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .kartu-header {
        padding-bottom: 3mm !important;
    }

    .kosa-logo {
        font-size: 12px !important;
    }

    .kartu-title {
        margin-top: 2px !important;
        font-size: 14px !important;
    }

    .kartu-content {
        height: auto !important;
        margin-top: 4mm !important;
    }

    .kartu-data {
        width: 67% !important;
    }

    .data-row {
        grid-template-columns:
            24mm
            3mm
            1fr !important;

        margin-bottom: 1.7mm !important;

        font-size: 8px !important;
    }

    .kartu-qr {
        width: 25% !important;
    }

    .qr-code {
        width: 20mm !important;
        height: 20mm !important;

        padding: 1mm !important;

        margin-bottom: 1mm !important;
    }

    .kartu-qr small {
        font-size: 5px !important;
    }

    .kartu-footer {
        left: 5mm !important;
        right: 5mm !important;
        bottom: 2mm !important;

        font-size: 5px !important;
    }

    .kartu-actions {
        display: none !important;
    }
}


/* =========================================================
   MOBILE
========================================================= */

@media screen and (max-width: 768px) {

    .kartu-page {
        padding: 10px;
        overflow-x: hidden;
    }

    .kartu-wrapper {

        width: 100%;
        height: auto;

        aspect-ratio: 85.6 / 54;

        margin: 20px auto;

        padding: 5% 6%;

        border-radius: 14px;
    }

    .kosa-logo {
        font-size: clamp(
            11px,
            3vw,
            22px
        );
    }

    .kartu-title {
        font-size: clamp(
            13px,
            3.5vw,
            26px
        );
    }

    .kartu-content {
        height: auto;
        margin-top: 5%;
    }

    .kartu-data {
        width: 67%;
    }

    .data-row {

        grid-template-columns:
            27%
            5%
            68%;

        margin-bottom: 4%;

        font-size: clamp(
            8px,
            2.3vw,
            17px
        );
    }

    .kartu-qr {
        width: 25%;
    }

    .qr-code {

        width: 100%;
        height: auto;

        aspect-ratio: 1 / 1;

        padding: 5%;
    }

    .kartu-qr small {
        font-size: clamp(
            5px,
            1.5vw,
            10px
        );

        white-space: nowrap;
    }

    .kartu-footer {
        left: 6%;
        right: 6%;
        bottom: 4%;

        font-size: clamp(
            5px,
            1.5vw,
            10px
        );
    }

    .kartu-footer span:last-child {
        display: none;
    }

    .kartu-actions {
        display: flex;
        flex-direction: column;

        align-items: center;

        gap: 10px;
    }

    .btn-cetak,
    .btn-kembali {

        width: 100%;
        max-width: 300px;

        margin: 0;
    }
}

</style>

