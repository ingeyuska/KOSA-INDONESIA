@extends('backend.v_layout.app')

@section('title', 'Galeri Foto')

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
                        Galeri
                    </p>

                    <h1 class="h3 mb-1">
                        Galeri Foto
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola album dan kumpulan foto kegiatan KOSA.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.galeri.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Galeri
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


        {{-- ERROR --}}
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


        {{-- PANEL --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>
                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-images"></i>

                        <span>
                            Daftar Galeri
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Satu galeri dapat memiliki beberapa foto.
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
                                Judul Galeri
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Jumlah Foto
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

                        @forelse($galeri as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- JUDUL --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $item->judul }}
                                    </div>

                                    @if($item->deskripsi)

                                        <small class="text-muted">
                                            {{ Str::limit($item->deskripsi, 80) }}
                                        </small>

                                    @endif

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


                                {{-- JUMLAH FOTO --}}
                                <td>

                                    <span class="badge text-bg-light">

                                        <i class="bi bi-images me-1"></i>

                                        {{ $item->foto_count }} Foto

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($item->status === 'published')

                                        <span class="badge text-bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Published

                                        </span>

                                    @else

                                        <span class="badge text-bg-secondary">

                                            <i class="bi bi-file-earmark me-1"></i>

                                            Draft

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.galeri.show', $item->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Lihat Galeri"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.galeri.edit', $item->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.galeri.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus galeri ini beserta seluruh fotonya?')"
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
                                            style="font-size: 40px;"
                                        ></i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada galeri
                                        </p>

                                        <p class="small mb-3">
                                            Silakan tambahkan galeri pertama.
                                        </p>

                                        <a
                                            href="{{ route('admin.galeri.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >

                                            <i class="bi bi-plus-circle me-1"></i>

                                            Tambah Galeri

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