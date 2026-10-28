@extends('backend.v_layout.app')

@section('title', 'Detail Pesan')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-envelope-open"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Detail Pesan
                    </h1>

                    <p class="text-muted mb-0">
                        Lihat informasi lengkap pesan dari pengunjung.
                    </p>

                </div>

            </div>


            <div class="heading-actions">

                <a
                    href="{{ route('admin.pesan-kontak.index') }}"
                    class="btn btn-outline-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
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


        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-envelope-open"></i>

                        <span>
                            Informasi Pesan
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Detail pesan yang diterima.
                    </p>

                </div>

            </div>


            <div class="p-4">

                {{-- NAMA --}}
                <div class="row mb-3">

                    <div class="col-md-3 fw-semibold">
                        Nama
                    </div>

                    <div class="col-md-9">
                        {{ $pesanKontak->nama }}
                    </div>

                </div>


                {{-- EMAIL --}}
                <div class="row mb-3">

                    <div class="col-md-3 fw-semibold">
                        Email
                    </div>

                    <div class="col-md-9">

                        <a href="mailto:{{ $pesanKontak->email }}">
                            {{ $pesanKontak->email }}
                        </a>

                    </div>

                </div>


                {{-- SUBJEK --}}
                <div class="row mb-3">

                    <div class="col-md-3 fw-semibold">
                        Subjek
                    </div>

                    <div class="col-md-9">

                        {{ $pesanKontak->subjek ?? '-' }}

                    </div>

                </div>


                {{-- TANGGAL --}}
                <div class="row mb-3">

                    <div class="col-md-3 fw-semibold">
                        Tanggal
                    </div>

                    <div class="col-md-9">

                        {{ $pesanKontak->created_at->format('d M Y H:i') }}

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="row mb-4">

                    <div class="col-md-3 fw-semibold">
                        Status
                    </div>

                    <div class="col-md-9">

                        @if($pesanKontak->status === 'baru')

                            <span class="badge text-bg-primary">
                                Baru
                            </span>

                        @elseif($pesanKontak->status === 'dibaca')

                            <span class="badge text-bg-warning">
                                Dibaca
                            </span>

                        @else

                            <span class="badge text-bg-success">
                                Dibalas
                            </span>

                        @endif

                    </div>

                </div>


                <hr>


                {{-- PESAN --}}
                <div class="mt-4">

                    <h3 class="h6 fw-bold mb-3">
                        Isi Pesan
                    </h3>

                    <div
                        class="p-3 rounded border bg-light"
                        style="white-space: pre-line;"
                    >
                        {{ $pesanKontak->pesan }}
                    </div>

                </div>


                {{-- UBAH STATUS --}}
                <div class="mt-4">

                    <h3 class="h6 fw-bold mb-3">
                        Ubah Status Pesan
                    </h3>


                    <form
                        action="{{ route('admin.pesan-kontak.status', ['pesanKontak' => $pesanKontak->id]) }}"
                        method="POST"
                        class="row g-2 align-items-end"
                    >

                        @csrf

                        @method('PUT')


                        <div class="col-md-4">

                            <label
                                for="status"
                                class="form-label"
                            >
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="baru"
                                    {{ $pesanKontak->status === 'baru' ? 'selected' : '' }}
                                >
                                    Baru
                                </option>

                                <option
                                    value="dibaca"
                                    {{ $pesanKontak->status === 'dibaca' ? 'selected' : '' }}
                                >
                                    Dibaca
                                </option>

                                <option
                                    value="dibalas"
                                    {{ $pesanKontak->status === 'dibalas' ? 'selected' : '' }}
                                >
                                    Dibalas
                                </option>

                            </select>

                        </div>


                        <div class="col-md-auto">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-check-circle"></i>

                                Simpan Status

                            </button>

                        </div>

                    </form>

                </div>


                {{-- ACTION --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="mailto:{{ $pesanKontak->email }}?subject={{ rawurlencode('Re: ' . ($pesanKontak->subjek ?? 'Pesan Kontak')) }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-reply"></i>

                        Balas Email

                    </a>


                    <form
                        action="{{ route('admin.pesan-kontak.destroy', ['pesanKontak' => $pesanKontak->id]) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus pesan ini?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger"
                        >

                            <i class="bi bi-trash"></i>

                            Hapus

                        </button>

                    </form>

                </div>

            </div>

        </section>

    </div>
</main>

@endsection