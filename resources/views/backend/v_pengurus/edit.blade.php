@extends('backend.v_layout.app')

@section('title', 'Edit Pengurus')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h1 class="h3 mb-1">
            Edit Pengurus KOSA
        </h1>

        <p class="text-muted mb-0">
            Perbarui data pengurus KOSA Indonesia.
        </p>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.pengurus.update', $pengurus->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


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
                        value="{{ old('nama', $pengurus->nama) }}"
                        placeholder="Nama lengkap"
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
                        value="{{ old('jabatan', $pengurus->jabatan) }}"
                        placeholder="Contoh: Ketua KOSA Indonesia"
                    >

                </div>


                {{-- FOTO LAMA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Foto Saat Ini
                    </label>

                    <div>

                        @if($pengurus->foto)

                            <img
                                src="{{ asset('storage/' . $pengurus->foto) }}"
                                alt="{{ $pengurus->nama }}"
                                width="150"
                                height="150"
                                style="
                                    object-fit: cover;
                                    border-radius: 12px;
                                "
                            >

                        @else

                            <div
                                class="bg-light d-flex align-items-center justify-content-center"
                                style="
                                    width:150px;
                                    height:150px;
                                    border-radius:12px;
                                "
                            >

                                <i class="fas fa-user fa-3x text-muted"></i>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- FOTO BARU --}}
                <div class="mb-3">

                    <label class="form-label">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
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
                        value="{{ old('urutan', $pengurus->urutan) }}"
                        min="0"
                    >

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

                        <option
                            value="1"
                            {{ old('status', $pengurus->status) == 1 ? 'selected' : '' }}
                        >
                            Aktif
                        </option>

                        <option
                            value="0"
                            {{ old('status', $pengurus->status) == 0 ? 'selected' : '' }}
                        >
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
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
