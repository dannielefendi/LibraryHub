<x-app-layout>
    <div class="py-8 bg-cover bg-center bg-no-repeat" 
        style="background-image: url('{{ asset('img/background1.png') }}'); 
                min-height: 100vh;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;">
                
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
           <div class="container">
                <div class="row mb-10">
                    <div class="col-12">
                        <div class="overflow-hidden rounded-3xl bg-white shadow-xl">
                        <div class="bg-gradient-to-r from-sky-600 to-cyan-500 p-6 text-white">
                                <h1 class="fs-2 fw-bold">
                                    👋🏻 Hi, {{ Auth::user()->name }}
                                </h1>

                                <a href="{{ route('user.borrowings') }}" class="btn btn-success mt-3">
                                    {{ __('View Borrowed Books') }}
                                </a>
                            </div>


                            @if ($totalFine > 0)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rounded border-red-300 bg-red-100 p-4">
                                            <p class="text-center fw-bold text-red-700">
                                                Your Total Fine: Rp {{ number_format($totalFine, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
           </div>

            <div class="container">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>        
            

            <div class="container">
                 <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="fs-2 fw-bold">
                                Book List
                            </h1>

                            
                            <form action="{{ route('user.dashboard') }}" method="GET" class="flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="Search by title or author"
                                    class="form-input w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                <button type="submit" class="btn btn-primary">
                                    Search
                                </button>
                            </form>
                           
                        </div>
                    </div>

                    <div class="col-12 mb-5">
                        <p class="text-muted mb-0">
                            Browse and borrow available books from the library
                        </p>
                    </div>

                    <!-- Filtering Category -->
                    <div class="col-12 mb-5">
                        <p class="fw-semibold mb-2">Filter by Category:</p>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $activeCategories = request('categories', []);
                            @endphp

        
                            <a href="{{ route('user.dashboard') }}" 
                            class="px-3 py-1 rounded border 
                                    {{ empty($activeCategories) ? 'bg-blue-500 text-white' : 'bg-white border-gray-300' }}">
                                All
                            </a>

                            @foreach($categories as $category)
                                @php
                                    $isActive = in_array($category->id, $activeCategories);
                                    $newActive = $isActive 
                                        ? array_diff($activeCategories, [$category->id])
                                        : array_merge($activeCategories, [$category->id]);
                                @endphp

                                <a href="{{ route('user.dashboard', ['categories' => $newActive]) }}" 
                                class="px-3 py-1 rounded border 
                                        {{ $isActive ? 'bg-blue-500 text-white' : 'bg-white border-gray-300' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>


                    @if($noBooks)
                        <div class="mb-4 p-4 text-center">
                            No Book Available
                        </div>
                    @endif

                    @foreach ($books as $book)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">

                                {{-- Cover --}}
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    <img
                                        src="{{ $book->image_cover
                                            ? asset('storage/' . $book->image_cover)
                                            : asset('images/no-cover.png') }}"
                                        alt="{{ $book->title }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="max-height: 220px; object-fit: cover;"
                                    >
                                </div>
                                <a href="{{ route('user.books.show', $book) }}" 
                                    class="w-100 mt-auto text-blue-600 font-semibold underline
                                        transition-transform transform hover:-translate-y-1 text-center">
                                    View
                                </a>

                                <div class="card-body d-flex flex-column">

                                    <h5 class="fs-4 fw-semibold text-gray-800">
                                        {{ $book->title }}
                                    </h5>

                                    <p class="text-sm text-muted mb-2">
                                        by {{ $book->author }} ({{ $book->year }})
                                    </p>

                                    <div class="mb-2">
                                        <strong>Stock:</strong>
                                        @if ($book->stock <= 5)
                                            <span class="badge bg-warning text-dark">
                                                {{ $book->stock }} left
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                {{ $book->stock }} available
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 flex-grow-1" style="line-height: 1.5;">
                                            {{ Str::limit($book->synopsis, 120) }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Categories:</strong>
                                        @foreach ($book->categories as $category)
                                            <span class="badge bg-secondary me-1 mb-1">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <form action="{{ route('user.borrow') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Borrow') }}
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination links -->
            <div class="mt-4 d-flex justify-content-center align-items-center">
                {{ $books->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
