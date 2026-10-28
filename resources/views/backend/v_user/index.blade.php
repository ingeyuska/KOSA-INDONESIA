@extends('backend.v_layout.app')

@section('title', 'Data Users')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-people"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">User Management</p>

                    <h1 class="h3 mb-1">
                        Users
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola akun pengguna Portal Alumni KOSA.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.users.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-person-plus"></i>
                    Tambah User
                </a>

            </div>

        </div>


        {{-- ALERT SUCCESS --}}
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


        {{-- ALERT ERROR --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show mt-3">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- VALIDATION ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger mt-3">

                <strong>
                    Data belum dapat diproses.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- TABLE --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-people"></i>

                        <span>
                            Daftar Users
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar akun yang terdaftar pada sistem.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Dibuat</th>

                            <th width="150" class="text-end">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div
                                            class="d-flex align-items-center justify-content-center"
                                            style="
                                                width:40px;
                                                height:40px;
                                                border-radius:50%;
                                                background:#f1f3f5;
                                            "
                                        >

                                            <i class="bi bi-person"></i>

                                        </div>

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $user->nama }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td>
                                    {{ $user->email }}
                                </td>


                                {{-- ROLE --}}
                                <td>

                                    @if($user->role === 'admin')

                                        <span class="badge text-bg-primary">
                                            <i class="bi bi-shield-check me-1"></i>
                                            Admin
                                        </span>

                                    @else

                                        <span class="badge text-bg-secondary">
                                            <i class="bi bi-person me-1"></i>
                                            Alumni
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

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

                                </td>


                                {{-- CREATED --}}
                                <td>

                                    @if($user->created_at)

                                        {{ $user->created_at->format('d M Y') }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        @if($user->id !== auth()->id())

                                            <form
                                                action="{{ route('admin.users.destroy', $user->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-light btn-sm text-danger"
                                                    title="Hapus"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        @else

                                            <button
                                                type="button"
                                                class="btn btn-light btn-sm text-muted"
                                                title="Akun yang sedang digunakan tidak dapat dihapus"
                                                disabled>
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5">
                                    <div class="text-muted">

                                        <i
                                            class="bi bi-people"
                                            style="font-size:40px;">
                                        </i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada users
                                        </p>

                                        <p class="small mb-3">
                                            Silakan tambahkan users pertama.
                                        </p>

                                        <a
                                            href="{{ route('admin.users.create') }}"
                                            class="btn btn-primary btn-sm">

                                            <i class="bi bi-person-plus"></i>

                                            Tambah User

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>
</main>

@endsection

