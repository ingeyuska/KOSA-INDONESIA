@extends('backend.v_layout.app')

@section('title', 'Tentang KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Tentang KOSA Indonesia
            </h1>

            <p class="text-muted mb-0">
                Kelola informasi tentang KOSA Indonesia
            </p>
        </div>

        <a href="{{ route('admin.tentang.create') }}"
           class="btn btn-primary">

            <i class="fa-solid fa-plus me-1"></i>

            Tambah Tentang

        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Data Tentang KOSA
            </h5>

        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="60">
                                No
                            </th>

                            <th width="120">
                                Foto
                            </th>

                            <th>
                                Judul
                            </th>

                            <th>
                                Deskripsi
                            </th>

                            <th width="180">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($tentangs as $tentang)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                {{-- FOTO --}}
                                <td>
                                    @if($tentang->foto)
                                        <img
                                            src="{{ asset('storage/' . $tentang->foto) }}"
                                            alt="{{ $tentang->judul }}"
                                            width="80"
                                            height="60"
                                            style="object-fit: cover; border-radius: 8px;">

                                    @else
                                        <div
                                            class="bg-light d-flex align-items-center justify-content-center"
                                            style="width:80px;height:60px;border-radius:8px;">

                                            <i class="fa-solid fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- JUDUL --}}
                                <td>
                                    <strong>
                                        {{ $tentang->judul }}
                                    </strong>
                                </td>


                                {{-- DESKRIPSI --}}
                                <td>
                                    {{ Str::limit(
                                        strip_tags($tentang->deskripsi),
                                        100
                                    ) }}

                                </td>

                               {{-- AKSI --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.tentang.edit', $tentang->id) }}"
                                            class="btn btn-light btn-sm"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.tentang.destroy', $tentang->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data Tentang KOSA ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-light btn-sm text-danger"
                                                title="Hapus"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="fa-solid fa-circle-info fa-2x mb-3"
                                        ></i>

                                        <p class="mb-0">
                                            Belum ada data Tentang KOSA.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection