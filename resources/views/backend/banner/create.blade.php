@extends('backend.v_layout.app')

@section('title', 'Tambah Banner')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h4>Tambah Banner</h4>
        <p class="text-muted">
            Tambahkan banner baru untuk halaman Beranda.
        </p>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

        <form
            action="{{ route('admin.banner.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            {{-- FOTO --}}
            <div class="mb-3">

                <label class="form-label">
                    Upload Foto
                </label>

                <input
                    type="file"
                    name="foto"
                    class="form-control"
                    accept="image/*"
                    required
                >

                <small class="text-muted">
                    Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                </small>

                @error('foto')
                    <br>
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            <div class="row">

                {{-- URUTAN --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Urutan
                    </label>

                    <input
                        type="number"
                        name="urutan"
                        class="form-control"
                        value="{{ old('urutan', 1) }}"
                        min="1"
                        required
                    >

                </div>


                {{-- STATUS --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control"
                        required
                    >
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                    </select>

                </div>

            </div>


            <div class="mt-4">

                <a
                    href="{{ route('admin.banner.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="fa-solid fa-upload"></i>
                    Upload Foto
                </button>

            </div>

        </form> 

        </div>

    </div>

</div>

@endsection