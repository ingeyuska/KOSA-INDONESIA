<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Admin Panel KOSA Indonesia">

    <title>@yield('title', 'Admin KOSA Indonesia')</title>


    {{-- =====================================================
         BOOTSTRAP
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('backend/assets/css/bootstrap.min.css') }}"
    >


    {{-- =====================================================
         BOOTSTRAP ICONS
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}"
    >


    {{-- =====================================================
         CSS TEMPLATE
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('backend/assets/css/style.css') }}"
    >


    {{-- =====================================================
         DATATABLES
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
    >


    {{-- =====================================================
         FONT AWESOME
    ====================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    {{-- =====================================================
         VITE
    ====================================================== --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >


    {{-- =====================================================
         SIDEBAR CUSTOM CSS
    ====================================================== --}}

    <style>

        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .sidebar-nav > .nav-link {
            margin-bottom: 3px;
        }


        /* =====================================================
           SIDEBAR DROPDOWN
        ===================================================== */

        .sidebar-dropdown {
            margin-bottom: 3px;
        }


        /* =====================================================
           SIDEBAR SUBMENU
        ===================================================== */

        .sidebar-submenu {
            padding-bottom: 4px;
        }


        /* =====================================================
           SUBMENU ICON
        ===================================================== */

        .sidebar-submenu-link i {
            width: 20px;
            text-align: center;
        }


        /* =====================================================
           JARAK ANTAR MENU
        ===================================================== */

        .sidebar-nav > .sidebar-dropdown {
            margin-bottom: 3px;
        }


        /* =====================================================
           SIDEBAR SECTION TITLE
        ===================================================== */

        .sidebar-section-title {
            display: flex;
            align-items: center;
            gap: 7px;

            margin: 13px 12px 5px;

            font-size: 9px;
            font-weight: 700;
            line-height: 1;

            color: #9aa4b2;

            text-transform: uppercase;
            letter-spacing: 0.7px;
        }


        /* GARIS KIRI */

        .sidebar-section-title::before {
            content: "";

            flex: 1;

            height: 1px;

            background: rgba(154, 164, 178, 0.25);
        }


        /* GARIS KANAN */

        .sidebar-section-title::after {
            content: "";

            flex: 1;

            height: 1px;

            background: rgba(154, 164, 178, 0.25);
        }


        /* TEXT TIDAK TURUN */

        .sidebar-section-title span {
            white-space: nowrap;
        }


        /* =====================================================
           SECTION PERTAMA
        ===================================================== */

        .sidebar-section-title.first-section {
            margin-top: 9px;
        }

    </style>

</head>


<body>

<div class="admin-shell">


    {{-- =====================================================
         BACKDROP SIDEBAR
    ====================================================== --}}

    <div
        class="sidebar-backdrop"
        data-sidebar-close>
    </div>



    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside
        class="admin-sidebar"
        id="adminSidebar"
        aria-label="Main navigation"
    >


        {{-- =================================================
             BRAND
        ================================================== --}}

        <div class="sidebar-header">

            <a
                class="brand-mark"
                href="{{ route('admin.dashboard') }}"
                aria-label="Admin dashboard"
            >

                <span class="brand-icon">

                    <i
                        class="bi bi-grid-1x2-fill"
                        aria-hidden="true">
                    </i>

                </span>


                <span class="brand-copy">

                    <span class="brand-title">
                        KOSA Indonesia
                    </span>

                    <span class="brand-subtitle">
                        Admin
                    </span>

                </span>

            </a>

        </div>



        {{-- =================================================
             MENU SIDEBAR
        ================================================== --}}

        <nav class="sidebar-nav">


            {{-- =================================================
                 DASHBOARD
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-speedometer2"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>



            {{-- =================================================
                 SECTION: ALUMNI
            ================================================== --}}

            <div class="sidebar-section-title first-section">
                <span>Alumni</span>
            </div>



            {{-- =================================================
                 ALUMNI
            ================================================== --}}

            <div class="sidebar-dropdown">

                <button
                    type="button"
                    class="nav-link sidebar-dropdown-toggle
                    {{
                        request()->routeIs('admin.alumni.*')
                        || request()->routeIs('admin.cerita-alumni.*')
                        || request()->routeIs('admin.tracer.*')
                        || request()->routeIs('admin.alumni.activation.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="nav-icon">

                        <i
                            class="bi bi-people"
                            aria-hidden="true">
                        </i>

                    </span>


                    <span class="nav-text">
                        Alumni
                    </span>


                    <span class="dropdown-arrow">

                        <i class="bi bi-chevron-down"></i>

                    </span>

                </button>


                {{-- SUB MENU --}}

                <div class="sidebar-submenu">


                    {{-- ALUMNI --}}

                    <a
                        class="sidebar-submenu-link
                        {{
                            request()->routeIs('admin.alumni.*')
                            && !request()->routeIs('admin.alumni.activation.*')
                            ? 'active'
                            : ''
                        }}"
                        href="{{ route('admin.alumni.index') }}"
                    >

                        <i class="bi bi-people"></i>

                        <span>
                            Alumni
                        </span>

                    </a>



                    {{-- CERITA ALUMNI --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.cerita-alumni.*') ? 'active' : '' }}"
                        href="{{ route('admin.cerita-alumni.index') }}"
                    >

                        <i class="bi bi-chat-quote"></i>

                        <span>
                            Cerita Alumni
                        </span>

                    </a>



                    {{-- TRACER --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.tracer.*') ? 'active' : '' }}"
                        href="{{ route('admin.tracer.index') }}"
                    >

                        <i class="bi bi-clipboard-data"></i>

                        <span>
                            Tracer
                        </span>

                    </a>



                    {{-- ALUMNI EXISTING --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.alumni.activation.*') ? 'active' : '' }}"
                        href="{{ route('admin.alumni.activation.index') }}"
                    >

                        <i class="fa-solid fa-user-check"></i>

                        <span>
                            Alumni Existing
                        </span>

                    </a>

                </div>

            </div>



            {{-- =================================================
                 SECTION: ORGANISASI
            ================================================== --}}

            <div class="sidebar-section-title">
                <span>Organisasi</span>
            </div>



            {{-- =================================================
                 KETUA KOSA
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.pengurus.*') ? 'active' : '' }}"
                href="{{ route('admin.pengurus.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-person-badge"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Ketua KOSA
                </span>

            </a>



            {{-- =================================================
                 STRUKTUR ORGANISASI
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.struktur-organisasi.*') ? 'active' : '' }}"
                href="{{ route('admin.struktur-organisasi.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-diagram-3"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Struktur Organisasi
                </span>

            </a>



            {{-- =================================================
                 SECTION: MASTER DATA
            ================================================== --}}

            <div class="sidebar-section-title">
                <span>Master Data</span>
            </div>



            {{-- =================================================
                 MASTER DATA
            ================================================== --}}

            <div class="sidebar-dropdown">

                <a
                    href="javascript:void(0);"
                    class="nav-link sidebar-dropdown-toggle
                    {{
                        request()->routeIs('admin.program-master.*')
                        || request()->routeIs('admin.jenis-keilmuan.*')
                        || request()->routeIs('admin.klasifikasi-program.*')
                        || request()->routeIs('admin.universitas.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="nav-icon">

                        <i
                            class="bi bi-database"
                            aria-hidden="true">
                        </i>

                    </span>


                    <span class="nav-text">
                        Master Data
                    </span>


                    <span class="dropdown-arrow">

                        <i class="bi bi-chevron-down"></i>

                    </span>

                </a>


                {{-- SUB MENU --}}

                <div class="sidebar-submenu">


                    {{-- PROGRAM --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.program-master.*') ? 'active' : '' }}"
                        href="{{ route('admin.program-master.index') }}"
                    >

                        <i class="bi bi-mortarboard"></i>

                        <span>
                            Program
                        </span>

                    </a>



                    {{-- JENIS KEILMUAN --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.jenis-keilmuan.*') ? 'active' : '' }}"
                        href="{{ route('admin.jenis-keilmuan.index') }}"
                    >

                        <i class="bi bi-book"></i>

                        <span>
                            Jenis Keilmuan
                        </span>

                    </a>



                    {{-- KLASIFIKASI PROGRAM --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.klasifikasi-program.*') ? 'active' : '' }}"
                        href="{{ route('admin.klasifikasi-program.index') }}"
                    >

                        <i class="bi bi-tags"></i>

                        <span>
                            Klasifikasi Program
                        </span>

                    </a>



                    {{-- UNIVERSITAS --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.universitas.*') ? 'active' : '' }}"
                        href="{{ route('admin.universitas.index') }}"
                    >

                        <i class="bi bi-building"></i>

                        <span>
                            Universitas
                        </span>

                    </a>

                </div>

            </div>



            {{-- =================================================
                 SECTION: KONTEN
            ================================================== --}}

            <div class="sidebar-section-title">
                <span>Konten</span>
            </div>



            {{-- =================================================
                 BERITA
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"
                href="{{ route('admin.berita.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-newspaper"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Berita
                </span>

            </a>



            {{-- =================================================
                 EVENT
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.event.*') ? 'active' : '' }}"
                href="{{ route('admin.event.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-calendar-event"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Event
                </span>

            </a>



            {{-- =================================================
                 AKTIVITAS
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.aktivitas.*') ? 'active' : '' }}"
                href="{{ route('admin.aktivitas.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-activity"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Aktivitas
                </span>

            </a>



            {{-- =================================================
                 GALERI
            ================================================== --}}

            <div class="sidebar-dropdown">

                <a
                    href="javascript:void(0);"
                    class="nav-link sidebar-dropdown-toggle
                    {{
                        request()->routeIs('admin.galeri.*')
                        || request()->routeIs('admin.video.*')
                        ? 'active'
                        : ''
                    }}"
                >

                    <span class="nav-icon">

                        <i
                            class="bi bi-images"
                            aria-hidden="true">
                        </i>

                    </span>


                    <span class="nav-text">
                        Galeri
                    </span>


                    <span class="dropdown-arrow">

                        <i class="bi bi-chevron-down"></i>

                    </span>

                </a>


                {{-- SUB MENU --}}

                <div class="sidebar-submenu">


                    {{-- FOTO --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"
                        href="{{ route('admin.galeri.index') }}"
                    >

                        <i class="bi bi-image"></i>

                        <span>
                            Foto
                        </span>

                    </a>



                    {{-- VIDEO --}}

                    <a
                        class="sidebar-submenu-link
                        {{ request()->routeIs('admin.video.*') ? 'active' : '' }}"
                        href="{{ route('admin.video.index') }}"
                    >

                        <i class="bi bi-camera-video"></i>

                        <span>
                            Video
                        </span>

                    </a>

                </div>

            </div>



            {{-- =================================================
                 SECTION: INFORMASI
            ================================================== --}}

            <div class="sidebar-section-title">
                <span>Informasi</span>
            </div>



            {{-- =================================================
                 PESAN KONTAK
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.pesan-kontak.*') ? 'active' : '' }}"
                href="{{ route('admin.pesan-kontak.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-envelope"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Pesan Kontak
                </span>

            </a>



            {{-- =================================================
                 TENTANG KOSA
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}"
                href="{{ route('admin.tentang.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-info-circle"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Tentang KOSA
                </span>

            </a>



            {{-- =================================================
                 ADMINISTRASI
            ================================================== --}}

            @if(auth()->user()->role === 'super_admin')

                <div class="sidebar-section-title">
                    <span>Administrasi</span>
                </div>


                {{-- =================================================
                     USER MANAGEMENT
                ================================================== --}}

                <div class="sidebar-dropdown">

                    <a
                        href="javascript:void(0);"
                        class="nav-link sidebar-dropdown-toggle
                        {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    >

                        <span class="nav-icon">

                            <i
                                class="bi bi-person-gear"
                                aria-hidden="true">
                            </i>

                        </span>


                        <span class="nav-text">
                            User Management
                        </span>


                        <span class="dropdown-arrow">

                            <i class="bi bi-chevron-down"></i>

                        </span>

                    </a>


                    {{-- SUB MENU --}}

                    <div class="sidebar-submenu">


                        {{-- ADMIN --}}

                        <a
                            class="sidebar-submenu-link
                            {{ request()->routeIs('admin.users.admin') ? 'active' : '' }}"
                            href="{{ route('admin.users.admin') }}"
                        >

                            <i class="bi bi-person-shield"></i>

                            <span>
                                Admin
                            </span>

                        </a>



                        {{-- MANAJEMEN --}}

                        <a
                            class="sidebar-submenu-link
                            {{ request()->routeIs('admin.users.manajemen') ? 'active' : '' }}"
                            href="{{ route('admin.users.manajemen') }}"
                        >

                            <i class="bi bi-person-badge"></i>

                            <span>
                                Manajemen
                            </span>

                        </a>



                        {{-- ALUMNI --}}

                        <a
                            class="sidebar-submenu-link
                            {{ request()->routeIs('admin.users.alumni') ? 'active' : '' }}"
                            href="{{ route('admin.users.alumni') }}"
                        >

                            <i class="bi bi-mortarboard"></i>

                            <span>
                                Alumni
                            </span>

                        </a>



                        {{-- MEMBER --}}

                        <a
                            class="sidebar-submenu-link
                            {{ request()->routeIs('admin.users.member') ? 'active' : '' }}"
                            href="{{ route('admin.users.member') }}"
                        >

                            <i class="bi bi-person"></i>

                            <span>
                                Member
                            </span>

                        </a>

                    </div>

                </div>

            @endif



            {{-- =================================================
                 SECTION: SISTEM
            ================================================== --}}

            <div class="sidebar-section-title">
                <span>Sistem</span>
            </div>



            {{-- =================================================
                 SETTINGS
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}"
                href="{{ route('admin.pengaturan.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-gear"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Settings
                </span>

            </a>



            {{-- =================================================
                 BANNER
            ================================================== --}}

            <a
                class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}"
                href="{{ route('admin.banner.index') }}"
            >

                <span class="nav-icon">

                    <i
                        class="bi bi-images"
                        aria-hidden="true">
                    </i>

                </span>

                <span class="nav-text">
                    Banner Dashboard
                </span>

            </a>

        </nav>



        {{-- =================================================
             USER SIDEBAR
        ================================================== --}}

        <div class="sidebar-user">

            @auth

                {{-- FOTO USER LOGIN --}}

                @if(auth()->user()->foto)

                    <img
                        class="avatar-img avatar-md sidebar-user-avatar"
                        src="{{ asset('storage/' . auth()->user()->foto) }}"
                        alt="{{ auth()->user()->nama }}"
                    >

                @else

                    <img
                        class="avatar-img avatar-md sidebar-user-avatar"
                        src="{{ asset('backend/assets/images/avatar/avatar.jpg') }}"
                        alt="{{ auth()->user()->nama }}"
                    >

                @endif


                {{-- NAMA USER LOGIN --}}

                <strong>
                    {{ auth()->user()->nama }}
                </strong>


                {{-- STATUS USER --}}

                <small>
                    {{ auth()->user()->status === 'aktif' ? 'Active' : 'Inactive' }}
                </small>

            @endauth

        </div>



        {{-- =================================================
             SIDEBAR FOOTER
        ================================================== --}}

        <div class="sidebar-footer">

            <span class="status-dot"></span>

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>

    </aside>



    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <div class="admin-main">


        {{-- =================================================
             NAVBAR
        ================================================== --}}

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">


                {{-- SIDEBAR TOGGLE --}}

                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                    aria-label="Toggle sidebar"
                >

                    <span></span>
                    <span></span>
                    <span></span>

                </button>



                {{-- SEARCH --}}

                <form
                    class="d-none d-md-flex ms-3 flex-grow-1"
                    role="search"
                >

                    <input
                        class="form-control search-input"
                        type="search"
                        placeholder="Search..."
                        aria-label="Search"
                    >

                </form>



                {{-- NAVBAR ACTIONS --}}

                <div class="navbar-actions ms-auto">


                    {{-- DARK / LIGHT MODE --}}

                    <button
                        class="icon-button theme-toggle"
                        type="button"
                        data-theme-toggle
                        aria-label="Switch color theme"
                        title="Switch color theme"
                    >

                        <i
                            class="bi bi-moon-stars"
                            data-theme-icon
                            aria-hidden="true">
                        </i>

                    </button>


                    {{-- NOTIFICATION PESAN KONTAK --}}

                    @php
                        $pesanBaru = \App\Models\PesanKontak::where('status', 'baru')
                            ->latest()
                            ->get();

                        $jumlahPesanBaru = $pesanBaru->count();
                    @endphp

                    <div class="dropdown">

                        <button
                            class="icon-button position-relative"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Notifications"
                        >

                            <i class="bi bi-bell" aria-hidden="true"></i>

                            {{-- Titik merah hanya jika ada pesan baru --}}
                            @if($jumlahPesanBaru > 0)
                                <span class="notification-dot"></span>
                            @endif

                        </button>

                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="dropdown-header fw-bold text-body">
                                Pesan Masuk
                            </div>

                            @if($jumlahPesanBaru > 0)

                                @foreach($pesanBaru->take(5) as $pesan)

                                    <a
                                        class="dropdown-item"
                                        href="{{ route('admin.pesan-kontak.show', $pesan->id) }}"
                                    >

                                        <div class="notification-title fw-semibold">
                                            {{ $pesan->nama }}
                                        </div>

                                        <div class="small text-muted">
                                            {{ \Illuminate\Support\Str::limit($pesan->subjek, 40) }}
                                        </div>

                                        <div class="small text-muted mt-1">
                                            {{ $pesan->created_at->diffForHumans() }}
                                        </div>

                                    </a>

                                @endforeach

                                @if($jumlahPesanBaru > 5)
                                    <div class="dropdown-divider"></div>

                                    <a
                                        href="{{ route('admin.pesan-kontak.index') }}"
                                        class="dropdown-item text-center text-primary"
                                    >
                                        Lihat semua pesan
                                    </a>
                                @endif

                            @else

                                <div class="dropdown-item text-muted">
                                    Belum ada pesan baru.
                                </div>

                            @endif

                        </div>

                    </div>

                 {{-- =================================================
     PROFILE NAVBAR
================================================= --}}

<div class="dropdown">

    {{-- PROFILE BUTTON --}}

    <button
        class="profile-button dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        aria-label="Profile"
    >

        @auth

            @if(auth()->user()->foto)

                <img
                    src="{{ asset('storage/' . auth()->user()->foto) }}"
                    alt="{{ auth()->user()->nama }}"
                    width="38"
                    height="38"
                    style="
                        width: 38px;
                        height: 38px;
                        border-radius: 50%;
                        object-fit: cover;
                        display: block;
                    "
                >

            @else

                <img
                    src="{{ asset('backend/assets/images/avatar/avatar.jpg') }}"
                    alt="{{ auth()->user()->nama }}"
                    width="38"
                    height="38"
                    style="
                        width: 38px;
                        height: 38px;
                        border-radius: 50%;
                        object-fit: cover;
                        display: block;
                    "
                >

            @endif

        @endauth

    </button>


    {{-- PROFILE DROPDOWN --}}

    <ul class="dropdown-menu dropdown-menu-end">

        <li>
            <a
                class="dropdown-item"
                href="{{ route('admin.profile.index') }}"
            >
                Profile
            </a>
        </li>

        <li>
            <a
                class="dropdown-item"
                href="{{ route('admin.profile.edit') }}"
            >
                Account settings
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>

            <form
                action="{{ route('admin.logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="dropdown-item"
                >
                    Sign out
                </button>

            </form>

        </li>

    </ul>

</div>
                </div>

            </div>

        </nav>



        {{-- =================================================
             ISI HALAMAN
        ================================================== --}}

        @yield('content')

    </div>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}


{{-- jQuery HARUS PALING AWAL --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


{{-- Bootstrap --}}

<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>


{{-- Template / Sidebar --}}

<script src="{{ asset('backend/assets/js/main.js') }}"></script>


{{-- DataTables Core --}}

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>


{{-- DataTables Bootstrap 5 --}}

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>



{{-- =========================================================
     DATATABLES
========================================================= --}}

<script>

$(document).ready(function () {


    /* =====================================================
       DATA TABLES
    ====================================================== */

    $('.data-table').each(function () {


        $(this).DataTable({

            pageLength: 10,


            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],


            language: {

                lengthMenu: "Show _MENU_ entries",

                search: "Search:",

                info: "Showing _START_ to _END_ of _TOTAL_ entries",

                infoEmpty: "Showing 0 to 0 of 0 entries",

                zeroRecords: "Tidak ada data yang ditemukan",

                emptyTable: "Belum ada data",

                paginate: {

                    previous: "Previous",

                    next: "Next"

                }

            },


            columnDefs: [

                {

                    orderable: false,

                    searchable: false,

                    targets: []

                }

            ]

        });

    });

});

</script>


</body>

</html>