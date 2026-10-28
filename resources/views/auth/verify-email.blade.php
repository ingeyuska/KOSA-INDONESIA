@extends('frontend.v_layouts.app')

@section('title', 'Verifikasi Email - KOSA Indonesia')

@section('content')

<section class="section-padding">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center p-5">

                        <div class="mb-4">
                            <i class="fas fa-envelope"
                               style="font-size: 60px;"></i>
                        </div>

                        <h2 class="mb-3">
                            Verifikasi Email Anda
                        </h2>

                        <p class="text-muted mb-4">
                            Terima kasih telah mendaftar di KOSA Indonesia.
                            Silakan buka email Anda dan klik link verifikasi
                            untuk mengaktifkan akun.
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p class="mb-3">
                            Belum menerima email?
                        </p>

                        <form
                            method="POST"
                            action="{{ route('verification.send') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                            >
                                Kirim Ulang Email Verifikasi
                            </button>

                        </form>

                        <div class="mt-4">

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-link text-muted"
                                >
                                    Keluar
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection

