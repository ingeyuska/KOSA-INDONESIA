@extends('backend.v_layout.app')

@section('title', 'Tambah Galeri')

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
                        Tambah Galeri
                    </h1>

                    <p class="text-muted mb-0">
                        Buat album baru dan tambahkan beberapa foto sekaligus.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="btn btn-outline-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>


        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert alert-danger mt-3">

                <strong>
                    Data belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

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
                            Form Tambah Galeri
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Isi informasi galeri dan pilih foto yang ingin dimasukkan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.galeri.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="p-4">

                    <div class="row g-3">

                        {{-- JUDUL --}}
                        <div class="col-md-8">

                            <label
                                for="judul"
                                class="form-label"
                            >
                                Judul Galeri
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="judul"
                                name="judul"
                                value="{{ old('judul') }}"
                                placeholder="Contoh: Dies Natalis KOSA 2026"
                                required
                            >

                        </div>


                        {{-- TANGGAL --}}
                        <div class="col-md-4">

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
                        <div class="col-md-4">

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
                                    {{ old('status', 'published') === 'published' ? 'selected' : '' }}
                                >
                                    Published
                                </option>

                                <option value="draft"
                                    {{ old('status') === 'draft' ? 'selected' : '' }}
                                >
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
                                rows="4"
                                placeholder="Masukkan deskripsi galeri..."
                            >{{ old('deskripsi') }}</textarea>

                        </div>


                        {{-- FOTO --}}
                        <div class="col-12">

                            <label
                                for="foto"
                                class="form-label"
                            >
                                Foto Galeri
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                id="foto"
                                name="foto[]"
                                accept="image/jpeg,image/png,image/webp"
                                multiple
                                required
                            >

                            <small class="text-muted">
                                Bisa memilih beberapa foto sekaligus.
                                Format JPG, JPEG, PNG, atau WEBP.
                                Maksimal 2 MB per foto.
                            </small>

                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a
                            href="{{ route('admin.galeri.index') }}"
                            class="btn btn-light"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Simpan Galeri

                        </button>

                    </div>

                </div>

            </form>

        </section>

    </div>
</main>

@endsection