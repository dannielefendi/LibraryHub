<x-app-layout>
    <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

        <div class="bg-gradient-to-r from-sky-600 to-cyan-500 p-6 text-white">
            <h1 class="fs-2 fw-bold">
                👋🏻 Hi, {{ Auth::user()->name }}
            </h1>
            <p class="mb-0">Here are the books you have borrowed:</p>
        </div>


        {{-- Borrowed Books --}}
        <div class="container my-4">
            <div class="row">
                @foreach ($borrowings as $borrow)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm rounded-3">
                            <div class="card-body d-flex flex-column">
                                <h5 class="fs-4 fw-semibold text-gray-800 mb-4">{{ $borrow->book->title }}</h5>
                                <p class="text-sm text-muted">
                                    <strong>Borrow Date:</strong> {{ $borrow->borrow_date->format('F j, Y') }}
                                </p>
                            
                                @if ($borrow->return_date)
                                    <p class="text-sm text-muted">
                                        <strong>Due Date:</strong> {{ $borrow->due_date->format('F j, Y') }}
                                    </p>
                                    <p class="text-sm text-muted mb-3">
                                        <strong>Return Date:</strong> {{ $borrow->return_date->format('F j, Y') }}
                                    </p>
                                @else
                                    <p class="text-sm text-muted mb-3">
                                        <strong>Due Date:</strong> {{ $borrow->due_date->format('F j, Y') }}
                                    </p>
                                @endif


                                <p class="mb-2">
                                    <strong>Status:</strong>
                                    <span class="px-1 py-1 rounded text-black text-xs
                                        @if ($borrow->status === 'Late') bg-yellow-500
                                        @elseif ($borrow->status === 'Borrowed') bg-blue-500 text-white
                                        @elseif ($borrow->status === 'Unavailable') bg-red-500
                                        @elseif ($borrow->status === 'Returned') bg-green-500
                                        @endif
                                    ">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </p>

                                @if ($borrow->fine_remaining > 0)
                                    <p class="text-sm text-danger"><strong>Fine Remaining:</strong> {{ $borrow->fine_remaining}}</p>
                                @endif

                                {{-- Optional: button for action --}}
                                {{-- <a href="#" class="btn btn-primary mt-auto w-100">Details</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- Back button --}}
            <div class="mt-4 text-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                    {{ __('Back to Dashboard') }}
                </a>
            </div>
        </div>

    </div>
       
</x-app-layout>
