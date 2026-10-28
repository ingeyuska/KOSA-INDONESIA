@extends('backend.v_layout.app')

@section('title', 'Pengurus KOSA')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Pengurus KOSA Indonesia
            </h1>

            <p class="text-muted mb-0">
                Kelola data pengurus KOSA Indonesia.
            </p>
        </div>

        <a
            href="{{ route('admin.pengurus.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Pengurus
        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th width="100">
                                Foto
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Jabatan
                            </th>

                            <th>
                                Urutan
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pengurus as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- FOTO --}}
                                <td>

                                    @if($item->foto)

                                        <img
                                            src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->nama }}"
                                            width="60"
                                            height="60"
                                            style="
                                                object-fit: cover;
                                                border-radius: 10px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="bg-light d-flex align-items-center justify-content-center"
                                            style="
                                                width:60px;
                                                height:60px;
                                                border-radius:10px;
                                            "
                                        >

                                            <i class="fas fa-pengurus text-muted"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <strong>
                                        {{ $item->nama }}
                                    </strong>

                                </td>


                                {{-- JABATAN --}}
                                <td>
                                    {{ $item->jabatan }}
                                </td>


                                {{-- URUTAN --}}
                                <td>
                                    {{ $item->urutan }}
                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($item->status)

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
                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-1">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.pengurus.edit', $item->id) }}"
                                        class="btn btn-light btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- HAPUS --}}
                                    @if($item->id !== auth()->id())

                                        <form
                                            action="{{ route('admin.pengurus.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')"
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

                                    @else

                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm text-muted"
                                            title="Akun yang sedang digunakan tidak dapat dihapus"
                                            disabled
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    @endif

                                </div>

                            </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <p class="text-muted mb-0">
                                        Belum ada data pengurus KOSA Indonesia.
                                    </p>

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