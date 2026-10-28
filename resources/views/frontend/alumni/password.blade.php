@extends('frontend.alumni.layouts.app')

@section('title', 'Ubah Password - Alumni KOSA')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="mb-4">
                        <span class="text-primary small fw-semibold">
                            KEAMANAN AKUN
                        </span>

                        <h3 class="mt-2 mb-2">
                            Ubah Password
                        </h3>

                        <p class="text-muted mb-0">
                            Silakan ubah password akun Anda.
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('alumni.password.update') }}">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">
                                Password Lama
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                placeholder="Masukkan password lama"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                required
                            >
                        </div>

                        <div class="d-flex gap-2">

                            <a href="{{ route('alumni.profile') }}"
                               class="btn btn-light">
                                Batal
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                <i class="fa-solid fa-lock me-1"></i>
                                Simpan Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection