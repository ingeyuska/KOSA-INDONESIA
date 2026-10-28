@extends('frontend.v_layouts.app')

@section('title', 'Galeri - Kosa Indonesia')

@section('content')

<!-- START PAGE BANNER -->
<section class="kosa-page-banner">
    <div class="container">
        <div class="kosa-page-banner-content text-center">
            <h1>
                Galeri
            </h1>

            <p>
                Dokumentasi kegiatan KOSA Indonesia
            </p>
        </div>
    </div>
</section>
<!-- END PAGE BANNER -->

<!-- START GALERI -->
<section class="blog_area section-padding">
    <div class="container">

        <div class="row">

            @forelse($galeri as $item)

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

                    <a href="{{ route('galeri.show', $item->slug) }}"
                       class="galeri-link">

                        <div class="single_blog">

                            {{-- FOTO UTAMA --}}
                            @if($item->foto->count() > 0)

                                <img
                                    src="{{ asset('storage/' . $item->foto->first()->file_foto) }}"
                                    class="img-fluid galeri-cover"
                                    alt="{{ $item->judul }}"
                                >

                            @else

                                <div class="galeri-no-image">
                                    <p>Belum ada foto</p>
                                </div>

                            @endif


                            {{-- TANGGAL --}}
                            <div class="img_info">
                                <span>
                                    {{ $item->tanggal
                                        ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y')
                                        : '-' }}
                                </span>
                            </div>


                            {{-- INFORMASI GALERI --}}
                            <div class="content_box">

                                <h2>{{ $item->judul }}</h2>

                                @if($item->deskripsi)
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}
                                    </p>
                                @endif

                                <span>
                                    {{ $item->foto->count() }} Foto
                                </span>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12 text-center">
                    <p>Belum ada galeri yang dipublikasikan.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>
<!-- END GALERI -->

@endsection


<style>
.galeri-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.galeri-link:hover {
    color: inherit;
}

.galeri-link .single_blog {
    height: 100%;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.galeri-link:hover .single_blog {
    transform: translateY(-5px);
}

.galeri-cover {
    width: 100%;
    height: 250px !important;
    object-fit: cover;
    object-position: center;
    display: block;
}

.galeri-no-image {
    width: 100%;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
}

.galeri-link .content_box {
    min-height: 150px;
}
</style>