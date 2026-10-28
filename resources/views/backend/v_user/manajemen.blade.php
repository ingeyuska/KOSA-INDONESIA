@extends('backend.v_layout.app')

@section('title', 'Manajemen KOICA')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1 fw-bold">
                <i class="bi bi-people text-primary me-2"></i>
                Manajemen KOICA
            </h4>

            <p class="text-muted mb-0">
                Data pengguna dengan role Manajemen KOICA
            </p>

        </div>

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
                    <i class="bi bi-person-badge text-primary me-2"></i>
                    Daftar Manajemen KOICA
                </h5>

                <small class="text-muted">
                    Daftar pengguna dengan role Manajemen KOICA.
                </small>

            </div>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="koicaTable"
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
                                Status
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

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection