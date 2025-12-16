<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Library Hub</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/profile._admin.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                📚 <span>Library Hub</span>
            </div>

            <!-- User Dropdown -->
            <div class="user-menu" x-data="{ open: false }">
                <button @click="open = !open" class="user-button">
                    <span>{{ Auth::user()->name }}</span>
                    <span class="arrow" :class="{ 'rotate': open }">▼</span>
                </button>

                <div x-show="open"
                     @click.away="open = false"
                     x-transition
                     class="dropdown">
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Page Header -->
        <div class="page-header">
            <h1>👤 Profile</h1>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
        </div>

        <!-- Profile Sections -->
        <div class="profile-container">

            <!-- Update Profile Information -->
            <div class="profile-card">
                <div class="card-header">
                    <h2>Profile Information</h2>
                    <p>Update your account's profile information and email address.</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Total Fine Alert -->
            @if($totalFineRemaining > 0)
                <div class="fine-alert">
                    <div class="fine-icon">⚠️</div>
                    <div class="fine-content">
                        <strong>Total Remaining Fine:</strong>
                        <span class="fine-amount">Rp {{ number_format($totalFineRemaining, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif

            <!-- Update Password -->
            <div class="profile-card">
                <div class="card-header">
                    <h2>Update Password</h2>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="profile-card danger-card">
                <div class="card-header">
                    <h2>Delete Account</h2>
                    <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </main>
</body>
</html>
