
@extends('backend.v_layout.app')

@section('title', 'Edit User')

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
                        User Management
                    </p>

                    <h1 class="h3 mb-1">
                        Edit User
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi akun user.
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
                    Data belum dapat diperbarui.
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

                        <i class="bi bi-person-gear"></i>

                        <span>
                            Form Edit User
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Perbarui data akun sesuai kebutuhan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.users.update', $user->id) }}"
                method="POST"
                enctype="multipart/form-data"
                autocomplete="off"
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
                                class="form-control"
                                id="nama"
                                name="nama"
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
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
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
                                Password Baru
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Kosongkan jika tidak ingin mengganti password"
                                autocomplete="new-password"
                            >

                            <small class="text-muted">
                                Kosongkan jika password lama tetap digunakan.
                            </small>

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

                                <option
                                    value="admin"
                                    {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>

                                <option
                                    value="alumni"
                                    {{ old('role', $user->role) == 'alumni' ? 'selected' : '' }}
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
                                    {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="tidak_aktif"
                                    {{ old('status', $user->status) == 'tidak_aktif' ? 'selected' : '' }}
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
                                value="{{ old('no_hp', $user->no_hp) }}"
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

                            @if($user->foto)

                                <div class="mb-2">

                                    <img
                                        src="{{ asset('storage/' . $user->foto) }}"
                                        alt="{{ $user->nama }}"
                                        style="
                                            width:100px;
                                            height:100px;
                                            object-fit:cover;
                                            border-radius:50%;
                                        "
                                    >

                                </div>

                            @endif

                            <input
                                type="file"
                                class="form-control"
                                id="foto"
                                name="foto"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti foto.
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
                            >{{ old('bio', $user->bio) }}</textarea>

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

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </form>

        </section>

    </div>
</main>

@endsection

