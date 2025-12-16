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
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="logo text-xl font-bold">📚 Library Hub</div>

            <!-- User Dropdown -->
            <div class="user-menu" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2">
                    <span>{{ Auth::user()->name }}</span>
                    <span :class="{ 'rotate-180': open }">▼</span>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute mt-2 right-4 bg-white shadow rounded p-2 w-40">
                    <a href="{{ route('profile.edit') }}" class="block py-1 px-2 hover:bg-gray-100 rounded">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left py-1 px-2 hover:bg-gray-100 rounded">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-6">➕ Add New Book</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Title</label>
                    <input type="text" name="title" required class="w-full border rounded p-2">
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Author</label>
                    <input type="text" name="author" required class="w-full border rounded p-2">
                </div>

                <!-- Year -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Year</label>
                    <input type="number" name="year" required class="w-full border rounded p-2">
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Stock</label>
                    <input type="number" name="stock" required class="w-full border rounded p-2">
                </div>

                <!-- Synopsis -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Synopsis</label>
                    <textarea name="synopsis" rows="4" placeholder="Enter book synopsis..." class="w-full border rounded p-2"></textarea>
                </div>

                <!-- Categories -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Categories</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($categories as $category)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            <span>{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Cover Image -->
                <div class="mb-4">
                    <label class="block font-medium mb-1">Cover Image</label>
                    <input type="file" name="image_cover" accept="image/*" required class="w-full">
                </div>

                <!-- Form Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">← Back</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Book</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
