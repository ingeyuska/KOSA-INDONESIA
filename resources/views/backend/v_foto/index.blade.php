@extends('backend.v_layout.app')

@section('title', 'Data Foto')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-images"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Foto
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola foto dan dokumentasi KOSA.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.foto.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle"></i>
                    Tambah Foto
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

                        <i class="bi bi-images"></i>

                        <span>
                            Daftar Foto
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar foto yang tersedia di sistem.
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

                            <th width="120">
                                Foto
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

                        @forelse($foto as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- FOTO --}}
                                <td>

                                    @if($item->file_foto)

                                        <img
                                            src="{{ asset('storage/' . $item->file_foto) }}"
                                            alt="{{ $item->judul }}"
                                            style="
                                                width:80px;
                                                height:55px;
                                                object-fit:cover;
                                                border-radius:8px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center"
                                            style="
                                                width:80px;
                                                height:55px;
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

                                    <div>

                                        <p class="fw-semibold mb-1">
                                            {{ $item->judul }}
                                        </p>

                                        <p class="text-muted small mb-0">
                                            {{ Str::limit($item->deskripsi, 80) }}
                                        </p>

                                    </div>

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
                                            href="{{ route('admin.foto.edit', ['foto' => $item->id]) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.foto.destroy', ['foto' => $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
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
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-images"
                                            style="font-size:40px;"
                                        ></i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada foto
                                        </p>

                                        <p class="small mb-3">
                                            Silakan tambahkan foto pertama.
                                        </p>

                                        <a
                                            href="{{ route('admin.foto.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-plus-circle"></i>
                                            Tambah Foto
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