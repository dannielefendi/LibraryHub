<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/admin/create_book.css') }}">
    @endpush
        
        <!-- @include('components.notif-validate') -->
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-plus-lg"></i> Add <span class="text-blue-700">New Book</span></h1>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}">
                        @error('author')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Year -->
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}">
                        @error('year')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}">
                        @error('stock')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Synopsis -->
                    <div class="form-group full-width">
                        <label>Synopsis</label>
                        <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis" rows="4" placeholder="Enter book synopsis...">{{ old('synopsis') }}</textarea>
                    
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
                                    <input type="checkbox"
                                        name="categories[]"
                                        value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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
                        <input type="file" class="form-control @error('image_cover') is-invalid @enderror" id="image_cover" name="image_cover" value="{{ old('image_cover') }} " accept="image/*">
                        <small class="helper-text">Upload book cover image (required)</small>
                    
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
                        Create Book
                    </button>
                </div>
            </form>
        </div>
</x-app-layout>
