<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- ⚙️ GUNAKAN ROUTE UPDATE DAN KIRIM ID --}}
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Author</label>
                        <input type="text" name="author" value="{{ $book->author }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Year</label>
                        <input type="number" name="year" value="{{ $book->year }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Stock</label>
                        <input type="number" name="stock" value="{{ $book->stock }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Synopsis</label>
                        <textarea name="synopsis" class="form-textarea w-full" rows="4">{{ $book->synopsis }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Category</label>
                        <select name="category_id" class="form-select w-full" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
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

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('books.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                            ← Back
                        </a>

                        <button type="submit"
                            class="btn btn-success bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
