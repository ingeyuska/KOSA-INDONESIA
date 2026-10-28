@extends('frontend.alumni.layouts.app')

@section('title', 'Profil Saya')

@section('content')

<section class="py-5">


<div class="container">

    {{-- HEADER --}}
    <div class="mb-4">

        <span class="text-primary fw-semibold small">
            PORTAL ALUMNI
        </span>

        <h2 class="fw-bold mb-1">
            Profil Saya
        </h2>

        <p class="text-muted mb-0">
            Kelola informasi profil alumni KOSA Indonesia.
        </p>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}
        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Periksa kembali data berikut:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('alumni.profile.update') }}">

                @csrf
                @method('PUT')


                {{-- =====================================================
                    DATA AKUN
                ====================================================== --}}

                <h5 class="fw-bold mb-4">
                    Data Akun
                </h5>

                <div class="row g-4">

                    {{-- NAMA --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Nama
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->nama ?? $user->nama ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="{{ $user->email ?? $alumni->email ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- ALUMNI ID --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Alumni ID
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->alumni_id ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Status Alumni
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->status ? ucfirst(str_replace('_', ' ', $alumni->status)) : '-' }}"
                            readonly
                        >

                    </div>

                </div>


                <hr class="my-5">


                {{-- =====================================================
                    INFORMASI PRIBADI
                ====================================================== --}}

                <h5 class="fw-bold mb-4">
                    Informasi Pribadi
                </h5>

                <div class="row g-4">

                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->jenis_kelamin ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- NOMOR HP --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Nomor HP
                        </label>

                        <input
                            type="text"
                            name="nomor_hp"
                            class="form-control"
                            value="{{ old('nomor_hp', $alumni->nomor_hp ?? '') }}"
                            placeholder="Masukkan nomor HP"
                        >

                    </div>


                    {{-- DOMISILI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Domisili
                        </label>

                        <input
                            type="text"
                            name="domisili"
                            class="form-control"
                            value="{{ old('domisili', $alumni->domisili ?? '') }}"
                            placeholder="Masukkan domisili"
                        >

                    </div>


                    {{-- PROVINSI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Provinsi
                        </label>

                        <input
                            type="text"
                            name="provinsi"
                            class="form-control"
                            value="{{ old('provinsi', $alumni->provinsi ?? '') }}"
                            placeholder="Masukkan provinsi"
                        >

                    </div>


                    {{-- KABUPATEN/KOTA --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Kabupaten / Kota
                        </label>

                        <input
                            type="text"
                            name="kabupaten_kota"
                            class="form-control"
                            value="{{ old('kabupaten_kota', $alumni->kabupaten_kota ?? '') }}"
                            placeholder="Masukkan kabupaten/kota"
                        >

                    </div>


                    {{-- KECAMATAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Kecamatan
                        </label>

                        <input
                            type="text"
                            name="kecamatan"
                            class="form-control"
                            value="{{ old('kecamatan', $alumni->kecamatan ?? '') }}"
                            placeholder="Masukkan kecamatan"
                        >

                    </div>


                    {{-- ALAMAT LENGKAP --}}
                    <div class="col-12">

                        <label class="form-label">
                            Alamat Lengkap
                        </label>

                        <textarea
                            name="alamat_lengkap"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat lengkap"
                        >{{ old('alamat_lengkap', $alumni->alamat_lengkap ?? '') }}</textarea>

                    </div>

                </div>


                <hr class="my-5">


                {{-- =====================================================
                    INFORMASI PENDIDIKAN
                ====================================================== --}}

                <h5 class="fw-bold mb-4">
                    Informasi Pendidikan
                </h5>

                <div class="row g-4">

                    {{-- PENDIDIKAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Pendidikan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->pendidikan ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- PENDIDIKAN TERAKHIR --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Pendidikan Terakhir
                        </label>

                        <input
                            type="text"
                            name="pendidikan_terakhir"
                            class="form-control"
                            value="{{ old('pendidikan_terakhir', $alumni->pendidikan_terakhir ?? '') }}"
                            placeholder="Masukkan pendidikan terakhir"
                        >

                    </div>


                    {{-- JURUSAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Jurusan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->jurusan ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- FAKULTAS --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Fakultas
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->fakultas ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- INSTITUSI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Institusi
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->institusi ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- PROGRAM --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Program
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->program ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- KLASIFIKASI PROGRAM --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Klasifikasi Program
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->klasifikasi_program ?? '-' }}"
                            readonly
                        >

                    </div>


                    {{-- JENIS KEILMUAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Jenis Keilmuan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $alumni->jenis_keilmuan ?? '-' }}"
                            readonly
                        >

                    </div>

                </div>


                <hr class="my-5">


                {{-- =====================================================
                    INFORMASI PEKERJAAN
                ====================================================== --}}

                <h5 class="fw-bold mb-4">
                    Informasi Pekerjaan
                </h5>

                <div class="row g-4">

                    {{-- STATUS PEKERJAAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Status Pekerjaan
                        </label>

                        <select
                            name="status_pekerjaan"
                            class="form-select"
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="bekerja"
                                {{ old('status_pekerjaan', $alumni->status_pekerjaan ?? '') == 'bekerja' ? 'selected' : '' }}>
                                Bekerja
                            </option>

                            <option value="belum_bekerja"
                                {{ old('status_pekerjaan', $alumni->status_pekerjaan ?? '') == 'belum_bekerja' ? 'selected' : '' }}>
                                Belum Bekerja
                            </option>

                            <option value="wirausaha"
                                {{ old('status_pekerjaan', $alumni->status_pekerjaan ?? '') == 'wirausaha' ? 'selected' : '' }}>
                                Wirausaha
                            </option>

                            <option value="melanjutkan_studi"
                                {{ old('status_pekerjaan', $alumni->status_pekerjaan ?? '') == 'melanjutkan_studi' ? 'selected' : '' }}>
                                Melanjutkan Studi
                            </option>

                        </select>

                    </div>


                    {{-- PEKERJAAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Pekerjaan
                        </label>

                        <input
                            type="text"
                            name="pekerjaan"
                            class="form-control"
                            value="{{ old('pekerjaan', $alumni->pekerjaan ?? '') }}"
                            placeholder="Masukkan pekerjaan"
                        >

                    </div>


                    {{-- BIDANG PEKERJAAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Bidang Pekerjaan
                        </label>

                        <input
                            type="text"
                            name="bidang_pekerjaan"
                            class="form-control"
                            value="{{ old('bidang_pekerjaan', $alumni->bidang_pekerjaan ?? '') }}"
                            placeholder="Masukkan bidang pekerjaan"
                        >

                    </div>


                    {{-- PERUSAHAAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Perusahaan
                        </label>

                        <input
                            type="text"
                            name="perusahaan"
                            class="form-control"
                            value="{{ old('perusahaan', $alumni->perusahaan ?? '') }}"
                            placeholder="Masukkan perusahaan"
                        >

                    </div>


                    {{-- JABATAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Jabatan
                        </label>

                        <input
                            type="text"
                            name="jabatan"
                            class="form-control"
                            value="{{ old('jabatan', $alumni->jabatan ?? '') }}"
                            placeholder="Masukkan jabatan"
                        >

                    </div>


                    {{-- UNIT KERJA --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Unit Kerja
                        </label>

                        <input
                            type="text"
                            name="unit_kerja"
                            class="form-control"
                            value="{{ old('unit_kerja', $alumni->unit_kerja ?? '') }}"
                            placeholder="Masukkan unit kerja"
                        >

                    </div>


                    {{-- LOKASI PEKERJAAN --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Lokasi Pekerjaan
                        </label>

                        <input
                            type="text"
                            name="lokasi_pekerjaan"
                            class="form-control"
                            value="{{ old('lokasi_pekerjaan', $alumni->lokasi_pekerjaan ?? '') }}"
                            placeholder="Masukkan lokasi pekerjaan"
                        >

                    </div>


                    {{-- TAHUN MULAI --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Tahun Mulai
                        </label>

                        <input
                            type="number"
                            name="tahun_mulai"
                            class="form-control"
                            value="{{ old('tahun_mulai', $alumni->tahun_mulai ?? '') }}"
                            placeholder="Contoh: 2025"
                            min="1900"
                            max="{{ date('Y') + 5 }}"
                        >

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="mt-5 d-flex gap-2">

                    <a href="{{ route('alumni.dashboard') }}"
                       class="btn btn-light">

                        <i class="fa-solid fa-arrow "></i>
                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fa-solid fa-save me-2"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


</section>

@endsection
