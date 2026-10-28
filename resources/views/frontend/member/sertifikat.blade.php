@extends('frontend.member.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- =========================
                HEADER
            ========================= --}}
            <div class="d-flex align-items-center mb-4">

                <i class="bi bi-translate me-3"
                   style="font-size: 20px; color: #0b1f4b;">
                </i>

                <h5 class="mb-0 fw-bold text-uppercase"
                    style="color: #0b1f4b;">
                    SERTIFIKAT
                </h5>

            </div>


            {{-- =========================
                TABLE
            ========================= --}}
            <div class="table-responsive">

                <table class="table table-bordered align-middle mb-0">

                    {{-- TABLE HEADER --}}
                    <thead>

                        <tr>

                            <th class="text-center" style="width: 75px;">
                                NO.
                            </th>

                            <th>
                                NAMA KEGIATAN
                            </th>

                            <th style="width: 250px;">
                                TEMPAT KEGIATAN
                            </th>

                            <th style="width: 230px;">
                                TANGGAL KEGIATAN
                            </th>

                            <th class="text-center" style="width: 220px;">
                                DOKUMEN
                            </th>

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody>

                        @forelse($sertifikats as $index => $sertifikat)

                            <tr>

                                {{-- =========================
                                    NO
                                ========================= --}}
                                <td class="text-center">

                                    {{ $index + 1 }}

                                </td>


                                {{-- =========================
                                    NAMA KEGIATAN
                                ========================= --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        <i class="bi bi-award me-2"
                                           style="
                                               font-size: 20px;
                                               color: #16b832;
                                           ">
                                        </i>

                                        <span>
                                            {{ $sertifikat->event->judul }}
                                        </span>

                                    </div>

                                </td>


                                {{-- =========================
                                    TEMPAT KEGIATAN
                                ========================= --}}
                                <td>

                                    <i class="bi bi-geo-alt me-2"
                                       style="color: #0b1f4b;">
                                    </i>

                                    {{ $sertifikat->event->lokasi ?? '-' }}

                                </td>


                                {{-- =========================
                                    TANGGAL KEGIATAN
                                ========================= --}}
                                <td>

                                    <i class="bi bi-calendar-event me-2"
                                       style="color: #0b1f4b;">
                                    </i>

                                    {{ \Carbon\Carbon::parse(
                                        $sertifikat->event->tanggal
                                    )->translatedFormat('d F Y') }}

                                </td>


                                {{-- =========================
                                    DOKUMEN
                                ========================= --}}
                                <td class="text-center">

                                                                    <a href="{{ route(
                                    'member.sertifikat.show',
                                    $sertifikat->id
                                ) }}"
                                class="btn btn-success btn-sm"
                                target="_blank">

                                    <i class="bi bi-file-earmark-text me-1"></i>
                                    Lihat Sertifikat

                                </a>

                                </td>

                            </tr>

                        @empty

                            {{-- =========================
                                DATA KOSONG
                            ========================= --}}
                            <tr>

                                <td colspan="5"
                                    class="text-center py-5">

                                    <i class="bi bi-award fs-1 text-muted">
                                    </i>

                                    <p class="text-muted mt-3 mb-0">
                                        Belum ada sertifikat.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    STYLE
========================================================= --}}
<style>

    /* =========================
       CARD
    ========================= */

    .card {
        border-radius: 6px;
    }


    /* =========================
       TABLE
    ========================= */

    .table {
        color: #0b1f4b;
    }


    .table thead th {

        background: #ffffff;

        color: #0b1f4b;

        font-size: 14px;

        font-weight: 700;

        padding: 16px 15px;

        vertical-align: middle;

        white-space: nowrap;

    }


    .table tbody td {

        padding: 15px;

        font-size: 15px;

        color: #0b1f4b;

        vertical-align: middle;

    }


    /* BORDER */

    .table-bordered > :not(caption) > * > * {

        border-color: #e1e5ec;

    }


    /* HOVER */

    .table tbody tr:hover {

        background-color: #fafcff;

    }


    /* =========================
       BUTTON
    ========================= */

    .btn-success {

        background-color: #18bd3a;

        border-color: #18bd3a;

        font-size: 14px;

        font-weight: 500;

        padding: 7px 13px;

        border-radius: 5px;

        white-space: nowrap;

    }


    .btn-success:hover {

        background-color: #14a932;

        border-color: #14a932;

    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 768px) {

        .container-fluid {

            padding-left: 15px !important;

            padding-right: 15px !important;

        }


        .card-body {

            padding: 15px;

        }


        .table-responsive {

            overflow-x: auto;

            -webkit-overflow-scrolling: touch;

        }


        .table {

            min-width: 900px;

        }


        .table thead th {

            font-size: 13px;

        }


        .table tbody td {

            font-size: 14px;

        }

    }

</style>

@endsection