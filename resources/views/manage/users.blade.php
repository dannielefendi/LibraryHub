<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Users - Library Hub</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/admin/user_list.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <i class="bi bi-book"></i> <span>Library Hub</span>
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
            <h1><i class="bi bi-people-fill"></i> Library Users</h1>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
        </div>

        <!-- Users List -->
        <div class="users-container">
            @foreach($users as $user)
                <div class="user-card">
                    <!-- User Header -->
                    <div class="user-header">
                        <div class="user-info">
                            <h2>{{ $user->name }}</h2>
                            <div class="user-meta">
                                <span class="user-id">ID: {{ $user->id }}</span>
                                <span class="user-email"><i class="bi bi-envelope-at-fill"></i> {{ $user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="user-details">
                        <p class="join-date"><i class="bi bi-calendar-check-fill"></i> Joined On: {{ $user->created_at->format('F j, Y') }}</p>

                        @if($user->borrow->count() > 0)
                            <p class="borrow-count">📚 Borrowing Items: <strong>{{ $user->borrow->count() }}</strong></p>
                        @else
                            <p class="no-records">No borrowing records for this user</p>
                        @endif
                    </div>

                    <!-- Borrowing List -->
                    @if($user->borrow->count() > 0)
                        <div class="borrowing-list">
                            @foreach($user->borrow as $index => $book)
                                <div class="borrowing-item {{ $index > 0 ? 'has-border' : '' }}">
                                    <div class="book-info">
                                        <span class="book-title">📖 {{ $book->book->title }}</span>
                                        <span class="status-badge status-{{ strtolower($book->status) }}">
                                            {{ $book->status }}
                                        </span>
                                    </div>

                                    @if(($book->status == 'Late' || $book->status == 'Returned') && $book->fine_remaining > 0)
                                        <p class="fine-warning">
                                            ⚠️ Fine Remaining: Rp {{ number_format($book->fine_remaining, 0, ',', '.') }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
