@extends('backend.v_layout.app')

@section('title', 'Edit Alumni')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4>Edit Alumni</h4>

        <p class="text-muted">
            Perbarui data alumni KOSA Indonesia
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
        action="{{ route('admin.alumni.update', $alumni->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('backend.v_alumni.form')

    </form>

</div>

@endsection