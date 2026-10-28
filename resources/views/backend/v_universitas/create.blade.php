@extends('backend.v_layout.app')

@section('title', 'Tambah Universitas')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Tambah Universitas</h4>
            <p class="text-muted mb-0">
                Tambahkan data universitas baru
            </p>
        </div>

        <a href="{{ route('admin.universitas.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.universitas.store') }}"
                  method="POST">

                @csrf

                {{-- Nama Universitas --}}
                <div class="mb-3">
                    <label for="nama_universitas" class="form-label">
                        Nama Universitas
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_universitas"
                        id="nama_universitas"
                        class="form-control @error('nama_universitas') is-invalid @enderror"
                        value="{{ old('nama_universitas') }}"
                        placeholder="Masukkan nama universitas"
                        required
                    >

                    @error('nama_universitas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <div class="form-check form-switch">

                        <input
                            type="checkbox"
                            name="aktif"
                            value="1"
                            class="form-check-input"
                            id="aktif"
                            {{ old('aktif', true) ? 'checked' : '' }}
                        >

                        <label class="form-check-label" for="aktif">
                            Universitas Aktif
                        </label>

                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.universitas.index') }}"
                       class="btn btn-light border">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection