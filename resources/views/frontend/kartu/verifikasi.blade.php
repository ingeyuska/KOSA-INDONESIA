<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Verifikasi Anggota - KOSA Indonesia</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef4f8;
            color: #123d7a;
        }

        .verifikasi-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;
        }

        .verifikasi-card {
            width: 100%;
            max-width: 500px;

            background: #fff;

            border-radius: 20px;

            padding: 40px 35px;

            text-align: center;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, .12);
        }

        .verifikasi-logo {
            font-size: 24px;
            font-weight: 800;

            letter-spacing: 2px;

            color: #123d7a;

            margin-bottom: 25px;
        }

        .verifikasi-icon {
            width: 80px;
            height: 80px;

            margin: 0 auto 20px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;
        }

        .valid {
            background: #e7f8ef;
            color: #16a56b;
        }

        .invalid {
            background: #fdeaea;
            color: #dc3545;
        }

        .verifikasi-card h2 {
            margin: 0 0 10px;

            color: #123d7a;

            font-size: 25px;
        }

        .verifikasi-info {
            color: #666;

            line-height: 1.6;

            margin-bottom: 25px;
        }

        .verifikasi-data {
            text-align: left;

            border-top: 1px solid #eee;
        }

        .verifikasi-row {
            display: grid;

            grid-template-columns: 130px 20px 1fr;

            padding: 14px 0;

            border-bottom: 1px solid #eee;
        }

        .verifikasi-row span {
            color: #666;
        }

        .verifikasi-row strong {
            color: #123d7a;
            font-weight: 700;
        }

        .verifikasi-footer {
            margin-top: 25px;

            font-size: 12px;

            color: #999;

            letter-spacing: 1px;
        }

        @media (max-width: 500px) {

            .verifikasi-card {
                padding: 30px 20px;
            }

            .verifikasi-row {
                grid-template-columns: 105px 15px 1fr;

                font-size: 14px;
            }

            .verifikasi-card h2 {
                font-size: 21px;
            }

        }

    </style>

</head>


<body>

<div class="verifikasi-page">

    <div class="verifikasi-card">

        <div class="verifikasi-logo">
            KOSA INDONESIA
        </div>


        @if($alumni)

            {{-- DATA ALUMNI DITEMUKAN --}}

            @if($aktif)

                {{-- AKTIF --}}

                <div class="verifikasi-icon valid">
                    ✓
                </div>

                <h2>
                    ANGGOTA VALID
                </h2>

                <p class="verifikasi-info">
                    Data anggota KOSA Indonesia berhasil
                    ditemukan dan terverifikasi.
                </p>

            @else

                {{-- KARTU TIDAK AKTIF --}}

                <div class="verifikasi-icon invalid">
                    ✕
                </div>

                <h2>
                    KARTU TIDAK AKTIF
                </h2>

                <p class="verifikasi-info">
                    Data anggota ditemukan, tetapi kartu
                    keanggotaan sudah tidak aktif atau telah
                    melewati masa berlaku.
                </p>

            @endif


            <div class="verifikasi-data">

                <div class="verifikasi-row">

                    <span>Nama</span>

                    <b>:</b>

                    <strong>
                        {{ $alumni->nama }}
                    </strong>

                </div>


                <div class="verifikasi-row">

                    <span>ID Alumni</span>

                    <b>:</b>

                    <strong>
                        {{ $alumni->alumni_id ?? '-' }}
                    </strong>

                </div>


                <div class="verifikasi-row">

                    <span>Thn. Lulus</span>

                    <b>:</b>

                    <strong>
                        {{ $alumni->tahun_lulus ?? '-' }}
                    </strong>

                </div>


                <div class="verifikasi-row">

                    <span>Program Studi</span>

                    <b>:</b>

                    <strong>
                        {{ $alumni->jurusan ?? '-' }}
                    </strong>

                </div>


                <div class="verifikasi-row">

                    <span>Status</span>

                    <b>:</b>

                    <strong>
                        {{ $aktif ? 'AKTIF' : 'TIDAK AKTIF' }}
                    </strong>

                </div>


                @if($kartu)

                    <div class="verifikasi-row">

                        <span>Berlaku Sampai</span>

                        <b>:</b>

                        <strong>
                            {{ $kartu->tanggal_berlaku_sampai?->format('d-m-Y') ?? '-' }}
                        </strong>

                    </div>

                @endif

            </div>


        @else

            {{-- TIDAK VALID --}}

            <div class="verifikasi-icon invalid">
                ✕
            </div>

            <h2>
                ANGGOTA TIDAK VALID
            </h2>

            <p class="verifikasi-info">
                ID Alumni tidak ditemukan atau tidak
                terdaftar sebagai anggota KOSA Indonesia.
            </p>

        @endif


        <div class="verifikasi-footer">
            KARTU KEANGGOTAAN &bull; KOSA INDONESIA
        </div>

    </div>

</div>

</body>

</html>