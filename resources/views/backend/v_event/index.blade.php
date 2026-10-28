@extends('backend.v_layout.app')

@section('title', 'Event')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-bold">
                <i class="bi bi-calendar-event text-primary me-2"></i>
                Event
            </h4>

            <p class="text-muted mb-0">
                Kelola event KOSA Indonesia
            </p>
        </div>


        <a
            href="{{ route('admin.event.create') }}"
            class="btn btn-primary btn-sm"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Event
        </a>

    </div>


    {{-- =========================
        ALERT SUCCESS
    ========================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

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

        <div class="alert alert-danger alert-dismissible fade show">

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
        VALIDATION ERROR
    ========================= --}}
    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    {{-- =========================
        TABLE
    ========================= --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <div>

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-calendar-event text-primary me-2"></i>
                    Daftar Event
                </h5>

                <small class="text-muted">
                    Daftar event KOSA Indonesia yang tersedia.
                </small>

            </div>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="eventTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%; font-size:13px;"
                >

                    <thead>

                        <tr>

                            <th width="45">
                                No
                            </th>

                            <th width="85">
                                Foto
                            </th>

                            <th>
                                Judul
                            </th>

                            <th width="110">
                                Tanggal
                            </th>

                            <th width="80">
                                Waktu
                            </th>

                            <th>
                                Lokasi
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="120" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($events as $event)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- FOTO --}}
                                <td>

                                    @if($event->foto)

                                        <img
                                            src="{{ asset('storage/' . $event->foto) }}"
                                            alt="{{ $event->judul }}"
                                            width="65"
                                            height="45"
                                            style="
                                                object-fit: cover;
                                                border-radius: 7px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width:65px;
                                                height:45px;
                                                border-radius:7px;
                                            "
                                        >
                                            <i class="bi bi-image text-muted"></i>
                                        </div>

                                    @endif

                                </td>


                                {{-- JUDUL --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $event->judul }}
                                    </div>

                                    @if($event->deskripsi)

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($event->deskripsi, 55) }}
                                        </small>

                                    @endif

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    @if($event->tanggal)

                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- WAKTU --}}
                                <td>
                                    {{ $event->waktu ?: '-' }}
                                </td>


                                {{-- LOKASI --}}
                                <td>

                                    {{ $event->lokasi ?: '-' }}

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($event->tanggal && \Carbon\Carbon::parse($event->tanggal)->lt(\Carbon\Carbon::today()))

                                        <span class="badge bg-secondary">
                                            Selesai
                                        </span>

                                    @else

                                        <span class="badge bg-primary">
                                            Akan Datang
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- PENDAFTAR --}}
                                        <a
                                            href="{{ route('admin.event.pendaftar', $event->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Lihat Pendaftar"
                                        >
                                            <i class="bi bi-people"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.event.edit', $event->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.event.destroy', $event->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus event ini?')"
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