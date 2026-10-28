@extends('backend.v_layout.app')

@section('title', 'Tambah Pengurus')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="h3 mb-1">
            Tambah Pengurus KOSA
        </h1>

        <p class="text-muted mb-0">
            Tambahkan data pengurus KOSA Indonesia.
        </p>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.pengurus.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama Pengurus
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Nama Lengkap"
                    >

                </div>


                {{-- JABATAN --}}
                <div class="mb-3">

                    <label class="form-label">
                        Jabatan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        class="form-control"
                        value="{{ old('jabatan') }}"
                        placeholder="Contoh: Ketua KOSA Indonesia"
                    >

                </div>


                {{-- FOTO --}}
                <div class="mb-3">

                    <label class="form-label">
                        Foto Pengurus
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Maksimal 2 MB.
                    </small>

                </div>


                {{-- URUTAN --}}
                <div class="mb-3">

                    <label class="form-label">
                        Urutan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="urutan"
                        class="form-control"
                        value="{{ old('urutan', 1) }}"
                        min="0"
                    >

                    <small class="text-muted">
                        Contoh: Ketua = 1, Wakil = 2, Sekretaris = 3, Bendahara = 4.
                    </small>

                </div>


                {{-- STATUS --}}
                <div class="mb-4">

                    <label class="form-label">
                        Status
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="1">
                            Aktif
                        </option>

                        <option value="0">
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.pengurus.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fas fa-save me-1"></i>
                        Simpan Pengurus
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection