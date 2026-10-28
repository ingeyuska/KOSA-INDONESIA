@extends('backend.v_layout.app')

@section('title', 'Profile Admin')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-person-badge"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">
                        Account
                    </p>

                    <h1 class="h3 mb-1">
                        Profile
                    </h1>

                    <p class="text-muted mb-0">
                        Informasi akun administrator Portal Alumni KOSA.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.profile.edit') }}"
                    class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil me-1"></i>
                    Edit Profile
                </a>
            </div>
        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show mt-3">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- PROFILE --}}
        <section class="row g-3 mt-1">

            {{-- FOTO --}}
            <div class="col-12 col-xl-4">
                <div class="panel h-100">
                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title">
                                <i class="bi bi-person-circle"></i>
                                <span>
                                    Foto Profile
                                </span>
                            </h2>
                            <p class="text-muted mb-0">
                                Foto akun administrator.
                            </p>
                        </div>
                    </div>

                    <div class="p-4 text-center">

                        @if($user->foto)

                            <img
                                src="{{ asset('storage/' . $user->foto) }}"
                                alt="{{ $user->nama }}"
                                class="rounded-circle mb-3"
                                style="
                                    width:140px;
                                    height:140px;
                                    object-fit:cover;
                                "
                            >

                        @else

                            <div
                                class="d-flex align-items-center justify-content-center mx-auto mb-3"
                                style="
                                    width:140px;
                                    height:140px;
                                    border-radius:50%;
                                    background:#f1f3f5;
                                "
                            >

                                <i
                                    class="bi bi-person"
                                    style="font-size:60px;"
                                ></i>

                            </div>

                        @endif


                        <h4 class="mb-1">
                            {{ $user->nama }}
                        </h4>

                        <p class="text-muted mb-2">
                            {{ $user->email }}
                        </p>


                        @if($user->role === 'admin')

                            <span class="badge text-bg-primary">
                                <i class="bi bi-shield-check me-1"></i>
                                Administrator
                            </span>

                        @else

                            <span class="badge text-bg-secondary">
                                Alumni
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- DATA PROFILE --}}
            <div class="col-12 col-xl-8">

                <div class="panel h-100">

                    <div class="panel-header">

                        <div>

                            <h2 class="h5 mb-1 section-title">

                                <i class="bi bi-person-vcard"></i>

                                <span>
                                    Informasi Profile
                                </span>

                            </h2>

                            <p class="text-muted mb-0">
                                Data akun administrator.
                            </p>

                        </div>

                    </div>


                    <div class="p-4">

                        {{-- NAMA --}}
                        <div class="row mb-3">

                            <div class="col-md-4 text-muted">
                                Nama
                            </div>

                            <div class="col-md-8 fw-semibold">
                                {{ $user->nama }}
                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="row mb-3">

                            <div class="col-md-4 text-muted">
                                Email
                            </div>

                            <div class="col-md-8">
                                {{ $user->email }}
                            </div>

                        </div>


                        {{-- NO HP --}}
                        <div class="row mb-3">

                            <div class="col-md-4 text-muted">
                                No. HP
                            </div>

                            <div class="col-md-8">

                                {{ $user->no_hp ?: '-' }}

                            </div>

                        </div>


                        {{-- ROLE --}}
                        <div class="row mb-3">

                            <div class="col-md-4 text-muted">
                                Role
                            </div>

                            <div class="col-md-8">

                                @if($user->role === 'admin')

                                    <span class="badge text-bg-primary">
                                        Admin
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        Alumni
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="row mb-3">

                            <div class="col-md-4 text-muted">
                                Status
                            </div>

                            <div class="col-md-8">

                                @if($user->status === 'aktif')

                                    <span class="badge text-bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge text-bg-secondary">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Tidak Aktif
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- BIO --}}
                        <div class="row">

                            <div class="col-md-4 text-muted">
                                Bio
                            </div>

                            <div class="col-md-8">

                                @if($user->bio)

                                    {{ $user->bio }}

                                @else

                                    <span class="text-muted">
                                        Belum ada bio.
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

</main>

@endsection

