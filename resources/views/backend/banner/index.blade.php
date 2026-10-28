@extends('backend.v_layout.app')

@section('title', 'Banner Beranda')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
        HEADER
    ========================================================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                Banner Beranda
            </h4>

            <p class="text-muted mb-0">
                Kelola banner yang tampil pada halaman utama KOSA Indonesia.
            </p>
        </div>

        <a
            href="{{ route('admin.banner.create') }}"
            class="btn btn-primary btn-sm"
        >
            <i class="fa-solid fa-plus me-1"></i>
            Tambah Banner
        </a>

    </div>


    {{-- =========================================================
        SUCCESS
    ========================================================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        DATA BANNER
    ========================================================= --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="bannerTable"
                    class="table table-hover table-sm align-middle mb-0 data-table"
                    style="width:100%; font-size:13px;"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="150">
                                Foto
                            </th>

                            <th width="80">
                                Urutan
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="100">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($banners as $banner)

                            <tr>

                                {{-- =================================================
                                    NO
                                ================================================== --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- =================================================
                                    FOTO
                                ================================================== --}}
                                <td>

                                    @if($banner->foto)

                                        <img
                                            src="{{ asset('storage/' . $banner->foto) }}"
                                            alt="Banner"
                                            style="
                                                width:120px;
                                                height:65px;
                                                object-fit:cover;
                                                border-radius:8px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="
                                                width:120px;
                                                height:65px;
                                                border-radius:8px;
                                            "
                                        >

                                            <i class="fa-solid fa-image text-muted"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- =================================================
                                    URUTAN
                                ================================================== --}}
                                <td>
                                    {{ $banner->urutan }}
                                </td>


                                {{-- =================================================
                                    STATUS
                                ================================================== --}}
                                <td>

                                    @if($banner->status === 'aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class='text-center'>
                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.banner.edit', $banner->id) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.banner.destroy', $banner->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus banner ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-light btn-sm text-dange"
                                                title="Hapus"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection