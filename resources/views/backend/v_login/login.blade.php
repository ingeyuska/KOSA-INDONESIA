<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AdminKOICA authentication page">
    <title>Login | AdminKOICA</title>

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body class="auth-body">

    <button
        class="icon-button theme-toggle auth-theme-toggle"
        type="button"
        data-theme-toggle
        aria-label="Switch color theme"
        title="Switch color theme">

        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>

    <main class="auth-page">

        <section class="auth-card">

            {{-- LOGO KOSA
            <a class="auth-brand" href="{{ url('/') }}">

                <span class="brand-icon">
                    <img
                        src="{{ asset('frontend/assets/images/logo/logo1.png') }}"
                        alt="Logo KOSA">
                </span>

                <span>
                    <h1>AdminKOICA</h1>
                    {{-- <small>Sign in to your admin workspace.</small> --}}
                {{-- </span>

            </a> --}} 

            {{-- FORM LOGIN --}}
            <form
                class="needs-validation"
                action="{{ route('admin.login.proses') }}"
                method="POST"
                novalidate>

                @csrf

                <div class="mb-4 text-center">
                    <p class="eyebrow mb-2 fs-2 " >Login Admin</p>

                    {{-- <h1 class="h3 mb-1 text-center">
                        Login
                    </h1> --}}
                </div>

                {{-- PESAN ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- EMAIL --}}
                <div class="mb-3">

                    <label
                        class="form-label"
                        for="loginEmail">

                        Email address

                    </label>

                    <input
                        class="form-control"
                        id="loginEmail"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required>

                    <div class="invalid-feedback">
                        Enter a valid email.
                    </div>

                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <label
                            class="form-label"
                            for="loginPassword">

                            Password

                        </label>

                    </div>

                    <input
                        class="form-control"
                        id="loginPassword"
                        type="password"
                        name="password"
                        required>

                    <div class="invalid-feedback">
                        Password must be at least 6 characters.
                    </div>

                </div>

                {{-- REMEMBER ME --}}
                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="rememberMe">

                    <label
                        class="form-check-label"
                        for="rememberMe">

                        Remember me

                    </label>

                </div>

                {{-- BUTTON --}}
                <button
                    class="btn btn-primary w-100"
                    type="submit">

                    <i
                        class="bi bi-box-arrow-in-right"
                        aria-hidden="true">
                    </i>

                    Sign In

                </button>

            </form>

        </section>

    </main>

    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

</body>
</html>