@extends('frontend.v_layouts.app')

@section('title', 'Verifikasi Tidak Valid')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-5 text-center">

                    <i
                        class="fa fa-times-circle text-danger"
                        style="font-size:55px;"
                    ></i>

                    <h3 class="mt-3">
                        Link Verifikasi Tidak Valid
                    </h3>

                    <p class="text-muted">
                        Link verifikasi tidak ditemukan atau
                        sudah tidak dapat digunakan.
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary"
                    >
                        Kembali ke Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection