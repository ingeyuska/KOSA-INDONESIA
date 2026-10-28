<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pengaturan;
use App\Models\Pengurus;
use App\Models\Tentang;
use App\Models\StrukturOrganisasi;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CeritaAlumniController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProgramMasterController;
use App\Http\Controllers\KlasifikasiProgramController;
use App\Http\Controllers\JenisKeilmuanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\KartuAlumniController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\ManajemenProfileController;
use App\Http\Controllers\AlumniActivationController;
use App\Http\Controllers\AlumniInvitationController;
use App\Http\Controllers\MemberVerificationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AlumniCeritaController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\UniversitasController;
use App\Http\Controllers\StrukturOrganisasiController;


/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->middleware('track.visitor')
    ->name('home');
Route::get('/statistik-alumni', [
    StatistikAlumniController::class,
    'index'
])->name('statistik.alumni');

/*
|--------------------------------------------------------------------------
| LOGIN ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'loginFrontend'])
    ->name('login');

Route::post('/login', [LoginController::class, 'prosesLoginFrontend'])
    ->name('login.proses');


Route::get('/register', function () {
    return view('frontend.register.register');
})->name('register');


// ===============================
// REGISTER ALUMNI
// ===============================

Route::get('/register/alumni', [RegisterController::class, 'registerAlumni'])
    ->name('register.alumni');

Route::post('/register/alumni', [RegisterController::class, 'storeAlumni'])
    ->name('register.alumni.store');


// ===============================
// REGISTER MEMBER
// ===============================

Route::get('/register/member', function () {
    return view('frontend.register.register-member');
})->name('register.member');

Route::post('/register/member', [RegisterController::class, 'storeMember'])
    ->name('register.member.store');
    
// ===============================
// VERIFIKASI MEMBER
// ===============================

Route::get('/member/verification/{token}', [
    MemberVerificationController::class,
    'verify'
])->name('member.verification');

/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');


    Route::post('/email/verification-notification', function (Request $request) {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'success',
            'Email verifikasi berhasil dikirim ulang. Silakan cek email Anda.'
        );

    })->middleware(['auth','throttle:6,1',])->name('verification.send');


    Route::get('/email/verify/{id}/{hash}', function (
        Request $request,
        $id,
        $hash
    ) {
        $user = \App\Models\User::findOrFail($id);

        if (!$request->hasValidSignature()) {
            abort(403, 'Link verifikasi tidak valid atau sudah kedaluwarsa.');
        }

        if (!hash_equals(
            sha1($user->getEmailForVerification()),
            $hash
        )) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Email berhasil diverifikasi. Silakan login.'
            );

    })->middleware([
        'signed',
        'throttle:6,1',
    ])->name('verification.verify');


/*
|--------------------------------------------------------------------------
| PORTAL ALUMNI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:alumni'])
    ->prefix('alumni')
    ->name('alumni.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AlumniController::class,
            'dashboard'
        ])->name('dashboard');


      /*
|--------------------------------------------------------------------------
| PROFILE ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/profile', [
    \App\Http\Controllers\ProfileController::class,
    'index'
])->name('profile');

Route::put('/profile', [
    \App\Http\Controllers\ProfileController::class,
    'update'
])->name('profile.update');


/*
|--------------------------------------------------------------------------
| PASSWORD ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/password', [
    AlumniController::class,
    'editPassword'
])->name('password.edit');

Route::put('/password', [
    AlumniController::class,
    'updatePassword'
])->name('password.update');


        /*
        |--------------------------------------------------------------------------
        | TRACER ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/tracer', [
            TracerController::class,
            'index'
        ])->name('tracer');

        Route::post('/tracer/update', [
            TracerController::class,
            'update'
        ])->name('tracer.update');

        Route::post('/tracer/organization', [
            TracerController::class,
            'organizationStore'
        ])->name('tracer.organization.store');

        Route::post('/tracer/activity', [
            TracerController::class,
            'activityStore'
        ])->name('tracer.activity.store');

        Route::post('/tracer/achievement', [
            TracerController::class,
            'achievementStore'
        ])->name('tracer.achievement.store');

        Route::post('/tracer/expertise', [
            TracerController::class,
            'expertiseStore'
        ])->name('tracer.expertise.store');

        Route::post('/tracer/submit', [
            TracerController::class,
            'submit'
        ])->name('tracer.submit');


        /*
        |--------------------------------------------------------------------------
        | CERITA ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/cerita', [
            AlumniCeritaController::class,
            'index'
        ])->name('cerita');

        Route::post('/cerita', [
            AlumniCeritaController::class,
            'store'
        ])->name('cerita.store');


        /*
        |--------------------------------------------------------------------------
        | KARTU ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/kartu-alumni', [
            KartuAlumniController::class,
            'show'
        ])->name('kartu');

        Route::get('/kartu-alumni/download', [
            KartuAlumniController::class,
            'download'
        ])->name('kartu.download');


        /*
        |--------------------------------------------------------------------------
        | CONTRIBUTION
        |--------------------------------------------------------------------------
        */

        Route::get('/contribution', function () {

            $alumni = auth()->user()->alumni;

            return view(
                'frontend.alumni.contribution',
                compact('alumni')
            );

        })->name('contribution');

        Route::put('/contribution', [
            AlumniController::class,
            'updateContribution'
        ])->name('contribution.update');


        /*
        |--------------------------------------------------------------------------
        | EVENT ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/event', [
            EventController::class,
            'indexAlumni'
        ])->name('event');

        Route::get('/event/{event:slug}', [
            EventController::class,
            'showAlumni'
        ])->name('event.show');

        Route::get('/event/{event:slug}/daftar', [
            PendaftaranController::class,
            'createAlumni'
        ])->name('event.daftar');

        Route::get('/event/{event:slug}/pendaftar', [
            PendaftaranController::class,
            'index'
        ])->name('event.pendaftar');

        Route::post('/event/{event:slug}/daftar', [
            PendaftaranController::class,
            'storeAlumni'
        ])->name('event.daftar.store');

        Route::put('/event/pendaftar/{pendaftaran}/hadir', [
            PendaftaranController::class,
            'hadir'
        ])->name('event.pendaftar.hadir');


        /*
        |--------------------------------------------------------------------------
        | STATISTIK / NETWORKING
        |--------------------------------------------------------------------------
        */

        Route::get('/statistik', [
            AlumniController::class,
            'statistikFrontend'
        ])->name('statistik');


        /*
        |--------------------------------------------------------------------------
        | SERTIFIKAT ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/sertifikat', [
            SertifikatController::class,
            'indexAlumni'
        ])->name('sertifikat');

        Route::get('/sertifikat/{pendaftaran}', [
            SertifikatController::class,
            'showAlumni'
        ])->name('sertifikat.show');

        Route::get('/sertifikat/{pendaftaran}/download', [
            SertifikatController::class,
            'download'
        ])->name('sertifikat.download');

    });

/*
|--------------------------------------------------------------------------
| MEMBER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | PASSWORD MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/password', [
            \App\Http\Controllers\MemberController::class,
            'editPassword'
        ])->name('password.edit');

        Route::put('/password', [
            \App\Http\Controllers\MemberController::class,
            'updatePassword'
        ])->name('password.update');


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            \App\Http\Controllers\MemberController::class,
            'dashboard'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROFILE MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [
            \App\Http\Controllers\MemberController::class,
            'profile'
        ])->name('profile');

        Route::put('/profile', [
            \App\Http\Controllers\MemberController::class,
            'updateProfile'
        ])->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | EVENT MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/event', [
            EventController::class,
            'indexMember'
        ])->name('event');

Route::get('/event-saya', [
    EventController::class,
    'registeredMember'
])->name('event.registered');
        /*
        |--------------------------------------------------------------------------
        | DETAIL EVENT MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/event/{event:slug}', [
            EventController::class,
            'showMember'
        ])->name('event.show');


        /*
        |--------------------------------------------------------------------------
        | FORM DAFTAR EVENT MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/event/{event:slug}/daftar', [
            PendaftaranController::class,
            'createMember'
        ])->name('event.daftar');


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENDAFTARAN MEMBER
        |--------------------------------------------------------------------------
        */

        Route::post('/event/{event:slug}/daftar', [
            PendaftaranController::class,
            'storeMember'
        ])->name('event.daftar.store');


        /*
        |--------------------------------------------------------------------------
        | SERTIFIKAT MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/sertifikat', [
            SertifikatController::class,
            'indexMember'
        ])->name('sertifikat');

        Route::get('/sertifikat/{pendaftaran}', [
            SertifikatController::class,
            'showMember'
        ])->name('sertifikat.show');

        Route::get('/sertifikat/{pendaftaran}/download', [
            SertifikatController::class,
            'downloadMember'
        ])->name('sertifikat.download');

    });

// PORTAL WEB
/*
|--------------------------------------------------------------------------
| TENTANG KOSA
|--------------------------------------------------------------------------
*/

Route::get('/tentang', function () {

    $tentang = Tentang::first();

    return view('frontend.tentang', compact('tentang'));

})->name('tentang');


/*
|--------------------------------------------------------------------------
| VISI & MISI
|--------------------------------------------------------------------------
*/

Route::get('/visi-misi', function () {

    $pengaturan = Pengaturan::first();

    return view('frontend.visi-misi', compact('pengaturan'));

})->name('visi-misi');


/*
|--------------------------------------------------------------------------
| PENGURUS
|--------------------------------------------------------------------------
*/
Route::get('/pengurus', function () {

    $pengurus = Pengurus::orderBy('id')->get();

    $struktur = StrukturOrganisasi::first();

    return view('frontend.pengurus', compact('pengurus', 'struktur'));

})->name('pengurus');


/*
|--------------------------------------------------------------------------
| STATISTIK ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/statistik-alumni', [
    AlumniController::class,
    'statistikFrontend'
])->name('statistik');


/*
|--------------------------------------------------------------------------
| CARI ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/alumni/cari', [
    AlumniController::class,
    'cariFrontend'
])->name('alumni.cari');



/*
|--------------------------------------------------------------------------
| CERITA ALUMNI
|--------------------------------------------------------------------------
*/

Route::get('/cerita-alumni', [AlumniController::class, 'ceritaAlumni'])
    ->name('cerita-alumni');


/*
|--------------------------------------------------------------------------
| BERITA FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/berita', [
    BeritaController::class,
    'indexFrontend'
])->name('berita');


Route::get('/berita/{berita:slug}', [BeritaController::class, 'showFrontend'])
    ->name('berita.show');


/*
|--------------------------------------------------------------------------
| EVENT FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/event', [EventController::class, 'indexFrontend'])
    ->name('event');


Route::get('/event/{event:slug}', [EventController::class, 'showFrontend'])
    ->name('event.show');


/*
|--------------------------------------------------------------------------
| DAFTAR EVENT
|--------------------------------------------------------------------------
*/

Route::get('/event/{event:slug}/daftar', [
    PendaftaranController::class,
    'create'
])->name('event.daftar');


Route::post('/event/{event:slug}/daftar', [
    PendaftaranController::class,
    'store'
])->name('event.daftar.store');



/*
|--------------------------------------------------------------------------
| KONTAK FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/kontak', [PesanKontakController::class, 'create'])
    ->name('kontak');

Route::post('/kontak', [PesanKontakController::class, 'store'])
    ->name('kontak.store');
/*
|--------------------------------------------------------------------------
| GALERI FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/galeri', function () {

    $galeri = \App\Models\Galeri::with('foto')
        ->where('status', 'published')
        ->latest('tanggal')
        ->get();

    return view('frontend.galeri', compact('galeri'));

})->name('galeri');


Route::get('/galeri/{galeri:slug}', [GaleriController::class, 'showFrontend'])
    ->name('galeri.show');


/*
|--------------------------------------------------------------------------
| VIDEO FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/video', [VideoController::class, 'indexFrontend'])
    ->name('video');


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [LoginController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login', [LoginController::class, 'prosesLogin'])
    ->name('admin.login.proses');;
// Route::get('/admin/logout', [LoginController::class, 'logout'])
//     ->name('admin.logout');

// Route::post('/admin/logout', [LoginController::class, 'prosesLogin'])
//     ->name('admin.logout.proses');;


/*
|--------------------------------------------------------------------------
| DASHBOARD & BACKEND ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

          Route::resource('banner', BannerController::class)
        ->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | REGISTER
        |--------------------------------------------------------------------------
        */

        Route::get('/register', [RegisterController::class, 'index'])
            ->name('register.index');


        // STRUKTUR ORGANISASI
        Route::get('/struktur-organisasi', [
    StrukturOrganisasiController::class,
    'index'
])->name('struktur-organisasi.index');

Route::post('/struktur-organisasi', [
    StrukturOrganisasiController::class,
    'store'
])->name('struktur-organisasi.store');


        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        Route::resource('berita', BeritaController::class)
            ->except(['show']);
            Route::post(
    '/berita/upload-image',
    [BeritaController::class, 'uploadImage']
)->name('berita.upload-image');


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS
        |--------------------------------------------------------------------------
        */

        Route::resource('aktivitas', AktivitasController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | VIDEO
        |--------------------------------------------------------------------------
        */

        Route::resource('video', VideoController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | PESAN KONTAK
        |--------------------------------------------------------------------------
        */

        Route::get('/pesan-kontak', [PesanKontakController::class, 'index'])
            ->name('pesan-kontak.index');

        Route::get('/pesan-kontak/{pesanKontak}', [PesanKontakController::class, 'show'])
            ->name('pesan-kontak.show');

        Route::put('/pesan-kontak/{pesanKontak}/status', [
            PesanKontakController::class,
            'updateStatus'
        ])->name('pesan-kontak.status');

        Route::delete('/pesan-kontak/{pesanKontak}', [
            PesanKontakController::class,
            'destroy'
        ])->name('pesan-kontak.destroy');


        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('profile.index');

        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | GALERI
        |--------------------------------------------------------------------------
        */

        Route::resource('galeri', GaleriController::class);

        Route::delete('/galeri-foto/{id}', [
            GaleriController::class,
            'destroyFoto'
        ])->name('galeri.foto.destroy');


        /*
        |--------------------------------------------------------------------------
        | EVENT
        |--------------------------------------------------------------------------
        */

        Route::get('/event', [EventController::class, 'index'])
            ->name('event.index');

        Route::get('/event/create', [EventController::class, 'create'])
            ->name('event.create');

        Route::post('/event', [EventController::class, 'store'])
            ->name('event.store');

        Route::get('/event/{event}/edit', [EventController::class, 'edit'])
            ->name('event.edit');

        Route::put('/event/{event}', [EventController::class, 'update'])
            ->name('event.update');

        Route::delete('/event/{event}', [EventController::class, 'destroy'])
            ->name('event.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENDAFTAR EVENT
        |--------------------------------------------------------------------------
        */
Route::get('/event/{event}/pendaftar', [
    PendaftaranController::class,
    'index'
])->name('event.pendaftar');

Route::resource(
            'universitas',
            UniversitasController::class
        )->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | TANDAI HADIR
        |--------------------------------------------------------------------------
        */

        Route::put('/event/pendaftar/{pendaftaran}/hadir', [
            PendaftaranController::class,
            'hadir'
        ])->name('event.pendaftar.hadir');


        /*
        |--------------------------------------------------------------------------
        | MANAGE DATA ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::resource('alumni', AlumniController::class)
            ->except(['show'])
            ->parameters([
                'alumni' => 'alumni',
            ]);


        /*
        |--------------------------------------------------------------------------
        | CERITA ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::resource('cerita-alumni', CeritaAlumniController::class)
            ->except(['show'])
            ->parameters([
                'cerita-alumni' => 'ceritaAlumni',
            ]);


        /*
        |--------------------------------------------------------------------------
        | TRACER
        |--------------------------------------------------------------------------
        */

        Route::get('/tracer', [
            TracerController::class,
            'indexAdmin'
        ])->name('tracer.index');

        Route::get('/tracer/{alumni}', [
            TracerController::class,
            'show'
        ])->name('tracer.show');


        /*
        |--------------------------------------------------------------------------
        | PENGURUS KOSA
        |--------------------------------------------------------------------------
        */

        Route::resource('pengurus', PengurusController::class)
        ->except(['show'])
        ->parameters(['pengurus' => 'pengurus']);


        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        Route::resource('program-master', ProgramMasterController::class)
            ->except(['show']);

        Route::resource('jenis-keilmuan', JenisKeilmuanController::class)
            ->except(['show']);

        Route::resource('klasifikasi-program', KlasifikasiProgramController::class)
            ->except(['show']);


       /*
        |--------------------------------------------------------------------------
        | TENTANG KOSA
        |--------------------------------------------------------------------------
        */

        Route::get('/tentang', [TentangController::class, 'index'])
            ->name('tentang.index');

        Route::get('/tentang/create', [TentangController::class, 'create'])
            ->name('tentang.create');

        Route::post('/tentang', [TentangController::class, 'store'])
            ->name('tentang.store');

        Route::get('/tentang/{tentang}/edit', [TentangController::class, 'edit'])
            ->name('tentang.edit');

        Route::put('/tentang/{tentang}', [TentangController::class, 'update'])
            ->name('tentang.update');

        Route::delete('/tentang/{tentang}', [TentangController::class, 'destroy'])
            ->name('tentang.destroy');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN
        |--------------------------------------------------------------------------
        */

        Route::get('/pengaturan', [PengaturanController::class, 'index'])
            ->name('pengaturan.index');

        Route::get('/pengaturan/edit', [PengaturanController::class, 'edit'])
            ->name('pengaturan.edit');

        Route::put('/pengaturan', [PengaturanController::class, 'update'])
            ->name('pengaturan.update');

        /*
|--------------------------------------------------------------------------
| ALUMNI EXISTING / AKTIVASI
|--------------------------------------------------------------------------
*/
Route::prefix('alumni-activation')
    ->name('alumni.activation.')
    ->group(function () {

        // Daftar Alumni Existing
        Route::get('/', [
            AlumniInvitationController::class,
            'index'
        ])->name('index');

        // Form tambah Alumni Existing
        Route::get('/create', [
            AlumniInvitationController::class,
            'create'
        ])->name('create');

        // Generate data dari tabel alumnis
        Route::post('/generate', [
            AlumniInvitationController::class,
            'generate'
        ])->name('generate');

        // Simpan Alumni Existing
        Route::post('/', [
            AlumniInvitationController::class,
            'store'
        ])->name('store');

        // Kirim email aktivasi secara bulk
        Route::post('/send-bulk', [
            AlumniInvitationController::class,
            'sendBulk'
        ])->name('sendBulk');

        // Kirim ulang email
        Route::post('/{id}/resend', [
            AlumniInvitationController::class,
            'resend'
        ])->name('resend');

        // Hapus invitation
        Route::delete('/{id}', [
            AlumniInvitationController::class,
            'destroy'
        ])->name('destroy');

    });
    Route::get('/alumni/export', [
    AlumniController::class,
    'export'
])->name('alumni.export');

    }); // <-- BARU DI SINI GROUP DITUTUP
/*
|--------------------------------------------------------------------------
| KHUSUS SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource('users', UserController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT - ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/users/admin', [
            UserController::class,
            'admin'
        ])->name('users.admin');

        Route::get('/users/admin/create', [
            UserController::class,
            'createAdmin'
        ])->name('users.admin.create');


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT - MANAJEMEN
        |--------------------------------------------------------------------------
        */

        Route::get('/users/manajemen', [
            UserController::class,
            'manajemen'
        ])->name('users.manajemen');

        Route::get('/users/manajemen/create', [
            UserController::class,
            'createManajemen'
        ])->name('users.manajemen.create');


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT - ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/users/alumni', [
            UserController::class,
            'alumni'
        ])->name('users.alumni');

        Route::get('/users/alumni/create', [
            UserController::class,
            'createAlumni'
        ])->name('users.alumni.create');


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT - MEMBER
        |--------------------------------------------------------------------------
        */

        Route::get('/users/member', [
            UserController::class,
            'member'
        ])->name('users.member');

        Route::get('/users/member/create', [
            UserController::class,
            'createMember'
        ])->name('users.member.create');


        /*
        |--------------------------------------------------------------------------
        | MANAGE SERTIFIKAT
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/event/pendaftar/{pendaftaran}/sertifikat/generate',
            [SertifikatController::class, 'generate']
        )->name('event.sertifikat.generate');

        Route::get(
            '/event/pendaftar/{pendaftaran}/sertifikat',
            [SertifikatController::class, 'show']
        )->name('event.sertifikat.show');

    });

 /*
|--------------------------------------------------------------------------
| MANAJEMEN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:manajemen'])
    ->prefix('manajemen')
    ->name('manajemen.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [ManajemenController::class, 'dashboard'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | ALUMNI
        |--------------------------------------------------------------------------
        */

        Route::get('/alumni', [AlumniController::class, 'index'])
            ->name('alumni.index');


        /*
        |--------------------------------------------------------------------------
        | TRACER
        |--------------------------------------------------------------------------
        */

        Route::get('/tracer', [TracerController::class, 'indexManajemen'])
            ->name('tracer.index');

        Route::get('/tracer/{alumni}', [TracerController::class, 'show'])
            ->name('tracer.show');


        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [ManajemenProfileController::class, 'index'])
            ->name('profile.index');

        Route::get('/profile/edit', [ManajemenProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [ManajemenProfileController::class, 'update'])
            ->name('profile.update');


    });
   /*
|--------------------------------------------------------------------------
| AKTIVASI AKUN ALUMNI
|--------------------------------------------------------------------------
*/

Route::prefix('alumni/aktivasi')
    ->name('alumni.activation.')
    ->group(function () {

        // Halaman konfirmasi identitas
        Route::get('/{token}', [
            AlumniActivationController::class,
            'show'
        ])->name('show');

        // Proses konfirmasi identitas
        Route::post('/{token}/confirm', [
            AlumniActivationController::class,
            'confirm'
        ])->name('confirm');

        // Halaman buat password
        Route::get('/{token}/password', [
            AlumniActivationController::class,
            'password'
        ])->name('password');

        // Proses aktivasi akun
        Route::post('/{token}/activate', [
            AlumniActivationController::class,
            'activate'
        ])->name('activate');

    });
/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::post('/admin/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');

})->name('admin.logout');
/*
|--------------------------------------------------------------------------
| SERTIFIKAT DOWNLOAD
|--------------------------------------------------------------------------
*/

Route::get(
    '/sertifikat/{pendaftaran}/download',
    [SertifikatController::class, 'download']
)->name('sertifikat.download');

//TESTI EVENT
Route::middleware(['auth', 'role:alumni,member'])->group(function () {

    Route::post(
        '/event/{event}/testimoni',
        [TestimoniController::class, 'store']
    )->name('event.testimoni.store');

});

// ===============================
// VERIFIKASI KARTU ANGGOTA
// ===============================

Route::get('/verifikasi/anggota/{id_anggota}', [
    KartuController::class,
    'verifikasi'
])->name('verifikasi.anggota');
