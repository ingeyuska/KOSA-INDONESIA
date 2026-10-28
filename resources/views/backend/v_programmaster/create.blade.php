@extends('backend.v_layout.app')

@section('title', 'Tambah Program')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-plus-circle"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Alumni Management
                    </p>

                    <h1 class="h3 mb-1">
                        Tambah Program
                    </h1>

                    <p class="text-muted mb-0">
                        Tambahkan pilihan program alumni.
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
                    action="{{ route('admin.program-master.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- NAMA PROGRAM --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Program
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama') }}"
                            placeholder="Contoh: Degree Program"
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

                            <option value="1"
                                @selected(old('aktif', 1) == 1)
                            >
                                Aktif
                            </option>

                            <option value="0"
                                @selected(old('aktif') === '0')
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

                            Simpan

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