<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - Library Hub</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin/create_book.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">


</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <i class="bi bi-book"></i> <span>Library Hub</span>
            </div>

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
        <!-- @include('components.notif-validate') -->
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="bi bi-plus-lg"></i> Add New Book</h1>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
