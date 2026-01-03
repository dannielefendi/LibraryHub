<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin/edit_books.css') }}">
    @endpush

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="fs-1 font-bold text-white">
            <i class="bi bi-pen-fill"></i> Edit <span class="text-blue-700">Book</span>
        </h1>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Title -->
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $book->title }}">
                    @error('title')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Author -->
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ $book->author }}">
                    @error('author')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Year -->
                <div class="form-group">
                    <label>Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ $book->year }}">
                    @error('year')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $book->stock }}">
                    @error('stock')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Synopsis -->
                <div class="form-group full-width">
                    <label>Synopsis</label>
                    <textarea class="form-control @error('synopsis') is-invalid @enderror" name="synopsis" rows="4" placeholder="Enter book synopsis...">{{ $book->synopsis }}</textarea>
                        @error('synopsis')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Categories (Checkboxes) -->
                <div class="form-group full-width">
                    <label>Categories</label>
                    <div class="checkbox-grid @error('categories') is-invalid @enderror">
                        @foreach ($categories as $category)
                            <label class="checkbox-label">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ $book->categories->contains('id', $category->id) ? 'checked' : '' }}
                                >
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                        @error('categories')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="form-group full-width">
                    <label>Cover Image</label>
                    @if($book->image_cover)
                        <div class="current-image">
                            <img src="{{ url('storage/' . $book->image_cover) }}" alt="Current Cover">
                            <p class="image-label">Current Cover</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image_cover') is-invalid @enderror" name="image_cover" accept="image/*">
                    <small class="helper-text">Leave empty to keep current image</small>
                        @error('image_cover')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
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
</x-app-layout>
