    {{-- TOP BAR --}}
<header class='kosa-header'>
    <div class="top-bar">

    <div class="container">

        <div class="top-bar-left">

            {{-- TELEPON --}}
            <span>
                <i class="fa-solid fa-phone"></i>
                {{ $pengaturan?->telepon ?: '(+62) 812-1231-3840' }}
            </span>

            {{-- EMAIL --}}
            <span>
                <i class="fa-solid fa-envelope"></i>
                {{ $pengaturan?->email ?: 'inggg@gmail.com' }}
            </span>

        </div>

    </div>


    </div>


    {{-- NAVBAR --}}
    <div id="navigation" class="site-navigation">

        <div class="container">

            <div class="row align-items-center">

                {{-- LOGO --}}
                <div class="col-lg-2 col-md-3 col-6">

                    <div class="site-logo">

                        <a href="{{ route('home') }}">
                            <img
                                src="{{ asset('frontend/assets/images/logo/logo1.png') }}"
                                alt="KOSA Indonesia">
                        </a>

                    </div>

                </div>


                {{-- MENU DESKTOP --}}
                <div class="col-lg-7 col-md-6 d-none d-lg-block">

                    <nav id="main-menu">

                        <ul>

                            <li>
                                <a href="{{ route('home') }}">
                                    Beranda
                                </a>
                            </li>


                            {{-- TENTANG --}}
                            <li class="dropdown">

                                <a href="javascript:void(0);" class="dropdown-toggle">
                                    Tentang KOSA
                                </a>

                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="{{ route('tentang') }}">
                                            Profil KOSA
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('visi-misi') }}">
                                            Visi & Misi
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('pengurus') }}">
                                            Pengurus
                                        </a>
                                    </li>

                                </ul>

                            </li>


                            {{-- ALUMNI --}}
                            <li class="dropdown">

                                <a href="javascript:void(0);" class="dropdown-toggle">
                                    Alumni
                                </a>

                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="{{ route('cerita-alumni') }}">
                                            Cerita Alumni
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('statistik') }}">
                                            Statistik Alumni
                                        </a>
                                    </li>
                                </ul>

                            </li>


                            {{-- BERITA --}}
                            <li>
                                <a href="{{ route('berita') }}">
                                    Berita
                                </a>
                            </li>


                            {{-- EVENT --}}
                            <li>
                                <a href="{{ route('event') }}">
                                    Event
                                </a>
                            </li>


                            {{-- GALERI --}}
                            <li class="dropdown">

                                <a href="javascript:void(0);" class="dropdown-toggle">
                                    Galeri
                                </a>

                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="{{ route('galeri') }}">
                                            Foto Kegiatan
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('video') }}">
                                            Video Kegiatan
                                        </a>
                                    </li>

                                </ul>

                            </li>


                            {{-- KONTAK --}}
                            <li>
                                <a href="{{ route('kontak') }}">
                                    Kontak
                                </a>
                            </li>

                        </ul>

                    </nav>

                </div>


                {{-- BAGIAN KANAN --}}
                <div class="col-lg-3 col-md-3 col-6">

                    <div class="kosa-navbar-right">

                        {{-- SEARCH --}}
                        <button
                            type="button"
                            class="kosa-search-button"
                            aria-label="Search">

                            <i class="fa-solid fa-magnifying-glass"></i>

                        </button>


                        {{-- LOGIN DESKTOP --}}
                        <a href="{{ route('login') }}"
                        class="kosa-login-button">

                            Login KOSAID

                        </a>


                        {{-- DAFTAR DESKTOP --}}
                        <a href="{{ route('register') }}"
                        class="kosa-register-button">

                            Daftar Sekarang

                        </a>


                        {{-- HAMBURGER MOBILE --}}
                        <button
                            type="button"
                            class="kosa-mobile-menu-button"
                            id="kosaMobileMenuButton"
                            aria-label="Buka Menu">

                            <i class="fa-solid fa-bars"></i>

                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            MOBILE MENU
        ========================= --}}

        <div class="kosa-mobile-menu" id="kosaMobileMenu">

            <div class="kosa-mobile-menu-inner">

                {{-- CLOSE --}}
                <div class="kosa-mobile-menu-header">

                    <span>
                        Menu
                    </span>

                    <button
                        type="button"
                        id="kosaMobileMenuClose"
                        aria-label="Tutup Menu">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                {{-- MENU --}}
                <nav class="kosa-mobile-nav">

                    <ul>

                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fa-solid fa-house"></i>
                                Beranda
                            </a>
                        </li>


                        {{-- TENTANG --}}
                        <li class="mobile-dropdown">

                            <button type="button">

                                <span>
                                    <i class="fa-solid fa-circle-info"></i>
                                    Tentang KOSA
                                </span>

                                <i class="fa-solid fa-chevron-down"></i>

                            </button>

                            <ul>

                                <li>
                                    <a href="{{ route('tentang') }}">
                                        Profil KOSA
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('visi-misi') }}">
                                        Visi & Misi
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('pengurus') }}">
                                        Pengurus
                                    </a>
                                </li>

                            </ul>

                        </li>


                        {{-- ALUMNI --}}
                        <li class="mobile-dropdown">

                            <button type="button">

                                <span>
                                    <i class="fa-solid fa-users"></i>
                                    Alumni
                                </span>

                                <i class="fa-solid fa-chevron-down"></i>

                            </button>

                            <ul>

                                <li>
                                    <a href="{{ route('cerita-alumni') }}">
                                        Cerita Alumni
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('statistik') }}">
                                        Statistik Alumni
                                    </a>
                                </li>

                            </ul>

                        </li>


                        {{-- BERITA --}}
                        <li>
                            <a href="{{ route('berita') }}">
                                <i class="fa-solid fa-newspaper"></i>
                                Berita
                            </a>
                        </li>


                        {{-- EVENT --}}
                        <li>
                            <a href="{{ route('event') }}">
                                <i class="fa-solid fa-calendar-days"></i>
                                Event
                            </a>
                        </li>


                        {{-- GALERI --}}
                        <li class="mobile-dropdown">

                            <button type="button">

                                <span>
                                    <i class="fa-solid fa-images"></i>
                                    Galeri
                                </span>

                                <i class="fa-solid fa-chevron-down"></i>

                            </button>

                            <ul>

                                <li>
                                    <a href="{{ route('galeri') }}">
                                        Foto Kegiatan
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('video') }}">
                                        Video Kegiatan
                                    </a>
                                </li>

                            </ul>

                        </li>


                        {{-- KONTAK --}}
                        <li>
                            <a href="{{ route('kontak') }}">
                                <i class="fa-solid fa-envelope"></i>
                                Kontak
                            </a>
                        </li>

                    </ul>


                    {{-- LOGIN & DAFTAR --}}
                    <div class="kosa-mobile-auth">

                        <a href="{{ route('login') }}"
                        class="kosa-mobile-login">

                            <i class="fa-solid fa-right-to-bracket"></i>
                            Login KOSAID

                        </a>


                        <a href="{{ route('register') }}"
                        class="kosa-mobile-register">

                            <i class="fa-solid fa-user-plus"></i>
                            Daftar Sekarang

                        </a>

                    </div>

                </nav>

            </div>

        </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const menuButton = document.getElementById('kosaMobileMenuButton');
        const menu = document.getElementById('kosaMobileMenu');
        const closeButton = document.getElementById('kosaMobileMenuClose');


        /* =====================================================
        BUKA MOBILE MENU
        ===================================================== */

        if (menuButton && menu) {

            menuButton.addEventListener('click', function () {

                menu.classList.add('active');

                document.body.style.overflow = 'hidden';

            });

        }


        /* =====================================================
        TUTUP MOBILE MENU
        ===================================================== */

        if (closeButton && menu) {

            closeButton.addEventListener('click', function () {

                menu.classList.remove('active');

                document.body.style.overflow = '';

                // Tutup semua submenu
                document.querySelectorAll('.mobile-dropdown').forEach(function (dropdown) {
                    dropdown.classList.remove('active');
                });

            });

        }


        /* =====================================================
        DROPDOWN MOBILE
        TENTANG / ALUMNI / GALERI
        ===================================================== */

        const dropdownButtons =
            document.querySelectorAll('.kosa-mobile-nav .mobile-dropdown > button');


        dropdownButtons.forEach(function (button) {

            button.addEventListener('click', function (e) {

                e.preventDefault();
                e.stopPropagation();

                const parent = this.closest('.mobile-dropdown');


                /* Tutup dropdown lain */

                document.querySelectorAll(
                    '.kosa-mobile-nav .mobile-dropdown'
                ).forEach(function (dropdown) {

                    if (dropdown !== parent) {
                        dropdown.classList.remove('active');
                    }

                });


                /* Toggle dropdown yang diklik */

                parent.classList.toggle('active');

            });

        });


        /* =====================================================
        KLIK LINK SUBMENU
        TUTUP MENU MOBILE
        ===================================================== */

        const mobileLinks =
            document.querySelectorAll('.kosa-mobile-nav a');


        mobileLinks.forEach(function (link) {

            link.addEventListener('click', function () {

                if (menu) {
                    menu.classList.remove('active');
                }

                document.body.style.overflow = '';

            });

        });


        /* =====================================================
        KLIK DI LUAR MENU
        ===================================================== */

        document.addEventListener('click', function (e) {

            if (
                menu &&
                menu.classList.contains('active') &&
                !menu.contains(e.target) &&
                !menuButton.contains(e.target)
            ) {

                menu.classList.remove('active');

                document.body.style.overflow = '';

            }

        });

    });
    </script>
    </div>
</header>