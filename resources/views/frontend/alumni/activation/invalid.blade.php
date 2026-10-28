@extends('frontend.v_layouts.app')

@section('title', 'Link Aktivasi Tidak Valid')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center p-5">

                    <div
                        style="
                            width:70px;
                            height:70px;
                            background:#fdecec;
                            color:#dc3545;
                            border-radius:50%;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            margin:auto;
                            font-size:30px;
                        "
                    >
                        <i class="fa-solid fa-link-slash"></i>
                    </div>

                    <h3 class="mt-4">
                        Link Aktivasi Tidak Valid
                    </h3>

                    <p class="text-muted">
                        Link aktivasi alumni tidak ditemukan,
                        sudah digunakan, atau sudah tidak berlaku.
                    </p>

                    <a
                        href="{{ route('register.alumni') }}"
                        class="btn btn-primary"
                    >
                        Kembali ke Registrasi Alumni
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection