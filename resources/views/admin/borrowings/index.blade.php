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
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $borrowing->book->title }}</h5>
                                <p class="card-text mb-1"><strong>User:</strong> {{ $borrowing->user->name }}</p>
                                <p class="card-text mb-1"><strong>Borrow Date:</strong> {{ $borrowing->borrow_date }}</p>
                                <p class="card-text mb-3">
                                    <strong>Status:</strong>
                                    <span class="badge
                                        @if ($borrowing->status === 'Pending') bg-warning text-dark
                                        @elseif ($borrowing->status === 'Borrowed') bg-success
                                        @elseif ($borrowing->status === 'Rejected') bg-danger
                                        @elseif ($borrowing->status === 'Returned') bg-secondary
                                        @endif">
                                        {{ ucfirst($borrowing->status) }}
                                    </span>
                                </p>

                                <div class="d-grid gap-2">
                                    @if ($borrowing->status === 'Pending')
                                        <form action="{{ route('admin.borrowings.approve', $borrowing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success w-100 mb-2">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.borrowings.reject', $borrowing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">
                                                Reject
                                            </button>
                                        </form>
                                    @elseif ($borrowing->status === 'Borrowed')
                                        <form action="{{ route('admin.borrowings.returned', $borrowing->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info w-100">
                                                Mark Returned
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted text-center d-block">Completed</span>
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
        </div>
    </div>
</x-app-layout>
