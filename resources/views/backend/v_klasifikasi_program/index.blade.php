@extends('backend.v_layout.app')

@section('title', 'Data Klasifikasi Program')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- =========================
            HEADER
        ========================= --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-tags"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Alumni Management
                    </p>

                    <h1 class="h3 mb-1">
                        Klasifikasi Program
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola pilihan klasifikasi program alumni.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.klasifikasi-program.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Klasifikasi
                </a>

            </div>

        </div>


        {{-- =========================
            ALERT SUCCESS
        ========================= --}}
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


        {{-- =========================
            ALERT ERROR
        ========================= --}}
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


        {{-- =========================
            TABLE
        ========================= --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-tags me-1"></i>

                        <span>
                            Daftar Klasifikasi Program
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar klasifikasi program yang tersedia.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table
                    id="klasifikasiProgramTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%; font-size:13px;"
                >

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th>
                                Nama Klasifikasi
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="100" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($klasifikasiPrograms as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <span class="fw-semibold">
                                        {{ $item->nama }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($item->aktif)

                                        <span class="badge text-bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge text-bg-secondary">
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
                                                'admin.klasifikasi-program.edit',
                                                ['klasifikasi_program' => $item->id]
                                            ) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.klasifikasi-program.destroy',
                                                ['klasifikasi_program' => $item->id]
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus klasifikasi program ini?')"
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

        </section>

    </div>

</main>

@endsection