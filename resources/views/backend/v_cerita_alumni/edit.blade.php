@extends('backend.v_layout.app')

@section('title', 'Edit Cerita Alumni')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h1 class="h3 mb-1">
            Edit Cerita Alumni
        </h1>

        <p class="text-muted mb-0">
            Perbarui cerita dan informasi alumni KOSA Indonesia.
        </p>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Terjadi kesalahan:
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
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">
                Form Edit Cerita Alumni
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.cerita-alumni.update', $ceritaAlumni->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


               {{-- NAMA --}}
<div class="mb-3">

    <label for="nama" class="form-label">
        Nama Alumni
    </label>

    <input
        type="text"
        name="nama"
        id="nama"
        class="form-control"
        value="{{ $ceritaAlumni->alumni->nama ?? '-' }}"
        readonly
    >

</div>


{{-- PROGRAM --}}
<div class="mb-3">

    <label for="program" class="form-label">
        Program
    </label>

    <input
        type="text"
        name="program"
        id="program"
        class="form-control"
        value="{{ $ceritaAlumni->alumni->program ?? '-' }}"
        readonly
    >

</div>


                {{-- FOTO LAMA --}}
                @if($ceritaAlumni->foto)

                    <div class="mb-3">

                        <label class="form-label">
                            Foto Saat Ini
                        </label>

                        <div>

                            <img
                                src="{{ asset('storage/' . $ceritaAlumni->foto) }}"
                                alt="{{ $ceritaAlumni->nama }}"
                                style="
                                    width: 120px;
                                    height: 120px;
                                    object-fit: cover;
                                    border-radius: 12px;
                                "
                            >

                        </div>

                    </div>

                @endif


                {{-- FOTO BARU --}}
                <div class="mb-3">

                    <label for="foto" class="form-label">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                        Maksimal 2 MB.
                    </small>

                    @error('foto')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- CERITA --}}
                <div class="mb-3">

                    <label for="cerita" class="form-label">
                        Cerita Alumni
                        <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="cerita"
                        id="cerita"
                        rows="7"
                        class="form-control @error('cerita') is-invalid @enderror"
                    >{{ old('cerita', $ceritaAlumni->cerita) }}</textarea>

                    @error('cerita')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <div>
                        <span class="badge bg-success">
                            Aktif
                        </span>
                    </div>

                    <input type="hidden" name="status" value="1">

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.cerita-alumni.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-save me-1"></i>

                        Update Cerita

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection