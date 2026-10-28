@extends('backend.v_layout.app')

@section('title', 'Edit Aktivitas')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Edit Aktivitas
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi aktivitas.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.aktivitas.index') }}"
                    class="btn btn-outline-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="alert alert-danger mt-3">

                <strong>
                    Data belum dapat diperbarui.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-activity"></i>

                        <span>
                            Form Edit Aktivitas
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Perbarui data aktivitas sesuai kebutuhan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.aktivitas.update', ['aktivita' => $aktivita->id]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="row g-3">


                    {{-- JUDUL --}}
                    <div class="col-12">

                        <label
                            for="judul"
                            class="form-label"
                        >
                            Judul Aktivitas
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $aktivita->judul) }}"
                            required
                        >

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="col-12">

                        <label
                            for="deskripsi"
                            class="form-label"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            class="form-control"
                            id="deskripsi"
                            name="deskripsi"
                            rows="7"
                            required
                        >{{ old('deskripsi', $aktivita->deskripsi) }}</textarea>

                    </div>


                    {{-- GAMBAR --}}
                    <div class="col-md-6">

                        <label
                            for="gambar"
                            class="form-label"
                        >
                            Gambar Aktivitas
                        </label>


                        @if($aktivita->gambar)

                            <div class="mb-2">

                                <img
                                    src="{{ asset('storage/' . $aktivita->gambar) }}"
                                    alt="{{ $aktivita->judul }}"
                                    style="
                                        width:180px;
                                        height:110px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    "
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            class="form-control"
                            id="gambar"
                            name="gambar"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="col-md-3">

                        <label
                            for="tanggal"
                            class="form-label"
                        >
                            Tanggal
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal', $aktivita->tanggal?->format('Y-m-d')) }}"
                            required
                        >

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-3">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            class="form-select"
                            id="status"
                            name="status"
                            required
                        >

                            <option value="draft"
                                {{ old('status', $aktivita->status) === 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published"
                                {{ old('status', $aktivita->status) === 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                        </select>

                    </div>


                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.aktivitas.index') }}"
                        class="btn btn-light"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-check-circle"></i>

                        Simpan Perubahan

                    </button>

                </div>


            </form>

        </section>

    </div>
</main>

@endsection