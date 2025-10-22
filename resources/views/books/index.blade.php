<x-app-layout>
    {{-- Slot Header --}}
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book List') }}
            </h2>

            <button onclick="window.location.href='{{ route('books.create') }}'" class="btn btn-primary">
                Add New Book
            </button>
        </div>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Books Table --}}
                <table class="table table-hover">
                    <thead class="bg-gray-100">
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
                                    <a href="{{ route('books.edit', $book) }}"
                                       class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Empty State --}}
                @if ($books->isEmpty())
                    <p class="mt-4 text-gray-500">No books found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
