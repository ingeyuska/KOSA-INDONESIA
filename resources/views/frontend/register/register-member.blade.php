@extends('frontend.v_layouts.app')

@section('title', 'Registrasi Member - KOSA Indonesia')

@section('content')

<style>
    /* =========================================================
       REGISTER MEMBER
    ========================================================= */

    .register-wrapper {
        min-height: 85vh;
        padding: 70px 0;
        background: #f5f8fc;
    }

    .register-card {
        overflow: hidden;
        border: none;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .register-header {
        padding: 35px 40px;

        color: #ffffff;

        background: linear-gradient(
            135deg,
            #0b2c5f,
            #164b8c
        );
    }

    .register-header .icon {
        width: 55px;
        height: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 18px;

        border-radius: 50%;

        background: rgba(255, 255, 255, 0.15);

        font-size: 24px;
    }

    .register-header h2 {
        margin-bottom: 8px;

        color: #ffffff;

        font-weight: 700;
    }

    .register-header p {
        margin: 0;

        color: #ffffff;

        opacity: 0.85;
    }


    /* =========================================================
       BODY
    ========================================================= */

    .register-body {
        padding: 40px;
    }


    /* =========================================================
       SECTION TITLE
    ========================================================= */

    .section-title {
        margin-bottom: 22px;
        padding-bottom: 12px;

        border-bottom: 2px solid #eef2f7;

        color: #0b2c5f;

        font-size: 18px;
        font-weight: 700;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-label {
        margin-bottom: 8px;

        color: #344054;

        font-weight: 600;
    }

    .form-control,
    .form-select {
        min-height: 46px;

        padding: 10px 14px;

        border: 1px solid #d9e0e8;
        border-radius: 9px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #164b8c;

        box-shadow:
            0 0 0 3px rgba(22, 75, 140, 0.10);
    }

    textarea.form-control {
        min-height: 100px;

        resize: vertical;
    }


    /* =========================================================
       CHECKBOX
    ========================================================= */

    .form-check {
        padding-left: 1.8rem;
    }

    .form-check-input {
        margin-left: -1.8rem;

        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #0b2c5f;
        border-color: #0b2c5f;
    }

    .form-check-label {
        cursor: pointer;

        color: #344054;

        line-height: 1.5;
    }


    /* =========================================================
       INFORMATION BOX
    ========================================================= */

    .info-box {
        margin-bottom: 30px;
        padding: 14px 16px;

        border-left: 4px solid #164b8c;
        border-radius: 8px;

        background: #f0f6ff;

        color: #475467;

        font-size: 14px;
        line-height: 1.6;
    }


    /* =========================================================
       REQUIRED
    ========================================================= */

    .required {
        color: #dc3545;
    }


    /* =========================================================
       REGISTER BUTTON
    ========================================================= */

    .register-button {
        width: 100%;
        min-height: 50px;

        border: none;
        border-radius: 9px;

        background: #0b2c5f;
        color: #ffffff;

        font-size: 16px;
        font-weight: 600;

        transition: 0.2s;
    }

    .register-button:hover {
        background: #164b8c;
        color: #ffffff;

        transform: translateY(-1px);
    }


    /* =========================================================
       LOGIN TEXT
    ========================================================= */

    .login-text {
        margin-top: 22px;

        text-align: center;

        color: #667085;

        font-size: 14px;
    }

    .login-text a {
        color: #0b2c5f;

        font-weight: 600;
        text-decoration: none;
    }

    .login-text a:hover {
        text-decoration: underline;
    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 768px) {

        .register-wrapper {
            min-height: auto;

            padding: 35px 15px;
        }

        .register-header,
        .register-body {
            padding: 25px;
        }

        .register-header h2 {
            font-size: 24px;
        }

        .register-header p {
            font-size: 14px;

            line-height: 1.6;
        }

        .section-title {
            font-size: 17px;
        }
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 575px) {

        .register-wrapper {
            padding: 25px 10px;
        }

        .register-card {
            border-radius: 14px;
        }

        .register-header,
        .register-body {
            padding: 22px 18px;
        }

        .register-header .icon {
            width: 48px;
            height: 48px;

            margin-bottom: 15px;

            font-size: 20px;
        }

        .register-header h2 {
            font-size: 22px;
        }

        .register-header p {
            font-size: 13px;
        }

        .register-body {
            font-size: 14px;
        }

        .form-label {
            font-size: 13px;
        }

        .form-control,
        .form-select {
            min-height: 45px;

            font-size: 14px;
        }

        .info-box {
            font-size: 13px;
        }

        .register-button {
            min-height: 48px;

            font-size: 14px;
        }

        .login-text {
            font-size: 13px;
        }

        .form-check-label {
            font-size: 13px;
        }
    }
</style>


<div class="register-wrapper">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8 col-xl-7">

                <div class="register-card">

                    {{-- =====================================================
                        HEADER
                    ====================================================== --}}

                    <div class="register-header">

                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>

                        <h2>
                            Registrasi Member
                        </h2>

                        <p>
                            Bergabung dengan komunitas KOSA Indonesia
                            sebagai member.
                        </p>

                    </div>


                    {{-- =====================================================
                        BODY
                    ====================================================== --}}

                    <div class="register-body">

                        {{-- ERROR --}}

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Registrasi belum berhasil.
                                </strong>

                                <ul class="mb-0 mt-2">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        {{-- INFORMATION --}}

                        <div class="info-box">

                            <strong>Informasi</strong>
                            <br>

                            Setelah melakukan registrasi, Anda akan menerima
                            email konfirmasi. Silakan klik link konfirmasi
                            pada email tersebut untuk mengaktifkan akun Member
                            KOSA Indonesia.

                        </div>


                        {{-- =================================================
                            FORM
                        ================================================== --}}

                        <form
                            action="{{ route('register.member.store') }}"
                            method="POST"
                        >

                            @csrf


                            {{-- =================================================
                                DATA AKUN
                            ================================================== --}}

                            <div class="section-title">

                                <i class="fa fa-user-circle me-2"></i>

                                Data Akun

                            </div>


                            {{-- NAMA --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    Nama Lengkap

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    value="{{ old('nama') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >

                            </div>


                            {{-- EMAIL --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    required
                                >

                            </div>


                            {{-- PASSWORD --}}

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Password

                                        <span class="required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Minimal 8 karakter"
                                        required
                                    >

                                </div>


                                {{-- KONFIRMASI PASSWORD --}}

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Konfirmasi Password

                                        <span class="required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- =================================================
                                DATA MEMBER
                            ================================================== --}}

                            <div class="section-title mt-4">

                                <i class="fa fa-id-card me-2"></i>

                                Data Member

                            </div>


                            {{-- PEKERJAAN --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    Pekerjaan

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="pekerjaan"
                                    class="form-control"
                                    value="{{ old('pekerjaan') }}"
                                    placeholder="Contoh: Dosen, Mahasiswa, Pegawai, dll."
                                    required
                                >

                            </div>


                            {{-- NO HP --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    No. HP yang bisa dihubungi

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    class="form-control"
                                    value="{{ old('no_hp') }}"
                                    placeholder="Contoh: 081234567890"
                                    required
                                >

                            </div>


                            {{-- PERUSAHAAN --}}

                            <div class="mb-3">

                                <label class="form-label">
                                    Perusahaan / Institusi
                                </label>

                                <input
                                    type="text"
                                    name="perusahaan"
                                    class="form-control"
                                    value="{{ old('perusahaan') }}"
                                    placeholder="Nama perusahaan atau institusi"
                                >

                            </div>


                            {{-- DOMISILI --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    Domisili

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="domisili"
                                    class="form-control"
                                    value="{{ old('domisili') }}"
                                    placeholder="Contoh: Jakarta Selatan"
                                    required
                                >

                            </div>


                            {{-- ALAMAT --}}

                            <div class="mb-3">

                                <label class="form-label">

                                    Alamat Lengkap

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <textarea
                                    name="alamat"
                                    class="form-control"
                                    placeholder="Masukkan alamat lengkap"
                                    required
                                >{{ old('alamat') }}</textarea>

                            </div>


                            {{-- =================================================
                                INFORMASI KOSA
                            ================================================== --}}

                            <div class="mb-4">

                                <label class="form-label">

                                    Informasi yang ingin didapatkan dari KOSA

                                    <span class="required">
                                        *
                                    </span>

                                </label>

                                <div class="text-muted mb-3" style="font-size: 13px;">
                                    Anda dapat memilih lebih dari satu.
                                </div>


                                {{-- SEMINAR --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Seminar"
                                        id="infoSeminar"
                                        {{ in_array('Seminar', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoSeminar"
                                    >
                                        Seminar
                                    </label>

                                </div>


                                {{-- AKTIVITAS SOSIAL --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Aktivitas Sosial KOICA"
                                        id="infoSosial"
                                        {{ in_array('Aktivitas Sosial KOICA', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoSosial"
                                    >
                                        Aktivitas Sosial KOICA
                                    </label>

                                </div>


                                {{-- MENTORING --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Mentoring Beasiswa S2 / S3 KOICA"
                                        id="infoMentoring"
                                        {{ in_array('Mentoring Beasiswa S2 / S3 KOICA', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoMentoring"
                                    >
                                        Mentoring Beasiswa S2 / S3 KOICA
                                    </label>

                                </div>


                                {{-- INFORMASI BEASISWA --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Informasi Beasiswa S2 / S3 KOICA"
                                        id="infoBeasiswa"
                                        {{ in_array('Informasi Beasiswa S2 / S3 KOICA', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoBeasiswa"
                                    >
                                        Informasi Beasiswa S2 / S3 KOICA
                                    </label>

                                </div>


                                {{-- KEHIDUPAN MAHASISWA DI KOREA --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Kehidupan Mahasiswa di Korea"
                                        id="infoKorea"
                                        {{ in_array('Kehidupan Mahasiswa di Korea', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoKorea"
                                    >
                                        Kehidupan Mahasiswa di Korea
                                    </label>

                                </div>


                                {{-- KUIS DAN LOMBA --}}

                                <div class="form-check mb-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Kuis dan Lomba lainnya"
                                        id="infoKuis"
                                        {{ in_array('Kuis dan Lomba lainnya', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoKuis"
                                    >
                                        Kuis dan Lomba lainnya
                                    </label>

                                </div>


                                {{-- GATHERING --}}

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Gathering dan Networking"
                                        id="infoGathering"
                                        {{ in_array('Gathering dan Networking', old('informasi_kosa', [])) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label"
                                        for="infoGathering"
                                    >
                                        Gathering dan Networking
                                    </label>

                                </div>

                            </div>


                            {{-- =================================================
                                SUBMIT
                            ================================================== --}}

                            <button
                                type="submit"
                                class="btn register-button w-100"
                            >

                                <i class="fa fa-user-plus me-2"></i>

                                Daftar sebagai Member

                            </button>


                            {{-- =================================================
                                LOGIN
                            ================================================== --}}

                            <div class="login-text">

                                Sudah memiliki akun?

                                <a href="{{ route('login') }}">
                                    Login di sini
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection