@extends('backend.v_layout.app')

@section('title', 'Edit Tentang KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h1 class="h3 mb-1">
            Edit Tentang KOSA
        </h1>

        <p class="text-muted mb-0">
            Perbarui informasi mengenai KOSA Indonesia.
        </p>

    </div>


    {{-- ERROR --}}
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
                Edit Informasi Tentang KOSA
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.tentang.update', $tentang->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


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
                        value="{{ old('judul', $tentang->judul) }}"
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
                        required
                    >{{ old('deskripsi', $tentang->deskripsi) }}</textarea>

                    @error('deskripsi')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- FOTO LAMA --}}
                <div class="mb-4">

                    <label class="form-label">
                        Foto Saat Ini
                    </label>

                    <div>

                        @if($tentang->foto)

                            <img
                                src="{{ asset('storage/' . $tentang->foto) }}"
                                alt="{{ $tentang->judul }}"
                                style="
                                    width: 220px;
                                    height: 150px;
                                    object-fit: cover;
                                    border-radius: 8px;
                                    border: 1px solid #ddd;
                                "
                            >

                        @else

                            <div
                                class="bg-light d-flex align-items-center justify-content-center"
                                style="
                                    width:220px;
                                    height:150px;
                                    border-radius:8px;
                                "
                            >

                                <span class="text-muted">
                                    Belum ada foto
                                </span>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- FOTO BARU --}}
                <div class="mb-4">

                    <label
                        for="foto"
                        class="form-label"
                    >
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>

                    @error('foto')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- PREVIEW FOTO BARU --}}
                <div
                    class="mb-4"
                    id="preview-container"
                    style="display:none;"
                >

                    <label class="form-label">
                        Preview Foto Baru
                    </label>

                    <div>

                        <img
                            id="preview-image"
                            src="#"
                            alt="Preview"
                            style="
                                width:220px;
                                height:150px;
                                object-fit:cover;
                                border-radius:8px;
                                border:1px solid #ddd;
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

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PREVIEW FOTO --}}
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