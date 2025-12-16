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
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Synopsis -->
                    <div class="form-group full-width">
                        <label>Synopsis</label>
                        <textarea name="synopsis" rows="4" placeholder="Enter book synopsis..."></textarea>
                    </div>

                    <!-- Categories (Checkboxes) -->
                    <div class="form-group full-width">
                        <label>Categories</label>
                        <div class="checkbox-grid">
                            @foreach ($categories as $category)
                                <label class="checkbox-label">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Cover Image -->
                    <div class="form-group full-width">
                        <label>Cover Image</label>
                        <input type="file" name="image_cover" accept="image/*" required>
                        <small class="helper-text">Upload book cover image (required)</small>
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