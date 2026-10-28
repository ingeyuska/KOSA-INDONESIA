@extends('frontend.v_layouts.app')

@section('title', 'Registrasi Alumni - KOSA Indonesia')

@section('content')

<style>
    .register-page {
        background: #f5f8fc;
        min-height: 100vh;
        padding: 60px 0;
    }

    .register-wrapper {
        max-width: 650px;
        margin: auto;
    }

    .register-card {
        background: #fff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(20, 45, 80, 0.10);
    }

    .register-header {
        background: linear-gradient(135deg, #0b2d5c, #164d8f);
        color: white;
        padding: 35px 40px;
    }

    .register-header h2 {
        font-weight: 700;
        margin-bottom: 8px;
        color: #fff;
    }

    .register-header p {
        margin: 0;
        color: rgba(255,255,255,.8);
    }

    .register-header .badge-register {
        display: inline-block;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .register-body {
        padding: 40px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e9eef5;
    }

    .section-number {
        width: 34px;
        height: 34px;
        background: #0b2d5c;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        flex-shrink: 0;
    }

    .section-title h5 {
        margin: 0;
        font-weight: 700;
        color: #172b4d;
    }

    .section-title small {
        display: block;
        color: #8a94a6;
        margin-top: 3px;
    }

    .form-label {
        font-weight: 600;
        color: #344054;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 48px;
        border-radius: 9px;
        border: 1px solid #d8e0eb;
        padding: 10px 13px;
        transition: .2s;
    }

    .form-control:focus {
        border-color: #164d8f;
        box-shadow: 0 0 0 3px rgba(22,77,143,.10);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .required {
        color: #dc3545;
    }

    .info-box {
        background: #f1f6fc;
        border-left: 4px solid #164d8f;
        padding: 15px 17px;
        border-radius: 8px;
        color: #526071;
        font-size: 13px;
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .step-box {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
    }

    .step {
        flex: 1;
        text-align: center;
        font-size: 12px;
        color: #8a94a6;
        position: relative;
    }

    .step.active {
        color: #0b2d5c;
        font-weight: 600;
    }

    .step-number {
        width: 30px;
        height: 30px;
        margin: 0 auto 7px;
        border-radius: 50%;
        background: #e9eef5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .step.active .step-number {
        background: #0b2d5c;
        color: white;
    }

    .btn-register {
        min-height: 50px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #0b2d5c, #164d8f);
        color: white;
        font-weight: 600;
        font-size: 15px;
        transition: .2s;
    }

    .btn-register:hover {
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(11,45,92,.20);
        color: white;
    }

    .login-info {
        text-align: center;
        margin-top: 18px;
        color: #7b8794;
        font-size: 14px;
    }

    .login-info a {
        color: #164d8f;
        font-weight: 600;
        text-decoration: none;
    }

    .help-text {
        font-size: 12px;
        color: #8a94a6;
        margin-top: 7px;
        line-height: 1.5;
    }

    @media(max-width: 576px) {

        .register-page {
            padding: 25px 12px;
        }

        .register-header,
        .register-body {
            padding: 25px 20px;
        }

        .step-box {
            gap: 5px;
        }

        .step {
            font-size: 10px;
        }
    }
</style>

<div class="register-page">

<div class="container">

    <div class="register-wrapper">

        <div class="register-card">

            {{-- HEADER --}}
            <div class="register-header">

                <span class="badge-register">
                    KOSA Indonesia
                </span>

                <h2>
                    Registrasi Alumni
                </h2>

                <p>
                    Aktivasi akun Alumni Existing KOSA Indonesia.
                </p>

            </div>


            <div class="register-body">

                {{-- ERROR --}}
                @if($errors->any())

                    <div class="alert alert-danger rounded-3">

                        <strong>
                            Registrasi belum dapat dilanjutkan.
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- SUCCESS --}}
                @if(session('success'))

                    <div class="alert alert-success rounded-3">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- PROGRESS --}}
                <div class="step-box">

                    <div class="step active">

                        <div class="step-number">
                            1
                        </div>

                        Identifikasi

                    </div>


                    <div class="step">

                        <div class="step-number">
                            2
                        </div>

                        Konfirmasi

                    </div>


                    <div class="step">

                        <div class="step-number">
                            3
                        </div>

                        Aktivasi

                    </div>


                    <div class="step">

                        <div class="step-number">
                            4
                        </div>

                        Profil

                    </div>

                </div>


                {{-- INFO --}}
                <div class="info-box">

                    <strong>Alumni Existing KOSA</strong>

                    <br>

                    Jika Anda merupakan alumni KOSA yang datanya
                    telah terdaftar di database, masukkan email yang
                    terdaftar pada data KOSA.

                    <br><br>

                    Sistem akan memeriksa data Anda dan memberikan
                    akses aktivasi akun secara aman.

                </div>


                {{-- SECTION --}}
                <div class="section-title">

                    <div class="section-number">
                        1
                    </div>

                    <div>

                        <h5>
                            Identifikasi Alumni
                        </h5>

                        <small>
                            Masukkan email yang terdaftar di database KOSA
                        </small>

                    </div>

                </div>


                {{-- FORM --}}
                <form
                    action="{{ route('register.alumni.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="form-group">

                        <label class="form-label">

                            Email Alumni

                            <span class="required">*</span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            autocomplete="email"
                            required
                        >

                        <div class="help-text">

                            Gunakan email yang sebelumnya tercatat
                            pada database Alumni KOSA Indonesia.
                         Jika anda tidak ingat dengan akun anda / terdapat perubahan data email silakan hubungi admin melalui email.
                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-register w-100"
                    >

                        Lanjutkan Registrasi

                    </button>

                </form>


                {{-- LOGIN --}}
                <div class="login-info">

                    Sudah memiliki akun?

                    <a href="{{ route('login') }}">
                        Login di sini
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
