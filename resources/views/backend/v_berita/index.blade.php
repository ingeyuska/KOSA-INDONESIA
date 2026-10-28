@extends('backend.v_layout.app')

@section('title', 'Data Berita')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- =========================
            HEADER
        ========================= --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-newspaper"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Berita
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola berita dan informasi KOSA.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.berita.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Berita
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

                        <i class="bi bi-newspaper me-1"></i>

                        <span>
                            Daftar Berita
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar berita yang tersedia di sistem.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table
                    id="beritaTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%; font-size:13px;"
                >

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th width="90">
                                Gambar
                            </th>

                            <th>
                                Judul
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="140">
                                Tanggal Publish
                            </th>

                            <th width="100" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($berita as $item)

                            <tr>

                                {{-- =====================
                                    NO
                                ====================== --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- =====================
                                    GAMBAR
                                ====================== --}}
                                <td>

                                    @if($item->gambar)

                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->judul }}"
                                            width="70"
                                            height="50"
                                            style="
                                                object-fit: cover;
                                                border-radius: 7px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width:70px;
                                                height:50px;
                                                border-radius:7px;
                                            "
                                        >

                                            <i class="bi bi-image text-muted"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- =====================
                                    JUDUL
                                ====================== --}}
                                <td>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $item->judul }}
                                        </div>

                                        <small class="text-muted">
                                            {{ Str::limit(strip_tags($item->isi), 70) }}
                                        </small>

                                    </div>

                                </td>


                                {{-- =====================
                                    STATUS
                                ====================== --}}
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


                                {{-- =====================
                                    TANGGAL
                                ====================== --}}
                                <td>

                                    @if($item->tanggal_publish)

                                        {{ $item->tanggal_publish->format('d M Y H:i') }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- =====================
                                    AKSI
                                ====================== --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route(
                                                'admin.berita.edit',
                                                ['beritum' => $item->id]
                                            ) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.berita.destroy',
                                                ['beritum' => $item->id]
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')"
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