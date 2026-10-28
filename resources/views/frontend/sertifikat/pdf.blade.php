<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Sertifikat - {{ $pendaftaran->nama_lengkap }}
    </title>

    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: white;
        }

        /* =====================================================
           HALAMAN SERTIFIKAT
        ===================================================== */

        .sertifikat {
            position: relative;

            width: 297mm;
            height: 210mm;

            margin: 0;
            padding: 0;

            overflow: hidden;

            background: white;
        }


        /* =====================================================
           BACKGROUND
        ===================================================== */

        .background {
            position: absolute;

            top: 0;
            left: 0;

            width: 297mm;
            height: 210mm;

            object-fit: fill;

            z-index: 1;
        }


        /* =====================================================
           NOMOR SERTIFIKAT
        ===================================================== */

        .nomor-kosa {
            position: absolute;

            top: 61mm;
            left: 50%;

            transform: translateX(-50%);

            width: 180mm;

            text-align: center;

            font-size: 3.7mm;
            font-weight: 500;

            color: #183675;

            letter-spacing: 0.35mm;

            white-space: nowrap;

            z-index: 2;
        }


        /* =====================================================
           DIBERIKAN KEPADA
        ===================================================== */

        .diberikan-kepada {
            position: absolute;

            top: 69mm;
            left: 50%;

            transform: translateX(-50%);

            width: 200mm;

            text-align: center;

            font-size: 4.3mm;

            color: #202020;

            z-index: 2;
        }


        /* =====================================================
           NAMA PESERTA
        ===================================================== */

        .nama-peserta {
            position: absolute;

            top: 78mm;
            left: 50%;

            transform: translateX(-50%);

            width: 250mm;

            text-align: center;

            font-family:
                Georgia,
                'Times New Roman',
                serif;

            font-size: 16mm;

            line-height: 1;

            font-weight: bold;

            color: #172e6a;

            white-space: nowrap;

            letter-spacing: 0.3mm;

            z-index: 2;
        }


        /* =====================================================
           ORNAMEN NAMA
        ===================================================== */

        .ornamen-nama {
            position: absolute;

            top: 101mm;
            left: 50%;

            transform: translateX(-50%);

            width: 85mm;

            text-align: center;

            z-index: 2;
        }

        .ornamen-nama::before,
        .ornamen-nama::after {
            content: "";

            display: inline-block;

            vertical-align: middle;

            width: 35mm;
            height: 0.35mm;

            background: #c8912e;
        }

        .ornamen-nama span {
            display: inline-block;

            width: 3mm;
            height: 3mm;

            margin: 0 4mm;

            background: #c8912e;

            transform: rotate(45deg);

            vertical-align: middle;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-peserta {
            position: absolute;

            top: 107mm;
            left: 50%;

            transform: translateX(-50%);

            width: 220mm;

            text-align: center;

            font-size: 4.7mm;

            font-weight: bold;

            color: #172e6a;

            letter-spacing: 0.15mm;

            z-index: 2;
        }


        /* =====================================================
           EVENT
        ===================================================== */

        .deskripsi-event {
            position: absolute;

            top: 119mm;
            left: 50%;

            transform: translateX(-50%);

            width: 235mm;

            text-align: center;

            color: #172e6a;

            z-index: 2;
        }

        .nama-event {
            font-family:
                Georgia,
                'Times New Roman',
                serif;

            font-size: 5.8mm;

            font-weight: bold;

            line-height: 1.3;

            margin-bottom: 2mm;
        }

        .penyelenggara {
            font-size: 4.1mm;

            color: #222;

            line-height: 1.4;
        }


        /* =====================================================
           TANGGAL
        ===================================================== */

        .tanggal-sertifikat {
            position: absolute;

            top: 145mm;
            left: 50%;

            transform: translateX(-50%);

            width: 150mm;

            text-align: center;

            font-size: 4mm;

            color: #222;

            white-space: nowrap;

            z-index: 2;
        }


        /* =====================================================
           ORNAMEN TANGGAL
        ===================================================== */

        .ornamen-tanggal {
            position: absolute;

            top: 152mm;
            left: 50%;

            transform: translateX(-50%);

            width: 55mm;

            text-align: center;

            z-index: 2;
        }

        .ornamen-tanggal::before,
        .ornamen-tanggal::after {
            content: "";

            display: inline-block;

            vertical-align: middle;

            width: 20mm;
            height: 0.35mm;

            background: #c8912e;
        }

        .ornamen-tanggal span {
            display: inline-block;

            width: 2.8mm;
            height: 2.8mm;

            margin: 0 3mm;

            background: #c8912e;

            transform: rotate(45deg);

            vertical-align: middle;
        }


        /* =====================================================
           JABATAN
        ===================================================== */

        .jabatan-utama {
            position: absolute;

            top: 157mm;
            left: 50%;

            transform: translateX(-50%);

            width: 180mm;

            text-align: center;

            font-size: 4.4mm;

            line-height: 1.4;

            font-weight: bold;

            color: #172e6a;

            z-index: 2;
        }


        /* =====================================================
           TANDA TANGAN
        ===================================================== */

        .ttd-container {
            position: absolute;

            top: 169mm;
            left: 50%;

            transform: translateX(-50%);

            width: 80mm;

            text-align: center;

            z-index: 2;
        }

        .ttd {
            display: block;

            width: 40mm;
            height: 17mm;

            object-fit: contain;

            margin: 0 auto;
        }


        /* =====================================================
           NAMA PENANDATANGAN
        ===================================================== */

        .nama-penandatangan {
            font-size: 4mm;

            font-weight: bold;

            color: #172e6a;

            margin-top: 1mm;
        }
    </style>
</head>


<body>

    <div class="sertifikat">

        {{-- =================================================
             BACKGROUND SERTIFIKAT
        ================================================== --}}

        <img
            src="{{ public_path('storage/sertifikat/template-sertifikat.png') }}"
            class="background"
            alt="Background Sertifikat"
        >


        {{-- =================================================
             NOMOR SERTIFIKAT
        ================================================== --}}

        @if($pendaftaran->sertifikat_nomor)
            <div class="nomor-kosa">
                No. {{ $pendaftaran->sertifikat_nomor }}
            </div>
        @endif


        {{-- =================================================
             DIBERIKAN KEPADA
        ================================================== --}}

        <div class="diberikan-kepada">
            Dengan ini diberikan kepada
        </div>


        {{-- =================================================
             NAMA PESERTA
        ================================================== --}}

        <div class="nama-peserta">
            {{ $pendaftaran->nama_lengkap }}
        </div>


        {{-- =================================================
             ORNAMEN
        ================================================== --}}

        <div class="ornamen-nama">
            <span></span>
        </div>


        {{-- =================================================
             STATUS
        ================================================== --}}

        <div class="status-peserta">
            SEBAGAI PESERTA
        </div>


        {{-- =================================================
             EVENT
        ================================================== --}}

        <div class="deskripsi-event">

            <div class="nama-event">
                “{{ $pendaftaran->event->judul }}”
            </div>

            <div class="penyelenggara">
                YANG DISELENGGARAKAN OLEH KOSA INDONESIA.
            </div>

        </div>


        {{-- =================================================
             TANGGAL
        ================================================== --}}

        @if($pendaftaran->sertifikat_diterbitkan_at)

            <div class="tanggal-sertifikat">
                {{ $pendaftaran->sertifikat_diterbitkan_at->translatedFormat('d F Y') }}
            </div>

        @endif


        {{-- =================================================
             ORNAMEN TANGGAL
        ================================================== --}}

        <div class="ornamen-tanggal">
            <span></span>
        </div>


        {{-- =================================================
             JABATAN
        ================================================== --}}

        <div class="jabatan-utama">

            KETUA DEWAN PENGURUS
            <br>
            KOSA INDONESIA

        </div>


        {{-- =================================================
             TANDA TANGAN
        ================================================== --}}

        <div class="ttd-container">

            <img
                src="{{ public_path('storage/sertifikat/ttd-ketua.jpeg') }}"
                class="ttd"
                alt="Tanda tangan Ketua KOSA"
            >

            <div class="nama-penandatangan">
                {{ $namaPenandatangan ?? 'Ketua Dewan Pengurus' }}
            </div>

        </div>

    </div>

</body>

</html>