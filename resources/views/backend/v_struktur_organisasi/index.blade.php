@extends('backend.v_layout.app')

@section('title', 'Struktur Organisasi')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Struktur Organisasi</h4>
            <p class="text-muted mb-0">
                Upload gambar struktur organisasi KOSA Indonesia.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.struktur-organisasi.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Gambar Struktur Organisasi
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        required
                    >

                    <small class="text-muted">
                        Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </small>
                </div>

                @if($struktur && $struktur->gambar)
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Gambar Saat Ini
                        </label>

                        <div class="border rounded p-3 text-center bg-light">
                            <img
                                src="{{ asset('storage/' . $struktur->gambar) }}"
                                alt="Struktur Organisasi"
                                class="img-fluid"
                                style="max-height: 600px;"
                            >
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">
                    <i class="ti-upload"></i>
                    {{ $struktur ? 'Ganti Gambar' : 'Upload Gambar' }}
                </button>

            </form>

        </div>
    </div>

</div>

@endsection