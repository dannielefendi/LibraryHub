<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LibraryHub') }} - Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/auth/forgot-password.css') }}">
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

                    <h1 class="title">Forgot Password?</h1>
                    <p class="subtitle">No problem. Just let us know your email address and we will send you a password reset link.</p>
                </div>

                @if (session('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="form">
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

                    <div class="form__meta">
                        <a href="{{ route('login') }}" class="link">Back to login</a>
                    </div>

                    <div class="form__submit">
                        <button type="submit" class="btn">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
