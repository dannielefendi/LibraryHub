<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - Library Hub</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/detail_book.css') }}">
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
            <h1>📖 Book Details</h1>
        </div>

        <!-- Book Detail Card -->
        <div class="detail-container">
            <div class="detail-card">
                <!-- Book Display -->
                <div class="book-display">
                    <!-- Cover Image -->
                    <div class="book-cover">
                        @if($book->image_cover)
                            <img src="{{ url('storage/' . $book->image_cover) }}" alt="{{ $book->title }} Cover">
                        @else
                            <div class="no-image">
                                <span>📚</span>
                                <p>No Image</p>
                            </div>
                        @endif
                    </div>

                    <!-- Book Information -->
                    <div class="book-info">
                        <h2 class="book-title">{{ $book->title }}</h2>
                        <p class="book-author">by {{ $book->author }}</p>

                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Year</span>
                                <span class="info-value">{{ $book->year }}</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Stock</span>
                                <span class="info-value stock-badge {{ $book->stock > 5 ? 'stock-high' : ($book->stock > 2 ? 'stock-medium' : 'stock-low') }}">
                                    {{ $book->stock }}
                                </span>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="categories-section">
                            <span class="info-label">Categories</span>
                            <div class="categories-list">
                                @if($book->categories->count() > 0)
                                    @foreach($book->categories as $category)
                                        <span class="category-badge">{{ $category->name }}</span>
                                    @endforeach
                                @else
                                    <span class="no-category">No categories</span>
                                @endif
                            </div>
                        </div>

                        <!-- Synopsis -->
                        @if($book->synopsis)
                            <div class="synopsis-section">
                                <h3 class="synopsis-title">Synopsis</h3>
                                <p class="synopsis-text">{{ $book->synopsis }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    @if (Auth::user()->role === 'admin')
                         <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        ← Back to List
                    </a>
                    @elseif (Auth::user()->role === 'user')
                         <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                        ← Back to Dashboard
                    </a>
                    @endif

                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary w-100 mb-2">
                        Edit Book
                    </a>
                   

                </div>
                <div class="container">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
</body>
</html>
