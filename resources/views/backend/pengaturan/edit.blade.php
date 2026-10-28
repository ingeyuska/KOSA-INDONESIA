@extends('backend.v_layout.app')

@section('title', 'Edit Pengaturan KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Edit Pengaturan KOSA
            </h1>

            <p class="text-muted mb-0">
                Kelola informasi umum dan pengaturan website KOSA Indonesia.
            </p>
        </div>

        <a href="{{ route('admin.pengaturan.index') }}"
           class="btn btn-secondary">

            <i class="ti-arrow-left"></i>
            Kembali

        </a>

    </div>


    {{-- ERROR VALIDASI --}}
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


    <form
        action="{{ route('admin.pengaturan.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- =====================================
            INFORMASI UTAMA
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Informasi Utama KOSA
                </h5>

            </div>


            <div class="card-body">

                {{-- NAMA KOSA --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama KOSA
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_kosa"
                        class="form-control"
                        value="{{ old('nama_kosa', $pengaturan->nama_kosa) }}"
                        placeholder="KOSA Indonesia"
                        required
                    >

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi KOSA
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control"
                        placeholder="Masukkan deskripsi KOSA Indonesia..."
                    >{{ old('deskripsi', $pengaturan->deskripsi) }}</textarea>

                </div>

            </div>

        </div>


        {{-- =====================================
            LOGO & FAVICON
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Logo & Favicon
                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    {{-- LOGO --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Logo KOSA
                        </label>

                        @if($pengaturan->logo)

                            <div class="mb-3">

                                <img
                                    src="{{ asset('storage/' . $pengaturan->logo) }}"
                                    alt="Logo KOSA"
                                    style="max-width: 200px; max-height: 120px;"
                                    class="img-thumbnail"
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            name="logo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Format JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
                        </small>

                    </div>


                    {{-- FAVICON --}}
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Favicon
                        </label>

                        @if($pengaturan->favicon)

                            <div class="mb-3">

                                <img
                                    src="{{ asset('storage/' . $pengaturan->favicon) }}"
                                    alt="Favicon"
                                    style="width: 80px; height: 80px; object-fit: contain;"
                                    class="img-thumbnail"
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            name="favicon"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp,.ico"
                        >

                        <small class="text-muted">
                            Format JPG, PNG, WEBP atau ICO. Maksimal 1 MB.
                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================
            KONTAK
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Informasi Kontak
                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    {{-- TELEPON --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Telepon
                        </label>

                        <input
                            type="text"
                            name="telepon"
                            class="form-control"
                            value="{{ old('telepon', $pengaturan->telepon) }}"
                            placeholder="(+62) 812-1231-3840"
                        >

                    </div>


                    {{-- WHATSAPP --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            WhatsApp
                        </label>

                        <input
                            type="text"
                            name="whatsapp"
                            class="form-control"
                            value="{{ old('whatsapp', $pengaturan->whatsapp) }}"
                            placeholder="6281212313840"
                        >

                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $pengaturan->email) }}"
                            placeholder="info@kosaindonesia.org"
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="form-control"
                            placeholder="Alamat KOSA Indonesia..."
                        >{{ old('alamat', $pengaturan->alamat) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================
            MEDIA SOSIAL
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Media Sosial
                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    {{-- INSTAGRAM --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Instagram
                        </label>

                        <input
                            type="text"
                            name="instagram"
                            class="form-control"
                            value="{{ old('instagram', $pengaturan->instagram) }}"
                            placeholder="https://instagram.com/..."
                        >

                    </div>


                    {{-- FACEBOOK --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Facebook
                        </label>

                        <input
                            type="text"
                            name="facebook"
                            class="form-control"
                            value="{{ old('facebook', $pengaturan->facebook) }}"
                            placeholder="https://facebook.com/..."
                        >

                    </div>


                    {{-- YOUTUBE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            YouTube
                        </label>

                        <input
                            type="text"
                            name="youtube"
                            class="form-control"
                            value="{{ old('youtube', $pengaturan->youtube) }}"
                            placeholder="https://youtube.com/..."
                        >

                    </div>


                    {{-- LINKEDIN --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            LinkedIn
                        </label>

                        <input
                            type="text"
                            name="linkedin"
                            class="form-control"
                            value="{{ old('linkedin', $pengaturan->linkedin) }}"
                            placeholder="https://linkedin.com/..."
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================
            PESAN KETUA
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Pesan Ketua KOSA
                </h5>

            </div>


            <div class="card-body">

                <label class="form-label">
                    Pesan Ketua
                </label>

                <textarea
                    name="pesan_ketua"
                    rows="8"
                    class="form-control"
                    placeholder="Tuliskan pesan Ketua KOSA Indonesia..."
                >{{ old('pesan_ketua', $pengaturan->pesan_ketua) }}</textarea>

                <small class="text-muted">
                    Pesan ini nantinya akan ditampilkan pada bagian
                    <strong>Pesan Ketua</strong> di halaman beranda.
                </small>

            </div>

        </div>


        {{-- =====================================
            FOOTER
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Pengaturan Footer
                </h5>

            </div>


            <div class="card-body">

                {{-- DESKRIPSI FOOTER --}}
                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi Footer
                    </label>

                    <textarea
                        name="deskripsi_footer"
                        rows="4"
                        class="form-control"
                        placeholder="Deskripsi yang ditampilkan pada footer..."
                    >{{ old('deskripsi_footer', $pengaturan->deskripsi_footer) }}</textarea>

                </div>


                {{-- COPYRIGHT --}}
                <div class="mb-3">

                    <label class="form-label">
                        Copyright
                    </label>

                    <input
                        type="text"
                        name="copyright"
                        class="form-control"
                        value="{{ old('copyright', $pengaturan->copyright) }}"
                        placeholder="© 2026 KOSA Indonesia"
                    >

                </div>

            </div>

        </div>


        {{-- =====================================
            SEO
        ====================================== --}}
        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">
                    Pengaturan SEO
                </h5>

            </div>


            <div class="card-body">

                {{-- META TITLE --}}
                <div class="mb-3">

                    <label class="form-label">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        class="form-control"
                        value="{{ old('meta_title', $pengaturan->meta_title) }}"
                        placeholder="KOSA Indonesia - KOICA Scholarship Alumni">
                </div>
                {{-- VISI --}}
            <div class="mb-4">

                <label class="form-label">
                    Visi KOSA Indonesia
                </label>

                <textarea
                    name="visi"
                    class="form-control"
                    rows="5"
                    placeholder="Masukkan visi KOSA Indonesia">{{ old('visi', $pengaturan->visi) }}</textarea>

            </div>


            {{-- MISI --}}
            <div class="mb-4">

                <label class="form-label">
                    Misi KOSA Indonesia
                </label>

                <textarea
                    name="misi"
                    class="form-control"
                    rows="8"
                    placeholder="Masukkan misi KOSA Indonesia">{{ old('misi', $pengaturan->misi) }}</textarea>

            </div>


                {{-- META DESCRIPTION --}}
                <div class="mb-3">

                    <label class="form-label">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="form-control"
                        placeholder="Deskripsi website untuk mesin pencari..."
                    >{{ old('meta_description', $pengaturan->meta_description) }}</textarea>

                </div>


                {{-- META KEYWORDS --}}
                <div class="mb-3">

                    <label class="form-label">
                        Meta Keywords
                    </label>

                    <input
                        type="text"
                        name="meta_keywords"
                        class="form-control"
                        value="{{ old('meta_keywords', $pengaturan->meta_keywords) }}"
                        placeholder="KOSA Indonesia, KOICA, alumni KOICA"
                    >

                </div>


            </div>

        </div>


        {{-- =====================================
            BUTTON
        ====================================== --}}
        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="{{ route('admin.pengaturan.index') }}"
                class="btn btn-secondary"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="ti-save"></i>
                Simpan Pengaturan

            </button>

        </div>

    </form>

</div>

@endsection