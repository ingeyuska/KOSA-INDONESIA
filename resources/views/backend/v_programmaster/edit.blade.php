@extends('backend.v_layout.app')

@section('title', 'Edit Program')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-pencil"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Alumni Management
                    </p>

                    <h1 class="h3 mb-1">
                        Edit Program
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui data program alumni.
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <h2 class="h5 mb-0 section-title">

                    <i class="bi bi-mortarboard"></i>

                    Form Program

                </h2>

            </div>


            <div class="p-4">

                <form
                    action="{{ route('admin.program-master.update', $program->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- NAMA PROGRAM --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Program
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama', $program->nama) }}"
                            required
                        >

                        @error('nama')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="aktif"
                            class="form-select"
                            required
                        >

                            <option
                                value="1"
                                @selected(old('aktif', $program->aktif) == 1)
                            >
                                Aktif
                            </option>

                            <option
                                value="0"
                                @selected(old('aktif', $program->aktif) == 0)
                            >
                                Tidak Aktif
                            </option>

                        </select>

                        @error('aktif')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-save"></i>

                            Simpan Perubahan

                        </button>


                        <a
                            href="{{ route('admin.program-master.index') }}"
                            class="btn btn-light"
                        >

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </section>

    </div>

</main>

@endsection