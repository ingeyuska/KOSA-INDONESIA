@extends('backend.v_manajemen.layout.app')

@section('title', 'Dashboard Manajemen')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
    <h3 class="mb-1">
            Dashboard Manajemen
        </h3>        
        <p class="text-muted">
            Selamat datang, {{ auth()->user()->nama }}
        </p>
    </div>

    <div class="row">

        {{-- DATA ALUMNI --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-users fa-2x"></i>
                        </div>

                        <div>
                            <h6 class="text-muted mb-1">
                                Manage Data Alumni
                            </h6>

                            <h4 class="fw-bold mb-0">
                                Data Alumni
                            </h4>
                        </div>
                    </div>

                    <a href="{{ route('manajemen.alumni.index') }}"
                       class="btn btn-primary mt-3">
                        Kelola Data Alumni
                    </a>

                </div>
            </div>
        </div>


        {{-- TRACER ALUMNI --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-chart-line fa-2x"></i>
                        </div>

                        <div>
                            <h6 class="text-muted mb-1">
                                Tracer Alumni
                            </h6>

                            <h4 class="fw-bold mb-0">
                                Data Tracer
                            </h4>
                        </div>
                    </div>

                    <a href="{{ route('manajemen.tracer.index') }}"
                       class="btn btn-primary mt-3">
                        Lihat Tracer Alumni
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection