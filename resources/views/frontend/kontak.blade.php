
@extends('frontend.v_layouts.app')

@section('title', 'Kontak - KOSA Indonesia')

@section('content')

{{--=========================
    PAGE BANNER
========================= --}}
<section class="kosa-page-banner">
    <div class="container">
        <div class="kosa-page-banner-content text-center">
            <h1>Kontak Kami</h1>
            <p>Hubungi KOSA Indonesia</p>
        </div>
    </div>
</section>

{{-- =========================
    KONTAK
========================= --}}
<section class="kosa-contact-section">
    <div class="container">

        <div class="row">

            {{-- TELEPON --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="kosa-contact-card">
                    <div class="kosa-contact-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h3>Telepon</h3>
                    <p>{{ $pengaturan?->telepon ?: '(+62) 812-1231-3840' }}</p>
                </div>
            </div>

            {{-- EMAIL --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="kosa-contact-card">
                    <div class="kosa-contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>{{ $pengaturan?->email ?: 'inggg@gmail.com' }}</p>
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="kosa-contact-card">
                    <div class="kosa-contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3>Alamat</h3>
                    <p>{{ $pengaturan?->alamat ?: 'Indonesia' }}</p>
                </div>
            </div>

        </div>

        {{-- FORM KONTAK --}}
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="kosa-contact-form">

                    <div class="contact-form-title">
                        <h3>Kirim Pesan</h3>
                        <p>Isi formulir berikut untuk menghubungi KOSA Indonesia.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text"
                                           name="nama"
                                           class="form-control"
                                           placeholder="Masukkan nama">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="Masukkan email">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Subjek</label>
                                    <input type="text"
                                           name="subjek"
                                           class="form-control"
                                           placeholder="Subjek pesan">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pesan</label>
                                    <textarea name="pesan"
                                              class="form-control"
                                              rows="6"
                                              placeholder="Tulis pesan Anda..."></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="kosa-contact-submit">
                                    Kirim Pesan
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>


{{-- =========================
    CSS KHUSUS HALAMAN KONTAK
    BANNER TIDAK DISENTUH
========================= --}}
<style>

.kosa-contact-section {
    position: relative;
    padding: 80px 0;
    background: #f7f9fc;
    overflow: hidden;
}

/* Dekorasi */
.kosa-contact-section::before {
    content: "";
    position: absolute;

    width: 320px;
    height: 320px;

    border-radius: 50%;

    background: rgba(20, 58, 99, 0.04);

    top: -120px;
    left: -100px;
}

.kosa-contact-section::after {
    content: "";
    position: absolute;

    width: 260px;
    height: 260px;

    border-radius: 50%;

    background: rgba(20, 58, 99, 0.04);

    right: -80px;
    bottom: -100px;
}


/* CARD */
.kosa-contact-card {
    position: relative;
    z-index: 2;

    height: 100%;
    padding: 35px 25px;

    text-align: center;

    background: #fff;

    border: 1px solid #e9edf3;
    border-radius: 12px;

    box-shadow: 0 10px 30px rgba(0,0,0,0.06);

    transition: all 0.3s ease;
}

.kosa-contact-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.10);
}


/* ICON */
.kosa-contact-icon {
    width: 65px;
    height: 65px;

    margin: 0 auto 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f0f4f8;
    color: #143a63;

    font-size: 25px;
}

.kosa-contact-card h3 {
    margin-bottom: 12px;

    color: #222;

    font-size: 20px;
    font-weight: 600;
}

.kosa-contact-card p {
    margin: 0;

    color: #666;

    font-size: 16px;
    line-height: 1.7;
}


/* JARAK CARD KE FORM */
.kosa-contact-section .row:first-child {
    margin-bottom: 60px;
}


/* FORM */
.kosa-contact-form {
    position: relative;
    z-index: 2;

    padding: 45px;

    background: #fff;

    border: 1px solid #e9edf3;
    border-radius: 14px;

    box-shadow: 0 12px 35px rgba(0,0,0,0.07);
}


/* JUDUL FORM */
.contact-form-title {
    margin-bottom: 30px;
    text-align: center;
}

.contact-form-title h3 {
    margin-bottom: 10px;

    color: #222;

    font-size: 28px;
    font-weight: 700;
}

.contact-form-title p {
    margin: 0;

    color: #777;

    font-size: 16px;
}


/* INPUT */
.kosa-contact-form .form-group {
    margin-bottom: 22px;
}

.kosa-contact-form label {
    display: block;

    margin-bottom: 8px;

    color: #333;

    font-size: 15px;
    font-weight: 600;
}

.kosa-contact-form .form-control {
    width: 100%;

    min-height: 48px;

    padding: 12px 15px;

    border: 1px solid #dfe4ea;
    border-radius: 7px;

    background: #fff;

    color: #333;

    transition: all 0.3s ease;
}

.kosa-contact-form textarea.form-control {
    min-height: 150px;
    resize: vertical;
}

.kosa-contact-form .form-control:focus {
    border-color: #143a63;

    box-shadow: 0 0 0 3px rgba(20,58,99,0.08);

    outline: none;
}


/* BUTTON */
.kosa-contact-submit {
    width: 100%;

    padding: 14px 25px;

    border: none;
    border-radius: 7px;

    background: #143a63;

    color: #fff;

    font-size: 16px;
    font-weight: 600;

    cursor: pointer;

    transition: all 0.3s ease;
}

.kosa-contact-submit:hover {
    background: #0f2d4d;
    transform: translateY(-2px);
}


/* RESPONSIVE */
@media (max-width: 767px) {

    .kosa-contact-section {
        padding: 60px 0;
    }

    .kosa-contact-section .row:first-child {
        margin-bottom: 40px;
    }

    .kosa-contact-card {
        margin-bottom: 20px;
    }

    .kosa-contact-form {
        padding: 30px 20px;
    }

    .contact-form-title h3 {
        font-size: 24px;
    }

}

</style>

@endsection

