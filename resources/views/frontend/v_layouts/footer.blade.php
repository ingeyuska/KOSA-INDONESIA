<!-- START FOOTER -->

<div class="footer section-padding">
```
<div class="container">

    <div class="row">

        {{-- ===================================================== --}}
        {{-- LOGO, DESKRIPSI & SOCIAL MEDIA --}}
        {{-- ===================================================== --}}
        <div class="col-lg-4 col-sm-6 col-xs-12">

            <div class="single_footer">

                {{-- LOGO --}}
                <a href="{{ route('home') }}">

                    @if($pengaturan?->logo)

                        <img
                            src="{{ asset('storage/' . $pengaturan->logo) }}"
                            alt="{{ $pengaturan->nama_kosa ?? 'KOSA Indonesia' }}"
                        >

                    @else

                        <img
                            src="{{ asset('frontend/assets/images/logo/logo1.png') }}"
                            alt="KOSA Indonesia"
                        >

                    @endif

                </a>

                {{-- DESKRIPSI --}}
                <p>
                    {{ $pengaturan?->deskripsi_footer
                        ?: $pengaturan?->deskripsi
                        ?: 'KOSA Indonesia merupakan wadah alumni program KOICA untuk membangun jejaring, berbagi pengalaman, meningkatkan kapasitas, dan berkolaborasi dalam memberikan kontribusi bagi Indonesia.' }}
                </p>

            </div>


            {{-- ================================================= --}}
            {{-- SOCIAL MEDIA --}}
            {{-- ================================================= --}}
            <div class="foot_social">

                <ul>

                    {{-- FACEBOOK --}}
                    <li>
                        <a
                            href="{{ $pengaturan?->facebook ?: 'javascript:void(0)' }}"
                            class="top_f_facebook"
                            @if($pengaturan?->facebook)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>


                    {{-- INSTAGRAM --}}
                    <li>
                        <a
                            href="{{ $pengaturan?->instagram ?: 'javascript:void(0)' }}"
                            class="top_f_instagram"
                            @if($pengaturan?->instagram)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>


                    {{-- LINKEDIN --}}
                    <li>
                        <a
                            href="{{ $pengaturan?->linkedin ?: 'javascript:void(0)' }}"
                            class="top_f_linkedin"
                            @if($pengaturan?->linkedin)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>


                    {{-- YOUTUBE --}}
                    <li>
                        <a
                            href="{{ $pengaturan?->youtube ?: 'javascript:void(0)' }}"
                            class="top_f_youtube"
                            @if($pengaturan?->youtube)
                                target="_blank"
                                rel="noopener noreferrer"
                            @endif
                        >
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>

                </ul>

            </div>

        </div>
        {{-- END LOGO, DESKRIPSI & SOCIAL MEDIA --}}


        {{-- ===================================================== --}}
        {{-- MENU --}}
        {{-- ===================================================== --}}
        <div class="col-lg-2 col-sm-6 col-xs-12">

            <div class="single_footer">

                <h4>Menu</h4>

                <ul>

                    <li>
                        <a href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('tentang') }}">
                            Tentang Pengurus
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('statistik') }}">
                            Statistik Alumni
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('berita') }}">
                            Berita
                        </a>
                    </li>

                </ul>

            </div>

        </div>
        {{-- END MENU --}}


        {{-- ===================================================== --}}
        {{-- INFORMASI --}}
        {{-- ===================================================== --}}
        <div class="col-lg-2 col-sm-6 col-xs-12">

            <div class="single_footer">

                <h4>Informasi</h4>

                <ul>

                    <li>
                        <a href="{{ route('event') }}">
                            Event
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('galeri') }}">
                            Galeri
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('kontak') }}">
                            Kontak
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('login') }}">
                            Login KOSAID
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('register.alumni') }}">
                            Daftar Sekarang
                        </a>
                    </li>

                </ul>

            </div>

        </div>
        {{-- END INFORMASI --}}


        {{-- ===================================================== --}}
        {{-- STATISTIK PENGUNJUNG --}}
        {{-- ===================================================== --}}
        <div class="col-lg-4 col-sm-6 col-xs-12">

            <div class="single_footer kosa-footer-statistik">

                <h4>Statistik Pengunjung</h4>

                <div class="kosa-visitor-grid">

                    {{-- TOTAL --}}
                    <div class="kosa-visitor-item">

                        <div class="kosa-visitor-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div class="kosa-visitor-info">

                            <strong>
                                {{ number_format($totalPengunjung) }}
                            </strong>

                            <span>
                                Total Pengunjung
                            </span>

                        </div>

                    </div>


                    {{-- HARI INI --}}
                    <div class="kosa-visitor-item">

                        <div class="kosa-visitor-icon">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>

                        <div class="kosa-visitor-info">

                            <strong>
                                {{ number_format($pengunjungHariIni) }}
                            </strong>

                            <span>
                                Hari Ini
                            </span>

                        </div>

                    </div>


                    {{-- BULAN INI --}}
                    <div class="kosa-visitor-item">

                        <div class="kosa-visitor-icon">
                            <i class="fa-solid fa-chart-column"></i>
                        </div>

                        <div class="kosa-visitor-info">

                            <strong>
                                {{ number_format($pengunjungBulanIni) }}
                            </strong>

                            <span>
                                Bulan Ini
                            </span>

                        </div>

                    </div>


                    {{-- KENAIKAN --}}
                    <div class="kosa-visitor-item">

                        <div class="kosa-visitor-icon">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>

                        <div class="kosa-visitor-info">

                            <strong>
                                {{ $persentasePengunjung > 0 ? '+' : '' }}{{ $persentasePengunjung }}%
                            </strong>

                            <span>
                                Dibanding bulan lalu
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        {{-- END STATISTIK PENGUNJUNG --}}

    </div>


    {{-- ========================================================= --}}
    {{-- COPYRIGHT --}}
    {{-- ========================================================= --}}
    <div class="row fc">

        <div class="col-lg-6 col-sm-6 col-xs-12">

            <div class="footer_copyright">

                <p>
                    {{ $pengaturan?->copyright
                        ?: '© ' . date('Y') . ' KOSA Indonesia. All Rights Reserved.' }}
                </p>

            </div>

        </div>


        <div class="col-lg-6 col-sm-6 col-xs-12">

            <div class="footer_menu">

                <ul>

                    <li>
                        <a href="#">
                            Terms of Use
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Privacy Policy
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>


</div>

<!-- END FOOTER -->
