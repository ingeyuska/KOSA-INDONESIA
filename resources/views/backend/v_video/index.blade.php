@extends('backend.v_layout.app')

@section('title', 'Data Video')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-camera-video"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Video
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola video dan dokumentasi KOSA.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.video.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle"></i>
                    Tambah Video
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

                        <i class="bi bi-camera-video"></i>

                        <span>
                            Daftar Video
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar video yang tersedia di sistem.
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
                                Judul
                            </th>

                            <th>
                                URL Video
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

                        @forelse($video as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
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


                                {{-- URL --}}
                                <td>

                                    <a
                                        href="{{ $item->url_video }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-decoration-none"
                                    >
                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        Lihat Video
                                    </a>

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
                                            href="{{ route('admin.video.edit', $item->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.video.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus video ini?')"
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
                                            class="bi bi-camera-video"
                                            style="font-size:40px;"
                                        ></i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada video
                                        </p>

                                        <p class="small mb-3">
                                            Silakan tambahkan video pertama.
                                        </p>

                                        <a
                                            href="{{ route('admin.video.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-plus-circle"></i>
                                            Tambah Video
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