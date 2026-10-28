@extends('backend.v_layout.app')

@section('title', 'Tambah Event')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="mb-4">

        <h1 class="h3 mb-1">
            Tambah Event
        </h1>

        <p class="text-muted">
            Tambahkan event baru KOSA Indonesia
        </p>

    </div>


    {{-- =========================================================
         VALIDATION ERROR
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         FORM
    ========================================================== --}}

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="{{ route('admin.event.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- =================================================
                     JUDUL EVENT
                ================================================== --}}

                <div class="mb-3">

                    <label class="form-label">
                        Judul Event
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul event"
                        required
                    >

                </div>


                {{-- =================================================
                     DESKRIPSI
                ================================================== --}}

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="6"
                        class="form-control"
                        placeholder="Masukkan deskripsi event"
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- =================================================
                     TANGGAL / WAKTU / LOKASI
                ================================================== --}}

                <div class="row">

                    {{-- TANGGAL --}}

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ old('tanggal') }}"
                            required
                        >

                        <small class="text-muted">
                            Status event otomatis berdasarkan tanggal.
                        </small>

                    </div>


                    {{-- WAKTU --}}

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Waktu
                        </label>

                        <input
                            type="time"
                            name="waktu"
                            class="form-control"
                            value="{{ old('waktu') }}"
                        >

                    </div>


                    {{-- LOKASI --}}

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            class="form-control"
                            value="{{ old('lokasi') }}"
                            placeholder="Contoh: Jakarta"
                        >

                    </div>

                </div>

                {{-- =================================================
                    PENDAFTARAN EVENT
                ================================================= --}}

                <div class="card border mb-4">

                    <div class="card-header bg-light">

                        <strong>
                            <i class="fas fa-user-plus me-1"></i>
                            Pendaftaran Event
                        </strong>

                    </div>

                    <div class="card-body">

                        {{-- Nilai default jika checkbox tidak dicentang --}}
                        <input
                            type="hidden"
                            name="pendaftaran_aktif"
                            value="0"
                        >

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="pendaftaran_aktif"
                                name="pendaftaran_aktif"
                                value="1"
                                {{ old('pendaftaran_aktif', 0) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="pendaftaran_aktif"
                            >
                                <strong>
                                    Aktifkan Pendaftaran
                                </strong>
                            </label>

                        </div>

                        <small class="text-muted d-block mt-2">

                            Jika diaktifkan, peserta dapat melakukan
                            pendaftaran langsung melalui website KOSA Indonesia.

                        </small>

                        <div class="alert alert-info mt-3 mb-0">

                            <i class="fas fa-info-circle me-1"></i>

                            Tidak perlu memasukkan link pendaftaran.
                            Sistem akan otomatis membuat halaman pendaftaran
                            untuk event ini.

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOTO EVENT
                ================================================== --}}

                <div class="mb-3">

                    <label class="form-label">
                        Foto Event
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*"
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG, WEBP.
                        Maksimal 2 MB.
                    </small>

                </div>


                {{-- =================================================
                     MATERI PAPARAN
                ================================================== --}}

                <div class="mb-3">

                    <label class="form-label">
                        Materi Paparan
                    </label>

                    <input
                        type="file"
                        name="materi"
                        class="form-control"
                        accept=".pdf,.ppt,.pptx"
                    >

                    <small class="text-muted">

                        Upload materi seminar/paparan.
                        Format PDF, PPT, PPTX.
                        Maksimal 10 MB.

                    </small>

                </div>


                {{-- =================================================
                     GALERI
                ================================================== --}}

                <div class="mb-4">

                    <label class="form-label">
                        Galeri Foto
                    </label>

                    <input
                        type="file"
                        name="galeri[]"
                        class="form-control"
                        accept="image/*"
                        multiple
                    >

                    <small class="text-muted">

                        Bisa memilih beberapa foto sekaligus.
                        Maksimal 2 MB per foto.

                    </small>

                </div>


                {{-- =================================================
                     INFO STATUS
                ================================================== --}}

                <div class="alert alert-info">

                    <i class="fas fa-info-circle me-1"></i>

                    <strong>Status event otomatis.</strong>

                    <br>

                    Event dengan tanggal hari ini atau setelahnya
                    akan ditampilkan sebagai <strong>Akan Datang</strong>.

                    <br>

                    Event dengan tanggal yang sudah lewat
                    akan ditampilkan sebagai <strong>Terlaksana</strong>.

                    <br>

                    Admin tidak perlu mengisi status secara manual.

                </div>


                {{-- =================================================
                     BUTTON
                ================================================== --}}

                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.event.index') }}"
                        class="btn btn-secondary"
                    >

                        <i class="fas fa-arrow-left me-1"></i>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>

                        Simpan Event

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection