@extends('backend.v_layout.app')

@section('title', 'Edit Berita')

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
                    <p class="eyebrow mb-1">Content Management</p>

                    <h1 class="h3 mb-1">
                        Edit Berita
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi berita.
                    </p>
                </div>

            </div>

            <div class="heading-actions">

                <a
                    href="{{ route('admin.berita.index') }}"
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

                        <i class="bi bi-newspaper"></i>

                        <span>
                            Form Edit Berita
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Perbarui data berita sesuai kebutuhan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('admin.berita.update', $berita->id) }}"
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
                            Judul Berita
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $berita->judul) }}"
                            placeholder="Masukkan judul berita"
                            required
                        >

                    </div>


                    {{-- ISI BERITA --}}
                    <div class="col-12">

                        <label
                            for="isi"
                            class="form-label"
                        >
                            Isi Berita
                        </label>

                        <textarea
                            class="form-control"
                            id="isi"
                            name="isi"
                            rows="12"
                            required
                        >{{ old('isi', $berita->isi) }}</textarea>

                        @error('isi')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- GAMBAR COVER --}}
                    <div class="col-md-6">

                        <label
                            for="gambar"
                            class="form-label"
                        >
                            Gambar Berita
                        </label>

                        @if($berita->gambar)

                            <div class="mb-2">

                                <img
                                    src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
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

                            <option
                                value="draft"
                                {{ old('status', $berita->status) == 'draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                {{ old('status', $berita->status) == 'published' ? 'selected' : '' }}
                            >
                                Published
                            </option>

                        </select>

                    </div>


                    {{-- TANGGAL PUBLISH --}}
                    <div class="col-md-3">

                        <label
                            for="tanggal_publish"
                            class="form-label"
                        >
                            Tanggal Publish
                        </label>

                        <input
                            type="datetime-local"
                            class="form-control"
                            id="tanggal_publish"
                            name="tanggal_publish"
                            value="{{ old(
                                'tanggal_publish',
                                $berita->tanggal_publish
                                    ? $berita->tanggal_publish->format('Y-m-d\TH:i')
                                    : ''
                            ) }}"
                        >

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.berita.index') }}"
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


{{-- =========================================================
     CKEDITOR 5
========================================================= --}}

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

    class MyUploadAdapter {

        constructor(loader) {
            this.loader = loader;
        }

        upload() {

            return this.loader.file.then(file => {

                return new Promise((resolve, reject) => {

                    const data = new FormData();

                    data.append('upload', file);

                    data.append(
                        '_token',
                        document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    );

                    fetch("{{ route('admin.berita.upload-image') }}", {
                        method: 'POST',
                        body: data,
                        headers: {
                            'Accept': 'application/json'
                        }
                    })

                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal mengupload gambar.'
                            );
                        }

                        return response.json();

                    })

                    .then(result => {

                        resolve({
                            default: result.url
                        });

                    })

                    .catch(error => {

                        console.error(error);

                        reject(error);

                    });

                });

            });

        }

        abort() {
            // Upload dibatalkan
        }
    }


    function MyCustomUploadAdapterPlugin(editor) {

        editor.plugins
            .get('FileRepository')
            .createUploadAdapter = (loader) => {

                return new MyUploadAdapter(loader);

            };

    }


    ClassicEditor
        .create(document.querySelector('#isi'), {

            extraPlugins: [
                MyCustomUploadAdapterPlugin
            ],

            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'blockQuote',
                'insertTable',
                'uploadImage',
                '|',
                'undo',
                'redo'
            ]

        })

        .then(editor => {

            console.log('CKEditor berhasil aktif.');

        })

        .catch(error => {

            console.error(
                'CKEditor error:',
                error
            );

        });

</script>

@endsection