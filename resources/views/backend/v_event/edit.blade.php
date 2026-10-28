@extends('backend.v_layout.app')

@section('title', 'Edit Event')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="mb-4">

        <h1 class="h3 mb-1">
            Edit Event
        </h1>

        <p class="text-muted">
            Ubah informasi event KOSA Indonesia
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
                action="{{ route('admin.event.update', $event->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


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
                        value="{{ old('judul', $event->judul) }}"
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
                    >{{ old('deskripsi', $event->deskripsi) }}</textarea>

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
                            value="{{ old(
                                'tanggal',
                                $event->tanggal
                                    ? $event->tanggal->format('Y-m-d')
                                    : ''
                            ) }}"
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
                            value="{{ old('waktu', $event->waktu) }}"
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
                            value="{{ old('lokasi', $event->lokasi) }}"
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

                        {{-- 
                            Nilai default = 0
                            Jika checkbox dicentang, nilai 1 akan dikirim
                        --}}
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
                                {{ old(
                                    'pendaftaran_aktif',
                                    $event->pendaftaran_aktif
                                ) ? 'checked' : '' }}
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
                            berdasarkan event ini.

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOTO EVENT SAAT INI
                ================================================== --}}

                @if($event->foto)

                    <div class="mb-3">

                        <label class="form-label">
                            Foto Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ asset('storage/' . $event->foto) }}"
                            alt="{{ $event->judul }}"
                            style="
                                width:200px;
                                height:130px;
                                object-fit:cover;
                                border-radius:8px;
                                border:1px solid #ddd;
                            "
                        >

                    </div>

                @endif


                {{-- =================================================
                     GANTI FOTO
                ================================================== --}}

                <div class="mb-4">

                    <label class="form-label">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                    </small>

                </div>


                {{-- =================================================
                     MATERI SAAT INI
                ================================================== --}}

                @if($event->materi)

                    <div class="mb-3">

                        <label class="form-label">
                            Materi Saat Ini
                        </label>

                        <div>

                            <a
                                href="{{ asset('storage/' . $event->materi) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-outline-primary btn-sm"
                            >

                                <i class="fas fa-file-pdf me-1"></i>

                                Lihat Materi

                            </a>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     MATERI BARU
                ================================================== --}}

                <div class="mb-4">

                    <label class="form-label">

                        {{ $event->materi
                            ? 'Ganti Materi Paparan'
                            : 'Materi Paparan'
                        }}

                    </label>

                    <input
                        type="file"
                        name="materi"
                        class="form-control"
                        accept=".pdf,.ppt,.pptx"
                    >

                    <small class="text-muted">

                        PDF, PPT, PPTX.
                        Maksimal 10 MB.
                        Kosongkan jika tidak ingin mengganti.

                    </small>

                </div>


                {{-- =================================================
                     GALERI LAMA
                ================================================== --}}

                @if($event->galeri && count($event->galeri) > 0)

                    <div class="mb-3">

                        <label class="form-label">
                            Galeri Saat Ini
                        </label>

                        <div class="row g-2">

                            @foreach($event->galeri as $foto)

                                <div class="col-md-2 col-sm-4 col-6">

                                    <img
                                        src="{{ asset('storage/' . $foto) }}"
                                        alt="Galeri {{ $event->judul }}"
                                        style="
                                            width:100%;
                                            height:100px;
                                            object-fit:cover;
                                            border-radius:8px;
                                            border:1px solid #ddd;
                                        "
                                    >

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     TAMBAH GALERI
                ================================================== --}}

                <div class="mb-4">

                    <label class="form-label">
                        Tambah Foto Galeri
                    </label>

                    <input
                        type="file"
                        name="galeri[]"
                        class="form-control"
                        accept="image/*"
                        multiple
                    >

                    <small class="text-muted">

                        Kamu bisa menambahkan beberapa foto sekaligus.

                    </small>

                </div>


                {{-- =================================================
                     INFO STATUS EVENT
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

                    Admin tidak perlu mengubah status secara manual.

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

                        Update Event

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection