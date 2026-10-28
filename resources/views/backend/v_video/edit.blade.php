@extends('backend.v_layout.app')

@section('title', 'Edit Video')

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
                        Edit Video
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi video.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.video.index') }}"
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

                        <i class="bi bi-camera-video"></i>

                        <span>
                            Form Edit Video
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Perbarui data video sesuai kebutuhan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.video.update', ['video' => $video->id]) }}"
                method="POST"
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
                            Judul Video
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $video->judul) }}"
                            required
                        >

                    </div>


                    {{-- URL VIDEO --}}
                    <div class="col-md-8">

                        <label
                            for="url_video"
                            class="form-label"
                        >
                            URL Video
                        </label>

                        <input
                            type="url"
                            class="form-control"
                            id="url_video"
                            name="url_video"
                            value="{{ old('url_video', $video->url_video) }}"
                            required
                        >

                        <small class="text-muted">
                            Masukkan URL YouTube atau platform video lainnya.
                        </small>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="col-md-2">

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
                            value="{{ old('tanggal', $video->tanggal?->format('Y-m-d')) }}"
                        >

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-2">

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
                                {{ old('status', $video->status) === 'published' ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="draft"
                                {{ old('status', $video->status) === 'draft' ? 'selected' : '' }}>
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
                            placeholder="Masukkan deskripsi video"
                        >{{ old('deskripsi', $video->deskripsi) }}</textarea>

                    </div>


                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.video.index') }}"
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