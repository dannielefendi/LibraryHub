<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Hub - Books</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
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
            <h1>📖 Book Collection</h1>
            <div class="header-buttons">
                <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add New Book</a>
                <a href="{{ route('admin.borrowings') }}" class="btn btn-secondary">Manage Borrowings</a>
                <a href="{{ route('manage.users') }}" class="btn btn-secondary">User List</a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- Books Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Year</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Year</th>
                            <th class="px-4 py-2 text-left">Stock</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($books as $book)
                            <tr>
                                <td class="px-4 py-2">{{ $book->title }}</td>
                                <td class="px-4 py-2">{{ $book->author }}</td>
                                <td class="px-4 py-2">{{ $book->category->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $book->year }}</td>
                                <td class="px-4 py-2">{{ $book->stock }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-info mr-2">View</a>
                                    <a href="{{ route('books.edit', $book) }}"
                                       class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Delete this book?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: #94a3b8;">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Stats -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">{{ $books->count() }}</div>
                <div class="stat-label">Total Books</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $books->sum('stock') }}</div>
                <div class="stat-label">Total Stock</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $books->pluck('category.name')->unique()->count() }}</div>
                <div class="stat-label">Categories</div>
            </div>
        </div>
    </main>
</body>
</html>
