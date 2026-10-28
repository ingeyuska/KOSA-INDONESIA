@extends('frontend.v_layouts.app')

@section('title', 'Konfirmasi Alumni')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-9">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">

                        <div
                            style="
                                width:60px;
                                height:60px;
                                background:#eaf2ff;
                                border-radius:50%;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                margin:auto;
                                font-size:26px;
                                color:#0d6efd;
                            "
                        >
                            <i class="fa-solid fa-user-check"></i>
                        </div>

                        <h3 class="mt-3 mb-2">
                            Konfirmasi Identitas Alumni
                        </h3>

                        <p class="text-muted mb-0">
                            Pastikan data berikut sesuai dengan data Anda.
                        </p>

                    </div>


                    {{-- ALERT --}}
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


                    {{-- DATA ALUMNI --}}
                    <div class="bg-light rounded p-4 mb-4">

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Nama Alumni
                            </small>

                            <strong>
                                {{ $invitation->nama_lengkap }}
                            </strong>

                        </div>


                        <div>

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $invitation->email }}
                            </strong>

                        </div>

                    </div>


                    {{-- KONFIRMASI --}}
                  <form action="{{ route('alumni.activation.confirm', $invitation->token) }}" method="POST">
    @csrf

    <input type="hidden" name="email" value="{{ $invitation->email }}">

    <div class="form-check mb-4">
        <input
            class="form-check-input"
            type="checkbox"
            name="konfirmasi"
            id="konfirmasi"
            value="1"
            required
        >

        <label class="form-check-label" for="konfirmasi">
            Saya mengonfirmasi bahwa data di atas adalah data saya sebagai alumni
            KOSA Indonesia.
        </label>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="fa-solid fa-arrow-right"></i>
        Konfirmasi & Lanjutkan
    </button>
</form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection