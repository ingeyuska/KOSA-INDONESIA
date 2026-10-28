@extends('backend.v_layout.app')

@section('title', 'Tambah Cerita Alumni')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="mb-4">

        <h1 class="h3 mb-1">
            Tambah Cerita Alumni
        </h1>

        <p class="text-muted mb-0">
            Tambahkan cerita dan pengalaman alumni KOSA Indonesia.
        </p>

    </div>


    {{-- =========================
        VALIDATION ERROR
    ========================= --}}
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


    {{-- =========================
        FORM
    ========================= --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">
                Form Cerita Alumni
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.cerita-alumni.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label for="nama" class="form-label">
                        Nama Alumni
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama alumni"
                    >

                    @error('nama')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

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
                        class="form-control @error('program') is-invalid @enderror"
                        value="{{ old('program') }}"
                        placeholder="Contoh: KOICA Degree Program"
                    >

                    @error('program')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- FOTO --}}
                <div class="mb-3">

                    <label for="foto" class="form-label">
                        Foto Alumni
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
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
                        placeholder="Tuliskan pengalaman atau cerita alumni..."
                    >{{ old('cerita') }}</textarea>

                    @error('cerita')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label for="status" class="form-label">
                        Status
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                    >

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option
                            value="1"
                            {{ old('status') === '1' ? 'selected' : '' }}
                        >
                            Aktif
                        </option>

                        <option
                            value="0"
                            {{ old('status') === '0' ? 'selected' : '' }}
                        >
                            Tidak Aktif
                        </option>

                    </select>

                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

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

                        Simpan Cerita

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection