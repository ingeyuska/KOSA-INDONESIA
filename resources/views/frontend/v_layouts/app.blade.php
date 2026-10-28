<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Kosa Indonesia')</title>

    {{-- CSS Template --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/assets/webfonts/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/css/owl.theme.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-simple-mobilemenu.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    {{-- SELECT2 CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    >

    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    @include('frontend.v_layouts.navbar')

    {{-- Isi setiap halaman --}}
    @yield('content')

    {{-- Footer --}}
    @include('frontend.v_layouts.footer')


    {{-- JavaScript Template --}}

    {{-- jQuery --}}
    <script src="{{ asset('frontend/assets/js/jquery-1.12.4.min.js') }}"></script>

    {{-- SELECT2 JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    </script>

    {{-- Bootstrap --}}
    <script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- Owl Carousel --}}
    <script src="{{ asset('frontend/assets/owlcarousel/js/owl.carousel.min.js') }}"></script>

    {{-- Mobile Menu --}}
    <script src="{{ asset('frontend/assets/js/jquery-simple-mobilemenu.js') }}"></script>

    {{-- Magnific Popup --}}
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>

    {{-- Mixitup --}}
    <script src="{{ asset('frontend/assets/js/jquery.mixitup.js') }}"></script>

    {{-- GSAP --}}
    <script src="{{ asset('frontend/assets/js/gsap.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/ScrollTrigger.min.js') }}"></script>

    {{-- Scroll Top --}}
    <script src="{{ asset('frontend/assets/js/scrolltopcontrol.js') }}"></script>

    {{-- Inview --}}
    <script src="{{ asset('frontend/assets/js/jquery.inview.min.js') }}"></script>

    {{-- WOW --}}
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>

    {{-- Main Scripts --}}
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

    @stack('scripts')

</body>

</html>