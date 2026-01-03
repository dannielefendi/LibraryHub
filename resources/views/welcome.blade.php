<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LibraryHub') }}</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="welcome-wrapper" style="background-image: url('{{ asset('img/background1.png') }}');">
        
        <nav class="navbar">
            <div class="logo-container">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <span class="logo-text">BiLibrary</span>
            </div>
        </nav>

        <div class="hero-container">
            <div class="hero-content">
                
                <h1 class="hero-title">
                    Discover a World of <br>
                    <span class="highlight-text">Limitless Knowledge</span>
                </h1>
                
                <p class="hero-subtitle">
                    Manage your reading list, access thousands of digital resources, and join a community of lifelong learners. Everything you need, all in one place.
                </p>

                <div class="cta-group">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Get Started
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>

                    <a href="{{ route('login') }}" class="btn btn-outline">
                        Sign In
                    </a>
                </div>
            </div>
        </div>

        <footer class="simple-footer">
            <p>&copy; {{ date('Y') }} LibraryHub. Read, Learn, Grow.</p>
        </footer>
    </div>
</body>
</html>