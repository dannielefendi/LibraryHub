<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex">
                    <div class="w-1/3">
                        @if($book->image_cover)
                            <img src="{{ asset('storage/' . $book->image_cover) }}" alt="Cover" class="w-full h-auto object-cover border">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                    </div>
                    <div class="w-2/3 pl-6">
                        <h3 class="text-2xl font-bold">{{ $book->title }}</h3>
                        <p class="text-lg text-gray-600">by {{ $book->author }}</p>
                        <p class="mt-4"><strong>Year:</strong> {{ $book->year }}</p>
                        <p><strong>Stock:</strong> {{ $book->stock }}</p>
                        <p><strong>Categories:</strong>
                            @if($book->categories->count() > 0)
                                @foreach($book->categories as $category)
                                    <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-1">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            @else
                                -
                            @endif
                        </p>
                        @if($book->synopsis)
                            <p class="mt-4"><strong>Synopsis:</strong></p>
                            <p>{{ $book->synopsis }}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary ml-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>