<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
                <h3 class="text-lg font-semibold text-gray-800">
                    Hi, {{ Auth::user()->name }}!
                </h3>

                @if ($totalFine > 0)
                    <p class="mt-1 text-red-600 font-medium">
                        Total Fine: Rp {{ number_format($totalFine, 0, ',', '.') }}
                    </p>
                @endif
            </div>
        
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif


            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text mb-1"><strong>Author:</strong> {{ $book->author }}</p>
                                <p class="card-text mb-1"><strong>Year:</strong> {{ $book->year }}</p>
                                <p class="card-text mb-1"><strong>Categories:</strong>
                                    @if($book->categories->count() > 0)
                                        @foreach($book->categories as $category)
                                            <span class="badge badge-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                                <p class="card-text mb-3"><strong>Stock:</strong> {{ $book->stock }}</p>

                                <form action="{{ route('user.borrow') }}" method="POST">
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

            <div class="mt-4 text-center">
                <a href="{{ route('user.borrowings') }}" class="btn btn-secondary">
                    {{ __('View Borrowed Books') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
