@extends('backend.v_layout.app')

@section('title', 'Tambah Berita')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">
            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-newspaper"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">Content Management</p>

                    <h1 class="h3 mb-1">
                        Tambah Berita
                    </h1>

                    <p class="text-muted mb-0">
                        Tambahkan berita baru ke website KOSA.
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
                    Data belum dapat disimpan.
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-pencil-square"></i>

                        <span>
                            Form Berita
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Isi informasi berita dengan lengkap.
                    </p>

                </div>

            </div>


            <form
                id="formBerita"
                action="{{ route('admin.berita.store') }}"
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
                            Judul Berita
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
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
                            id="isi"
                            name="isi"
                            class="form-control"
                            rows="12"
                        >{{ old('isi') }}</textarea>

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

                        <input
                            type="file"
                            class="form-control"
                            id="gambar"
                            name="gambar"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small class="text-muted">
                            Format JPG, JPEG, PNG atau WEBP.
                            Maksimal 2 MB.
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
                                {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                {{ old('status') == 'published' ? 'selected' : '' }}
                            >
                                Published
                            </option>

                        </select>

                    </div>


                    {{-- TANGGAL --}}
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
                            value="{{ old('tanggal_publish') }}"
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
                        id="btnSimpan"
                    >

                        <i class="bi bi-check-circle"></i>

                        Simpan Berita

                    </button>

                </div>

            </form>

        </section>

    </div>
</main>


{{-- =========================================================
     CKEDITOR
========================================================= --}}

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

    let beritaEditor = null;


    /*
    |--------------------------------------------------------------------------
    | CUSTOM UPLOAD ADAPTER
    |--------------------------------------------------------------------------
    */

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


                    fetch(
                        "{{ route('admin.berita.upload-image') }}",
                        {
                            method: 'POST',
                            body: data,
                            headers: {
                                'Accept': 'application/json'
                            }
                        }
                    )

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


    /*
    |--------------------------------------------------------------------------
    | CKEDITOR UPLOAD PLUGIN
    |--------------------------------------------------------------------------
    */

    function MyCustomUploadAdapterPlugin(editor) {

        editor.plugins
            .get('FileRepository')
            .createUploadAdapter = (loader) => {

                return new MyUploadAdapter(loader);

            };

    }


    /*
    |--------------------------------------------------------------------------
    | INIT CKEDITOR
    |--------------------------------------------------------------------------
    */

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

        const form = document.querySelector('#formBerita');

        form.addEventListener('submit', function (e) {

            // Ambil isi CKEditor
            const data = editor.getData();

            // Masukkan ke textarea
            document.querySelector('#isi').value = data;

            // Cek isi berita
            if (!data.trim()) {
                e.preventDefault();

                alert('Isi berita belum diisi.');

                return;
            }

            // Tombol loading
            const button = document.querySelector('#btnSimpan');

            button.disabled = true;

            button.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1"></span>
                Menyimpan...
            `;
        });

    })
    .catch(error => {
        console.error('CKEditor error:', error);
    });

</script>

@endsection