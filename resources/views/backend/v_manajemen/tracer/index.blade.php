@extends('backend.v_manajemen.layout.app')

@section('title', 'Tracer Alumni')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3 class="mb-1">Tracer Alumni</h3>

        <p class="text-muted">
            Data tracer alumni KOSA Indonesia
        </p>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alumni</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($alumni as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->user->nama ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->user->email ?? '-' }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('manajemen.tracer.show', $item->id) }}"
                                        class="btn btn-sm btn-primary">

                                        Lihat Tracer

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center text-muted">

                                    Belum ada data alumni.

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