@extends('backend.v_layout.app')

@section('title', 'Aktivasi Alumni Existing')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-bold">
                <i class="fa fa-users text-primary me-2"></i>
                Alumni Existing KOSA
            </h4>

            <p class="text-muted mb-0">
                Kelola data alumni dan kirim link aktivasi akun.
            </p>
        </div>

        {{-- GENERATE --}}
        <form
            action="{{ route('admin.alumni.activation.generate') }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Generate semua data alumni dari database?')"
        >
            @csrf

            <button type="submit" class="btn btn-primary px-4">
                <i class="fa fa-database me-2"></i>
                Generate Data Alumni
            </button>
        </form>

    </div>


    {{-- =====================================================
        ALERT SUCCESS
    ====================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">

            <i class="fa fa-check-circle me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =====================================================
        ALERT ERROR
    ====================================================== --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">

            <i class="fa fa-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =====================================================
        VALIDATION ERROR
    ====================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">

            @foreach($errors->all() as $error)

                <div>
                    <i class="fa fa-circle-exclamation me-1"></i>
                    {{ $error }}
                </div>

            @endforeach

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =====================================================
        FORM BULK EMAIL
        Dibuat terpisah agar tidak terjadi nested form
    ====================================================== --}}
    <form
        id="bulkActivationForm"
        action="{{ route('admin.alumni.activation.sendBulk') }}"
        method="POST"
    >
        @csrf
    </form>


    {{-- =====================================================
        CARD DATA ALUMNI
    ====================================================== --}}
    <div class="card shadow-sm border-0">

        {{-- CARD HEADER --}}
        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-1 fw-bold">
                        <i class="fa fa-users text-primary me-2"></i>
                        Data Alumni Existing
                    </h5>

                    <small class="text-muted">
                        Pilih alumni yang ingin dikirimkan link aktivasi.
                    </small>
                </div>

                <button
                    type="submit"
                    form="bulkActivationForm"
                    class="btn btn-success"
                    onclick="return confirm('Kirim email aktivasi ke alumni yang dipilih?')"
                >
                    <i class="fa fa-paper-plane me-2"></i>
                    Kirim Email Terpilih
                </button>

            </div>

        </div>


        {{-- CARD BODY --}}
        <div class="card-body">

            <table
                id="alumniActivationTable"
                class="table table-hover table-sm align-middle data-table"
                style="width:100%; font-size:12px;"
            >

                <thead>

                    <tr>

                        <th width="40" class="text-center">
                            <input
                                type="checkbox"
                                id="checkAll"
                                class="form-check-input"
                            >
                        </th>

                        <th width="50">
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            No. HP
                        </th>

                        <th>
                            Status
                        </th>

                        <th width="100" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($invitations as $invitation)

                        <tr>

                            {{-- CHECKBOX --}}
                            <td class="text-center">

                                @if(!$invitation->used)

                                    <input
                                        type="checkbox"
                                        name="ids[]"
                                        value="{{ $invitation->id }}"
                                        class="form-check-input check-item"
                                        form="bulkActivationForm"
                                    >

                                @endif

                            </td>


                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- NAMA --}}
                            <td>
                                <span class="fw-semibold">
                                    {{ $invitation->nama_lengkap }}
                                </span>
                            </td>


                            {{-- EMAIL --}}
                            <td>
                                {{ $invitation->email }}
                            </td>


                            {{-- NO HP --}}
                            <td>
                                {{ $invitation->no_hp ?? '-' }}
                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($invitation->used)

                                    <span class="badge bg-success">
                                        <i class="fa fa-check-circle me-1"></i>
                                        Sudah Aktif
                                    </span>

                                @elseif($invitation->token)

                                    <span class="badge bg-info">
                                        <i class="fa fa-envelope me-1"></i>
                                        Link Terkirim
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        <i class="fa fa-clock me-1"></i>
                                        Belum Dikirim
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-1">

                                    {{-- KIRIM ULANG --}}
                                    @if(!$invitation->used)

                                        <form
                                            action="{{ route('admin.alumni.activation.resend', $invitation->id) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-sm"
                                                title="Kirim Aktivasi"
                                            >
                                                <i class="fa fa-paper-plane"></i>
                                            </button>

                                        </form>

                                    @endif


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.alumni.activation.destroy', $invitation->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Hapus data ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus"
                                        >
                                            <i class="fa fa-trash"></i>
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


{{-- =====================================================
    CHECK ALL
====================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkAll = document.getElementById('checkAll');

    if (!checkAll) {
        return;
    }

    checkAll.addEventListener('change', function () {

        document
            .querySelectorAll('.check-item')
            .forEach(function (checkbox) {

                checkbox.checked = checkAll.checked;

            });

    });

});
</script>

@endsection