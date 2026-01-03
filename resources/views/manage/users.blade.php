<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin/user_list.css') }}">
    @endpush

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="fs-1 font-bold text-white">
            <i class="bi bi-people-fill"></i> Library <span class="text-blue-700">Users</span>
        </h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary w-25">Back to Books</a>
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
                            <span class="user-email"><i class="bi bi-envelope-at-fill"></i> : {{ $user->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="user-details">
                    <p class="join-date"><i class="bi bi-calendar-check-fill"></i> Joined On: {{ $user->created_at->format('F j, Y') }}</p>

                    @if($user->borrow->count() > 0)
                        <p class="borrow-count">Borrowing Items: <strong>{{ $user->borrow->count() }}</strong></p>
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
                                    <span class="book-title">{{ $book->book->title }}</span>
                                    <span class="status-badge status-{{ strtolower($book->status) }}">
                                        {{ $book->status }}
                                    </span>
                                </div>

                                @if(($book->status == 'Late' || $book->status == 'Returned') && $book->fine_remaining > 0)
                                    <p class="fine-warning">
                                        Fine Remaining: Rp {{ number_format($book->fine_remaining, 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
