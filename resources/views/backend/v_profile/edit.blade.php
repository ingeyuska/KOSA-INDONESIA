@extends('backend.v_layout.app')

@section('title', 'Edit Profile')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Account
                    </p>

                    <h1 class="h3 mb-1">
                        Edit Profile
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi akun administrator.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.profile.index') }}"
                    class="btn btn-outline-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>


        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger mt-3">

                <strong>
                    Data belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-person-gear"></i>

                        <span>
                            Form Edit Profile
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Ubah data profile sesuai kebutuhan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="p-4">

                    <div class="row g-3">


                        {{-- NAMA --}}
                        <div class="col-md-6">

                            <label
                                for="nama"
                                class="form-label"
                            >
                                Nama
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control"
                                value="{{ old('nama', $user->nama) }}"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}"
                                required
                            >

                        </div>


                        {{-- NO HP --}}
                        <div class="col-md-6">

                            <label
                                for="no_hp"
                                class="form-label"
                            >
                                No. HP
                            </label>

                            <input
                                type="text"
                                id="no_hp"
                                name="no_hp"
                                class="form-control"
                                value="{{ old('no_hp', $user->no_hp) }}"
                                placeholder="08xxxxxxxxxx"
                            >

                        </div>


                        {{-- FOTO --}}
                        <div class="col-md-6">

                            <label
                                for="foto"
                                class="form-label"
                            >
                                Foto Profile
                            </label>

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <small class="text-muted">
                                JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            </small>

                        </div>


                        {{-- BIO --}}
                        <div class="col-12">

                            <label
                                for="bio"
                                class="form-label"
                            >
                                Bio
                            </label>

                            <textarea
                                id="bio"
                                name="bio"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan bio..."
                            >{{ old('bio', $user->bio) }}</textarea>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="col-md-6">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Password Baru
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak ingin mengubah"
                                autocomplete="new-password"
                            >

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="col-md-6">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                            >

                        </div>


                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a
                            href="{{ route('admin.profile.index') }}"
                            class="btn btn-light"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-circle me-1"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </div>

            </form>

        </section>

    </div>

</main>

@endsection

