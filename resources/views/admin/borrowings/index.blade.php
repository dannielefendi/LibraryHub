{{-- resources/views/admin/borrowings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowings Management') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h3 class="text-lg font-semibold mb-4">Book Loan List</h3>

            {{-- Pesan sukses/error --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @forelse ($borrowings as $borrowing)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $borrowing->book->title }}</h5>
                                <p class="card-text mb-1"><strong>User:</strong> {{ $borrowing->user->name }}</p>
                                <p class="card-text mb-1"><strong>Borrow Date:</strong> {{ $borrowing->borrow_date->format('F j, Y') }}</p>
                                <p class="card-text mb-1"><strong>Due Date:</strong> {{ $borrowing->due_date->format('F j, Y') }}</p>
                                <p class="card-text mb-3">
                                    <strong>Status:</strong>
                                    <span class="badge
                                        @if ($borrowing->status === 'Late') bg-warning text-dark
                                        @elseif ($borrowing->status === 'Borrowed') bg-success
                                        @elseif ($borrowing->status === 'Unavailable') bg-danger
                                        @elseif ($borrowing->status === 'Returned') bg-secondary
                                        @endif">
                                        {{ ucfirst($borrowing->status) }}
                                    </span>
                                </p>

                                <div class="mt-auto d-grid gap-2">
                                    {{-- Tombol Mark Returned --}}
                                    @if (in_array($borrowing->status, ['Borrowed', 'Late']))

                                        <form action="{{ route('admin.borrowings.returned', $borrowing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info w-100 mb-2">
                                                Mark Returned
                                            </button>
                                        </form>
                                    @elseif (in_array($borrowing->status, ['Returned']) && $borrowing->fine_remaining > 0)
                                        <span class="text-danger text-center d-block pb-2">Unpaid Fines <i class="bi bi-exclamation-circle-fill text-danger"></i></span>
                                    @else
                                        <span class="text-success text-center d-block pb-2">Completed <i class="bi bi-check-circle-fill text-success"></i></span>

                                    @endif

                                        {{-- Form bayar denda --}}
                                    @if ($borrowing->fine_remaining > 0)
                                        <form action="{{ route('admin.borrowings.payFine', $borrowing->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="amount" placeholder="Enter payment" class="form-control mb-2" required>
                                            <button type="submit" class="btn btn-warning w-100">
                                                Pay Fine
                                            </button>
                                        </form>
                                        <p class="text-danger text-center">Remaining Fine: Rp {{ number_format($borrowing->fine_remaining) }}</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada data peminjaman
                        </div>
                    </div>
                @endforelse
            </div>
              {{-- Total fine --}}
            @php
                $totalFine = \App\Http\Controllers\BorrowingController::totalFineRemaining(Auth::id());
            @endphp
            @if ($totalFine = 0)
                <div class="mt-4 p-4 bg-red-100 text-red-800 rounded text-center">
                    <strong>Total Remaining Fine:</strong> Rp {{ number_format($totalFine) }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
