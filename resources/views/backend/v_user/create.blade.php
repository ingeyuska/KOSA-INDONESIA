
@extends('backend.v_layout.app')

@section('title', 'Tambah User')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-person-plus"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">
                        User Management
                    </p>

                    <h1 class="h3 mb-1">
                        Tambah User
                    </h1>

                    <p class="text-muted mb-0">
                        Tambahkan akun baru untuk Admin atau Alumni KOSA.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-outline-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="alert alert-danger mt-3">

                <strong>
                    Data belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-person-plus"></i>

                        <span>
                            Form Tambah User
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Isi data akun yang akan ditambahkan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.users.store') }}"
                method="POST"
                enctype="multipart/form-data"
                autocomplete="off"
            >

                @csrf

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
                                class="form-control"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama"
                                autocomplete="off"
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
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                autocomplete="off"
                                required
                            >

                        </div>


                        {{-- PASSWORD --}}
                        <div class="col-md-6">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Minimal 6 karakter"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        {{-- ROLE --}}
                        <div class="col-md-3">

                            <label
                                for="role"
                                class="form-label"
                            >
                                Role
                            </label>

                            <select
                                class="form-select"
                                id="role"
                                name="role"
                                required
                            >

                                <option value="">
                                    Pilih Role
                                </option>

                                <option
                                    value="admin"
                                    {{ old('role') == 'admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>

                                <option
                                    value="alumni"
                                    {{ old('role') == 'alumni' ? 'selected' : '' }}
                                >
                                    Alumni
                                </option>

                            </select>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-3">

                            <label
                                for="status"
                                class="form-label"
                            >
                                Status
                            </label>

                            <select
                                class="form-select"
                                id="status"
                                name="status"
                                required
                            >

                                <option
                                    value="aktif"
                                    {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="tidak_aktif"
                                    {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

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
                                class="form-control"
                                id="no_hp"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                placeholder="08xxxxxxxxxx"
                                autocomplete="off"
                            >

                        </div>


                        {{-- FOTO --}}
                        <div class="col-md-6">

                            <label
                                for="foto"
                                class="form-label"
                            >
                                Foto
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                id="foto"
                                name="foto"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <small class="text-muted">
                                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
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
                                class="form-control"
                                id="bio"
                                name="bio"
                                rows="5"
                                placeholder="Masukkan bio user..."
                                autocomplete="off"
                            >{{ old('bio') }}</textarea>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="btn btn-light"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-circle"></i>
                            Simpan User
                        </button>

                    </div>

                </div>

            </form>

        </section>

    </div>
</main>

@endsection

