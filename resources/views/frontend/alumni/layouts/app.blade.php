<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Portal Alumni - KOSA Indonesia')
    </title>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
          href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="{{ asset('frontend/assets/css/all.min.css') }}">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    @stack('styles')

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef3f7;
            font-family: 'Lexend', sans-serif;
            color: #173f5f;
        }

        /* =====================================================
           TOP NAVBAR
        ===================================================== */

        .alumni-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;

            height: 76px;

            display: flex;
            align-items: center;

            background: #004f7f;

            z-index: 1050;

            box-shadow: 0 2px 8px rgba(0,0,0,.12);
        }

        .alumni-brand {
            width: 240px;
            height: 76px;

            display: flex;
            align-items: center;

            padding: 0 15px;

            background: #064a76;
        }

        .alumni-brand img {
            width: 35px;
            height: 35px;

            object-fit: contain;

            margin-right: 9px;
        }

        .alumni-brand span {
            color: #fff;

            font-size: 18px;

            font-weight: 700;
        }

        .alumni-toggle {
            width: 60px;
            height: 76px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;
            background: transparent;

            color: rgba(255,255,255,.65);

            font-size: 22px;

            cursor: pointer;
        }

        .alumni-toggle:hover {
            color: #fff;
        }

        /* =====================================================
   DROPDOWN PROFILE
===================================================== */

.alumni-user {
    position: relative;

    margin-left: auto;

    height: 76px;

    display: flex;
    align-items: center;

    padding-right: 25px;

    color: #fff;
}


/* Jangan mengubah tampilan awal user */
.alumni-user-btn {
    display: flex;
    align-items: center;

    border: none;
    background: transparent;

    padding: 0;

    color: inherit;

    font-family: inherit;

    cursor: pointer;
}


/* Pastikan nama dan avatar tetap seperti sebelumnya */
.alumni-user-avatar {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #0788c5;
}

.alumni-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

.alumni-user-avatar i {
    font-size: 16px;
    color: #fff;
}


/* CHEVRON */
.alumni-chevron {
    margin-left: 7px;

    font-size: 10px;

    color: rgba(255,255,255,.65);

    transition: transform .2s ease;
}

.alumni-chevron.rotate {
    transform: rotate(180deg);
}


/* DROPDOWN */
.alumni-dropdown-menu {
    position: absolute;

    top: 65px;
    right: 25px;

    width: 180px;

    background: #fff;

    border: 1px solid #e5e9ed;

    border-radius: 7px;

    padding: 6px;

    box-shadow: 0 6px 20px rgba(0,0,0,.15);

    display: none;

    z-index: 9999;
}


/* MUNCUL SAAT DIKLIK */
.alumni-dropdown-menu.show {
    display: block;
}


/* ITEM DROPDOWN */
.alumni-dropdown-menu a,
.alumni-dropdown-menu form button {

    width: 100%;

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 10px 12px;

    border: none;

    background: transparent;

    color: #536273;

    font-family: 'Lexend', sans-serif;

    font-size: 13px;

    font-weight: 500;

    text-decoration: none;

    border-radius: 5px;

    cursor: pointer;

    text-align: left;
}


/* HOVER */
.alumni-dropdown-menu a:hover,
.alumni-dropdown-menu form button:hover {

    background: #eef7fc;

    color: #0788c5;
}


/* ICON */
.alumni-dropdown-menu i {

    width: 18px;

    text-align: center;

    font-size: 14px;
}


/* FORM */
.alumni-dropdown-menu form {
    margin: 0;
}

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .alumni-sidebar {
            position: fixed;

            top: 76px;
            left: 0;
            bottom: 0;

            width: 240px;

            background: #fff;

            border-right: 1px solid #e4e9ee;

            z-index: 1000;

            overflow-y: auto;

            transition: .25s ease;
        }

        .alumni-sidebar-profile {
            padding: 27px 19px 24px;

            border-bottom: 1px solid #edf0f3;
        }

        .alumni-profile-top {
            display: flex;
            align-items: center;
        }

        .alumni-sidebar-avatar {
            width: 40px;
            height: 40px;

            flex-shrink: 0;

            border-radius: 50%;

            overflow: hidden;

            background: linear-gradient(
                135deg,
                #ef3030,
                #087fc1
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: #fff;
        }

        .alumni-sidebar-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .alumni-sidebar-id {
            margin-left: 10px;

            flex: 1;

            font-size: 13px;

            color: #8795a7;
        }

        .alumni-sidebar-arrow {
            color: #a4afbc;

            font-size: 10px;
        }

        .alumni-online {
            margin-top: 6px;

            color: #14b88a;

            font-size: 10px;

            font-weight: 500;
        }

        .alumni-sidebar-name {
            margin-top: 5px;

            color: #8795a7;

            font-size: 12px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        /* =====================================================
           SIDEBAR SECTION
        ===================================================== */

        .alumni-menu-title {
            padding: 24px 20px 9px;

            color: #727e8d;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;
        }

        .alumni-menu {
            list-style: none;

            margin: 0;

            padding: 0 9px;
        }

        .alumni-menu li {
            margin-bottom: 3px;
        }

        .alumni-menu a {
            min-height: 45px;

            display: flex;
            align-items: center;

            padding: 10px 13px;

            border-radius: 7px;

            color: #8491a5;

            text-decoration: none;

            font-size: 13px;

            font-weight: 500;

            transition: .2s;
        }

        .alumni-menu a i {
            width: 24px;

            margin-right: 10px;

            text-align: center;

            font-size: 15px;
        }

        .alumni-menu a:hover {
            background: #eef7fc;

            color: #0788c5;
        }

        .alumni-menu a.active {
            background: #eef7fc;

            color: #0788c5;

            font-weight: 600;

            border-left: 3px solid #0788c5;

            border-radius: 0 7px 7px 0;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .alumni-main {
            margin-left: 240px;

            padding-top: 76px;

            min-height: 100vh;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .alumni-page-header {
            min-height: 112px;

            padding: 25px 28px 22px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            background: #fff;

            border-bottom: 1px solid #edf0f3;
        }

        .alumni-page-title {
            margin: 0;

            color: #073b63;

            font-size: 25px;

            font-weight: 800;
        }

        .alumni-page-subtitle {
            margin-top: 4px;

            color: #8997a7;

            font-size: 12px;
        }

        .alumni-breadcrumb {
            color: #8491a5;

            font-size: 11px;
        }

        .alumni-breadcrumb .active {
            color: #0788c5;

            font-weight: 600;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .alumni-content {
            padding: 23px 28px 40px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .alumni-footer {
            margin-left: 240px;

            padding: 18px 25px;

            background: #fff;

            border-top: 1px solid #e5e9ed;

            color: #7c8793;

            font-size: 11px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 991px) {

            .alumni-sidebar {
                transform: translateX(-100%);
            }

            .alumni-sidebar.show {
                transform: translateX(0);
            }

            .alumni-main {
                margin-left: 0;
            }

            .alumni-footer {
                margin-left: 0;
            }

            .alumni-user-name {
                display: none;
            }
        }

        @media(max-width: 576px) {

            .alumni-brand {
                width: 180px;
            }

            .alumni-brand span {
                font-size: 14px;
            }

            .alumni-page-header {
                padding: 20px;
            }

            .alumni-content {
                padding: 18px;
            }

            .alumni-breadcrumb {
                display: none;
            }

        }
        /* =====================================================
   SIDEBAR PROFILE DROPDOWN
===================================================== */

.alumni-sidebar-profile {
    position: relative;
}


/* PROFILE BUTTON */

.alumni-sidebar-profile-btn {
    width: 100%;

    padding: 0;

    border: none;

    background: transparent;

    font-family: 'Lexend', sans-serif;

    text-align: left;

    cursor: pointer;
}

.alumni-sidebar-profile-btn:focus {
    outline: none;
}


/* DROPDOWN */

.alumni-sidebar-dropdown {
    display: none;

    margin-top: 14px;

    padding: 6px;

    background: #fff;

    border: 1px solid #e5e9ed;

    border-radius: 7px;

    box-shadow: 0 5px 18px rgba(0,0,0,.10);

    animation: sidebarDropdown .15s ease;
}


/* SAAT AKTIF */

.alumni-sidebar-dropdown.show {
    display: block;
}


/* ANIMASI */

@keyframes sidebarDropdown {

    from {
        opacity: 0;
        transform: translateY(-5px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* ITEM */

.alumni-sidebar-dropdown a,
.alumni-sidebar-dropdown form button {

    width: 100%;

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 10px 12px;

    border: none;

    background: transparent;

    color: #536273;

    font-family: 'Lexend', sans-serif;

    font-size: 12px;

    font-weight: 500;

    text-decoration: none;

    border-radius: 5px;

    cursor: pointer;

    text-align: left;
}


/* HOVER */

.alumni-sidebar-dropdown a:hover,
.alumni-sidebar-dropdown form button:hover {

    background: #eef7fc;

    color: #0788c5;

}


/* ICON */

.alumni-sidebar-dropdown i {

    width: 18px;

    text-align: center;

    font-size: 13px;

}


/* FORM */

.alumni-sidebar-dropdown form {

    margin: 0;

}


/* ARROW */

.alumni-sidebar-profile-btn .alumni-sidebar-arrow {

    transition: transform .2s ease;

}


.alumni-sidebar-profile-btn .alumni-sidebar-arrow.rotate {

    transform: rotate(90deg);

}

    </style>
    

</head>


<body>


{{-- =========================================================
     NAVBAR ALUMNI
========================================================= --}}

<nav class="alumni-navbar">

    <div class="alumni-brand">

        <img
            src="{{ asset('frontend/assets/images/logo/logo1.png') }}"
            alt="KOSA">

        <span>
            Alumni KOSA
        </span>

    </div>


    {{-- TOGGLE SIDEBAR --}}
    <button
        type="button"
        class="alumni-toggle"
        id="alumniSidebarToggle">

        <i class="fa-solid fa-bars"></i>

    </button>


    {{-- USER --}}
    <div class="alumni-user">

        <button
            type="button"
            class="alumni-user-btn"
            id="alumniUserDropdown">

            <div class="alumni-user-avatar">

                @if(Auth::user()->alumni?->foto)

                    <img
                        src="{{ asset('storage/' . Auth::user()->alumni->foto) }}"
                        alt="Foto Alumni">

                @else

                    <i class="fa-solid fa-user"></i>

                @endif

            </div>

            <span class="alumni-user-name">
                {{ Auth::user()->nama ?? 'Alumni' }}
            </span>

            <i class="fa-solid fa-chevron-down alumni-chevron"></i>

        </button>


        {{-- DROPDOWN --}}
        <div
            class="alumni-dropdown-menu"
            id="alumniDropdownMenu">

            <a href="{{ route('alumni.profile') }}">

                <i class="fa-solid fa-user"></i>

                <span>Profil</span>

            </a>


            <form
                action="{{ route('logout') }}"
                method="POST">

                @csrf

                <button type="submit">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </div>

</nav>


{{-- =========================================================
     SIDEBAR
========================================================= --}}

<aside
    class="alumni-sidebar"
    id="alumniSidebar">


   {{-- PROFILE --}}

<div class="alumni-sidebar-profile">

    {{-- PROFILE BUTTON --}}
    <button
        type="button"
        class="alumni-sidebar-profile-btn"
        id="alumniSidebarProfileBtn"
    >

        <div class="alumni-profile-top">

            {{-- FOTO ALUMNI --}}
            <div class="alumni-sidebar-avatar">

                @if(Auth::user()->alumni?->foto)

                    <img
                        src="{{ asset('storage/' . Auth::user()->alumni->foto) }}"
                        alt="Foto Alumni"
                    >

                @else

                    <i class="fa-solid fa-user"></i>

                @endif

            </div>


            {{-- ID ALUMNI --}}
            <div class="alumni-sidebar-id">

                {{ Auth::user()->alumni?->alumni_id ?? 'A-XXXXX' }}

            </div>


            <i
                class="fa-solid fa-chevron-right alumni-sidebar-arrow"
                id="alumniSidebarProfileArrow"
            ></i>

        </div>


        {{-- STATUS ONLINE --}}
        <div class="alumni-online">

            <i
                class="fa-solid fa-circle"
                style="font-size:6px;"
            ></i>

            online

        </div>


        {{-- NAMA --}}
        <div class="alumni-sidebar-name">

            {{ Auth::user()->nama ?? 'Alumni' }}

        </div>

    </button>


    {{-- DROPDOWN PROFILE SIDEBAR --}}

    <div
        class="alumni-sidebar-dropdown"
        id="alumniSidebarDropdown"
    >

        {{-- PROFIL --}}
        <a href="{{ route('alumni.profile') }}">

            <i class="fa-solid fa-user"></i>

            <span>Profil</span>

        </a>


        {{-- UBAH PASSWORD --}}
        <a href="{{ route('alumni.password.edit') }}">

            <i class="fa-solid fa-lock"></i>

            <span>Ubah Password</span>

        </a>


        {{-- LOGOUT --}}
        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button type="submit">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </button>

        </form>

    </div>

</div>

    {{-- MENU ALUMNI --}}

    <div class="alumni-menu-title">

        --- Menu Alumni ---

    </div>


    <ul class="alumni-menu">

        <li>

            <a href="{{ route('alumni.dashboard') }}"
               class="{{ request()->routeIs('dashboard.alumni') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                Home

            </a>

        </li>


        <li>

            <a href="{{ route('alumni.profile') }}"
               class="{{ request()->routeIs('profile') ? 'active' : '' }}">

                <i class="fa-solid fa-user"></i>

                Data Diri

            </a>

        </li>


        <li>

            <a href="{{ route('alumni.tracer') }}"
               class="{{ request()->routeIs('tracer*') ? 'active' : '' }}">

                <i class="fa-solid fa-chart-line"></i>

                Tracer Alumni

            </a>

        </li>

       <li>
            <a href="{{ route('alumni.kartu') }}"
            class="{{ request()->routeIs('alumni.kartu') ? 'active' : '' }}">

                <i class="fa-solid fa-id-card"></i>

                Kartu Alumni
            </a>
        </li>

        <li>
            <a href="{{ route('alumni.event') }}">
                <i class="fa-solid fa-calendar-days"></i>

                Event
            </a>
        </li>

        <li>

            <li>

                <a href="{{ route('alumni.sertifikat') }}"
                class="{{ request()->routeIs('alumni.sertifikat*') ? 'active' : '' }}">

                    <i class="fa-solid fa-certificate"></i>

                    Sertifikat

                </a>

            </li>

        </li>


        <li>

            <a href="{{ route('alumni.contribution') }}">

                <i class="fa-solid fa-users"></i>

                Networking & Kontribusi Alumni

            </a>

        </li>

    </ul>


    {{-- MENU LAINNYA --}}

    {{-- <div class="alumni-menu-title">

        --- Menu Lainnya ---

    </div>


    <ul class="alumni-menu">

        <li>

            <a href="{{ route('berita') }}">

                <i class="fa-solid fa-newspaper"></i>

                Berita KOSA

            </a>

        </li>


        <li>

            <a href="{{ route('galeri') }}">

                <i class="fa-solid fa-image"></i>

                Galeri Kegiatan

            </a>

        </li>


        <li>

            <a href="{{ route('kontak') }}">

                <i class="fa-solid fa-phone"></i>

                Kontak

            </a>

        </li>

    </ul> --}}


    {{-- BANTUAN --}}

    {{-- <div style="
        margin-top:25px;
        padding:20px;
        border-top:1px solid #edf0f3;
        color:#8795a7;
        font-size:11px;
    ">

        <strong style="
            display:block;
            color:#607086;
            margin-bottom:4px;
        ">

            <i class="fa-solid fa-headset me-1"></i>

            Butuh bantuan?

        </strong>

        Hubungi admin KOSA Indonesia

    </div> --}}

</aside>


{{-- =========================================================
     MAIN
========================================================= --}}

<main class="alumni-main">


    <div class="alumni-page-header">

        <div>

            <h1 class="alumni-page-title">

                @yield('page-title', 'Dashboard Alumni')

            </h1>

            <div class="alumni-page-subtitle">

                @yield(
                    'page-subtitle',
                    'Kelola profil alumni dan kegiatan KOSA Indonesia dalam satu tempat.'
                )

            </div>

        </div>


        <div class="alumni-breadcrumb">

            Beranda

            <span class="mx-2">
                <i class="fa-solid fa-chevron-right"
                   style="font-size:8px;"></i>
            </span>

            <span class="active">

                @yield('breadcrumb', 'Dashboard')

            </span>

        </div>

    </div>


    <div class="alumni-content">

        @yield('content')

    </div>

</main>


{{-- FOOTER --}}

<footer class="alumni-footer">

    © {{ date('Y') }} Korea Scholarship Alumni (KOSA) Indonesia.
    All rights reserved.

</footer>

{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script src="{{ asset('frontend/assets/js/jquery-1.12.4.min.js') }}"></script>

<script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       SIDEBAR TOGGLE
    ===================================================== */

    const alumniToggle =
        document.getElementById('alumniSidebarToggle');

    const alumniSidebar =
        document.getElementById('alumniSidebar');


    if (alumniToggle && alumniSidebar) {

        alumniToggle.addEventListener('click', function (event) {

            event.stopPropagation();

            alumniSidebar.classList.toggle('show');

        });


        document.addEventListener('click', function (event) {

            if (window.innerWidth <= 991) {

                if (
                    !alumniSidebar.contains(event.target) &&
                    !alumniToggle.contains(event.target)
                ) {

                    alumniSidebar.classList.remove('show');

                }

            }

        });

    }



    /* =====================================================
       DROPDOWN PROFILE NAVBAR
    ===================================================== */

    const alumniUserDropdown =
        document.getElementById('alumniUserDropdown');

    const alumniDropdownMenu =
        document.getElementById('alumniDropdownMenu');


    if (
        alumniUserDropdown &&
        alumniDropdownMenu
    ) {

        alumniUserDropdown.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                alumniDropdownMenu.classList.toggle('show');


                const chevron =
                    this.querySelector('.alumni-chevron');


                if (chevron) {

                    chevron.classList.toggle('rotate');

                }

            }
        );


        alumniDropdownMenu.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }



    /* =====================================================
       DROPDOWN PROFILE SIDEBAR
    ===================================================== */

    const sidebarProfileBtn =
        document.getElementById(
            'alumniSidebarProfileBtn'
        );

    const sidebarProfileDropdown =
        document.getElementById(
            'alumniSidebarDropdown'
        );

    const sidebarProfileArrow =
        document.getElementById(
            'alumniSidebarProfileArrow'
        );


    if (
        sidebarProfileBtn &&
        sidebarProfileDropdown
    ) {


        /* KLIK PROFILE SIDEBAR */

        sidebarProfileBtn.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                sidebarProfileDropdown.classList.toggle(
                    'show'
                );


                if (sidebarProfileArrow) {

                    sidebarProfileArrow.classList.toggle(
                        'rotate'
                    );

                }

            }
        );



        /* KLIK ISI DROPDOWN */

        sidebarProfileDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );



        /* KLIK DI LUAR DROPDOWN */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !sidebarProfileDropdown.contains(
                        event.target
                    ) &&
                    !sidebarProfileBtn.contains(
                        event.target
                    )
                ) {

                    sidebarProfileDropdown.classList.remove(
                        'show'
                    );


                    if (sidebarProfileArrow) {

                        sidebarProfileArrow.classList.remove(
                            'rotate'
                        );

                    }

                }

            }
        );

    }

});

</script>


@stack('scripts')

</body>

</html>

