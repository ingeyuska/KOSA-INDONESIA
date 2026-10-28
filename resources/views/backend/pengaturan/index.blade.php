@extends('backend.v_layout.app')

@section('title', 'Pengaturan KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Pengaturan KOSA
            </h1>

            <p class="text-muted mb-0">
                Kelola informasi umum website KOSA Indonesia.
            </p>
        </div>

        <a href="{{ route('admin.pengaturan.edit') }}"
           class="btn btn-primary">

            <i class="ti-pencil"></i>
            Edit Pengaturan

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- INFORMASI UMUM --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Informasi Umum
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                {{-- LOGO --}}
                <div class="col-md-3 text-center mb-4">

                    <label class="fw-bold d-block mb-2">
                        Logo KOSA
                    </label>

                    @if($pengaturan->logo)

                        <img
                            src="{{ asset('storage/' . $pengaturan->logo) }}"
                            alt="Logo KOSA"
                            style="max-width: 180px; max-height: 120px;"
                            class="img-fluid"
                        >

                    @else

                        <div class="text-muted">
                            Belum ada logo
                        </div>

                    @endif

                </div>


                {{-- DATA --}}
                <div class="col-md-9">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                Nama KOSA
                            </label>

                            <p class="mb-0">
                                {{ $pengaturan->nama_kosa ?? '-' }}
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                Email
                            </label>

                            <p class="mb-0">
                                {{ $pengaturan->email ?? '-' }}
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                Telepon
                            </label>

                            <p class="mb-0">
                                {{ $pengaturan->telepon ?? '-' }}
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="fw-bold">
                                WhatsApp
                            </label>

                            <p class="mb-0">
                                {{ $pengaturan->whatsapp ?? '-' }}
                            </p>

                        </div>


                        <div class="col-md-12 mb-3">

                            <label class="fw-bold">
                                Alamat
                            </label>

                            <p class="mb-0">
                                {{ $pengaturan->alamat ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DESKRIPSI --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Deskripsi KOSA
            </h5>
        </div>

        <div class="card-body">

            <p class="mb-0">
                {{ $pengaturan->deskripsi ?? '-' }}
            </p>

        </div>

    </div>

    {{-- VISI & MISI --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Tujuan & Fungsi KOSA Indonesia
            </h5>
        </div>

        <div class="card-body">

            {{-- VISI --}}
            <div class="mb-4">

                <h6 class="fw-bold">
                    Tujuan
                </h6>

                @if($pengaturan->visi)

                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $pengaturan->visi }}
                    </p>

                @else

                    <p class="text-muted mb-0">
                        Tujuan KOSA Indonesia belum diatur.
                    </p>

                @endif

            </div>


            {{-- MISI --}}
            <div>

                <h6 class="fw-bold">
                    Fungsi
                </h6>

                @if($pengaturan->misi)

                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $pengaturan->misi }}
                    </p>

                @else

                    <p class="text-muted mb-0">
                        Fungsi KOSA Indonesia belum diatur.
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- PESAN KETUA --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Pesan Ketua
            </h5>
        </div>

        <div class="card-body">

            @if($pengaturan->pesan_ketua)

                <p style="white-space: pre-line;">
                    {{ $pengaturan->pesan_ketua }}
                </p>

            @else

                <p class="text-muted mb-0">
                    Pesan Ketua belum diatur.
                </p>

            @endif

        </div>

    </div>


    {{-- SOSIAL MEDIA --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Media Sosial
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Instagram</strong>
                    <p class="mb-0">
                        {{ $pengaturan->instagram ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Facebook</strong>
                    <p class="mb-0">
                        {{ $pengaturan->facebook ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>YouTube</strong>
                    <p class="mb-0">
                        {{ $pengaturan->youtube ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>LinkedIn</strong>
                    <p class="mb-0">
                        {{ $pengaturan->linkedin ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="mb-0">
                Pengaturan Footer & SEO
            </h5>
        </div>

        <div class="card-body">

            <div class="mb-3">

                <strong>Deskripsi Footer</strong>

                <p class="mb-0">
                    {{ $pengaturan->deskripsi_footer ?? '-' }}
                </p>

            </div>


            <div class="mb-3">

                <strong>Copyright</strong>

                <p class="mb-0">
                    {{ $pengaturan->copyright ?? '-' }}
                </p>

            </div>


            <div class="mb-3">

                <strong>Meta Title</strong>

                <p class="mb-0">
                    {{ $pengaturan->meta_title ?? '-' }}
                </p>

            </div>


            <div class="mb-3">

                <strong>Meta Description</strong>

                <p class="mb-0">
                    {{ $pengaturan->meta_description ?? '-' }}
                </p>

            </div>


            <div>

                <strong>Meta Keywords</strong>

                <p class="mb-0">
                    {{ $pengaturan->meta_keywords ?? '-' }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection