@extends('backend.v_layout.app')

@section('title', 'Pesan Kontak')

@section('content')

<main class="dashboard-content">
    <div class="container-fluid px-3 px-lg-4 py-4">

        {{-- HEADER --}}
        <div class="page-heading">

            <div class="page-heading-copy">

                <span class="page-icon">
                    <i class="bi bi-envelope"></i>
                </span>

                <div>

                    <p class="eyebrow mb-1">
                        Content Management
                    </p>

                    <h1 class="h3 mb-1">
                        Pesan Kontak
                    </h1>

                    <p class="text-muted mb-0">
                        Kelola pesan yang dikirim melalui halaman kontak KOSA.
                    </p>

                </div>

            </div>

        </div>


        {{-- ALERT --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show mt-3">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif


        {{-- TABLE --}}
        <section class="panel mt-3">

            <div class="panel-header">

                <div>

                    <h2 class="h5 mb-1 section-title">

                        <i class="bi bi-envelope"></i>

                        <span>
                            Daftar Pesan
                        </span>

                    </h2>

                    <p class="text-muted mb-0">
                        Pesan yang masuk dari pengunjung website.
                    </p>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Pengirim
                            </th>

                            <th>
                                Subjek
                            </th>

                            <th>
                                Pesan
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th width="150" class="text-end">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pesan as $item)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                {{-- PENGIRIM --}}
                                <td>

                                    <div>

                                        <p class="fw-semibold mb-1">
                                            {{ $item->nama }}
                                        </p>

                                        <p class="text-muted small mb-0">
                                            {{ $item->email }}
                                        </p>

                                    </div>

                                </td>


                                {{-- SUBJEK --}}
                                <td>

                                    {{ $item->subjek ?? '-' }}

                                </td>


                                {{-- PESAN --}}
                                <td>

                                    <span>
                                        {{ Str::limit($item->pesan, 80) }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($item->status === 'baru')

                                        <span class="badge text-bg-primary">
                                            Baru
                                        </span>

                                    @elseif($item->status === 'dibaca')

                                        <span class="badge text-bg-warning">
                                            Dibaca
                                        </span>

                                    @else

                                        <span class="badge text-bg-success">
                                            Dibalas
                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    {{ $item->created_at->format('d M Y H:i') }}

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- LIHAT --}}
                                        <a
                                            href="{{ route('admin.pesan-kontak.show', ['pesanKontak' => $item->id]) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-eye"></i>
                                            Lihat
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.pesan-kontak.destroy', ['pesanKontak' => $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pesan ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-light btn-sm text-danger"
                                            >
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-envelope-open"
                                            style="font-size:40px;"
                                        ></i>

                                        <p class="mt-2 mb-1 fw-semibold">
                                            Belum ada pesan
                                        </p>

                                        <p class="small mb-0">
                                            Pesan dari pengunjung akan muncul di sini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>
</main>

@endsection