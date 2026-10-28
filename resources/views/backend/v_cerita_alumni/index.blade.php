@extends('backend.v_layout.app')

@section('title', 'Cerita Alumni')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Cerita Alumni
            </h1>

            <p class="text-muted mb-0">
                Kelola cerita dan pengalaman alumni KOSA Indonesia.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.cerita-alumni.create') }}"
               class="btn btn-primary">

                <i class="fas fa-plus me-1"></i>
                Tambah Cerita

            </a>
        </div>

    </div>


    {{-- =========================
        ALERT SUCCESS
    ========================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
        ALERT ERROR
    ========================= --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
        TABLE
    ========================= --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="ceritaAlumniTable"
                    class="table table-hover align-middle data-table"
                    style="width:100%;"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="100">
                                Foto
                            </th>

                            <th>
                                Nama Alumni
                            </th>

                            <th>
                                Program
                            </th>

                            <th>
                                Cerita
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="150" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($ceritaAlumnis as $cerita)

                            <tr>

                                {{-- =========================
                                    NO
                                ========================= --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- =========================
                                    FOTO
                                ========================= --}}
                                <td>

                                    @if($cerita->foto)

                                        <img
                                            src="{{ asset('storage/' . $cerita->foto) }}"
                                            alt="{{ $cerita->alumni->nama ?? 'Alumni KOSA Indonesia' }}"
                                            width="65"
                                            height="65"
                                            style="
                                                object-fit: cover;
                                                border-radius: 10px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width: 65px;
                                                height: 65px;
                                                border-radius: 10px;
                                            "
                                        >
                                            <i class="fas fa-user-graduate text-muted"></i>
                                        </div>

                                    @endif

                                </td>


                                {{-- =========================
                                    NAMA ALUMNI
                                ========================= --}}
                                <td>

                                    <strong>
                                        {{ $cerita->alumni->nama ?? '-' }}
                                    </strong>

                                </td>


                                {{-- =========================
                                    PROGRAM
                                ========================= --}}
                                <td>

                                    @if($cerita->alumni?->program)

                                        <span class="badge bg-info">
                                            {{ $cerita->alumni->program }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- =========================
                                    CERITA
                                ========================= --}}
                                <td>

                                    {{ Str::limit($cerita->cerita, 100) }}

                                </td>


                                {{-- =========================
                                    STATUS
                                ========================= --}}
                                <td>

                                    @if($cerita->status)

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                {{-- =========================
                                    AKSI
                                ========================= --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.cerita-alumni.edit', $cerita->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.cerita-alumni.destroy', $cerita->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus cerita alumni ini?')"
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

        </div>

    </div>

</div>

@endsection