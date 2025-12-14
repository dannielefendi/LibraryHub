<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowings Management - Library Hub</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/manage_borowing.css') }}">
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
            <h1>📋 Borrowings Management</h1>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">← Back to Books</a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        <!-- Borrowings Grid -->
        <div class="borrowings-grid">
            @forelse ($borrowings as $borrowing)
                <div class="borrowing-card">
                    <div class="card-header">
                        <h3>{{ $borrowing->book->title }}</h3>
                        <span class="status-badge status-{{ strtolower($borrowing->status) }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="info-row">
                            <span class="label">👤 User:</span>
                            <span class="value">{{ $borrowing->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">📅 Borrow Date:</span>
                            <span class="value">{{ $borrowing->borrow_date->format('F j, Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">⏰ Due Date:</span>
                            <span class="value">{{ $borrowing->due_date->format('F j, Y') }}</span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <!-- Mark Returned Button -->
                        @if (in_array($borrowing->status, ['Borrowed', 'Late']))
                            <form action="{{ route('admin.borrowings.returned', $borrowing->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    ✓ Mark Returned
                                </button>
                            </form>
                        @elseif (in_array($borrowing->status, ['Returned']) && $borrowing->fine_remaining > 0)
                            <div class="status-message status-warning">
                                ⚠️ Unpaid Fines
                            </div>
                        @else
                            <div class="status-message status-complete">
                                ✓ Completed
                            </div>
                        @endif

                        <!-- Pay Fine Form -->
                        @if ($borrowing->fine_remaining > 0)
                            <div class="fine-section">
                                <p class="fine-amount">Remaining Fine: Rp {{ number_format($borrowing->fine_remaining) }}</p>
                                <form action="{{ route('admin.borrowings.payFine', $borrowing->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="amount" placeholder="Enter payment amount" required>
                                    <button type="submit" class="btn btn-warning">
                                        💰 Pay Fine
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📚</div>
                    <p>No borrowing records found</p>
                </div>
            @endforelse
        </div>

        <!-- Total Fine -->
        @php
            $totalFine = \App\Http\Controllers\BorrowingController::totalFineRemaining(Auth::id());
        @endphp
        @if ($totalFine > 0)
            <div class="total-fine">
                <strong>Total Remaining Fine:</strong> Rp {{ number_format($totalFine) }}
            </div>
        @endif
    </main>
</body>
</html>
