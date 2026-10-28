@extends('frontend.alumni.layouts.app')

@section('title', 'Cerita Saya - KOSA Indonesia')

@section('content')

<section class="kosa-alumni-story-form">
    <div class="container">

        <div class="kosa-dashboard-panel">

            <div class="kosa-panel-header">
                <div>
                    <span>CERITA ALUMNI</span>
                    <h3>Cerita Saya</h3>
                </div>

                <i class="fa-solid fa-comment-dots"></i>
            </div>

            <p class="kosa-panel-description">
                Bagikan pengalaman dan cerita Anda selama menjadi bagian
                dari KOSA Indonesia.
            </p>

            {{-- DATA ALUMNI --}}
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Nama Alumni
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $alumni->nama ?? '-' }}"
                        readonly
                    >
                </div>

                <div class="col-md-6 mb-3">
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

            </div>

            {{-- FORM --}}
            <form
    a        action="{{ route('alumni.cerita.store') }}"
                method="POST"
                enctype="multipart/form-data" >
                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Foto Cerita
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Cerita Anda
                    </label>

                    <textarea
                        name="cerita"
                        class="form-control"
                        rows="7"
                        placeholder="Ceritakan pengalaman Anda bersama KOSA Indonesia..."
                    ></textarea>
                </div>

                <button
                    type="submit"
                    class="kosa-dashboard-button" >
                    Kirim Cerita
                    <i class="fa-solid fa-paper-plane"></i>
                </button>

            </form>

        </div>

    </div>
</section>

@endsection