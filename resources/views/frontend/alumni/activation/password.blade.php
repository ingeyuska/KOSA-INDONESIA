@extends('frontend.v_layouts.app')

@section('title', 'Buat Password Alumni')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-9">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">

                        <div
                            style="
                                width:60px;
                                height:60px;
                                background:#eaf2ff;
                                border-radius:50%;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                margin:auto;
                                font-size:26px;
                                color:#0d6efd;
                            "
                        >
                            <i class="fa-solid fa-lock"></i>
                        </div>

                        <h3 class="mt-3 mb-2">
                            Buat Password Akun
                        </h3>

                        <p class="text-muted mb-0">
                            Silakan buat password untuk mengaktifkan akun alumni Anda.
                        </p>

                    </div>


                    {{-- ALERT ERROR --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- DATA ALUMNI --}}
                    <div class="bg-light rounded p-4 mb-4">

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Nama Alumni
                            </small>

                            <strong>
                                {{ $alumni->nama }}
                            </strong>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $alumni->email }}
                            </strong>

                        </div>

                    </div>


                    {{-- FORM PASSWORD --}}
                    <form
                        action="{{ route('alumni.activation.activate', $invitation->token) }}"
                        method="POST"
                    >

                        @csrf


                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                minlength="8"
                                required
                            >

                            <small class="text-muted">
                                Minimal 8 karakter.
                            </small>

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                required
                            >

                        </div>


                        {{-- PERSETUJUAN DATA --}}
                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="persetujuan_data"
                                id="persetujuan_data"
                                value="1"
                                required
                            >

                            <label
                                class="form-check-label"
                                for="persetujuan_data"
                            >
                                Saya menyetujui bahwa data alumni yang saya berikan
                                dapat digunakan untuk keperluan administrasi dan
                                layanan KOSA Indonesia.
                            </label>

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            <i class="fa-solid fa-check"></i>
                            Aktifkan Akun
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection