<x-app-layout>
    <div x-data="{ showFilters: {{ request('categories') ? 'true' : 'false' }} }" class="py-6">
        
        <div class="container">
            <div class="row mb-10">
                <div class="col-12">
                    <div class="overflow-hidden rounded-3xl bg-white shadow-xl">
                        <div class="bg-gradient-to-r from-sky-600 to-cyan-500 p-6 text-white">
                            <h1 class="fs-2 fw-bold">
                                Hi, {{ Auth::user()->name }}
                            </h1>

                            <a href="{{ route('user.borrowings') }}" class="btn btn-success mt-3">
                                {{ __('View Borrowed Books') }}
                            </a>
                        </div>

                        @if ($totalFine > 0)
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded border-red-300 bg-red-100 p-4">
                                        <p class="text-center fw-bold text-red-700 m-0">
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
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h1 class="fs-1 font-bold text-dark">
                                Book <span class="text-blue-700">List</span>
                            </h1>
                            <p class="text-muted mb-0">
                                Browse and borrow available books from the library
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-2">
                            <button 
                                @click="showFilters = !showFilters" 
                                type="button"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg border transition-all duration-200"
                                :class="showFilters ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span x-text="showFilters ? 'Hide Filter' : 'Show Filter'"></span>
                            </button>

                            <form action="{{ route('user.dashboard') }}" method="GET" class="flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by title or author"
                                    class="form-input w-64 px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                <button type="submit" class="btn btn-primary px-4">
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div 
                    x-show="showFilters" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    class="col-12 mb-5" 
                    style="display: none;"
                >
                    <div class="bg-white p-4 rounded-xl border border-blue-300 shadow-lg" style="background: linear-gradient(90deg, #e0f2fe 0%, #f0f9ff 100%);">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="fw-bold mb-0 text-gray-700">Filter by Category:</p>
                            @if(request('categories'))
                                <a href="{{ route('user.dashboard') }}" class="text-sm text-red-600 hover:underline">Reset Filter</a>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $activeCategories = request('categories', []);
                            @endphp

                            <a href="{{ route('user.dashboard') }}"
                                class="px-4 py-2 rounded-xl border text-base font-semibold shadow-sm transition-all duration-150
                                {{ empty($activeCategories) ? 'bg-blue-600 text-black border-blue-600' : 'bg-white text-blue-700 border-blue-400 hover:bg-blue-50' }}"
                                style="min-width: 150px; text-align: center;">
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
                                    class="px-4 py-2 rounded-xl border text-base font-semibold shadow-sm transition-all duration-150
                                    {{ $isActive ? 'bg-blue-600 text-black border-blue-600' : 'bg-white text-blue-700 border-blue-400 hover:bg-blue-50' }}"
                                    style="min-width: 150px; text-align: center;">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($noBooks)
                    <div class="col-12 py-10 text-center">
                        <div class="rounded-xl p-5 d-inline-block">
                            <p class="text-muted mb-0">No Books Available with current filters.</p>
                        </div>
                    </div>
                @endif

                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3xl overflow-hidden hover:shadow-lg transition-all duration-300">
                            {{-- Cover --}}
                            <div class="p-3 bg-gray-50 d-flex justify-content-center align-items-center position-relative group">
                                <img
                                    src="{{ $book->image_cover ? asset('storage/' . $book->image_cover) : asset('images/no-cover.png') }}"
                                    alt="{{ $book->title }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 220px; width: 150px; object-fit: cover;"
                                >
                                <div class="position-absolute bottom-0 mb-2">
                                    <a href="{{ route('user.books.show', $book) }}"
                                        class="bg-white px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm hover:bg-blue-50 transition-colors">
                                        Quick View
                                    </a>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="fs-5 fw-bold text-gray-800 mb-1">
                                    {{ $book->title }}
                                </h5>

                                <p class="text-xs text-muted mb-3">
                                    by {{ $book->author }} ({{ $book->year }})
                                </p>

                                <div class="mb-3">
                                    @if ($book->stock <= 5)
                                        <span class="badge rounded-pill bg-warning text-dark px-3">
                                            Only {{ $book->stock }} left
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-success px-3">
                                            {{ $book->stock }} available
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 flex-grow-1" style="line-height: 1.4;">
                                        {{ Str::limit($book->synopsis, 100) }}
                                    </p>
                                </div>

                                <div class="mb-4">
                                    @foreach ($book->categories as $category)
                                        <span class="inline-block bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded mr-1 mb-1 border border-gray-200">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <form action="{{ route('user.borrow') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary w-100 rounded-xl py-2 fw-bold" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                        {{ $book->stock <= 0 ? 'Out of Stock' : 'Borrow Now' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 d-flex justify-content-center">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>