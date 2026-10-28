@extends('backend.v_layout.app')

@section('title', 'Data Alumni')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-people"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Alumni Management
                    </p>

                    <h1 class="h3 mb-1">
                        Alumni
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola data alumni KOSA Indonesia.
                    </p>

                </div>

            </div>


         <div class="heading-actions d-flex gap-2">

    <a
        href="{{ route('admin.alumni.export') }}"
        class="btn btn-success btn-sm"
    >
        <i class="bi bi-file-earmark-excel"></i>
        Export Excel
    </a>

    <a
        href="{{ route('admin.alumni.create') }}"
        class="btn btn-primary btn-sm"
    >
        <i class="bi bi-plus-circle"></i>
        Tambah Alumni
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

                        <i class="bi bi-people"></i>

                        <span>
                            Daftar Alumni
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Daftar alumni yang terdaftar dalam sistem.
                    </p>

                </div>

            </div>


            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                         <table class="table table-hover align-middle data-table"
                             style="width:80%;">

                        <thead>

                            <tr>

                                <th width="60">
                                    No
                                </th>

                                <th width="90">
                                    Foto
                                </th>

                                <th>
                                    Nama
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Program
                                </th>

                                <th>
                                    Klasifikasi
                                </th>

                                <th>
                                    Institusi
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

                            @forelse($alumni as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- FOTO --}}
                                    <td>

                                        @if($item->foto)

                                            <img
                                                src="{{ asset('storage/' . $item->foto) }}"
                                                alt="{{ $item->nama }}"
                                                style="
                                                    width:50px;
                                                    height:50px;
                                                    object-fit:cover;
                                                    border-radius:50%;
                                                "
                                            >

                                        @else

                                            <div
                                                class="d-flex align-items-center justify-content-center"
                                                style="
                                                    width:50px;
                                                    height:50px;
                                                    background:#f1f3f5;
                                                    border-radius:50%;
                                                "
                                            >

                                                <i class="bi bi-person text-muted"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- NAMA --}}
                                    <td>

                                        <div>

                                            <p class="fw-semibold mb-1">
                                                {{ $item->nama }}
                                            </p>

                                            <p class="text-muted small mb-0">
                                                Angkatan:
                                                {{ $item->angkatan ?? '-' }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- EMAIL --}}
                                    <td>

                                        {{ $item->email }}

                                    </td>


                                    {{-- PROGRAM --}}
                                    <td>

                                        @if($item->program)

                                            <span class="badge text-bg-primary">
                                                {{ $item->program }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- KLASIFIKASI --}}
                                    <td>

                                        @if($item->klasifikasi_program)

                                            <span class="badge text-bg-info">
                                                {{ $item->klasifikasi_program }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- INSTITUSI --}}
                                    <td>

                                        @if($item->institusi)

                                            {{ $item->institusi }}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($item->status === 'aktif')

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
                                                href="{{ route('admin.alumni.edit', ['alumni' => $item->id]) }}"
                                                class="btn btn-light btn-sm"
                                                title="Edit"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.alumni.destroy', ['alumni' => $item->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data alumni ini?')"
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
                                        colspan="9"
                                        class="text-center py-5"
                                    >

                                        <div class="text-muted">

                                            <i
                                                class="bi bi-people"
                                                style="font-size:40px;"
                                            ></i>

                                            <p class="mt-2 mb-1 fw-semibold">
                                                Belum ada alumni
                                            </p>

                                            <p class="small mb-3">
                                                Silakan tambahkan data alumni pertama.
                                            </p>

                                            <a
                                                href="{{ route('admin.alumni.create') }}"
                                                class="btn btn-primary btn-sm"
                                            >

                                                <i class="bi bi-plus-circle"></i>

                                                Tambah Alumni

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                    </div>
                </div>

            </div>

        </section>

    </div>

</main>

@endsection