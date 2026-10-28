@extends('backend.v_layout.app')

@section('title', 'Data Universitas')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-building"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Master Data
                    </p>

                    <h1 class="h3 mb-1">
                        Universitas
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola data universitas alumni KOSA.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.universitas.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle"></i>
                    Tambah Universitas
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


        {{-- TABLE --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-building"></i>

                        <span>
                            Daftar Universitas
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar universitas yang tersedia di sistem.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table
                    id="universitasTable"
                    class="table table-hover align-middle mb-0 data-table"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Universitas
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="150" class="text-end">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($universitas as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA UNIVERSITAS --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $item->nama_universitas }}
                                    </div>

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

                                    <div
                                        class="d-flex justify-content-end gap-1"
                                    >

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.universitas.edit', ['universita' => $item->id]) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.universitas.destroy', ['universita' => $item->id]) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus universitas ini?')"
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