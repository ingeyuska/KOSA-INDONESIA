@extends('backend.v_layout.app')

@section('title', 'Data Program')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-mortarboard"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Alumni Management
                    </p>

                    <h1 class="h3 mb-1">
                        Program
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola pilihan program alumni.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.program-master.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle"></i>
                    Tambah Program
                </a>

            </div>

        </div>


        {{-- ALERT --}}
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


        {{-- TABLE --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-mortarboard"></i>

                        <span>
                            Daftar Program
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar program yang tersedia.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Program
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="120" class="text-end">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($programs as $item)

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
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.program-master.edit', $item->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.program-master.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus program ini?')"
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

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-mortarboard"
                                            style="font-size:40px;"
                                        ></i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada program
                                        </p>

                                        <p class="small mb-3">
                                            Silakan tambahkan program pertama.
                                        </p>

                                        <a
                                            href="{{ route('admin.program-master.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-plus-circle"></i>
                                            Tambah Program
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