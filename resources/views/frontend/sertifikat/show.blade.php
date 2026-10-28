@extends('frontend.member.layouts.app')

@section('title', 'Sertifikat Peserta')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Sertifikat Peserta
            </h4>

            <p class="text-muted mb-0">
                {{ $pendaftaran->nama_lengkap }}
            </p>
        </div>

        <div class="d-flex gap-2">

            {{-- KEMBALI --}}
            <a
                href="{{ route(
                    'admin.event.pendaftar',
                    $pendaftaran->event_id
                ) }}"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            {{-- DOWNLOAD --}}
            <a
                href="{{ route(
                    'sertifikat.download',
                    $pendaftaran->id
                ) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-download me-1"></i>
                Download PDF
            </a>

        </div>

    </div>


    {{-- PREVIEW --}}
    <div class="card shadow-sm">

        <div class="card-body p-4">

            <div
                style="
                    width: 100%;
                    background: #fff;
                    border: 1px solid #ddd;
                    padding: 20px;
                "
            >

                @include(
                    'frontend.sertifikat.pdf',
                    ['pendaftaran' => $pendaftaran]
                )

            </div>

        </div>

    </div>

</div>

@endsection