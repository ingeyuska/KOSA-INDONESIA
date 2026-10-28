@extends('frontend.member.layouts.app')

@section('title', $event->judul . ' - Portal Member KOSA Indonesia')

@section('content')

<section class="kosa-event-detail">

    <div class="container">

        {{-- =====================================================
            HEADER / BACK
        ====================================================== --}}

        <div class="event-detail-back">
            <a href="{{ route('member.event') }}">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Event
            </a>
        </div>


        {{-- =====================================================
            EVENT DETAIL CARD
        ====================================================== --}}

        <div class="event-detail-card">

            {{-- FOTO EVENT --}}

            @if($event->foto)

                <div class="event-detail-image">
                    <img
                        src="{{ asset('storage/' . $event->foto) }}"
                        alt="{{ $event->judul }}">
                </div>

            @else

                <div class="event-detail-no-image">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

            @endif


            {{-- CONTENT --}}

            <div class="event-detail-content">

                {{-- TANGGAL --}}

                <span class="event-detail-date">

                    <i class="fa-regular fa-calendar"></i>

                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}

                </span>


                {{-- JUDUL --}}

                <h1>
                    {{ $event->judul }}
                </h1>


                {{-- INFO EVENT --}}

                <div class="event-detail-info">

                    @if($event->waktu)

                        <div class="event-info-item">

                            <i class="fa-regular fa-clock"></i>

                            <div>
                                <span>Waktu</span>

                                <strong>
                                    {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}
                                    WIB
                                </strong>
                            </div>

                        </div>

                    @endif


                    @if($event->lokasi)

                        <div class="event-info-item">

                            <i class="fa-solid fa-location-dot"></i>

                            <div>
                                <span>Lokasi</span>

                                <strong>
                                    {{ $event->lokasi }}
                                </strong>
                            </div>

                        </div>

                    @endif

                </div>


                {{-- DESKRIPSI --}}

                @if($event->deskripsi)

                    <div class="event-detail-description">

                        <h2>
                            Tentang Event
                        </h2>

                        <p>
                            {!! nl2br(e($event->deskripsi)) !!}
                        </p>

                    </div>

                @endif


                {{-- =================================================
                    PENDAFTARAN
                ================================================== --}}

                @if($event->pendaftaran_aktif)

                    <div class="event-registration-box">

                        <div>

                            <strong>
                                Ingin mengikuti event ini?
                            </strong>

                            <p>
                                Segera daftarkan diri kamu untuk mengikuti kegiatan KOSA Indonesia.
                            </p>

                        </div>

                        <a
                            href="{{ route('member.event.daftar', $event->slug) }}"
                            class="event-registration-button"
                        >
                            <i class="fa-solid fa-user-plus"></i>
                            Daftar Event
                        </a>

                    </div>

                @endif


                {{-- =================================================
                    MATERI
                ================================================== --}}

                @if($event->materi)

                    <div class="event-material-box">

                        <div>

                            <i class="fa-solid fa-file-lines"></i>

                            <div>

                                <strong>
                                    Materi Paparan
                                </strong>

                                <p>
                                    Materi yang digunakan dalam event ini.
                                </p>

                            </div>

                        </div>

                        <a
                            href="{{ asset('storage/' . $event->materi) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <i class="fa-solid fa-download"></i>
                            Lihat Materi
                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
            TESTIMONI
        ====================================================== --}}

        @php

            $testimonis = $event->testimonis()
                ->where('status', 'disetujui')
                ->with('user')
                ->latest()
                ->get();

            $peserta = \App\Models\Pendaftaran::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->where('hadir', true)
                ->exists();

            $sudahTestimoni = \App\Models\Testimoni::where('event_id', $event->id)
                ->where('user_id', auth()->id())
                ->first();

            $eventSelesai = $event->tanggal &&
                $event->tanggal->lt(\Carbon\Carbon::today());

        @endphp


        <div class="event-testimoni-section">

            {{-- HEADER TESTIMONI --}}

            <div class="event-section-heading">

                <span>
                    TESTIMONI PESERTA
                </span>

                <h2>
                    Apa Kata Peserta?
                </h2>

                <p>
                    Bagikan pengalaman kamu setelah mengikuti event KOSA Indonesia.
                </p>

            </div>


            {{-- =================================================
                DAFTAR TESTIMONI
            ================================================== --}}

            @if($testimonis->count())

                <div class="event-testimoni-list">

                    @foreach($testimonis as $testimoni)

                        <div class="event-testimoni-card">

                            <div class="testimoni-user">

                                <div class="testimoni-avatar">

                                    @if($testimoni->user?->foto)

                                        <img
                                            src="{{ asset('storage/' . $testimoni->user->foto) }}"
                                            alt="{{ $testimoni->user->nama }}"
                                        >

                                    @else

                                        <i class="fa-solid fa-user"></i>

                                    @endif

                                </div>


                                <div>

                                    <strong>
                                        {{ $testimoni->user?->nama ?? 'Peserta' }}
                                    </strong>

                                    <div class="testimoni-stars">

                                        @for($i = 1; $i <= 5; $i++)

                                            @if($i <= $testimoni->rating)

                                                <i class="fa-solid fa-star"></i>

                                            @else

                                                <i class="fa-regular fa-star"></i>

                                            @endif

                                        @endfor

                                    </div>

                                </div>

                            </div>


                            <div class="testimoni-comment">

                                <i class="fa-solid fa-quote-left"></i>

                                <p>
                                    {{ $testimoni->komentar }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="event-testimoni-empty">

                    <i class="fa-regular fa-comment-dots"></i>

                    <h3>
                        Belum Ada Testimoni
                    </h3>

                    <p>
                        Belum ada peserta yang memberikan testimoni untuk event ini.
                    </p>

                </div>

            @endif


            {{-- =================================================
                FORM TESTIMONI
            ================================================== --}}

            @auth

                @if(in_array(auth()->user()->role, ['member', 'alumni']))

                    @if($eventSelesai)

                        @if($peserta)

                            @if(!$sudahTestimoni)

                                <div class="event-testimoni-form">

                                    <div class="testimoni-form-heading">

                                        <h3>
                                            Bagikan Pengalamanmu
                                        </h3>

                                        <p>
                                            Bagaimana pengalaman kamu mengikuti event ini?
                                        </p>

                                    </div>


                                    <form
                                        action="{{ route('event.testimoni.store', $event->id) }}"
                                        method="POST"
                                    >

                                        @csrf


                                        {{-- RATING --}}

                                        <div class="rating-form-group">

                                            <label>
                                                Berikan Rating
                                            </label>

                                            <div class="rating-stars-input">

                                                @for($i = 5; $i >= 1; $i--)

                                                    <input
                                                        type="radio"
                                                        id="rating-{{ $i }}"
                                                        name="rating"
                                                        value="{{ $i }}"
                                                        required
                                                    >

                                                    <label
                                                        for="rating-{{ $i }}"
                                                        title="{{ $i }} bintang"
                                                    >
                                                        <i class="fa-solid fa-star"></i>
                                                    </label>

                                                @endfor

                                            </div>

                                            @error('rating')

                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>

                                            @enderror

                                        </div>


                                        {{-- KOMENTAR --}}

                                        <div class="comment-form-group">

                                            <label for="komentar">
                                                Testimoni
                                            </label>

                                            <textarea
                                                id="komentar"
                                                name="komentar"
                                                rows="5"
                                                maxlength="1000"
                                                placeholder="Tuliskan pengalaman kamu mengikuti event ini..."
                                                required
                                            >{{ old('komentar') }}</textarea>

                                            @error('komentar')

                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>

                                            @enderror

                                        </div>


                                        <button
                                            type="submit"
                                            class="testimoni-submit-button"
                                        >

                                            <i class="fa-solid fa-paper-plane"></i>

                                            Kirim Testimoni

                                        </button>

                                    </form>

                                </div>

                            @elseif($sudahTestimoni->status === 'pending')

                                <div class="testimoni-status pending">

                                    <i class="fa-regular fa-clock"></i>

                                    <div>

                                        <strong>
                                            Testimoni Sedang Ditinjau
                                        </strong>

                                        <p>
                                            Terima kasih. Testimoni kamu sedang menunggu persetujuan admin.
                                        </p>

                                    </div>

                                </div>

                            @elseif($sudahTestimoni->status === 'disetujui')

                                <div class="testimoni-status approved">

                                    <i class="fa-solid fa-circle-check"></i>

                                    <div>

                                        <strong>
                                            Testimoni Kamu Sudah Ditampilkan
                                        </strong>

                                        <p>
                                            Terima kasih sudah membagikan pengalamanmu.
                                        </p>

                                    </div>

                                </div>

                            @else

                                <div class="testimoni-status rejected">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    <div>

                                        <strong>
                                            Testimoni Tidak Disetujui
                                        </strong>

                                        <p>
                                            Testimoni kamu tidak dapat ditampilkan.
                                        </p>

                                    </div>

                                </div>

                            @endif

                        @else

                            <div class="testimoni-info">

                                <i class="fa-solid fa-circle-info"></i>

                                <p>
                                    Testimoni hanya dapat diberikan oleh peserta yang
                                    terdaftar dan hadir pada event ini.
                                </p>

                            </div>

                        @endif

                    @endif

                @endif

            @endauth

        </div>

    </div>

</section>


<style>

/* =========================================================
   EVENT DETAIL
========================================================= */

.kosa-event-detail {
    padding: 35px 0 60px;
}

.event-detail-back {
    margin-bottom: 20px;
}

.event-detail-back a {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: #3155a5;
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;
}

.event-detail-back a:hover {
    color: #172b4d;
}


/* =========================================================
   DETAIL CARD
========================================================= */

.event-detail-card {
    overflow: hidden;

    background: #fff;

    border-radius: 18px;

    box-shadow:
        0 8px 30px rgba(31, 45, 61, 0.07);
}

.event-detail-image {
    width: 100%;
    height: 360px;
}

.event-detail-image img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;
}

.event-detail-no-image {
    width: 100%;
    height: 300px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #edf3f9;

    color: #3155a5;

    font-size: 60px;
}

.event-detail-content {
    padding: 35px;
}

.event-detail-date {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 10px;

    color: #3155a5;

    font-size: 13px;
    font-weight: 700;
}

.event-detail-content h1 {
    margin: 0 0 25px;

    color: #172b4d;

    font-size: 32px;
    font-weight: 700;

    line-height: 1.3;
}


/* =========================================================
   EVENT INFO
========================================================= */

.event-detail-info {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;

    padding-bottom: 25px;

    border-bottom: 1px solid #edf0f4;
}

.event-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.event-info-item > i {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #edf3f9;

    color: #3155a5;
}

.event-info-item span {
    display: block;

    margin-bottom: 3px;

    color: #8a96a3;

    font-size: 11px;
}

.event-info-item strong {
    color: #344563;

    font-size: 14px;
}


/* =========================================================
   DESCRIPTION
========================================================= */

.event-detail-description {
    padding-top: 28px;
}

.event-detail-description h2 {
    margin: 0 0 12px;

    color: #172b4d;

    font-size: 21px;
}

.event-detail-description p {
    margin: 0;

    color: #66788a;

    font-size: 14px;

    line-height: 1.8;
}


/* =========================================================
   REGISTRATION
========================================================= */

.event-registration-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    margin-top: 30px;
    padding: 22px;

    border-radius: 14px;

    background: #f1f5fb;
}

.event-registration-box strong {
    display: block;

    margin-bottom: 5px;

    color: #172b4d;
}

.event-registration-box p {
    margin: 0;

    color: #718096;

    font-size: 13px;
}

.event-registration-button {
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 11px 18px;

    border-radius: 9px;

    background: #3155a5;

    color: #fff;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;
}

.event-registration-button:hover {
    background: #24438a;

    color: #fff;
}


/* =========================================================
   MATERIAL
========================================================= */

.event-material-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    margin-top: 20px;
    padding: 20px;

    border: 1px solid #e4e9ef;

    border-radius: 13px;
}

.event-material-box > div {
    display: flex;
    align-items: center;
    gap: 12px;
}

.event-material-box > div > i {
    font-size: 24px;

    color: #3155a5;
}

.event-material-box strong {
    display: block;

    color: #344563;

    font-size: 14px;
}

.event-material-box p {
    margin: 4px 0 0;

    color: #8a96a3;

    font-size: 12px;
}

.event-material-box > a {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    color: #3155a5;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;
}


/* =========================================================
   TESTIMONI SECTION
========================================================= */

.event-testimoni-section {
    margin-top: 35px;
    padding: 35px;

    background: #fff;

    border-radius: 18px;

    box-shadow:
        0 8px 30px rgba(31, 45, 61, 0.07);
}

.event-section-heading {
    margin-bottom: 25px;
}

.event-section-heading > span {
    display: block;

    margin-bottom: 7px;

    color: #3155a5;

    font-size: 11px;
    font-weight: 700;

    letter-spacing: 1px;
}

.event-section-heading h2 {
    margin: 0 0 7px;

    color: #172b4d;

    font-size: 25px;
}

.event-section-heading p {
    margin: 0;

    color: #7b8794;

    font-size: 13px;
}


/* =========================================================
   TESTIMONI LIST
========================================================= */

.event-testimoni-list {
    display: grid;

    gap: 15px;
}

.event-testimoni-card {
    padding: 20px;

    border: 1px solid #e7ebf0;

    border-radius: 13px;

    background: #fafbfd;
}

.testimoni-user {
    display: flex;
    align-items: center;
    gap: 12px;
}

.testimoni-avatar {
    width: 45px;
    height: 45px;

    flex-shrink: 0;

    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #edf3f9;

    color: #3155a5;
}

.testimoni-avatar img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}

.testimoni-user strong {
    display: block;

    color: #344563;

    font-size: 14px;
}

.testimoni-stars {
    margin-top: 4px;
}

.testimoni-stars i {
    color: #f5b301;

    font-size: 12px;
}

.testimoni-comment {
    position: relative;

    margin-top: 16px;

    padding-left: 25px;
}

.testimoni-comment > i {
    position: absolute;

    top: 3px;
    left: 0;

    color: #aab5c2;

    font-size: 15px;
}

.testimoni-comment p {
    margin: 0;

    color: #68788a;

    font-size: 13px;

    line-height: 1.7;
}


/* =========================================================
   EMPTY
========================================================= */

.event-testimoni-empty {
    padding: 30px;

    text-align: center;

    border: 1px dashed #d5dce5;

    border-radius: 13px;
}

.event-testimoni-empty > i {
    margin-bottom: 10px;

    color: #b5c0cd;

    font-size: 30px;
}

.event-testimoni-empty h3 {
    margin: 0 0 5px;

    color: #344563;

    font-size: 16px;
}

.event-testimoni-empty p {
    margin: 0;

    color: #8a96a3;

    font-size: 13px;
}


/* =========================================================
   FORM TESTIMONI
========================================================= */

.event-testimoni-form {
    margin-top: 25px;

    padding: 25px;

    border-radius: 14px;

    background: #f7f9fc;

    border: 1px solid #e3e8ef;
}

.testimoni-form-heading h3 {
    margin: 0 0 5px;

    color: #172b4d;

    font-size: 19px;
}

.testimoni-form-heading p {
    margin: 0 0 20px;

    color: #7b8794;

    font-size: 13px;
}


/* =========================================================
   RATING INPUT
========================================================= */

.rating-form-group {
    margin-bottom: 20px;
}

.rating-form-group > label,
.comment-form-group > label {
    display: block;

    margin-bottom: 8px;

    color: #344563;

    font-size: 13px;
    font-weight: 600;
}

.rating-stars-input {
    display: flex;

    flex-direction: row-reverse;

    justify-content: flex-end;

    width: fit-content;
}

.rating-stars-input input {
    display: none;
}

.rating-stars-input label {
    padding: 2px;

    cursor: pointer;

    color: #cbd5e1;

    font-size: 26px;

    transition: 0.2s;
}

.rating-stars-input label:hover,
.rating-stars-input label:hover ~ label,
.rating-stars-input input:checked ~ label {
    color: #f5b301;
}


/* =========================================================
   COMMENT
========================================================= */

.comment-form-group textarea {
    width: 100%;

    box-sizing: border-box;

    padding: 13px 15px;

    border: 1px solid #d6dde6;

    border-radius: 10px;

    background: #fff;

    color: #344563;

    font-family: inherit;

    font-size: 13px;

    resize: vertical;

    outline: none;
}

.comment-form-group textarea:focus {
    border-color: #3155a5;
}


/* =========================================================
   SUBMIT
========================================================= */

.testimoni-submit-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-top: 17px;

    padding: 11px 18px;

    border: none;

    border-radius: 9px;

    background: #3155a5;

    color: #fff;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;
}

.testimoni-submit-button:hover {
    background: #24438a;
}


/* =========================================================
   STATUS
========================================================= */

.testimoni-status,
.testimoni-info {
    display: flex;
    align-items: flex-start;
    gap: 12px;

    margin-top: 25px;
    padding: 17px;

    border-radius: 12px;

    background: #f7f9fc;
}

.testimoni-status > i,
.testimoni-info > i {
    margin-top: 2px;

    font-size: 19px;
}

.testimoni-status strong {
    display: block;

    color: #344563;

    font-size: 13px;
}

.testimoni-status p,
.testimoni-info p {
    margin: 4px 0 0;

    color: #7b8794;

    font-size: 12px;

    line-height: 1.5;
}

.testimoni-status.pending > i {
    color: #f59e0b;
}

.testimoni-status.approved > i {
    color: #16a34a;
}

.testimoni-status.rejected > i {
    color: #dc2626;
}

.testimoni-info > i {
    color: #3155a5;
}


/* =========================================================
   ERROR
========================================================= */

.text-danger {
    display: block;

    margin-top: 5px;

    color: #dc2626;

    font-size: 12px;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .kosa-event-detail {
        padding: 20px 0 40px;
    }

    .event-detail-image {
        height: 220px;
    }

    .event-detail-no-image {
        height: 220px;
    }

    .event-detail-content {
        padding: 22px 18px;
    }

    .event-detail-content h1 {
        font-size: 24px;
    }

    .event-detail-info {
        display: grid;

        gap: 15px;
    }

    .event-registration-box {
        align-items: flex-start;

        flex-direction: column;

        padding: 18px;
    }

    .event-registration-button {
        width: 100%;

        justify-content: center;
    }

    .event-material-box {
        align-items: flex-start;

        flex-direction: column;
    }

    .event-material-box > a {
        width: 100%;

        justify-content: center;

        padding: 10px;

        border-radius: 8px;

        background: #edf3f9;
    }

    .event-testimoni-section {
        margin-top: 25px;

        padding: 22px 17px;
    }

    .event-section-heading h2 {
        font-size: 21px;
    }

    .event-testimoni-form {
        padding: 18px;
    }

    .rating-stars-input label {
        font-size: 23px;
    }

}

</style>

@endsection