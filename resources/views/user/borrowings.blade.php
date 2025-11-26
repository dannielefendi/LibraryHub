<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Borrowed') }}
        </h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="row">
                @foreach ($borrowings as $borrow)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $borrow->book->title }}</h5>
                                <p class="card-text mb-1"><strong>Borrow Date:</strong> {{ $borrow->borrow_date }}</p>
                                <p class="card-text mb-3">
                                    <strong>Status:</strong>
                                    <span class="px-2 py-1 rounded text-black
                                        @if ($borrow->status === 'Pending') bg-yellow-500
                                        @elseif ($borrow->status === 'Borrowed') bg-green-500
                                        @elseif ($borrow->status === 'Rejected') bg-red-500
                                        @elseif ($borrow->status === 'Returned') bg-gray-500
                                        @endif
                                    ">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                    {{ __('Back to Dashboard') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
