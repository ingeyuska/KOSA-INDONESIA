@extends('frontend.member.layouts.app')

@section('title', 'Ubah Password - Member KOSA')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- HEADER --}}
                    <div class="mb-4">

                        <span class="text-primary small fw-semibold">
                            KEAMANAN AKUN
                        </span>

                        <h4 class="mt-2 mb-2">
                            Ubah Password
                        </h4>

                        <p class="text-muted mb-0">
                            Ubah password akun Member KOSA Indonesia
                            untuk menjaga keamanan akun Anda.
                        </p>

                    </div>


                    {{-- PESAN BERHASIL --}}
                    @if(session('success'))

                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}
                        </div>

                    @endif


                    {{-- PESAN ERROR --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <div class="fw-semibold mb-1">
                                Terjadi kesalahan:
                            </div>

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- FORM PASSWORD --}}
                    <form
                        method="POST"
                        action="{{ route('member.password.update') }}"
                    >

                        @csrf
                        @method('PUT')


                        {{-- PASSWORD LAMA --}}
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


                        {{-- PASSWORD BARU --}}
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

                            <small class="text-muted">
                                Password minimal 8 karakter.
                            </small>

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
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


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('member.profile') }}"
                                class="btn btn-light"
                            >
                                <i class="fa-solid fa-arrow-left me-1"></i>
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
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