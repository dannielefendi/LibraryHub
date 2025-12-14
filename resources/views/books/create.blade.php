<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - Library Hub</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/create_book.css') }}">
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
            <h1>➕ Add New Book</h1>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" required>
                    </div>

                    <!-- Author -->
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" name="author" required>
                    </div>

                    <!-- Year -->
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" required>
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group full-width">
                        <label>Category</label>
                        <select name="category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-buttons">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Create Book
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
