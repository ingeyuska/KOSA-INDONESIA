@extends('frontend.v_layouts.app')
@section('title', 'Login - Alumni KOSA')
@section('content')
<!-- START SECTION TOP -->
<!--section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">
            <div class="section-top-title wow fadeInRight"
                data-wow-duration="1s"
                data-wow-delay="0.3s"
                data-wow-offset="0">

                <h1>Login</h1>

                <ul>
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>/ Login</li>
                </ul>

            </div>
        </div>
    </div>
</section-->
<!-- END SECTION TOP --> 



{{-- START LOGIN PORTAL --}}
<section class="kosa-login-section">

    <div class="container">

        <div class="kosa-login-wrapper">

            {{-- BAGIAN KIRI --}}
            <div class="kosa-login-info">

                <div class="kosa-login-logo">
                    <img
                        src="{{ asset('frontend/assets/images/logo.png') }}"
                        alt="KOSA Indonesia"
                    >
                </div>

                <h1>
                    Portal Alumni KOSA
                </h1>

                <p>
                    Selamat datang di Portal Alumni KOSA Indonesia.
                    Terhubung dengan sesama alumni, ikuti berbagai kegiatan,
                    dan bangun jejaring bersama KOSA.
                </p>

                <div class="kosa-login-info-list">

                    <div class="kosa-login-info-item">
                        <span class="kosa-login-icon">
                            <i class="fa-solid fa-users"></i>
                        </span>

                        <div>
                            <strong>Networking Alumni</strong>
                            <small>
                                Terhubung dengan jaringan alumni KOSA.
                            </small>
                        </div>
                    </div>

                    <div class="kosa-login-info-item">
                        <span class="kosa-login-icon">
                            <i class="fa-solid fa-calendar-check"></i>
                        </span>

                        <div>
                            <strong>Join Event</strong>
                            <small>
                                Ikuti kegiatan dan program KOSA.
                            </small>
                        </div>
                    </div>

                    <div class="kosa-login-info-item">
                        <span class="kosa-login-icon">
                            <i class="fa-solid fa-certificate"></i>
                        </span>

                        <div>
                            <strong>Sertifikat</strong>
                            <small>
                                Akses sertifikat kegiatan yang telah diikuti.
                            </small>
                        </div>
                    </div>

                </div>

            </div>


            {{-- BAGIAN KANAN --}}
            <div class="kosa-login-card">

                <div class="kosa-login-header">

                    <h2>
                        Login
                    </h2>

                    <p>
                        Masuk ke akun Portal Alumni KOSA
                    </p>

                </div>


                {{-- PESAN ERROR --}}
                @if ($errors->any())

                    <div class="kosa-login-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>

                        <span>
                            {{ $errors->first() }}
                        </span>
                    </div>

                @endif


                <form
                    action="{{ route('login.proses') }}"
                    method="POST"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div class="kosa-form-group">

                        <label for="email">
                            Email
                        </label>

                        <div class="kosa-input-wrapper">

                            <i class="fa-regular fa-envelope"></i>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email"
                                required
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="kosa-form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="kosa-input-wrapper">

                            <i class="fa-solid fa-lock"></i>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                            >

                            <button
                                type="button"
                                class="kosa-password-toggle"
                                onclick="togglePassword()"
                                aria-label="Tampilkan password"
                            >
                                <i
                                    id="passwordIcon"
                                    class="fa-regular fa-eye"
                                ></i>
                            </button>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="kosa-login-button"
                    >
                        <span>Masuk</span>

                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                </form>


                {{-- REGISTER --}}
                <div class="kosa-login-register">

                    <span>
                        Belum memiliki akun?
                    </span>

                    <a href="{{ route('register') }}">
                        Daftar sebagai Member
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- END LOGIN PORTAL --}}

<style>

/* =========================================================
   LOGIN PORTAL KOSA
========================================================= */

.kosa-login-section {
    width: 100%;
    min-height: calc(100vh - 100px);

    padding: 70px 20px;

    display: flex;
    align-items: center;

    background: #f5f8fc;

    box-sizing: border-box;
}


/* =========================================================
   WRAPPER
========================================================= */

.kosa-login-wrapper {
    width: 100%;
    max-width: 1050px;

    margin: 0 auto;

    display: grid;
    grid-template-columns: minmax(0, 1fr) 430px;

    background: #ffffff;

    border-radius: 22px;

    overflow: hidden;

    box-shadow:
        0 15px 45px rgba(15, 42, 77, 0.10);

    box-sizing: border-box;
}


/* =========================================================
   LEFT
========================================================= */

.kosa-login-info {
    padding: 60px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    background: #0d2b52;
    color: #ffffff;

    box-sizing: border-box;
}


.kosa-login-logo {
    margin-bottom: 28px;
}


.kosa-login-logo img {
    display: block;

    max-width: 150px;
    width: auto;
    height: auto;
}


.kosa-login-info h1 {
    margin: 0 0 18px;

    font-size: 38px;
    line-height: 1.2;

    font-weight: 700;

    color: #ffffff;
}


.kosa-login-info > p {
    max-width: 470px;

    margin: 0 0 35px;

    color: rgba(255,255,255,0.80);

    line-height: 1.8;
}


/* =========================================================
   INFO LIST
========================================================= */

.kosa-login-info-list {
    display: flex;
    flex-direction: column;

    gap: 22px;
}


.kosa-login-info-item {
    display: flex;
    align-items: center;

    gap: 15px;

    min-width: 0;
}


.kosa-login-icon {
    width: 45px;
    height: 45px;

    min-width: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: rgba(255,255,255,0.12);

    color: #ffffff;
}


.kosa-login-info-item strong {
    display: block;

    margin-bottom: 3px;

    color: #ffffff;

    font-size: 15px;
}


.kosa-login-info-item small {
    display: block;

    color: rgba(255,255,255,0.65);

    font-size: 13px;

    line-height: 1.5;
}


/* =========================================================
   RIGHT CARD
========================================================= */

.kosa-login-card {
    width: 100%;

    padding: 55px 45px;

    background: #ffffff;

    box-sizing: border-box;
}


/* =========================================================
   HEADER
========================================================= */

.kosa-login-header {
    margin-bottom: 30px;
}


.kosa-login-header h2 {
    margin: 0 0 7px;

    font-size: 30px;

    line-height: 1.3;

    font-weight: 700;

    color: #172b4d;
}


.kosa-login-header p {
    margin: 0;

    color: #7b8794;

    font-size: 14px;

    line-height: 1.6;
}


/* =========================================================
   ALERT
========================================================= */

.kosa-login-alert {
    display: flex;
    align-items: flex-start;

    gap: 10px;

    padding: 12px 14px;

    margin-bottom: 20px;

    border-radius: 8px;

    background: #fff1f1;

    color: #c0392b;

    font-size: 13px;

    line-height: 1.5;

    box-sizing: border-box;
}


/* =========================================================
   FORM
========================================================= */

.kosa-form-group {
    width: 100%;

    margin-bottom: 22px;
}


.kosa-form-group label {
    display: block;

    margin: 0 0 8px;

    color: #26384f;

    font-size: 14px;

    font-weight: 600;
}


/* =========================================================
   INPUT
========================================================= */

.kosa-input-wrapper {
    position: relative;

    width: 100%;

    display: flex;
    align-items: center;

    box-sizing: border-box;
}


.kosa-input-wrapper > i:first-child {
    position: absolute;

    left: 15px;

    color: #9aa7b8;

    font-size: 15px;

    pointer-events: none;

    z-index: 2;
}


.kosa-input-wrapper input {
    width: 100%;
    max-width: 100%;

    height: 50px;

    padding: 0 45px;

    border: 1px solid #dfe5ec;

    border-radius: 9px;

    background: #ffffff;

    color: #26384f;

    outline: none;

    transition: 0.2s;

    box-sizing: border-box;

    font-size: 14px;
}


.kosa-input-wrapper input:focus {
    border-color: #0d2b52;

    box-shadow:
        0 0 0 3px rgba(13,43,82,0.08);
}


.kosa-input-wrapper input::placeholder {
    color: #aab4c0;
}


/* =========================================================
   PASSWORD TOGGLE
========================================================= */

.kosa-password-toggle {
    position: absolute;

    right: 12px;

    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: none;

    background: transparent;

    color: #9aa7b8;

    cursor: pointer;

    padding: 5px;

    z-index: 3;
}


/* =========================================================
   LOGIN BUTTON
========================================================= */

.kosa-login-button {
    width: 100%;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 10px;

    border: none;

    border-radius: 9px;

    background: #0d2b52;

    color: #ffffff;

    font-size: 15px;

    font-weight: 600;

    cursor: pointer;

    transition: 0.25s;

    box-sizing: border-box;
}


.kosa-login-button:hover {
    background: #163f70;

    transform: translateY(-1px);
}


/* =========================================================
   REGISTER
========================================================= */

.kosa-login-register {
    width: 100%;

    margin-top: 25px;

    padding-top: 22px;

    border-top: 1px solid #edf0f4;

    text-align: center;

    font-size: 13px;

    line-height: 1.7;

    color: #7b8794;

    box-sizing: border-box;
}


.kosa-login-register a {
    margin-left: 4px;

    color: #0d2b52;

    font-weight: 600;

    text-decoration: none;

    white-space: normal;
}


.kosa-login-register a:hover {
    text-decoration: underline;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .kosa-login-section {
        min-height: auto;

        padding: 50px 20px;

        display: block;
    }


    .kosa-login-wrapper {
        grid-template-columns: 1fr;

        max-width: 700px;
    }


    .kosa-login-info {
        padding: 45px 40px;
    }


    .kosa-login-card {
        padding: 45px 40px;
    }

}


/* =========================================================
   MOBILE - IPHONE & ANDROID
========================================================= */

@media (max-width: 575px) {

    .kosa-login-section {
        min-height: auto;

        width: 100%;

        padding: 25px 12px 40px;

        display: block;
    }


    .kosa-login-wrapper {
        width: 100%;

        max-width: 100%;

        margin: 0;

        display: block;

        border-radius: 16px;

        overflow: hidden;
    }


    /* LEFT */

    .kosa-login-info {
        width: 100%;

        padding: 30px 22px;

        box-sizing: border-box;
    }


    .kosa-login-logo {
        margin-bottom: 20px;
    }


    .kosa-login-logo img {
        max-width: 125px;
    }


    .kosa-login-info h1 {
        margin-bottom: 14px;

        font-size: 27px;

        line-height: 1.25;
    }


    .kosa-login-info > p {
        margin-bottom: 25px;

        font-size: 13px;

        line-height: 1.7;
    }


    .kosa-login-info-list {
        gap: 17px;
    }


    .kosa-login-info-item {
        align-items: flex-start;

        gap: 12px;
    }


    .kosa-login-icon {
        width: 40px;
        height: 40px;

        min-width: 40px;

        border-radius: 10px;
    }


    .kosa-login-info-item strong {
        font-size: 14px;
    }


    .kosa-login-info-item small {
        font-size: 12px;

        line-height: 1.5;
    }


    /* RIGHT */

    .kosa-login-card {
        width: 100%;

        padding: 30px 22px;

        box-sizing: border-box;
    }


    .kosa-login-header {
        margin-bottom: 25px;
    }


    .kosa-login-header h2 {
        font-size: 26px;
    }


    .kosa-login-header p {
        font-size: 13px;
    }


    .kosa-form-group {
        margin-bottom: 18px;
    }


    .kosa-form-group label {
        font-size: 13px;
    }


    .kosa-input-wrapper input {
        height: 48px;

        font-size: 14px;

        padding-left: 42px;

        padding-right: 42px;
    }


    .kosa-login-button {
        height: 48px;

        font-size: 14px;
    }


    /* REGISTER TETAP MUNCUL DI HP */

    .kosa-login-register {
        display: block !important;

        margin-top: 22px;

        padding-top: 18px;

        font-size: 12px;

        line-height: 1.8;
    }


    .kosa-login-register a {
        display: inline;

        margin-left: 3px;
    }

}


/* =========================================================
   VERY SMALL PHONE
   iPhone SE / ANDROID SMALL SCREEN
========================================================= */

@media (max-width: 375px) {

    .kosa-login-section {
        padding-left: 8px;
        padding-right: 8px;
    }


    .kosa-login-info {
        padding: 27px 18px;
    }


    .kosa-login-card {
        padding: 27px 18px;
    }


    .kosa-login-info h1 {
        font-size: 24px;
    }


    .kosa-login-header h2 {
        font-size: 24px;
    }


    .kosa-login-register {
        font-size: 11.5px;
    }

}
/* =========================================================
   FIX TOMBOL MASUK DI MOBILE
========================================================= */

.kosa-login-card .kosa-login-button {
    display: flex !important;

    width: 100%;
    height: 50px;

    align-items: center;
    justify-content: center;

    gap: 10px;

    border: none;
    border-radius: 9px;

    background: #0d2b52 !important;
    color: #ffffff !important;

    font-size: 15px;
    font-weight: 600;

    visibility: visible !important;
    opacity: 1 !important;
}


@media (max-width: 575px) {

    .kosa-login-card .kosa-login-button {
        display: flex !important;

        width: 100%;
        height: 48px;

        font-size: 14px;

        visibility: visible !important;
        opacity: 1 !important;
    }

}

</style>



<script>

function togglePassword() {

    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('passwordIcon');


    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');

    }

}

</script>

@endsection