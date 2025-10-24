<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-center">
                <div class="w-full max-w-5xl bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <table class="w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Title</th>
                                    <th class="border px-4 py-2 text-left">Author</th>
                                    <th class="border px-4 py-2 text-left">Year</th>
                                    <th class="border px-4 py-2 text-center">Stock</th>
                                    <th class="border px-4 py-2 text-left">Category</th>
                                    <th class="border px-4 py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $book->title }}</td>
                                        <td class="border px-4 py-2">{{ $book->author }}</td>
                                        <td class="border px-4 py-2">{{ $book->year }}</td>
                                        <td class="border px-4 py-2 text-center">{{ $book->stock }}</td>
                                        <td class="border px-4 py-2">{{ $book->category->name }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('user.borrow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <x-primary-button>
                                                    {{ __('Borrow') }}
                                                </x-primary-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 text-center">
                            <a href="{{ route('user.borrowings') }}">
                                <x-secondary-button>
                                    {{ __('View Borrowed Books') }}
                                </x-secondary-button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
