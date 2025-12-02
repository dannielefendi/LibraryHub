<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LibraryHub') }} - Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>
<body class="page">

    <div class="page__bg" style="background-image: url('{{ asset('img/background1.png') }}');">
        <div class="container">
            <div class="card">

                <div class="card__header">
                    <a href="{{ url('/') }}" class="logo" title="Back to home">
                        <svg xmlns="http://www.w3.org/2000/svg" class="logo__icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>

                    <h1 class="title">Sign in with email</h1>
                    <p class="subtitle">Your gateway to limitless knowledge. Discover, read, and grow at your own pace</p>
                </div>

                @if (session('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf

                    <div class="form__group">
                        <label for="email" class="sr-only">Email</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="Email" class="input" />
                        </div>
                        @if($errors->has('email'))
                            <p class="error">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form__group">
                        <label for="password" class="sr-only">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input id="password" name="password" type="password" required placeholder="Password" class="input" />
                            <button type="button" class="input-right-icon toggle-password" data-target="password">
                                <svg class="icon icon-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="icon icon-eye-off" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @if($errors->has('password'))
                            <p class="error">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form__meta">
                        <label for="remember_me" class="checkbox-label">
                            <input id="remember_me" type="checkbox" name="remember" class="checkbox" />
                            <span class="checkbox-text">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link">Forgot password?</a>
                        @endif
                    </div>

                    <div class="form__submit">
                        <button type="submit" class="btn">Get Started</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = btn.dataset.target;
                const input = document.getElementById(targetId);
                const eyeIcon = btn.querySelector('.icon-eye');
                const eyeOffIcon = btn.querySelector('.icon-eye-off');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.style.display = 'none';
                    eyeOffIcon.style.display = 'block';
                } else {
                    input.type = 'password';
                    eyeIcon.style.display = 'block';
                    eyeOffIcon.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>