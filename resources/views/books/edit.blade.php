<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Library Hub</title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- ⚙️ GUNAKAN ROUTE UPDATE DAN KIRIM ID --}}
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
            <h1>✏️ Edit Book</h1>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $book->title }}" required>
                    </div>

                    <!-- Author -->
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" name="author" value="{{ $book->author }}" required>
                    </div>

                    <!-- Year -->
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" name="year" value="{{ $book->year }}" required>
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" value="{{ $book->stock }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Synopsis</label>
                        <textarea name="synopsis" class="form-textarea w-full" rows="4">{{ $book->synopsis }}</textarea>
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">
                        Categories
                    </label>

                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($categories as $category)
                            <label for="category-{{ $category->id }}" class="inline-flex items-center">
                                <input
                                    id="category-{{ $category->id }}"
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ $book->categories->contains('id', $category->id) ? 'checked' : '' }}
                                    class="form-checkbox"
                                >
                                <span class="ml-2">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>


                    <div class="mb-4">
                        <label class="block text-gray-700">Cover Image</label>
                        @if($book->image_cover)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $book->image_cover) }}" alt="Current Cover" class="w-32 h-48 object-cover border">
                            </div>
                        @endif
                        <input type="file" name="image_cover" class="form-input w-full" accept="image/*">
                        <small class="text-gray-500">Leave empty to keep current image</small>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-buttons">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Book
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
