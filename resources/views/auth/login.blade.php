<x-guest-layout>
<style>
    /* Override guest layout agar full-page centered */
    body { background: #F8FAFC !important; }

    .login-wrapper {
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 24px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background:
            radial-gradient(ellipse 60% 50% at 50% -10%, #DBEAFE 0%, transparent 70%),
            #F8FAFC;
    }

    .login-card {
        background: white;
        border-radius: 24px;
        border: 1.5px solid #E2E8F0;
        padding: 44px 40px;
        width: 100%; max-width: 420px;
        box-shadow: 0 8px 40px rgba(15,23,42,.08);
    }

    .login-brand { text-align: center; margin-bottom: 32px; }
    .login-brand-name {
        font-size: 1.75rem; font-weight: 800;
        color: #2563EB; letter-spacing: -.5px;
        display: block; text-decoration: none;
    }
    .login-brand-sub { font-size: .8rem; color: #94A3B8; font-weight: 500; margin-top: 2px; }

    .login-heading { font-size: 1.15rem; font-weight: 700; color: #0F172A; margin-bottom: 6px; }
    .login-subheading { font-size: .875rem; color: #64748B; margin-bottom: 28px; }

    .form-group { margin-bottom: 18px; }
    .form-label {
        display: block; font-size: .8rem; font-weight: 700;
        color: #374151; margin-bottom: 6px; letter-spacing: .01em;
    }
    .form-input {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid #E2E8F0; border-radius: 10px;
        font-family: inherit; font-size: .9rem; color: #0F172A;
        background: #FAFAFA; transition: all .15s; outline: none;
    }
    .form-input:focus { border-color: #2563EB; background: white; box-shadow: 0 0 0 3px #DBEAFE; }
    .form-input::placeholder { color: #CBD5E1; }

    .form-error { font-size: .78rem; color: #EF4444; margin-top: 5px; font-weight: 500; }

    .form-remember {
        display: flex; align-items: center; gap: 8px;
        font-size: .84rem; color: #64748B; font-weight: 500;
        cursor: pointer; margin-bottom: 24px;
    }
    .form-remember input[type="checkbox"] {
        width: 16px; height: 16px; border-radius: 4px;
        accent-color: #2563EB; cursor: pointer;
    }

    .btn-submit {
        width: 100%; padding: 13px;
        background: #2563EB; color: white;
        font-family: inherit; font-size: .95rem; font-weight: 700;
        border: none; border-radius: 11px;
        cursor: pointer; transition: background .15s, transform .1s;
    }
    .btn-submit:hover { background: #1D4ED8; }
    .btn-submit:active { transform: scale(.98); }

    .login-footer {
        text-align: center; margin-top: 20px;
        font-size: .83rem; color: #94A3B8;
    }
    .login-footer a {
        color: #2563EB; font-weight: 600; text-decoration: none;
    }
    .login-footer a:hover { text-decoration: underline; }

    .divider { height: 1px; background: #F1F5F9; margin: 20px 0; }
</style>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-brand">
            <a href="/" class="login-brand-name">Shopind</a>
            <p class="login-brand-sub">Belanja Mudah & Cepat</p>
        </div>

        <h2 class="login-heading">Selamat datang kembali</h2>
        <p class="login-subheading">Masuk ke akun Shopind kamu</p>

        <x-auth-session-status class="form-error" style="margin-bottom:16px" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" class="form-input" type="email" name="email"
                    value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="contoh@email.com">
                @error('email')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input id="password" class="form-input" type="password" name="password"
                    required autocomplete="current-password" placeholder="••••••••">
                @error('password')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <label class="form-remember">
                <input id="remember_me" type="checkbox" name="remember">
                Ingat saya
            </label>

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        @if (Route::has('password.request'))
        <div class="login-footer" style="margin-top:16px">
            <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>
        @endif

        <div class="divider"></div>
        <div class="login-footer">
            <a href="{{ route('products.index') }}">← Kembali ke Beranda</a>
        </div>
    </div>
</div>
</x-guest-layout>