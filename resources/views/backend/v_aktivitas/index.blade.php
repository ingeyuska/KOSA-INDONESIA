@extends('backend.v_layout.app')

@section('title', 'Data Aktivitas')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-activity"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Aktivitas
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola aktivitas dan kegiatan KOSA.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.aktivitas.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle"></i>
                    Tambah Aktivitas
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

                        <i class="bi bi-activity"></i>

                        <span>
                            Daftar Aktivitas
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar aktivitas yang tersedia di sistem.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table
                    id="aktivitasTable"
                    class="table table-hover align-middle mb-0 data-table"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="100">
                                Gambar
                            </th>

                            <th>
                                Judul
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="150" class="text-end">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($aktivitas as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- GAMBAR --}}
                                <td>

                                    @if($item->gambar)

                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->judul }}"
                                            style="
                                                width:70px;
                                                height:50px;
                                                object-fit:cover;
                                                border-radius:8px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center"
                                            style="
                                                width:70px;
                                                height:50px;
                                                background:#f1f3f5;
                                                border-radius:8px;
                                            "
                                        >
                                            <i class="bi bi-image text-muted"></i>
                                        </div>

                                    @endif

                                </td>


                                {{-- JUDUL --}}
                                <td>

                                    <p class="fw-semibold mb-1">
                                        {{ $item->judul }}
                                    </p>

                                    <p class="text-muted small mb-0">
                                        {{ Str::limit($item->deskripsi, 80) }}
                                    </p>

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    @if($item->tanggal)

                                        {{ $item->tanggal->format('d M Y') }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($item->status === 'published')

                                        <span class="badge text-bg-success">
                                            Published
                                        </span>

                                    @else

                                        <span class="badge text-bg-warning">
                                            Draft
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.aktivitas.edit', ['aktivita' => $item->id]) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.aktivitas.destroy', ['aktivita' => $item->id]) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')"
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