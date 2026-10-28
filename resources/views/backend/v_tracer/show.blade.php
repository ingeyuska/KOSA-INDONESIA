@extends('backend.v_layout.app')

@section('title', 'Detail Tracer Alumni')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4>Detail Tracer Alumni</h4>

            <p class="text-muted mb-0">
                Informasi tracer alumni
            </p>

        </div>

        <a
            href="{{ route('admin.tracer.index') }}"
            class="btn btn-secondary"
        >
            ← Kembali
        </a>

    </div>


    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Nama Alumni</th>
                    <td>
                        {{ $alumni->user->nama ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>
                        {{ $alumni->user->email ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Status Pekerjaan</th>
                    <td>
                        {{ ucwords(str_replace('_', ' ', $alumni->status_pekerjaan ?? '-')) }}
                    </td>
                </tr>

                <tr>
                    <th>Bidang Pekerjaan</th>
                    <td>
                        {{ $alumni->bidang_pekerjaan ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Perusahaan / Institusi</th>
                    <td>
                        {{ $alumni->perusahaan ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Jabatan</th>
                    <td>
                        {{ $alumni->jabatan ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Lokasi Pekerjaan</th>
                    <td>
                        {{ $alumni->lokasi_pekerjaan ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Tahun Mulai</th>
                    <td>
                        {{ $alumni->tahun_mulai ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>
                        {{ $alumni->pendidikan_terakhir ?? '-' }}
                    </td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection