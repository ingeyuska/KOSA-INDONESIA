@extends('frontend.alumni.layouts.app')

@section('title', 'Networking & Kontribusi')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9 col-md-11">

            {{-- HEADER --}}
            <div class="mb-4">
                <h2 class="fw-bold">
                    Networking & Kontribusi
                </h2>

                <p class="text-muted mb-0">
                    Tentukan bentuk kontribusi dan networking yang dapat Anda berikan
                    sebagai Alumni KOSA Indonesia.
                </p>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('alumni.contribution.update') }}" method="POST">

                @csrf
                @method('PUT')

                {{-- KONTRIBUSI --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-handshake me-2"></i>
                            Kesediaan Berkontribusi
                        </h5>

                        {{-- MENTOR --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Bersedia menjadi mentor?
                            </label>

                            <div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_mentor"
                                        value="1"
                                        id="mentor_ya"
                                        {{ old('bersedia_mentor', $alumni->bersedia_mentor) == 1 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="mentor_ya">
                                        Ya
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_mentor"
                                        value="0"
                                        id="mentor_tidak"
                                        {{ old('bersedia_mentor', $alumni->bersedia_mentor) == 0 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="mentor_tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>

                        </div>

                        {{-- NARASUMBER --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Bersedia menjadi narasumber?
                            </label>

                            <div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_narasumber"
                                        value="1"
                                        id="narasumber_ya"
                                        {{ old('bersedia_narasumber', $alumni->bersedia_narasumber) == 1 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="narasumber_ya">
                                        Ya
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_narasumber"
                                        value="0"
                                        id="narasumber_tidak"
                                        {{ old('bersedia_narasumber', $alumni->bersedia_narasumber) == 0 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="narasumber_tidak">
                                        Tidak
                                    </label>
                                </div>

                            </div>

                        </div>

                        {{-- EXPERT --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Bersedia menjadi expert?
                            </label>

                            <div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_expert"
                                        value="1"
                                        id="expert_ya"
                                        {{ old('bersedia_expert', $alumni->bersedia_expert) == 1 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="expert_ya">
                                        Ya
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_expert"
                                        value="0"
                                        id="expert_tidak"
                                        {{ old('bersedia_expert', $alumni->bersedia_expert) == 0 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="expert_tidak">
                                        Tidak
                                    </label>
                                </div>

                            </div>

                        </div>

                        {{-- KOLABORASI SOSIAL --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Bersedia mengikuti kolaborasi sosial?
                            </label>

                            <div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_kolaborasi_sosial"
                                        value="1"
                                        id="sosial_ya"
                                        {{ old('bersedia_kolaborasi_sosial', $alumni->bersedia_kolaborasi_sosial) == 1 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="sosial_ya">
                                        Ya
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_kolaborasi_sosial"
                                        value="0"
                                        id="sosial_tidak"
                                        {{ old('bersedia_kolaborasi_sosial', $alumni->bersedia_kolaborasi_sosial) == 0 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="sosial_tidak">
                                        Tidak
                                    </label>
                                </div>

                            </div>

                        </div>

                        {{-- BOLEH DIHUBUNGI --}}
                        <div class="mb-2">

                            <label class="form-label fw-semibold">
                                Bersedia dihubungi oleh KOSA Indonesia?
                            </label>

                            <div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_dihubungi"
                                        value="1"
                                        id="hubungi_ya"
                                        {{ old('bersedia_dihubungi', $alumni->bersedia_dihubungi) == 1 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="hubungi_ya">
                                        Ya
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="bersedia_dihubungi"
                                        value="0"
                                        id="hubungi_tidak"
                                        {{ old('bersedia_dihubungi', $alumni->bersedia_dihubungi) == 0 ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="hubungi_tidak">
                                        Tidak
                                    </label>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                {{-- KEAHLIAN --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-lightbulb me-2"></i>
                            Keahlian & Mentoring
                        </h5>

                        <div class="mb-3">

                            <label for="topik_mentoring" class="form-label fw-semibold">
                                Topik yang dapat Anda bantu dalam mentoring
                            </label>

                            <textarea
                                name="topik_mentoring"
                                id="topik_mentoring"
                                rows="4"
                                class="form-control"
                                placeholder="Contoh: Persiapan studi S2/S3, penelitian, karier, beasiswa, dll.">{{ old('topik_mentoring', $alumni->topik_mentoring) }}</textarea>

                        </div>

                        <div>

                            <label for="tag_expertise_text" class="form-label fw-semibold">
                                Tag keahlian
                            </label>

                            <input
                                type="text"
                                name="tag_expertise_text"
                                id="tag_expertise_text"
                                class="form-control"
                                value="{{ old('tag_expertise_text', is_array($alumni->tag_expertise) ? implode(', ', $alumni->tag_expertise) : '') }}"
                                placeholder="Contoh: Data Analyst, Pendidikan, IT, Research"
                            >

                            <small class="text-muted">
                                Pisahkan setiap keahlian dengan koma.
                            </small>

                        </div>

                    </div>
                </div>


                {{-- JENIS KOLABORASI --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-people-group me-2"></i>
                            Jenis Kolaborasi
                        </h5>

                        @php
                            $jenisKolaborasi = [
                                'Research',
                                'Professional',
                                'Social Activity',
                                'Scholarship Mentoring',
                                'Business',
                            ];

                            $selectedKolaborasi = old(
                                'jenis_kolaborasi',
                                $alumni->jenis_kolaborasi ?? []
                            );

                            if (!is_array($selectedKolaborasi)) {
                                $selectedKolaborasi = [];
                            }
                        @endphp

                        <div class="row">

                            @foreach($jenisKolaborasi as $item)

                                <div class="col-md-6 mb-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="jenis_kolaborasi[]"
                                            value="{{ $item }}"
                                            id="kolaborasi_{{ \Illuminate\Support\Str::slug($item) }}"
                                            {{ in_array($item, $selectedKolaborasi) ? 'checked' : '' }}
                                        >

                                        <label
                                            class="form-check-label"
                                            for="kolaborasi_{{ \Illuminate\Support\Str::slug($item) }}"
                                        >
                                            {{ $item }}
                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>


                {{-- AREA KONTRIBUSI --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            <i class="fa-solid fa-layer-group me-2"></i>
                            Area Kontribusi
                        </h5>

                        @php
                            $areaKontribusi = [
                                'Pendidikan',
                                'Digital',
                                'Kesehatan',
                                'Lingkungan',
                                'Sosial',
                                'Kewirausahaan',
                                'Penelitian',
                                'Lainnya',
                            ];

                            $selectedArea = old(
                                'area_kontribusi',
                                $alumni->area_kontribusi ?? []
                            );

                            if (!is_array($selectedArea)) {
                                $selectedArea = [];
                            }
                        @endphp

                        <div class="row">

                            @foreach($areaKontribusi as $item)

                                <div class="col-md-6 mb-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="area_kontribusi[]"
                                            value="{{ $item }}"
                                            id="area_{{ \Illuminate\Support\Str::slug($item) }}"
                                            {{ in_array($item, $selectedArea) ? 'checked' : '' }}
                                        >

                                        <label
                                            class="form-check-label"
                                            for="area_{{ \Illuminate\Support\Str::slug($item) }}"
                                        >
                                            {{ $item }}
                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('alumni.profile') }}"
                        class="btn btn-light"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        <i class="fa-solid fa-save me-1"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection