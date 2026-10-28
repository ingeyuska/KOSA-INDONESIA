@extends('backend.v_layout.app')

@section('title', 'Tambah Alumni Existing')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                Tambah Alumni Existing KOSA
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.alumni.activation.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="nama_lengkap"
                           class="form-control"
                           value="{{ old('nama_lengkap') }}"
                           required>

                    @error('nama_lengkap')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        No. HP
                    </label>

                    <input type="text"
                           name="no_hp"
                           class="form-control"
                           value="{{ old('no_hp') }}">

                </div>


                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn btn-primary">

                        Simpan

                    </button>

                    <a href="{{ route('admin.alumni.activation.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection