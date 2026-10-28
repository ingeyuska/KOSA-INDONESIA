@extends('backend.v_layout.app')

@section('title', 'Pendaftar Event')

@section('content')

<style>
    /* =========================================================
       PENDAFTAR EVENT
    ========================================================= */

    .pendaftar-page {
        padding: 4px 0 30px;
    }

    /* HEADER */
    .pendaftar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .pendaftar-title-wrapper {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .pendaftar-title-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #e8f0ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1264d8;
        font-size: 30px;
        flex-shrink: 0;
    }

    .pendaftar-header h4 {
        margin: 0 0 4px;
        font-size: 29px;
        font-weight: 700;
        color: #102a4c;
    }

    .pendaftar-header p {
        margin: 0;
        color: #71829a;
        font-size: 16px;
    }

    .btn-kembali {
        border-radius: 11px;
        padding: 9px 17px;
        font-weight: 600;
    }


    /* =========================================================
       EVENT INFO
    ========================================================= */

    .event-info-card {
        background: #fff;
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(31, 52, 80, 0.08);
        margin-bottom: 28px;
    }

    .event-info-body {
        padding: 26px 20px;
    }

    .event-info-item {
        min-height: 58px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-right: 1px solid #e5eaf1;
    }

    .event-info-item:last-child {
        border-right: 0;
    }

    .event-info-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: #eaf2ff;
        color: #1264d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .event-info-label {
        display: block;
        color: #74849b;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .event-info-value {
        display: block;
        color: #142a48;
        font-size: 16px;
        font-weight: 700;
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */

    .pendaftar-card {
        background: #fff;
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(31, 52, 80, 0.08);
        overflow: hidden;
    }

    .pendaftar-card-header {
        padding: 22px 28px 18px;
        border-bottom: 1px solid #edf1f5;
    }

    .pendaftar-card-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .pendaftar-card-icon {
        color: #1264d8;
        font-size: 27px;
    }

    .pendaftar-card-title h6 {
        margin: 0;
        color: #122b4d;
        font-size: 20px;
        font-weight: 700;
    }

    .pendaftar-card-title p {
        margin: 3px 0 0;
        color: #8190a5;
        font-size: 13px;
    }


    /* CUSTOM SEARCH */
    .pendaftar-search {
        width: 310px;
        height: 46px;
        border: 1px solid #dce4ee;
        border-radius: 11px;
        padding: 0 15px 0 43px;
        font-size: 13px;
        outline: none;
        background: #fff;
        transition: .2s;
    }

    .pendaftar-search:focus {
        border-color: #86aee6;
        box-shadow: 0 0 0 3px rgba(18, 100, 216, .08);
    }

    .pendaftar-search-wrapper {
        position: relative;
    }

    .pendaftar-search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #788aa2;
        font-size: 17px;
        pointer-events: none;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .pendaftar-table-wrapper {
        padding: 0 28px 20px;
    }

    #pendaftarEventTable {
        font-size: 13px !important;
        margin-top: 0 !important;
    }

    #pendaftarEventTable thead th {
        background: #f5f8fc;
        color: #5d7089;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .2px;
        padding: 13px 12px;
        border-bottom: 1px solid #e3e9f1;
        white-space: nowrap;
    }

    #pendaftarEventTable tbody td {
        padding: 13px 12px;
        color: #243b5a;
        border-bottom: 1px solid #edf1f5;
        vertical-align: middle;
    }

    #pendaftarEventTable tbody tr:last-child td {
        border-bottom: 0;
    }

    #pendaftarEventTable tbody tr:hover {
        background: #fafcff;
    }

    .member-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #168b57;
        color: #fff;
        padding: 7px 12px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .hadir-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #168b57;
        color: #fff;
        padding: 7px 11px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-hadir {
        font-size: 12px;
        border-radius: 8px;
        padding: 6px 10px;
    }

    .btn-sertifikat {
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        padding: 7px 12px;
        white-space: nowrap;
    }


    /* =========================================================
       DATATABLES
    ========================================================= */

    .pendaftar-card .dataTables_wrapper {
        font-size: 13px;
    }

    .pendaftar-card .dataTables_length {
        padding: 16px 0 8px;
    }

    .pendaftar-card .dataTables_length label {
        color: #5f7189;
        font-size: 13px;
    }

    .pendaftar-card .dataTables_length select {
        border: 1px solid #dce4ee;
        border-radius: 8px;
        padding: 5px 28px 5px 10px;
        margin: 0 5px;
    }

    /* Search bawaan DataTables disembunyikan */
    .pendaftar-card .dataTables_filter {
        display: none;
    }

    .pendaftar-card .dataTables_info {
        color: #73849b;
        padding-top: 15px;
        font-size: 13px;
    }

    .pendaftar-card .dataTables_paginate {
        padding-top: 10px;
    }

    .pendaftar-card .page-link {
        border-radius: 8px;
        margin: 0 2px;
        font-size: 13px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 992px) {

        .event-info-item {
            border-right: 0;
            border-bottom: 1px solid #edf1f5;
            padding: 15px 10px;
        }

        .event-info-item:last-child {
            border-bottom: 0;
        }

        .pendaftar-card-header {
            flex-direction: column;
            align-items: stretch !important;
        }

        .pendaftar-search {
            width: 100%;
        }
    }

    @media (max-width: 768px) {

        .pendaftar-header {
            align-items: flex-start;
        }

        .pendaftar-title-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .pendaftar-header h4 {
            font-size: 23px;
        }

        .pendaftar-header p {
            font-size: 14px;
        }

        .btn-kembali {
            padding: 8px 12px;
        }

        .pendaftar-card-header {
            padding: 18px;
        }

        .pendaftar-table-wrapper {
            padding: 0 18px 18px;
        }

        .event-info-body {
            padding: 15px;
        }
    }
</style>


<div class="container-fluid pendaftar-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div class="pendaftar-header">

        <div class="pendaftar-title-wrapper">

            <div class="pendaftar-title-icon">
                <i class="bi bi-calendar-event"></i>
            </div>

            <div>
                <h4>Pendaftar Event</h4>

                <p>
                    {{ $event->judul }}
                </p>
            </div>

        </div>


        <a href="{{ route('admin.event.index') }}"
           class="btn btn-secondary btn-kembali">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    {{-- =====================================================
         ALERT
    ====================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('warning'))

        <div class="alert alert-warning alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('warning') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =====================================================
         EVENT INFO
    ====================================================== --}}
    <div class="event-info-card">

        <div class="event-info-body">

            <div class="row align-items-center">

                {{-- EVENT --}}
                <div class="col-lg-4">

                    <div class="event-info-item">

                        <div class="event-info-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                        <div>

                            <span class="event-info-label">
                                Event
                            </span>

                            <span class="event-info-value">
                                {{ $event->judul }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- TANGGAL --}}
                <div class="col-lg-3">

                    <div class="event-info-item">

                        <div class="event-info-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>

                        <div>

                            <span class="event-info-label">
                                Tanggal
                            </span>

                            <span class="event-info-value">

                                {{ $event->tanggal
                                    ? \Carbon\Carbon::parse($event->tanggal)
                                        ->translatedFormat('d F Y')
                                    : '-'
                                }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- WAKTU --}}
                <div class="col-lg-2">

                    <div class="event-info-item">

                        <div class="event-info-icon">
                            <i class="bi bi-clock"></i>
                        </div>

                        <div>

                            <span class="event-info-label">
                                Waktu
                            </span>

                            <span class="event-info-value">
                                {{ $event->waktu ?: '-' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- TOTAL --}}
                <div class="col-lg-3">

                    <div class="event-info-item">

                        <div class="event-info-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <div>

                            <span class="event-info-label">
                                Total Pendaftar
                            </span>

                            <span class="event-info-value">
                                {{ $pendaftarans->count() }} peserta
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         DATA PENDAFTAR
    ====================================================== --}}
    <div class="pendaftar-card">

        {{-- CARD HEADER --}}
        <div class="pendaftar-card-header d-flex justify-content-between align-items-center">

            <div class="pendaftar-card-title">

                <div class="pendaftar-card-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>

                    <h6>
                        Data Pendaftar
                    </h6>

                    <p>
                        Daftar peserta yang terdaftar pada event ini.
                    </p>

                </div>

            </div>


            {{-- CUSTOM SEARCH --}}
            <div class="pendaftar-search-wrapper">

                <i class="bi bi-search pendaftar-search-icon"></i>

                <input
                    type="text"
                    id="pendaftarSearch"
                    class="pendaftar-search"
                    placeholder="Cari nama, email, no. hp..."
                >

            </div>

        </div>


        {{-- TABLE --}}
        <div class="pendaftar-table-wrapper">

            <div class="table-responsive">

                <table
                    id="pendaftarEventTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%;"
                >

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th>
                                ID Keanggotaan
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                WhatsApp
                            </th>

                            <th>
                                Instansi
                            </th>

                            <th>
                                Kehadiran
                            </th>

                            <th width="180">
                                Sertifikat
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($pendaftarans as $pendaftar)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- ID KEANGGOTAAN --}}
                                <td>

                                    @if($pendaftar->user && $pendaftar->user->alumni)

                                        <span class="member-badge">
                                            <i class="bi bi-person"></i>
                                            {{ $pendaftar->user->alumni->member_id }}
                                        </span>

                                    @elseif($pendaftar->user && $pendaftar->user->memberProfile)

                                        <span class="member-badge">
                                            <i class="bi bi-person"></i>
                                            {{ $pendaftar->user->memberProfile->member_id }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <span class="fw-semibold">
                                        {{ $pendaftar->nama_lengkap }}
                                    </span>

                                </td>


                                {{-- EMAIL --}}
                                <td>
                                    {{ $pendaftar->email }}
                                </td>


                                {{-- WHATSAPP --}}
                                <td>
                                    {{ $pendaftar->no_whatsapp }}
                                </td>


                                {{-- INSTANSI --}}
                                <td>
                                    {{ $pendaftar->instansi ?: '-' }}
                                </td>


                                {{-- KEHADIRAN --}}
                                <td>

                                    @if($pendaftar->hadir)

                                        <span class="hadir-badge">

                                            <i class="bi bi-check-circle"></i>

                                            Hadir

                                        </span>

                                    @else

                                        <form
                                            action="{{ route(
                                                'admin.event.pendaftar.hadir',
                                                $pendaftar->id
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="btn btn-outline-success btn-hadir"
                                                onclick="return confirm('Tandai peserta ini sebagai hadir?')"
                                            >

                                                <i class="bi bi-check-lg me-1"></i>
                                                Hadir

                                            </button>

                                        </form>

                                    @endif

                                </td>


                                {{-- SERTIFIKAT --}}
                                <td>

                                    @if($pendaftar->hadir)

                                        @if($pendaftar->sertifikat_nomor)

                                            <a
                                                href="{{ route(
                                                    'admin.event.sertifikat.show',
                                                    $pendaftar->id
                                                ) }}"
                                                class="btn btn-primary btn-sertifikat"
                                            >

                                                <i class="bi bi-award me-1"></i>

                                                Lihat Sertifikat

                                            </a>

                                        @else

                                            <a
                                                href="{{ route(
                                                    'admin.event.sertifikat.generate',
                                                    $pendaftar->id
                                                ) }}"
                                                class="btn btn-primary btn-sertifikat"
                                            >

                                                <i class="bi bi-award me-1"></i>

                                                Generate Sertifikat

                                            </a>

                                        @endif

                                    @else

                                        <span class="text-muted small">
                                            Belum tersedia
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CUSTOM DATATABLE SEARCH
========================================================= --}}
<script>
    $(document).ready(function () {

        $('#pendaftarSearch').on('keyup', function () {

            let searchValue = $(this).val();

            if ($.fn.DataTable.isDataTable('#pendaftarEventTable')) {

                $('#pendaftarEventTable')
                    .DataTable()
                    .search(searchValue)
                    .draw();

            }

        });

    });
</script>

@endsection