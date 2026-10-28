@extends('backend.v_layout.app')

@section('title', 'Tambah Alumni')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4>Tambah Alumni</h4>

        <p class="text-muted">
            Tambahkan data alumni baru
        </p>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.alumni.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @include('backend.v_alumni.form')

    </form>

</div>

@endsection