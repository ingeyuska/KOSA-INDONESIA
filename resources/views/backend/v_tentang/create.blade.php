@extends('backend.v_layout.app')

@section('title', 'Tambah Tentang KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="h3 mb-1">
            Tambah Tentang KOSA
        </h1>

        <p class="text-muted mb-0">
            Tambahkan informasi mengenai KOSA Indonesia.
        </p>
    </div>


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Terdapat kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Informasi Tentang KOSA
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.tentang.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- JUDUL --}}
                <div class="mb-4">

                    <label
                        for="judul"
                        class="form-label"
                    >
                        Judul
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Tentang KOSA Indonesia"
                        required
                    >

                    @error('judul')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label
                        for="deskripsi"
                        class="form-label"
                    >
                        Deskripsi
                        <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="8"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Tuliskan informasi mengenai KOSA Indonesia..."
                        required
                    >{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- FOTO --}}
                <div class="mb-4">

                    <label
                        for="foto"
                        class="form-label"
                    >
                        Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>

                    @error('foto')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- PREVIEW FOTO --}}
                <div
                    class="mb-4"
                    id="preview-container"
                    style="display:none;"
                >

                    <label class="form-label">
                        Preview Foto
                    </label>

                    <div>

                        <img
                            id="preview-image"
                            src="#"
                            alt="Preview"
                            style="
                                width: 200px;
                                height: 140px;
                                object-fit: cover;
                                border-radius: 8px;
                                border: 1px solid #ddd;
                            "
                        >

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.tentang.index') }}"
                        class="btn btn-secondary"
                    >

                        <i class="fa-solid fa-arrow-left me-1"></i>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fa-solid fa-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PREVIEW IMAGE --}}
<script>

document.getElementById('foto').addEventListener('change', function(event) {

    const file = event.target.files[0];

    const previewContainer =
        document.getElementById('preview-container');

    const previewImage =
        document.getElementById('preview-image');


    if (file) {

        const reader = new FileReader();

        reader.onload = function(e) {

            previewImage.src = e.target.result;

            previewContainer.style.display = 'block';

        };

        reader.readAsDataURL(file);

    } else {

        previewImage.src = '#';

        previewContainer.style.display = 'none';

    }

});

</script>

@endsection