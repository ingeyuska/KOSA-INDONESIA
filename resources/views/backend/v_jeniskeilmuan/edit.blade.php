@extends('backend.v_layout.app')

@section('title', 'Edit Jenis Keilmuan')

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
                        Edit Jenis Keilmuan
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui data jenis keilmuan.
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <h2 class="h5 mb-0 section-title">

                    <i class="bi bi-book"></i>

                    Form Jenis Keilmuan

                </h2>

            </div>


            <div class="p-4">

                <form
                    action="{{ route('admin.jenis-keilmuan.update', $jenis_keilmuan->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Jenis Keilmuan
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama', $jenis_keilmuan->nama) }}"
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
                                @selected($jenis_keilmuan->aktif)
                            >
                                Aktif
                            </option>

                            <option
                                value="0"
                                @selected(!$jenis_keilmuan->aktif)
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
                            href="{{ route('admin.jenis-keilmuan.index') }}"
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