@extends('backend.v_layout.app')

@section('title', 'Edit Klasifikasi Program')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

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
                        Edit Klasifikasi Program
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui data klasifikasi program.
                    </p>

                </div>

            </div>

        </div>


        <section class="panel mt-3">

            <div class="panel-header">

                <h2 class="h5 mb-0 section-title">

                    <i class="bi bi-tags"></i>

                    Form Klasifikasi Program

                </h2>

            </div>


            <div class="p-4">

                <form
                    action="{{ route(
                        'admin.klasifikasi-program.update',
                        ['klasifikasi_program' => $klasifikasiProgram->id]
                    ) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Klasifikasi
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama', $klasifikasiProgram->nama) }}"
                            required
                        >

                        @error('nama')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


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
                                @selected(old('aktif', $klasifikasiProgram->aktif) == 1)
                            >
                                Aktif
                            </option>

                            <option
                                value="0"
                                @selected(old('aktif', $klasifikasiProgram->aktif) == 0)
                            >
                                Tidak Aktif
                            </option>

                        </select>

                    </div>


                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-save"></i>

                            Simpan Perubahan

                        </button>


                        <a
                            href="{{ route('admin.klasifikasi-program.index') }}"
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