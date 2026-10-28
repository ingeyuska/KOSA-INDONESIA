@extends('frontend.v_layouts.app')

@section('title', 'Registrasi Berhasil')

@section('content')

<div class="container py-5">


<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4 p-md-5 text-center">

                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success"
                       style="font-size:60px;"></i>
                </div>

                <h3 class="mb-3">
                    Registrasi Berhasil
                </h3>

                <p class="text-muted">
                    Selamat, akun Member KOSA Indonesia berhasil dibuat.
                </p>

                <div class="alert alert-light border text-start mt-4">

                    <p class="mb-2">
                        <strong>Nama:</strong>
                        {{ $user->nama }}
                    </p>

                    <p class="mb-2">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </p>

                    <p class="mb-0">
                        <strong>Member ID:</strong>
                        {{ $user->memberProfile->member_id }}
                    </p>

                </div>

                <div class="alert alert-info text-start mt-4">

                    <strong>
                        <i class="fa-solid fa-envelope me-2"></i>
                        Silakan Cek Email Anda
                    </strong>

                    <p class="mb-0 mt-2">
                        Link untuk mengaktifkan akun Member telah dikirim
                        ke email <strong>{{ $user->email }}</strong>.
                        Silakan buka email tersebut dan klik tombol
                        <strong>Aktifkan Akun</strong>.
                    </p>

                </div>

                <p class="text-muted small mt-4 mb-0">
                    Jika email belum masuk, silakan periksa folder
                    <strong>Spam</strong> atau <strong>Junk</strong>.
                </p>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
