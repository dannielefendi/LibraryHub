<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input type="text" name="title" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Author</label>
                        <input type="text" name="author" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Year</label>
                        <input type="number" name="year" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Stock</label>
                        <input type="number" name="stock" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Category</label>
                        <select name="category_id" class="form-select w-full" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
    </div>
</x-app-layout>
