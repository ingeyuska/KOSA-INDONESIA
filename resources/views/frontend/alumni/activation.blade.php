@extends('frontend.v_layouts.app')

@section('title', 'Aktivasi Alumni')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-body p-4">

                    <h3 class="mb-3">
                        Aktivasi Alumni KOSA
                    </h3>

                    <p class="text-muted">
                        Halo <strong>{{ $invitation->nama_lengkap }}</strong>.
                    </p>

                    <p>
                        Silakan konfirmasi identitas Anda
                        sebelum melanjutkan aktivasi akun.
                    </p>

                    <form method="POST"
                          action="{{ route('alumni.activation.confirm', $invitation->token) }}">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan email Anda"
                                required
                            >

                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <button class="btn btn-primary w-100">
                            Konfirmasi Identitas
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection