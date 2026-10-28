@extends('backend.v_layout.app')

@section('title', 'Data Tracer Alumni')

@section('content')

<div class="container-fluid">

    {{-- =========================
        HEADER
    ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Data Tracer Alumni
            </h4>

            <p class="text-muted mb-0">
                Data pekerjaan dan pendidikan alumni
            </p>
        </div>

    </div>


    {{-- =========================
        SEARCH
    ========================= --}}
    <div class="card mb-4">

        <div class="card-body">

            <form action="{{ route('admin.tracer.index') }}" method="GET">

                <div class="row g-2">

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama, email, perusahaan, jabatan..."
                            value="{{ request('search') }}"
                        >

                    </div>

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            <i class="fas fa-search me-1"></i>
                            Cari
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================
        TABLE
    ========================= --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <table
                id="tracerTable"
                class="table table-hover table-sm align-middle data-table"
                style="width:100%;"
            >

                <thead>

                    <tr>

                        <th width="30">
                            No
                        </th>

                        <th>
                            ID Keanggotaan
                        </th>

                        <th>
                            Nama Alumni
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Status Pekerjaan
                        </th>

                        <th>
                            Perusahaan
                        </th>

                        <th>
                            Jabatan
                        </th>

                        <th>
                            Pendidikan
                        </th>

                        <th width="90" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($alumnis as $alumni)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- ID KEANGGOTAAN --}}
                            <td>
                                {{ $alumni->alumni_id ?? '-' }}
                            </td>


                            {{-- NAMA --}}
                            <td>
                                {{ $alumni->user->nama ?? '-' }}
                            </td>


                            {{-- EMAIL --}}
                            <td>
                                {{ $alumni->user->email ?? '-' }}
                            </td>


                            {{-- STATUS PEKERJAAN --}}
                            <td>

                                @if($alumni->status_pekerjaan)

                                    @switch($alumni->status_pekerjaan)

                                        @case('bekerja')

                                            <span class="badge bg-success">
                                                Bekerja
                                            </span>

                                            @break


                                        @case('belum_bekerja')

                                            <span class="badge bg-secondary">
                                                Belum Bekerja
                                            </span>

                                            @break


                                        @case('wirausaha')

                                            <span class="badge bg-warning text-dark">
                                                Wirausaha
                                            </span>

                                            @break


                                        @case('melanjutkan_pendidikan')

                                            <span class="badge bg-info">
                                                Melanjutkan Pendidikan
                                            </span>

                                            @break


                                        @default

                                            <span class="badge bg-secondary">
                                                {{ $alumni->status_pekerjaan }}
                                            </span>

                                    @endswitch

                                @else

                                    <span class="text-muted">
                                        Belum diisi
                                    </span>

                                @endif

                            </td>


                            {{-- PERUSAHAAN --}}
                            <td>
                                {{ $alumni->perusahaan ?? '-' }}
                            </td>


                            {{-- JABATAN --}}
                            <td>
                                {{ $alumni->jabatan ?? '-' }}
                            </td>


                            {{-- PENDIDIKAN --}}
                            <td>
                                {{ $alumni->pendidikan_terakhir ?? '-' }}
                            </td>


                            {{-- AKSI --}}
                            <td class="text-center">

                                <a
                                    href="{{ route('admin.tracer.show', $alumni->id) }}"
                                    class="btn btn-sm btn-info"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection