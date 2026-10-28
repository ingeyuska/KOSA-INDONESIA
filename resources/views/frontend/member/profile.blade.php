@extends('frontend.member.layouts.app')

@section('title', 'Profil Saya')

@section('content')

<style>
    .member-profile-section {
        padding: 50px 0;
    }

    .member-profile-title {
        margin-bottom: 30px;
    }

    .member-profile-card {
        border: 0;
        border-radius: 14px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .member-profile-card .card-body {
        padding: 35px;
    }

    .profile-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #0b2c5f;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #344054;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 45px;
        border: 1px solid #d9e0e7;
        border-radius: 8px;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #0788c5;
        box-shadow: 0 0 0 3px rgba(7, 136, 197, 0.08);
    }

    textarea.form-control {
        min-height: 100px;
    }

    .readonly-field {
        background: #f5f7fa;
        color: #667085;
    }

    .info-checkbox-wrapper {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 16px;
        background: #fff;
    }

    .info-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 13px;
        cursor: pointer;
        font-size: 14px;
        line-height: 1.5;
    }

    .info-checkbox:last-child {
        margin-bottom: 0;
    }

    .info-checkbox input {
        width: 17px;
        height: 17px;
        min-width: 17px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #0788c5;
    }

    .info-checkbox span {
        color: #344054;
    }

    .save-profile-button {
        background: #0b2c5f;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-weight: 600;
    }

    .save-profile-button:hover {
        background: #164b8c;
    }

    @media (max-width: 767px) {

        .member-profile-section {
            padding: 30px 15px;
        }

        .member-profile-card .card-body {
            padding: 22px 18px;
        }

        .member-profile-title h2 {
            font-size: 24px;
        }

        .profile-section-title {
            font-size: 17px;
        }

        .save-profile-button {
            width: 100%;
        }
    }
</style>


<section class="member-profile-section">

    <div class="container">

        {{-- =========================================================
            PAGE TITLE
        ========================================================== --}}
        <div class="member-profile-title">

            <h2 class="fw-bold mb-1">
                Profil Saya
            </h2>

            <p class="text-muted mb-0">
                Kelola informasi profil member KOSA Indonesia.
            </p>

        </div>


        {{-- =========================================================
            SUCCESS MESSAGE
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="fa-solid fa-circle-check me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERROR
        ========================================================== --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Periksa kembali data berikut:
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


        {{-- =========================================================
            PROFILE CARD
        ========================================================== --}}
        <div class="card member-profile-card">

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('member.profile.update') }}"
                >

                    @csrf
                    @method('PUT')


                    {{-- =================================================
                        DATA AKUN
                    ================================================== --}}
                    <h5 class="profile-section-title">
                        Data Akun
                    </h5>


                    <div class="row g-4">

                        {{-- NAMA --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Nama
                            </label>

                            <input
                                type="text"
                                class="form-control readonly-field"
                                value="{{ $user->nama }}"
                                readonly
                            >

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control readonly-field"
                                value="{{ $user->email }}"
                                readonly
                            >

                        </div>


                        {{-- MEMBER ID --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Member ID
                            </label>

                            <input
                                type="text"
                                class="form-control readonly-field"
                                value="{{ $profile->member_id ?? '-' }}"
                                readonly
                            >

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <input
                                type="text"
                                class="form-control readonly-field"
                                value="{{ ucfirst($user->status ?? '-') }}"
                                readonly
                            >

                        </div>

                    </div>


                    <hr class="my-5">


                    {{-- =================================================
                        INFORMASI MEMBER
                    ================================================== --}}
                    <h5 class="profile-section-title">
                        Informasi Member
                    </h5>


                    @php

                        $informasiKosa =
                            old(
                                'informasi_kosa',
                                $profile->informasi_kosa ?? []
                            );

                        /*
                        |--------------------------------------------------------------------------
                        | Jika data dari database berupa JSON string,
                        | ubah menjadi array.
                        |--------------------------------------------------------------------------
                        */

                        if (is_string($informasiKosa)) {

                            $informasiKosa =
                                json_decode(
                                    $informasiKosa,
                                    true
                                ) ?? [];

                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Pastikan selalu array
                        |--------------------------------------------------------------------------
                        */

                        if (!is_array($informasiKosa)) {

                            $informasiKosa = [];

                        }

                    @endphp


                    <div class="row g-4">

                        {{-- =================================================
                            PEKERJAAN
                        ================================================== --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Pekerjaan
                            </label>

                            <input
                                type="text"
                                name="pekerjaan"
                                class="form-control"
                                value="{{ old('pekerjaan', $profile->pekerjaan ?? '') }}"
                                placeholder="Masukkan pekerjaan"
                            >

                        </div>


                        {{-- =================================================
                            DOMISILI
                        ================================================== --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Domisili
                            </label>

                            <input
                                type="text"
                                name="domisili"
                                class="form-control"
                                value="{{ old('domisili', $profile->domisili ?? '') }}"
                                placeholder="Masukkan domisili"
                            >

                        </div>


                        {{-- =================================================
                            NO HP
                        ================================================== --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                No. HP
                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                value="{{ old('no_hp', $profile->no_hp ?? $user->no_hp ?? '') }}"
                                placeholder="Masukkan nomor HP"
                            >

                        </div>


                        {{-- =================================================
                            PERUSAHAAN / INSTANSI
                        ================================================== --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Perusahaan / Instansi
                            </label>

                            <input
                                type="text"
                                name="perusahaan"
                                class="form-control"
                                value="{{ old('perusahaan', $profile->perusahaan ?? '') }}"
                                placeholder="Masukkan perusahaan atau instansi"
                            >

                        </div>


                        {{-- =================================================
                            ALAMAT
                        ================================================== --}}
                        <div class="col-12">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat"
                            >{{ old('alamat', $profile->alamat ?? '') }}</textarea>

                        </div>


                        {{-- =================================================
                            INFORMASI KOSA
                        ================================================== --}}
                        <div class="col-12">

                            <label class="form-label">
                                Informasi yang ingin didapatkan dari KOSA
                            </label>

                            <div class="text-muted mb-3"
                                 style="font-size: 13px;">

                                Anda dapat memilih lebih dari satu.

                            </div>


                            <div class="info-checkbox-wrapper">


                                {{-- SEMINAR --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Seminar"
                                        {{ in_array('Seminar', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Seminar
                                    </span>

                                </label>


                                {{-- AKTIVITAS SOSIAL KOICA --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Aktivitas Sosial KOICA"
                                        {{ in_array('Aktivitas Sosial KOICA', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Aktivitas Sosial KOICA
                                    </span>

                                </label>


                                {{-- MENTORING BEASISWA --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Mentoring Beasiswa S2 / S3 KOICA"
                                        {{ in_array('Mentoring Beasiswa S2 / S3 KOICA', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Mentoring Beasiswa S2 / S3 KOICA
                                    </span>

                                </label>


                                {{-- INFORMASI BEASISWA --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Informasi Beasiswa S2 / S3 KOICA"
                                        {{ in_array('Informasi Beasiswa S2 / S3 KOICA', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Informasi Beasiswa S2 / S3 KOICA
                                    </span>

                                </label>


                                {{-- KEHIDUPAN MAHASISWA DI KOREA --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Kehidupan Mahasiswa di Korea"
                                        {{ in_array('Kehidupan Mahasiswa di Korea', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Kehidupan Mahasiswa di Korea
                                    </span>

                                </label>


                                {{-- KUIS DAN LOMBA --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Kuis dan Lomba lainnya"
                                        {{ in_array('Kuis dan Lomba lainnya', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Kuis dan Lomba lainnya
                                    </span>

                                </label>


                                {{-- GATHERING --}}
                                <label class="info-checkbox">

                                    <input
                                        type="checkbox"
                                        name="informasi_kosa[]"
                                        value="Gathering dan Networking"
                                        {{ in_array('Gathering dan Networking', $informasiKosa) ? 'checked' : '' }}
                                    >

                                    <span>
                                        Gathering dan Networking
                                    </span>

                                </label>


                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        BUTTON
                    ================================================== --}}
                    <div class="mt-4">

                        <button
                            type="submit"
                            class="btn btn-primary save-profile-button"
                        >

                            <i class="fa-solid fa-save me-2"></i>

                            Simpan Perubahan

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>

</section>

@endsection