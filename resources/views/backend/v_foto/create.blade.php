@extends('backend.v_layout.app')

@section('title', 'Tambah Foto')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-plus-circle"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Tambah Foto
                    </h1>

                    <p class="text-muted mb-0">
                        Tambahkan foto dokumentasi KOSA.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.foto.index') }}"
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
                    Data belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-images"></i>

                        <span>
                            Form Tambah Foto
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Isi informasi foto yang akan ditampilkan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.foto.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="row g-3">


                    {{-- JUDUL --}}
                    <div class="col-12">

                        <label
                            for="judul"
                            class="form-label"
                        >
                            Judul Foto
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Masukkan judul foto"
                            required
                        >

                    </div>


                    {{-- FILE FOTO --}}
                    <div class="col-md-6">

                        <label
                            for="file_foto"
                            class="form-label"
                        >
                            File Foto
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="file_foto"
                            name="file_foto"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <small class="text-muted">
                            Format JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
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
                            value="{{ old('tanggal') }}"
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

                            <option value="published"
                                {{ old('status', 'published') === 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="draft"
                                {{ old('status') === 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                        </select>

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
                            rows="6"
                            placeholder="Masukkan deskripsi foto"
                        >{{ old('deskripsi') }}</textarea>

                    </div>


                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.foto.index') }}"
                        class="btn btn-light"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-check-circle"></i>

                        Simpan Foto

                    </button>

                </div>


            </form>

        </section>

    </div>
</main>

@endsection