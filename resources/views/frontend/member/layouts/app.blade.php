<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Portal Member - KOSA Indonesia')
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

        .member-navbar {
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

        .member-brand {
            width: 240px;
            height: 76px;

            display: flex;
            align-items: center;

            padding: 0 15px;

            background: #064a76;
        }

        .member-brand img {
            width: 35px;
            height: 35px;

            object-fit: contain;

            margin-right: 9px;
        }

        .member-brand span {
            color: #fff;

            font-size: 18px;

            font-weight: 700;
        }

        .member-toggle {
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

        .member-toggle:hover {
            color: #fff;
        }

        .member-user {
            margin-left: auto;

            height: 76px;

            display: flex;
            align-items: center;

            padding-right: 25px;

            color: #fff;
        }

        .member-user-avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            overflow: hidden;

            margin-right: 9px;

            background: #087fc1;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .member-user-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .member-user-avatar i {
            color: #fff;
        }

        .member-user-name {
            font-size: 13px;

            color: rgba(255,255,255,.85);

            font-weight: 500;
        }

        .member-user > i {
            margin-left: 7px;

            font-size: 10px;

            color: rgba(255,255,255,.65);
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .member-sidebar {
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

        .member-sidebar-profile {
            padding: 27px 19px 24px;

            border-bottom: 1px solid #edf0f3;
        }

        .member-profile-top {
            display: flex;
            align-items: center;
        }

        .member-sidebar-avatar {
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

        .member-sidebar-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }

        .member-sidebar-id {
            margin-left: 10px;

            flex: 1;

            font-size: 13px;

            color: #8795a7;
        }

        .member-sidebar-arrow {
            color: #a4afbc;

            font-size: 10px;
        }

        .member-online {
            margin-top: 6px;

            color: #14b88a;

            font-size: 10px;

            font-weight: 500;
        }

        .member-sidebar-name {
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

        .member-menu-title {
            padding: 24px 20px 9px;

            color: #727e8d;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;
        }

        .member-menu {
            list-style: none;

            margin: 0;

            padding: 0 9px;
        }

        .member-menu li {
            margin-bottom: 3px;
        }

        .member-menu a {
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

        .member-menu a i {
            width: 24px;

            margin-right: 10px;

            text-align: center;

            font-size: 15px;
        }

        .member-menu a:hover {
            background: #eef7fc;

            color: #0788c5;
        }

        .member-menu a.active {
            background: #eef7fc;

            color: #0788c5;

            font-weight: 600;

            border-left: 3px solid #0788c5;

            border-radius: 0 7px 7px 0;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .member-main {
            margin-left: 240px;

            padding-top: 76px;

            min-height: 100vh;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .member-page-header {
            min-height: 112px;

            padding: 25px 28px 22px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            background: #fff;

            border-bottom: 1px solid #edf0f3;
        }

        .member-page-title {
            margin: 0;

            color: #073b63;

            font-size: 25px;

            font-weight: 800;
        }

        .member-page-subtitle {
            margin-top: 4px;

            color: #8997a7;

            font-size: 12px;
        }

        .member-breadcrumb {
            color: #8491a5;

            font-size: 11px;
        }

        .member-breadcrumb .active {
            color: #0788c5;

            font-weight: 600;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .member-content {
            padding: 23px 28px 40px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .member-footer {
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

            .member-sidebar {
                transform: translateX(-100%);
            }

            .member-sidebar.show {
                transform: translateX(0);
            }

            .member-main {
                margin-left: 0;
            }

            .member-footer {
                margin-left: 0;
            }

            .member-user-name {
                display: none;
            }
        }

        @media(max-width: 576px) {

            .member-brand {
                width: 180px;
            }

            .member-brand span {
                font-size: 14px;
            }

            .member-page-header {
                padding: 20px;
            }

            .member-content {
                padding: 18px;
            }

            .member-breadcrumb {
                display: none;
            }
        }
      /* =====================================================
        PROFILE DROPDOWN
        ===================================================== */

.member-sidebar-profile {
    position: relative;
}

.member-sidebar-profile-btn {
    width: 100%;
    padding: 0;

    border: none;
    background: transparent;

    font-family: 'Lexend', sans-serif;
    text-align: left;

    cursor: pointer;
}

.member-sidebar-profile-btn:focus {
    outline: none;
}


.member-sidebar-dropdown {
    display: none;

    margin-top: 14px;
    padding: 6px;

    background: #fff;

    border: 1px solid #e5e9ed;
    border-radius: 8px;

    box-shadow: 0 6px 20px rgba(0,0,0,.10);

    animation: memberSidebarDropdown .15s ease;
}

.member-sidebar-dropdown.show {
    display: block;
}


@keyframes memberSidebarDropdown {

    from {
        opacity: 0;
        transform: translateY(-5px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


.member-sidebar-dropdown a,
.member-sidebar-dropdown form button {

    width: 100%;

    min-height: 40px;

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 9px 11px;

    border: none;
    background: transparent;

    color: #536273;

    font-family: 'Lexend', sans-serif;
    font-size: 12px;
    font-weight: 500;

    text-decoration: none;

    border-radius: 6px;

    cursor: pointer;

    text-align: left;
}


.member-sidebar-dropdown a:hover,
.member-sidebar-dropdown form button:hover {

    background: #eef7fc;

    color: #0788c5;

}


.member-sidebar-dropdown i {

    width: 18px;

    text-align: center;

    font-size: 13px;
}


.member-sidebar-dropdown form {
    margin: 0;
}


.member-sidebar-profile-btn .member-sidebar-arrow {

    transition: transform .2s ease;

}


.member-sidebar-profile-btn .member-sidebar-arrow.rotate {

    transform: rotate(90deg);

}
    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR ALUMNI
========================================================= --}}

<nav class="member-navbar">

    <div class="member-brand">

        <img
            src="{{ asset('frontend/assets/images/logo/logo1.png') }}"
            alt="KOSA">

        <span>
            Member KOSA
        </span>

    </div>


    <button
        type="button"
        class="member-toggle"
        id="memberSidebarToggle">

        <i class="fa-solid fa-bars"></i>

    </button>


    <div class="member-user">

        <div class="member-user-avatar">

            @if(Auth::user()->foto ?? false)

                <img
                    src="{{ asset('storage/' . Auth::user()->foto) }}"
                    alt="Foto Member">

            @else

                <i class="fa-solid fa-user"></i>

            @endif

        </div>

        <span class="member-user-name">

            {{ Auth::user()->nama ?? 'Member' }}

        </span>

        <i class="fa-solid fa-chevron-down"></i>

    </div>

</nav>


{{-- =========================================================
     SIDEBAR
========================================================= --}}

<aside
    class="member-sidebar"
    id="memberSidebar">


    {{-- PROFILE --}}

   <div class="member-sidebar-profile">

    <button
        type="button"
        class="member-sidebar-profile-btn"
        id="memberSidebarProfileBtn"
    >

        <div class="member-profile-top">

            <div class="member-sidebar-avatar">

                @if(Auth::user()->foto ?? false)

                    <img
                        src="{{ asset('storage/' . Auth::user()->foto) }}"
                        alt="Foto">

                @else

                    <i class="fa-solid fa-user"></i>

                @endif

            </div>

            <div class="member-sidebar-id">

                {{ Auth::user()->member_id ?? 'G-XXXXX' }}

            </div>

            <i
                class="fa-solid fa-chevron-right member-sidebar-arrow"
                id="memberSidebarProfileArrow"
            ></i>

        </div>


        <div class="member-online">

            <i
                class="fa-solid fa-circle"
                style="font-size:6px;"
            ></i>

            online

        </div>


        <div class="member-sidebar-name">

            {{ Auth::user()->nama ?? 'Member' }}

        </div>

    </button>


    {{-- PROFILE DROPDOWN --}}

    <div
        class="member-sidebar-dropdown"
        id="memberSidebarDropdown"
    >

        <a href="{{ route('member.profile') }}">

            <i class="fa-solid fa-user"></i>

            <span>Profil</span>

        </a>


        <a href="{{ route('member.password.edit') }}">

            <i class="fa-solid fa-lock"></i>

            <span>Ubah Password</span>

        </a>


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

    <div class="member-menu-title">

        --- Menu Member ---

    </div>


    <ul class="member-menu">

        <li>

            <a href="{{ route('member.dashboard') }}"
               class="{{ request()->routeIs('dashboard.member') ? 'active' : '' }}">

                <i class="fa-solid fa-house"></i>

                Home

            </a>

        </li>


        <li>

            <a href="{{ route('member.profile') }}"
               class="{{ request()->routeIs('profile') ? 'active' : '' }}">

                <i class="fa-solid fa-user"></i>

                Data Diri

            </a>

        </li>


        <li>

            <a href="{{ route('member.event') }}">

                <i class="fa-solid fa-calendar-days"></i>

                 Event

            </a>

        </li>


        <li>

            <li>

    <li>
    <a href="{{ route('member.sertifikat') }}"
       class="{{ request()->routeIs('member.sertifikat*') ? 'active' : '' }}">

        <i class="fa-solid fa-certificate"></i>

        Sertifikat

    </a>
</li>

</li>

        </li>


        {{-- <li>

            <a href="{{ route('statistik') }}">

                <i class="fa-solid fa-users"></i>

                Networking Member

            </a>

        </li> --}}

    </ul>


    {{-- MENU LAINNYA --}}

    {{-- <div class="member-menu-title">

        --- Menu Lainnya ---

    </div>


    <ul class="member-menu">

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

<main class="member-main">


    <div class="member-page-header">

        <div>

            <h1 class="member-page-title">

                @yield('page-title', 'Dashboard Member')

            </h1>

            <div class="member-page-subtitle">

                @yield(
                    'page-subtitle',
                    'Kelola profil member dan kegiatan KOSA Indonesia dalam satu tempat.'
                )

            </div>

        </div>


        <div class="member-breadcrumb">

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


    <div class="member-content">

        @yield('content')

    </div>

</main>


{{-- FOOTER --}}

<footer class="member-footer">

    © {{ date('Y') }} Korea Scholarship Member (KOSA) Indonesia.
    All rights reserved.

</footer>

<script src="{{ asset('frontend/assets/js/jquery-1.12.4.min.js') }}"></script>

<script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       SIDEBAR MOBILE
    ===================================================== */

    const memberToggle =
        document.getElementById('memberSidebarToggle');

    const memberSidebar =
        document.getElementById('memberSidebar');


    if (memberToggle && memberSidebar) {

        memberToggle.addEventListener('click', function (event) {

            event.stopPropagation();

            memberSidebar.classList.toggle('show');

        });


        document.addEventListener('click', function (event) {

            if (window.innerWidth <= 991) {

                if (
                    !memberSidebar.contains(event.target) &&
                    !memberToggle.contains(event.target)
                ) {

                    memberSidebar.classList.remove('show');

                }

            }

        });

    }


    /* =====================================================
       PROFILE DROPDOWN
    ===================================================== */

    const memberProfileBtn =
        document.getElementById('memberSidebarProfileBtn');

    const memberProfileDropdown =
        document.getElementById('memberSidebarDropdown');

    const memberProfileArrow =
        document.getElementById('memberSidebarProfileArrow');


    if (
        memberProfileBtn &&
        memberProfileDropdown
    ) {

        memberProfileBtn.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();


                const isOpen =
                    memberProfileDropdown.classList.contains('show');


                /* Tutup dropdown */

                memberProfileDropdown.classList.toggle(
                    'show',
                    !isOpen
                );


                /* Putar arrow */

                if (memberProfileArrow) {

                    memberProfileArrow.classList.toggle(
                        'rotate',
                        !isOpen
                    );

                }

            }
        );


        /* Klik di dalam dropdown */

        memberProfileDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );


        /* Klik di luar dropdown */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !memberProfileDropdown.contains(event.target) &&
                    !memberProfileBtn.contains(event.target)
                ) {

                    memberProfileDropdown.classList.remove('show');


                    if (memberProfileArrow) {

                        memberProfileArrow.classList.remove('rotate');

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