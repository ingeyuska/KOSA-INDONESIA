@extends('frontend.v_layouts.app')

@section('title', 'Verifikasi Kedaluwarsa')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-5 text-center">

                    <i
                        class="fa fa-clock text-warning"
                        style="font-size:55px;"
                    ></i>

                    <h3 class="mt-3">
                        Link Verifikasi Kedaluwarsa
                    </h3>

                    <p class="text-muted">
                        Link verifikasi akun Member telah
                        melewati batas waktu 24 jam.
                    </p>

                    <a
                        href="{{ route('register.member') }}"
                        class="btn btn-primary"
                    >
                        Registrasi Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection