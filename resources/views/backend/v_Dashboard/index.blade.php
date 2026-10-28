@extends('backend.v_layout.app')

@section('title', 'Dashboard Admin')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- PAGE HEADING --}}
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">Overview</p>
                    <h1 class="h3 mb-1">Dashboard</h1>
                    <p class="text-muted mb-0">
                        Selamat datang di Dashboard Admin KOSA.
                    </p>
                </div>
            </div>
        </div>


        {{-- STATISTIK --}}
        <section class="row g-3 mt-1">

            {{-- ALUMNI --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-primary">

                    <div class="metric-top">
                        <span class="metric-label">
                            Total Alumni
                        </span>

                        <span class="metric-icon">
                            <i class="bi bi-people"></i>
                        </span>
                    </div>

                    <div class="metric-value">
                        {{ $jumlahAlumni }}
                    </div>

                    <div class="metric-meta">
                        <span>Data alumni KOSA</span>
                    </div>

                </article>
            </div>


            {{-- BERITA --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-success">

                    <div class="metric-top">
                        <span class="metric-label">
                            Berita
                        </span>

                        <span class="metric-icon">
                            <i class="bi bi-newspaper"></i>
                        </span>
                    </div>

                    <div class="metric-value">
                      {{ $jumlahBerita }}
                    </div>

                    <div class="metric-meta">
                        <span>Artikel berita</span>
                    </div>

                </article>
            </div>


            {{-- EVENT --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-warning">

                    <div class="metric-top">
                        <span class="metric-label">
                            Event
                        </span>

                        <span class="metric-icon">
                            <i class="bi bi-calendar-event"></i>
                        </span>
                    </div>

                    <div class="metric-value">
                        {{ $jumlahEvent}}
                    </div>

                    <div class="metric-meta">
                        <span>Event KOSA</span>
                    </div>

                </article>
            </div>

            {{-- PESAN --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <article class="metric-card metric-danger">

                    <div class="metric-top">
                        <span class="metric-label">
                            Pesan Baru
                        </span>
                        <span class="metric-icon">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>
                    <div class="metric-value">
                        {{ $jumlahPesanBaru }}
                    </div>
                    <div class="metric-meta">
                        <span>Pesan kontak</span>
                    </div>
                </article>
            </div>
        </section>

        {{-- WELCOME PANEL --}}
        <section class="row g-3 mt-1">
            <div class="col-12 col-xl-8">
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title">
                                <i class="bi bi-bar-chart-line"></i>
                                <span>Informasi KOSA</span>
                            </h2>
                            <p class="text-muted mb-0">
                                Ringkasan informasi Portal Alumni KOSA.
                            </p>
                        </div>
                    </div>
                    <div class="p-4">
                        <h4>
                            Selamat Datang di Dashboard Admin
                        </h4>
                        <p class="text-muted">
                            Dashboard ini digunakan untuk mengelola
                            data alumni, berita, event, aktivitas,
                            foto, video, dan pesan kontak pada
                            Portal Alumni KOSA.
                        </p>
                    </div>
                </div>
            </div>

            {{-- QUICK INFO --}}
            <div class="col-12 col-xl-4">
                <div class="panel h-100">
                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title">
                                <i class="bi bi-info-circle"></i>
                                <span>Quick Info</span>
                            </h2>
                            <p class="text-muted mb-0">
                                Informasi sistem
                            </p>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Status Sistem</span>
                            <span class="badge text-bg-success">
                                Aktif
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Role</span>
                            <strong>Administrator</strong>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span>Portal</span>
                            <strong>KOSA</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection