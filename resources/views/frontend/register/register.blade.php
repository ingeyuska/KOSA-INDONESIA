@extends('frontend.v_layouts.app')

@section('title', 'Registrasi KOSA Indonesia')

@section('content')

<style>
    .register-choice-section {
        padding: 90px 0;
        background: #f6f9fd;
        min-height: 80vh;
    }

    .register-heading span {
        display: inline-block;
        color: #164b8c;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
    }

    .register-heading h1 {
        color: #0b2c5f;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .register-heading p {
        color: #667085;
        font-size: 16px;
    }

    .register-card {
        height: 100%;
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e7edf5;
        padding: 45px 35px;
        text-align: center;
        transition: all .3s ease;
        box-shadow: 0 8px 25px rgba(16, 24, 40, .05);
    }

    .register-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(16, 24, 40, .12);
        border-color: #d5e2f3;
    }

    .register-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #164b8c;
        font-size: 35px;
    }

    .register-card h3 {
        color: #0b2c5f;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .register-card p {
        color: #667085;
        line-height: 1.7;
        min-height: 55px;
        margin-bottom: 28px;
    }

    .register-card .btn {
        min-width: 210px;
        min-height: 48px;
        border-radius: 9px;
        font-weight: 600;
        padding: 12px 20px;
    }

    .btn-alumni {
        background: #0b2c5f;
        border-color: #0b2c5f;
        color: #fff;
    }

    .btn-alumni:hover {
        background: #164b8c;
        border-color: #164b8c;
        color: #fff;
    }

    .btn-member {
        background: #fff;
        color: #0b2c5f;
        border: 1px solid #0b2c5f;
    }

    .btn-member:hover {
        background: #0b2c5f;
        color: #fff;
    }

    .register-note {
        text-align: center;
        margin-top: 35px;
        color: #667085;
        font-size: 14px;
    }

    @media (max-width: 767px) {
        .register-choice-section {
            padding: 60px 15px;
        }

        .register-card {
            padding: 35px 25px;
        }
    }
</style>

<section class="register-choice-section">


<div class="container">

    {{-- HEADING --}}
    <div class="register-heading text-center mb-5">

        <span>
            REGISTRASI KOSA INDONESIA
        </span>

        <h1>
            Bergabung Bersama KOSA
        </h1>

        <p>
            Pilih jenis keanggotaan yang sesuai dengan Anda.
        </p>

    </div>


    <div class="row justify-content-center g-4">

        {{-- ALUMNI --}}
        <div class="col-lg-5 col-md-6">

            <div class="register-card">

                <div class="register-icon">

                    <i class="fa fa-graduation-cap"></i>

                </div>

                <h3>
                    Alumni
                </h3>

                <p>
                    Khusus bagi alumni atau lulusan
                    program KOICA yang ingin bergabung
                    dan terhubung dengan komunitas KOSA Indonesia.
                </p>

                <a
                    href="{{ route('register.alumni') }}"
                    class="btn btn-alumni"
                >
                    Daftar sebagai Alumni
                    <i class="fa fa-arrow-right ms-2"></i>
                </a>

            </div>

        </div>


        {{-- MEMBER --}}
        <div class="col-lg-5 col-md-6">

            <div class="register-card">

                <div class="register-icon">

                    <i class="fa fa-users"></i>

                </div>

                <h3>
                    Member
                </h3>

                <p>
                    Untuk masyarakat atau non-alumni
                    yang ingin menjadi bagian dari komunitas
                    dan mengikuti kegiatan KOSA Indonesia.
                </p>

                <a
                    href="{{ route('register.member') }}"
                    class="btn btn-member"
                >
                    Daftar sebagai Member
                    <i class="fa fa-arrow-right ms-2"></i>
                </a>

            </div>

        </div>

    </div>


    <div class="register-note">

        Sudah memiliki akun?

        <a
            href="{{ route('login') }}"
            style="color:#0b2c5f;font-weight:600;text-decoration:none;"
        >
            Login di sini
        </a>

    </div>

</div>


</section>

@endsection
