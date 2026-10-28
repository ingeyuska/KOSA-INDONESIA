@extends('frontend.alumni.layouts.app')

@section('title', 'Tracer Alumni - KOSA Indonesia')

@section('content')

<div class="container py-5">

    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">TRACER ALUMNI</h2>
        <p class="text-muted mb-0">
            Lengkapi data untuk memperbarui informasi alumni
        </p>
    </div>


    {{-- =====================================================
        ALERT
    ====================================================== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- =====================================================
        CARD UTAMA
    ====================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-lg-5">

            {{-- =================================================
                TAHUN PENYELENGGARAAN
            ================================================== --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-5">

                    <label class="form-label fw-semibold">
                        Tahun Penyelenggaraan
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        value="{{ $alumni->tahun_penyelenggaraan ?? date('Y') }}"
                        disabled
                    >

                </div>
            </div>


            {{-- =================================================
                PROGRESS
            ================================================== --}}
            <div class="mb-4">

                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-semibold">
                        Progress Pengisian
                    </span>

                    <span id="progressText">
                        {{ $progress }}%
                    </span>
                </div>

                <div class="progress" style="height: 10px;">
                    <div
                        id="progressBar"
                        class="progress-bar"
                        role="progressbar"
                        style="width: {{ $progress }}%"
                    ></div>
                </div>

            </div>


            {{-- =================================================
                STEPPER
            ================================================== --}}
         <div class="stepper mb-5">

    <div
        class="step"
        data-step="1"
    >
        <div class="step-number">1</div>
        <div class="step-title">Profil Diri</div>
    </div>

    <div class="step-line"></div>

    <div
        class="step"
        data-step="2"
    >
        <div class="step-number">2</div>
        <div class="step-title">Pekerjaan</div>
    </div>

    <div class="step-line"></div>

    <div
        class="step"
        data-step="3"
    >
        <div class="step-number">3</div>
        <div class="step-title">Pengalaman</div>
    </div>

    <div class="step-line"></div>

    <div
        class="step"
        data-step="4"
    >
        <div class="step-number">4</div>
        <div class="step-title">Expertise</div>
    </div>

</div>


            {{-- =================================================
                FORM PROFILE + PEKERJAAN
            ================================================== --}}
            <form
                action="{{ route('alumni.tracer.update') }}"
                method="POST"
                id="tracerForm"
            >

                @csrf


                {{-- =================================================
                    STEP 1 - PROFIL DIRI
                ================================================== --}}
                <div class="tracer-step" id="step1">

                    <div class="mb-4">
                        <h4 class="fw-bold">
                            Profil Diri
                        </h4>

                        <p class="text-muted">
                            Lengkapi informasi kontak dan alamat tempat tinggal Anda.
                        </p>
                    </div>


                    <div class="row g-4">

                        {{-- NO HP --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                No. HP <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nomor_hp"
                                class="form-control"
                                value="{{ old('nomor_hp', $alumni->nomor_hp) }}"
                                placeholder="Contoh: 08123456789"
                            >

                            @error('nomor_hp')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- PROVINSI --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Provinsi <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="provinsi"
                                class="form-control"
                                value="{{ old('provinsi', $alumni->provinsi) }}"
                                placeholder="Contoh: Jawa Tengah"
                            >

                        </div>


                        {{-- KABUPATEN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Kabupaten/Kota <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="kabupaten_kota"
                                class="form-control"
                                value="{{ old('kabupaten_kota', $alumni->kabupaten_kota) }}"
                                placeholder="Contoh: Kabupaten Brebes"
                            >

                        </div>


                        {{-- KECAMATAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Kecamatan <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="kecamatan"
                                class="form-control"
                                value="{{ old('kecamatan', $alumni->kecamatan) }}"
                                placeholder="Contoh: Jatibarang"
                            >

                        </div>


                        {{-- ALAMAT --}}
                        <div class="col-12">

                            <label class="form-label">
                                Alamat Lengkap <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="alamat_lengkap"
                                rows="3"
                                class="form-control"
                                placeholder="Masukkan alamat lengkap"
                            >{{ old('alamat_lengkap', $alumni->alamat_lengkap) }}</textarea>

                        </div>

                    </div>


                    <div class="text-end mt-4">

                        <button
                            type="button"
                            class="btn btn-primary px-4"
                            onclick="nextStep(2)"
                        >
                            Simpan & Lanjut
                            <i class="bi bi-arrow-right"></i>
                        </button>

                    </div>

                </div>


                {{-- =================================================
                    STEP 2 - PEKERJAAN
                ================================================== --}}
                <div class="tracer-step" id="step2">

                    <div class="mb-4">
                        <h4 class="fw-bold">
                            Pekerjaan Saat Ini
                        </h4>

                        <p class="text-muted">
                            Informasi ini digunakan untuk mengetahui posisi dan kondisi pekerjaan alumni saat ini.
                        </p>
                    </div>


                    <div class="row g-4">

                        {{-- STATUS PEKERJAAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Status Pekerjaan <span class="text-danger">*</span>
                            </label>

                            <select
                                name="status_pekerjaan"
                                class="form-select"
                            >

                                <option value="">
                                    -- Pilih Status --
                                </option>

                                <option value="bekerja"
                                    {{ $alumni->status_pekerjaan == 'bekerja' ? 'selected' : '' }}>
                                    Bekerja
                                </option>

                                <option value="belum_bekerja"
                                    {{ $alumni->status_pekerjaan == 'belum_bekerja' ? 'selected' : '' }}>
                                    Belum Bekerja
                                </option>

                                <option value="wirausaha"
                                    {{ $alumni->status_pekerjaan == 'wirausaha' ? 'selected' : '' }}>
                                    Wirausaha
                                </option>

                                <option value="melanjutkan_pendidikan"
                                    {{ $alumni->status_pekerjaan == 'melanjutkan_pendidikan' ? 'selected' : '' }}>
                                    Melanjutkan Pendidikan
                                </option>

                            </select>

                        </div>


                        {{-- BIDANG --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Bidang Pekerjaan <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="bidang_pekerjaan"
                                class="form-control"
                                value="{{ old('bidang_pekerjaan', $alumni->bidang_pekerjaan) }}"
                                placeholder="Contoh: Teknologi Informasi"
                            >

                        </div>


                        {{-- PERUSAHAAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Perusahaan/Instansi <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="perusahaan"
                                class="form-control"
                                value="{{ old('perusahaan', $alumni->perusahaan) }}"
                            >

                        </div>


                        {{-- JABATAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Jabatan <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="jabatan"
                                class="form-control"
                                value="{{ old('jabatan', $alumni->jabatan) }}"
                            >

                        </div>


                        {{-- LEVEL --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Level Jabatan <span class="text-danger">*</span>
                            </label>

                            <select
                                name="level_jabatan"
                                class="form-select"
                            >

                                <option value="">
                                    -- Pilih Level --
                                </option>

                                <option value="staff"
                                    {{ $alumni->level_jabatan == 'staff' ? 'selected' : '' }}>
                                    Staff
                                </option>

                                <option value="supervisor"
                                    {{ $alumni->level_jabatan == 'supervisor' ? 'selected' : '' }}>
                                    Supervisor
                                </option>

                                <option value="manager"
                                    {{ $alumni->level_jabatan == 'manager' ? 'selected' : '' }}>
                                    Manager
                                </option>

                                <option value="direktur"
                                    {{ $alumni->level_jabatan == 'direktur' ? 'selected' : '' }}>
                                    Direktur
                                </option>

                                <option value="lainnya"
                                    {{ $alumni->level_jabatan == 'lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>

                            </select>

                        </div>


                        {{-- ESELON --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Eselon
                            </label>

                            <input
                                type="text"
                                name="eselon"
                                class="form-control"
                                value="{{ old('eselon', $alumni->eselon) }}"
                                placeholder="Opsional"
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
                                value="{{ old('unit_kerja', $alumni->unit_kerja) }}"
                            >

                        </div>


                        {{-- STATUS KEPEGAWAIAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Status Kepegawaian <span class="text-danger">*</span>
                            </label>

                            <select
                                name="status_kepegawaian"
                                class="form-select"
                            >

                                <option value="">
                                    -- Pilih Status --
                                </option>

                                <option value="tetap"
                                    {{ $alumni->status_kepegawaian == 'tetap' ? 'selected' : '' }}>
                                    Pegawai Tetap
                                </option>

                                <option value="kontrak"
                                    {{ $alumni->status_kepegawaian == 'kontrak' ? 'selected' : '' }}>
                                    Kontrak
                                </option>

                                <option value="honorer"
                                    {{ $alumni->status_kepegawaian == 'honorer' ? 'selected' : '' }}>
                                    Honorer
                                </option>

                                <option value="lainnya"
                                    {{ $alumni->status_kepegawaian == 'lainnya' ? 'selected' : '' }}>
                                    Lainnya
                                </option>

                            </select>

                        </div>


                        {{-- LOKASI --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Lokasi Pekerjaan <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="lokasi_pekerjaan"
                                class="form-control"
                                value="{{ old('lokasi_pekerjaan', $alumni->lokasi_pekerjaan) }}"
                                placeholder="Kota/Provinsi"
                            >

                        </div>


                        {{-- TAHUN MULAI --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Tahun Mulai <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                name="tahun_mulai"
                                class="form-control"
                                value="{{ old('tahun_mulai', $alumni->tahun_mulai) }}"
                                min="1900"
                                max="{{ date('Y') }}"
                            >

                        </div>


                        {{-- PENDIDIKAN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Pendidikan Terakhir <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="pendidikan_terakhir"
                                class="form-control"
                                value="{{ old('pendidikan_terakhir', $alumni->pendidikan_terakhir) }}"
                                placeholder="Contoh: S2"
                            >

                        </div>

                    </div>


                    <div class="d-flex justify-content-between mt-4">

                        <button
                            type="button"
                            class="btn btn-outline-secondary px-4"
                            onclick="nextStep(1)"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Simpan & Lanjut
                            <i class="bi bi-arrow-right"></i>
                        </button>

                    </div>

                </div>

            </form>


            {{-- =================================================
                STEP 3 - PENGALAMAN
            ================================================== --}}
            <div class="tracer-step" id="step3">

                <div class="mb-4">
                    <h4 class="fw-bold">
                        Pengalaman
                    </h4>

                    <p class="text-muted">
                        Tambahkan pengalaman yang pernah Anda miliki.
                    </p>
                </div>


                {{-- ORGANISASI --}}
                <div class="experience-box mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Pengalaman Organisasi
                            </h5>

                            <small class="text-muted">
                                Bisa ditambahkan lebih dari satu.
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#organizationModal"
                        >
                            + Tambah
                        </button>

                    </div>


                    @forelse($organizations as $organization)

                        <div class="experience-item">

                            <div>
                                <strong>
                                    {{ $organization->nama_organisasi }}
                                </strong>

                                <div class="text-muted small">
                                    {{ $organization->jabatan ?? 'Anggota' }}
                                    @if($organization->tahun_mulai)
                                        • {{ $organization->tahun_mulai }}
                                    @endif
                                </div>
                            </div>

                        </div>

                    @empty

                        <div class="text-muted small">
                            Belum ada pengalaman organisasi.
                        </div>

                    @endforelse

                </div>


                {{-- KEGIATAN PERKULIAHAN --}}
                <div class="experience-box mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Selama Perkuliahan
                            </h5>

                            <small class="text-muted">
                                Kegiatan, seminar, kepanitiaan, dan lainnya.
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#activityModal"
                        >
                            + Tambah
                        </button>

                    </div>


                    @forelse($activities as $activity)

                        <div class="experience-item">

                            <div>
                                <strong>
                                    {{ $activity->nama_kegiatan }}
                                </strong>

                                <div class="text-muted small">
                                    {{ $activity->peran ?? 'Peserta' }}

                                    @if($activity->tahun)
                                        • {{ $activity->tahun }}
                                    @endif
                                </div>
                            </div>

                        </div>

                    @empty

                        <div class="text-muted small">
                            Belum ada kegiatan.
                        </div>

                    @endforelse

                </div>


                {{-- PENCAPAIAN --}}
                <div class="experience-box mb-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Pencapaian Profesional
                            </h5>

                            <small class="text-muted">
                                Prestasi atau pencapaian di bidang profesional.
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#achievementModal"
                        >
                            + Tambah
                        </button>

                    </div>


                    @forelse($achievements as $achievement)

                        <div class="experience-item">

                            <div>
                                <strong>
                                    {{ $achievement->nama_pencapaian }}
                                </strong>

                                <div class="text-muted small">

                                    {{ $achievement->bidang ?? '-' }}

                                    @if($achievement->tahun)
                                        • {{ $achievement->tahun }}
                                    @endif

                                </div>
                            </div>

                        </div>

                    @empty

                        <div class="text-muted small">
                            Belum ada pencapaian.
                        </div>

                    @endforelse

                </div>


                <div class="d-flex justify-content-between mt-4">

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="nextStep(2)"
                    >
                        ← Kembali
                    </button>

                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="nextStep(4)"
                    >
                        Lanjut →
                    </button>

                </div>

            </div>


            {{-- =================================================
                STEP 4 - EXPERTISE
            ================================================== --}}
            <div class="tracer-step" id="step4">

                <div class="mb-4">
                    <h4 class="fw-bold">
                        Expertise
                    </h4>

                    <p class="text-muted">
                        Tambahkan bidang keahlian yang Anda miliki.
                    </p>
                </div>


                <form
                    action="{{ route('alumni.tracer.expertise.store') }}"
                    method="POST"
                    class="mb-4"
                >

                    @csrf

                    <div class="input-group">

                        <input
                            type="text"
                            name="nama_expertise"
                            class="form-control"
                            placeholder="Contoh: e-government, public policy, GIS"
                            required
                        >

                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            + Tambah
                        </button>

                    </div>

                </form>


                <div class="expertise-tags">

                    @forelse($expertises as $expertise)

                        <span class="badge bg-light text-dark border px-3 py-2 me-2 mb-2">

                            {{ $expertise->nama_expertise }}

                            <span class="ms-2 text-danger">
                                ×
                            </span>

                        </span>

                    @empty

                        <p class="text-muted">
                            Belum ada expertise yang ditambahkan.
                        </p>

                    @endforelse

                </div>


                <div class="d-flex justify-content-between mt-5">

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="nextStep(3)"
                    >
                        ← Kembali
                    </button>

                    @if($progress >= 100)

                        <form
                            action="{{ route('alumni.tracer.submit') }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-success px-4"
                            >
                                Submit Tracer
                            </button>

                        </form>

                    @else

                        <button
                            type="button"
                            class="btn btn-secondary"
                            disabled
                        >
                            Lengkapi Data Terlebih Dahulu
                        </button>

                    @endif

                </div>

            </div>

        </div>
    </div>
</div>


{{-- =========================================================
    MODAL ORGANISASI
========================================================= --}}
<div
    class="modal fade"
    id="organizationModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                action="{{ route('alumni.tracer.organization.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Pengalaman Organisasi
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Organisasi
                            </label>

                            <input
                                type="text"
                                name="nama_organisasi"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Jabatan
                            </label>

                            <input
                                type="text"
                                name="jabatan"
                                class="form-control"
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Tingkat Organisasi
                            </label>

                            <input
                                type="text"
                                name="tingkat_organisasi"
                                class="form-control"
                                placeholder="Kampus/Nasional/Internasional"
                            >

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Tahun Mulai
                            </label>

                            <input
                                type="number"
                                name="tahun_mulai"
                                class="form-control"
                            >

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                Tahun Selesai
                            </label>

                            <input
                                type="number"
                                name="tahun_selesai"
                                class="form-control"
                            >

                        </div>

                        <div class="col-12">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="3"
                            ></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
    MODAL KEGIATAN
========================================================= --}}
<div
    class="modal fade"
    id="activityModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                action="{{ route('alumni.tracer.activity.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Kegiatan Selama Perkuliahan
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Jenis Kegiatan
                            </label>

                            <input
                                type="text"
                                name="jenis_kegiatan"
                                class="form-control"
                                placeholder="Seminar / Kepanitiaan / Pelatihan"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Kegiatan
                            </label>

                            <input
                                type="text"
                                name="nama_kegiatan"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Peran
                            </label>

                            <input
                                type="text"
                                name="peran"
                                class="form-control"
                                placeholder="Peserta / Panitia / Ketua"
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Penyelenggara
                            </label>

                            <input
                                type="text"
                                name="penyelenggara"
                                class="form-control"
                            >

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Tahun
                            </label>

                            <input
                                type="number"
                                name="tahun"
                                class="form-control"
                            >

                        </div>

                        <div class="col-12">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="3"
                            ></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
    MODAL PENCAPAIAN
========================================================= --}}
<div
    class="modal fade"
    id="achievementModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                action="{{ route('alumni.tracer.achievement.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Pencapaian Profesional
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Pencapaian
                            </label>

                            <input
                                type="text"
                                name="nama_pencapaian"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Jenis Pencapaian
                            </label>

                            <input
                                type="text"
                                name="jenis_pencapaian"
                                class="form-control"
                                placeholder="Penghargaan / Sertifikasi / Prestasi"
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Bidang
                            </label>

                            <input
                                type="text"
                                name="bidang"
                                class="form-control"
                            >

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                Penyelenggara
                            </label>

                            <input
                                type="text"
                                name="penyelenggara"
                                class="form-control"
                            >

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Tahun
                            </label>

                            <input
                                type="number"
                                name="tahun"
                                class="form-control"
                            >

                        </div>

                        <div class="col-12">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="3"
                            ></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
    STYLE
========================================================= --}}
<style>

    .stepper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .step {
        text-align: center;
        min-width: 100px;
        position: relative;
    }

    .step-number {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9ecef;
        color: #6c757d;
        font-weight: 600;
    }

    .step-title {
        margin-top: 8px;
        font-size: 13px;
        color: #6c757d;
    }

    .step.active .step-number {
        background: #0d6efd;
        color: white;
    }

    .step.active .step-title {
        color: #0d6efd;
        font-weight: 600;
    }

    .step.completed .step-number {
        background: #198754;
        color: white;
    }

    .step.completed .step-title {
        color: #198754;
        font-weight: 600;
    }

    .step-line {
        height: 2px;
        flex: 1;
        background: #dee2e6;
        max-width: 120px;
    }

    .tracer-step {
        display: none;
    }

    .tracer-step.active {
        display: block;
    }

    .experience-box {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
    }

    .experience-item {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 10px;
        background: #fafafa;
    }

    @media (max-width: 768px) {

        .stepper {
            overflow-x: auto;
            justify-content: flex-start;
            padding-bottom: 10px;
        }

        .step {
            min-width: 90px;
        }

        .step-line {
            min-width: 30px;
        }

        .step-title {
            font-size: 11px;
        }

    }

</style>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>

    function nextStep(stepNumber) {

        // =========================
        // SEMBUNYIKAN SEMUA STEP
        // =========================

        document
            .querySelectorAll('.tracer-step')
            .forEach(function(step) {

                step.classList.remove('active');

            });


        // =========================
        // TAMPILKAN STEP TERPILIH
        // =========================

        const targetStep = document.getElementById(
            'step' + stepNumber
        );

        if (targetStep) {

            targetStep.classList.add('active');

        }


        // =========================
        // UPDATE STEPPER
        // =========================

        document
            .querySelectorAll('.step')
            .forEach(function(step) {

                const number = parseInt(
                    step.getAttribute('data-step')
                );

                step.classList.remove('active');
                step.classList.remove('completed');


                // Step sebelumnya = selesai
                if (number < stepNumber) {

                    step.classList.add('completed');

                }


                // Step sekarang = aktif
                if (number === stepNumber) {

                    step.classList.add('active');

                }

            });


        // =========================
        // SCROLL KE ATAS
        // =========================

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    }


    // =========================
    // SAAT HALAMAN DIBUKA
    // =========================

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const savedStep =
                {{ session('tracer_step', 1) }};

            nextStep(savedStep);

        }
    );

</script>

@endsection