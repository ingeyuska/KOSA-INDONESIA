@extends('backend.v_layout.app')

@section('title', 'Manajemen Admin')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-bold">
                <i class="bi bi-person-gear text-primary me-2"></i>
                Manajemen Admin
            </h4>

            <p class="text-muted mb-0">
                Kelola akun administrator KOSA Indonesia
            </p>
        </div>


        <a
            href="{{ route('admin.users.create') }}"
            class="btn btn-primary btn-sm"
        >
            <i class="fa-solid fa-plus me-1"></i>
            Tambah Admin
        </a>

    </div>


    {{-- =========================
        ALERT SUCCESS
    ========================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================
        ALERT ERROR
    ========================= --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================
        TABLE
    ========================= --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <div>
                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-people text-primary me-2"></i>
                    Daftar Admin
                </h5>

                <small class="text-muted">
                    Daftar akun administrator KOSA Indonesia.
                </small>
            </div>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="adminTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%; font-size:13px;"
                >

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Email
                            </th>

                            <th width="120">
                                Role
                            </th>

                            <th width="110">
                                Status
                            </th>

                            <th width="100" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $user->nama }}
                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td>
                                    {{ $user->email }}
                                </td>


                                {{-- ROLE --}}
                                <td>

                                    <span class="badge bg-primary">

                                        {{ ucfirst(
                                            str_replace('_', ' ', $user->role)
                                        ) }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($user->status === 'aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route(
                                                'admin.users.edit',
                                                $user->id
                                            ) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.users.destroy',
                                                $user->id
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus akun admin ini?')"
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

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection