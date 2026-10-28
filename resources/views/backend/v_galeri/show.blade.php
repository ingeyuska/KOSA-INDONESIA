@extends('backend.v_layout.app')

@section('title', 'Detail Galeri')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Detail Galeri</h4>
            <p class="text-muted mb-0">
                Lihat informasi dan foto dalam galeri.
            </p>
        </div>

        <a href="{{ route('admin.galeri.index') }}"
           class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>


    {{-- INFORMASI GALERI --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4 class="fw-bold mb-3">
                {{ $galeri->judul }}
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Tanggal</strong>

                    <p class="mb-0 text-muted">
                        {{ $galeri->tanggal
                            ? $galeri->tanggal->format('d M Y')
                            : '-' }}
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Status</strong>

                    <p class="mb-0">
                        @if($galeri->status === 'published')
                            <span class="badge bg-success">
                                Published
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Draft
                            </span>
                        @endif
                    </p>
                </div>

                <div class="col-12">
                    <strong>Deskripsi</strong>

                    <p class="text-muted mb-0">
                        {{ $galeri->deskripsi ?: '-' }}
                    </p>
                </div>

            </div>

        </div>
    </div>


    {{-- FOTO GALERI --}}
    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="bi bi-images me-2"></i>
                Foto Galeri
            </h5>
        </div>

        <div class="card-body">

            @if($galeri->foto->count())

                <div class="row g-4">

                    @foreach($galeri->foto as $foto)

                        <div class="col-md-4 col-lg-3">

                            <div class="card h-100 shadow-sm">

                                <img
                                    src="{{ asset('storage/' . $foto->file_foto) }}"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: cover;"
                                    alt="{{ $galeri->judul }}"
                                >

                                <div class="card-body p-2">

                                    <form
                                        action="{{ route('admin.galeri.foto.destroy', $foto->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus foto ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm w-100"
                                        >
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus Foto
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-images fs-1 text-muted"></i>

                    <p class="text-muted mt-3 mb-0">
                        Belum ada foto di galeri ini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection