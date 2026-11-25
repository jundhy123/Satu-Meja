@extends('layouts.app')

@section('title', 'Masuk - Satu Meja')

@section('content')

<style>
    /* Hide Main Layout Components */
    nav,
    footer,
    aside,
    .sidebar {
        display: none !important;
    }

    /* Main Background */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px 20px;
        background: #f7f9f7;
    }

    /* Login Card */
    .login-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        padding: 32px 38px;
        border-radius: 20px;
        border: 1px solid #e8eee9;
        box-shadow: 0 8px 30px rgba(35, 65, 45, 0.06);
        animation: fadeUp 0.6s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #879188;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .back-button:hover {
        color: #315b3d;
    }

    /* Logo */
    .login-logo {
        width: 58px;
        height: 58px;
        background: #edf4ee;
        color: #315b3d;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }

    /* Input */
    .login-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #45594a;
        margin-bottom: 8px;
    }

    .login-input {
        width: 100%;
        height: 48px;
        padding: 0 14px;
        background: #fafcfb;
        border: 1px solid #dfe7e0;
        border-radius: 10px;
        font-size: 13px;
        color: #263c2d;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .login-input:focus {
        border-color: #527b5b;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(82, 123, 91, 0.08);
    }

    .login-input::placeholder {
        color: #a6b0a8;
    }

    /* Password */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper .login-input {
        padding-right: 45px;
    }

    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #87968a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        transition: color 0.2s;
    }

    .toggle-password:hover {
        color: #315b3d;
    }

    /* Login Button */
    .login-button {
        width: 100%;
        height: 49px;
        background: #315b3d;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .login-button:hover {
        background: #264a31;
        box-shadow: 0 5px 15px rgba(49, 91, 61, 0.15);
    }

    .login-button:active {
        transform: scale(0.99);
    }

    /* Demo Account */
    .demo-section {
        background: #f7faf7;
        border: 1px solid #e8eee9;
        border-radius: 12px;
        padding: 14px;
        margin-top: 24px;
    }

    .demo-button {
        padding: 9px;
        border: 1px solid #e2eae3;
        background: white;
        border-radius: 8px;
        color: #526956;
        font-size: 11px;
        font-weight: 600;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .demo-button:hover {
        background: #edf4ee;
        border-color: #b8cbb9;
    }

    /* Footer Register */
    .login-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 12px;
        color: #879188;
    }

    .login-footer a {
        color: #315b3d;
        font-weight: 700;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }

    /* Alert */
    .login-alert {
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 12px;
        margin-bottom: 15px;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card {
            padding: 25px 22px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .login-card {
            animation: none;
        }
    }
</style>

<div class="login-wrapper">

    <div class="login-card">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url('/') }}" class="back-button">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="17" height="17"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>

                Kembali

            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-8">

            <div class="login-logo">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="27" height="27"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>

                </svg>

            </div>

            <h2 class="font-heading text-2xl font-bold text-forest">
                Selamat Datang
            </h2>

            <p class="text-xs text-gray-500 mt-2">
                Masuk ke akun Satu Meja Anda.
            </p>

        </div>

        <!-- Alerts -->
        @if (session('error'))
            <div class="login-alert bg-red-50 border border-red-200 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="login-alert bg-green-50 border border-green-200 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="login-alert bg-red-50 border border-red-200 text-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.process') }}"
              method="POST"
              class="space-y-5">

            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="login-label">
                    Alamat Email
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    value="{{ old('email') }}"
                    class="login-input"
                    placeholder="nama@email.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="login-label">
                    Kata Sandi
                </label>

                <div class="password-wrapper">

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="login-input"
                        placeholder="Masukkan kata sandi">

                    <button
                        type="button"
                        id="togglePassword"
                        class="toggle-password"
                        aria-label="Lihat kata sandi"
                        aria-pressed="false">

                        <!-- Eye Open -->
                        <svg id="eyeOpen"
                             xmlns="http://www.w3.org/2000/svg"
                             width="19" height="19"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">

                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>

                        </svg>

                        <!-- Eye Closed -->
                        <svg id="eyeClosed"
                             xmlns="http://www.w3.org/2000/svg"
                             width="19" height="19"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             style="display: none;">

                            <path d="m3 3 18 18"/>
                            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                            <path d="M9.9 5.2A10.5 10.5 0 0 1 12 5c6.4 0 10 7 10 7a14.7 14.7 0 0 1-4 4.7"/>
                            <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7c1.1 0 2.1-.2 3-.5"/>

                        </svg>

                    </button>

                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded accent-green-800">

                    <span class="text-xs text-gray-500">
                        Ingat saya
                    </span>

                </label>

            </div>

            <!-- Submit -->
            <button type="submit" class="login-button">
                Masuk Sekarang
            </button>

        </form>

        <!-- Demo Accounts -->
        <div class="demo-section">

            <div class="flex items-center justify-between mb-3">

                <span class="text-xs font-bold text-forest">
                    Akun Demo
                </span>

                <span class="text-[10px] text-gray-400">
                    Pilih akun
                </span>

            </div>

            <div class="grid grid-cols-2 gap-2">

                <button type="button"
                    onclick="fillDemo('admin@satumeja.id')"
                    class="demo-button">
                    👑 Admin
                </button>

                <button type="button"
                    onclick="fillDemo('pendonasi@satumeja.id')"
                    class="demo-button">
                    🏬 Pendonasi
                </button>

                <button type="button"
                    onclick="fillDemo('penerima@satumeja.id')"
                    class="demo-button">
                    🏛️ Penerima
                </button>

                <button type="button"
                    onclick="fillDemo('bakery@satumeja.id')"
                    class="demo-button">
                    ⏳ Donasi Pending
                </button>

                <button type="button"
                    onclick="fillDemo('dapur@satumeja.id')"
                    class="demo-button">
                    ⏳ Penerima Pending
                </button>

                <button type="button"
                    onclick="fillDemo('rejected@satumeja.id')"
                    class="demo-button">
                    ✕ Ditolak
                </button>

            </div>

        </div>

        <!-- Register -->
        <div class="login-footer">

            Belum memiliki akun?

            <a href="{{ route('register') }}">
                Daftar sekarang
            </a>

        </div>

    </div>

</div>

<script>
    // Show / Hide Password
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    togglePassword.addEventListener('click', function () {

        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';

        eyeOpen.style.display = isHidden ? 'none' : 'block';
        eyeClosed.style.display = isHidden ? 'block' : 'none';

        togglePassword.setAttribute('aria-pressed', isHidden);

        togglePassword.setAttribute(
            'aria-label',
            isHidden ? 'Sembunyikan kata sandi' : 'Lihat kata sandi'
        );

    });

    // Demo Account
    function fillDemo(email) {

        document.getElementById('email').value = email;
        document.getElementById('password').value = 'password123';

    }
</script>

@endsection