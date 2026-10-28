<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Manajemen KOSA Indonesia">

    <title>
        @yield('title', 'Manajemen KOSA Indonesia')
    </title>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
        href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    {{-- CSS Template --}}
    <link rel="stylesheet"
        href="{{ asset('backend/assets/css/style.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="admin-shell">

    {{-- BACKDROP --}}
    <div class="sidebar-backdrop"
        data-sidebar-close>
    </div>


    {{-- =====================================================
        SIDEBAR MANAJEMEN
    ====================================================== --}}

    <aside class="admin-sidebar"
        id="adminSidebar"
        aria-label="Main navigation">

        {{-- BRAND --}}
        <div class="sidebar-header">

            <a class="brand-mark"
                href="{{ route('manajemen.dashboard') }}">

                <span class="brand-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span class="brand-copy">

                    <span class="brand-title">
                        KOSA Indonesia
                    </span>

                    <span class="brand-subtitle">
                        Manajemen
                    </span>

                </span>

            </a>

        </div>


        {{-- =====================================================
            MENU
        ====================================================== --}}

        <nav class="sidebar-nav">

            {{-- DASHBOARD --}}
            <a
                class="nav-link {{ request()->routeIs('manajemen.dashboard') ? 'active' : '' }}"
                href="{{ route('manajemen.dashboard') }}">

                <span class="nav-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            {{-- ALUMNI --}}
            <a
                class="nav-link {{ request()->routeIs('manajemen.alumni.*') ? 'active' : '' }}"
                href="{{ route('manajemen.alumni.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="nav-text">
                    Alumni
                </span>

            </a>


            {{-- TRACER --}}
            <a
                class="nav-link {{ request()->routeIs('manajemen.tracer.*') ? 'active' : '' }}"
                href="{{ route('manajemen.tracer.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-clipboard-data"></i>
                </span>

                <span class="nav-text">
                    Tracer
                </span>

            </a>


            {{-- PROFIL --}}
            <a
                class="nav-link {{ request()->routeIs('manajemen.profile.*') ? 'active' : '' }}"
                href="{{ route('manajemen.profile.index') }}">

                <span class="nav-icon">
                    <i class="bi bi-person-circle"></i>
                </span>

                <span class="nav-text">
                    Profile
                </span>

            </a>

        </nav>


        {{-- USER SIDEBAR --}}
        <div class="sidebar-user">

            @auth

                @if(auth()->user()->foto)

                    <img
                        class="avatar-img avatar-md sidebar-user-avatar"
                        src="{{ asset('storage/' . auth()->user()->foto) }}"
                        alt="{{ auth()->user()->nama }}">

                @else

                    <img
                        class="avatar-img avatar-md sidebar-user-avatar"
                        src="{{ asset('backend/assets/images/avatar/avatar.jpg') }}"
                        alt="{{ auth()->user()->nama }}">

                @endif

                <strong>
                    {{ auth()->user()->nama }}
                </strong>

                <small>
                    Manajemen
                </small>

            @endauth

        </div>


        {{-- FOOTER --}}
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


        {{-- NAVBAR --}}
        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                {{-- SIDEBAR TOGGLE --}}
                <button
                    class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                    aria-label="Toggle sidebar">

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                {{-- SEARCH --}}
                <form
                    class="d-none d-md-flex ms-3 flex-grow-1"
                    role="search">

                    <input
                        class="form-control search-input"
                        type="search"
                        placeholder="Search..."
                        aria-label="Search">

                </form>


                {{-- ACTION --}}
                <div class="navbar-actions ms-auto">

                    {{-- THEME --}}
                    <button
                        class="icon-button theme-toggle"
                        type="button"
                        data-theme-toggle
                        aria-label="Switch color theme">

                        <i
                            class="bi bi-moon-stars"
                            data-theme-icon>
                        </i>

                    </button>


                    {{-- PROFILE --}}
                    <div class="dropdown">

                        <button
                            class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            @if(auth()->user()->foto)

                                <img
                                    class="avatar-img avatar-sm"
                                    src="{{ asset('storage/' . auth()->user()->foto) }}"
                                    alt="{{ auth()->user()->nama }}">

                            @else

                                <img
                                    class="avatar-img avatar-sm"
                                    src="{{ asset('backend/assets/images/avatar/avatar.jpg') }}"
                                    alt="{{ auth()->user()->nama }}">

                            @endif

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('manajemen.profile.index') }}">

                                    Profile

                                </a>
                            </li>


                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('manajemen.profile.edit') }}">

                                    Account settings

                                </a>
                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li>

                                <form
                                    action="{{ route('admin.logout') }}"
                                    method="POST">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item">

                                        Sign out

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        {{-- =====================================================
            CONTENT
        ====================================================== --}}

        @yield('content')

    </div>

</div>


{{-- Bootstrap JS --}}
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

{{-- Template JS --}}
<script src="{{ asset('backend/assets/js/main.js') }}"></script>

</body>

</html>