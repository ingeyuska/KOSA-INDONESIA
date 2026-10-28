@extends('frontend.alumni.layouts.app')

@section('title', 'Pendaftaran Event - ' . $event->judul)

@section('page-title', 'Pendaftaran Event')

@section('page-subtitle', 'Isi data diri untuk mengikuti event KOSA Indonesia.')

@section('breadcrumb', 'Pendaftaran Event')


@section('content')

<div class="container-fluid px-0">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">

            <strong>
                <i class="fa-solid fa-circle-exclamation me-2"></i>
                Periksa kembali data Anda.
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    <div class="row">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- JUDUL EVENT --}}
                    <div class="mb-4">

                        <h4 class="fw-bold mb-2">
                            {{ $event->judul }}
                        </h4>

                        <div class="text-muted small">

                            <div class="mb-2">
                                <i class="fa-solid fa-calendar-days me-2"></i>

                                {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                            </div>

                            @if($event->waktu)
                                <div class="mb-2">
                                    <i class="fa-solid fa-clock me-2"></i>
                                    {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}
                                    WIB
                                </div>
                            @endif

                            @if($event->lokasi)
                                <div>
                                    <i class="fa-solid fa-location-dot me-2"></i>
                                    {{ $event->lokasi }}
                                </div>
                            @endif

                        </div>

                    </div>


                    <hr>


                    {{-- FORM --}}
                    <form
                        action="{{ route('alumni.event.daftar.store', $event->id) }}"
                        method="POST">

                        @csrf


                        {{-- NAMA --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_lengkap"
                                class="form-control"
                                value="{{ old('nama_lengkap', Auth::user()->nama) }}"
                                placeholder="Masukkan nama lengkap"
                                required>

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', Auth::user()->email) }}"
                                placeholder="Masukkan email"
                                required>

                        </div>


                        {{-- WHATSAPP --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                No. WhatsApp
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="no_whatsapp"
                                class="form-control"
                                value="{{ old('no_whatsapp', Auth::user()->no_hp) }}"
                                placeholder="Contoh: 081234567890"
                                required>

                        </div>


                        {{-- INSTANSI --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Instansi
                            </label>

                            <input
                                type="text"
                                name="instansi"
                                class="form-control"
                                value="{{ old('instansi') }}"
                                placeholder="Masukkan instansi">

                        </div>


                        {{-- KETERANGAN --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                rows="4"
                                class="form-control"
                                placeholder="Keterangan tambahan jika ada">{{ old('keterangan') }}</textarea>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('alumni.event.show', $event->id) }}"
                                class="btn btn-light">

                                <i class="fa-solid fa-arrow-left me-1"></i>

                                Kembali

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="fa-solid fa-paper-plane me-1"></i>

                                Kirim Pendaftaran

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- INFO --}}
        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Informasi
                    </h5>

                    <p class="text-muted small mb-0">
                        Silakan periksa kembali data Anda sebelum
                        mengirimkan pendaftaran event.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection