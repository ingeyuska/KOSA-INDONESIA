@extends('backend.v_layout.app')

@section('title', 'Edit Banner')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h4>Edit Banner</h4>
        <p class="text-muted">
            Perbarui informasi dan foto banner Beranda.
        </p>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form
                action="{{ route('admin.banner.update', $banner->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="mb-3">

                    <label class="form-label">
                        Judul Banner
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $banner->judul) }}"
                        placeholder="Contoh: KOSA Indonesia"
                    >

                    @error('judul')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control"
                        placeholder="Deskripsi banner..."
                    >{{ old('deskripsi', $banner->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- FOTO LAMA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Foto Banner Saat Ini
                    </label>

                    <div class="mb-3">

                        <img
                            src="{{ asset('storage/' . $banner->foto) }}"
                            alt="{{ $banner->judul }}"
                            style="
                                width: 300px;
                                height: 160px;
                                object-fit: cover;
                                border-radius: 10px;
                                border: 1px solid #ddd;
                            "
                        >

                    </div>

                </div>


                {{-- GANTI FOTO --}}
                <div class="mb-3">

                    <label class="form-label">
                        Ganti Foto Banner
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
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
                            value="{{ old('urutan', $banner->urutan) }}"
                            min="1"
                            required
                        >

                        @error('urutan')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

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

                            <option
                                value="aktif"
                                {{ old('status', $banner->status) == 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="tidak_aktif"
                                {{ old('status', $banner->status) == 'tidak_aktif' ? 'selected' : '' }}
                            >
                                Tidak Aktif
                            </option>

                        </select>

                        @error('status')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="mt-4">

                    <a
                        href="{{ route('admin.banner.index') }}"
                        class="btn btn-secondary"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa-solid fa-save"></i>
                        Update Banner
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection