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
<<<<<<< HEAD
=======
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input type="text" name="title" class="form-input w-full" required>
>>>>>>> 9c6506e (feat: add synopsis and image_cover to books table)
=======
>>>>>>> d4c4355 (redesign-profile)
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

                    <div class="mb-4">
                        <label class="block text-gray-700">Cover Image</label>
                        <input type="file" name="image_cover" class="form-input w-full" accept="image/*" required>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('books.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                            ← Back
                        </a>

                        <button type="submit" class="btn btn-success bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
