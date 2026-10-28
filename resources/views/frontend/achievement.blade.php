@extends('frontend.v_layouts.app')

@section('title', 'Achievement - Alumni KOSA')

@section('content')

<!-- START SECTION TOP -->
<section class="section-top">
    <div class="container">
        <div class="col-lg-10 offset-lg-1 text-center">

            <div class="section-top-title">
                <h1>Achievement</h1>

                <ul>
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li> / Achievement</li>
                </ul>
            </div>

        </div>
    </div>
</section>
<!-- END SECTION TOP -->


<!-- START ACHIEVEMENT -->
<section class="section-padding">
    <div class="container">

        <div class="row">

            @forelse($achievements as $achievement)

                <div class="col-lg-6 col-md-6 mb-4">

                    <div class="card h-100">

                        @if($achievement->foto)
                            <img
                                src="{{ asset('storage/' . $achievement->foto) }}"
                                class="card-img-top"
                                alt="{{ $achievement->judul }}"
                            >
                        @endif

                        <div class="card-body">

                            <h4 class="card-title">
                                {{ $achievement->judul }}
                            </h4>

                            @if($achievement->tahun)
                                <p class="text-muted">
                                    <i class="fa fa-calendar"></i>
                                    {{ $achievement->tahun }}
                                </p>
                            @endif

                            <p class="card-text">
                                {{ $achievement->deskripsi ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center">

                    <p class="text-muted">
                        Belum ada achievement.
                    </p>

                </div>

            @endforelse

        </div>

    </div>
</section>
<!-- END ACHIEVEMENT -->

@endsection