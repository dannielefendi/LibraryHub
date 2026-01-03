<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    @endpush

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="fs-1 font-bold text-white mb-4">
            Book <span class="text-blue-700">Collection</span>
        </h1>

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

    <!-- Stats -->
    <div class="stats mb-5">
        <div class="stat-card">
            <div class="stat-number">{{ $totalBooks }}</div>
            <div class="stat-label">Total Books</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalStock }}</div>
            <div class="stat-label">Total Stock</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalCategories }}</div>
            <div class="stat-label">Categories</div>
        </div>
    </div>

    <!-- Books Table -->
    <div class="table-container flex justify-center">
        <table>
            <thead>
                <tr>
                    <th class="text-center">Title</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Year</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td class="px-4 py-2">{{ $book->title }}</td>
                        <td class="px-4 py-2">{{ $book->author }}</td>

                        <td class="px-4 py-2">
                            @if ($book->categories->count() > 0)
                                @foreach ($book->categories as $category)
                                    <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-1">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>

                        <td class="px-4 py-2">{{ $book->year }}</td>

                        <td class="px-4 py-2">
                            @if ($book->stock > 5)
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white font-semibold">
                                    {{ $book->stock }}
                                </span>
                            @elseif ($book->stock > 0)
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-yellow-400 text-black font-semibold">
                                    {{ $book->stock }}
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-500 text-white font-bold">
                                    Unavailable
                                </span>
                            @endif
                        </td>





                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('books.show', $book) }}"
                            class="btn btn-primary flex w-full h-10 justify-center items-center mb-3">
                                View
                            </a>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-secondary flex w-full h-10 justify-center items-center">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn-delete flex w-full h-10 justify-center items-center"
                                        onclick="return confirm('Delete this book?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-400">
                            No books found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $books->onEachSide(1)->links() }}
    </div>

</x-app-layout>