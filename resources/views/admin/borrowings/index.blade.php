{{-- resources/views/admin/borrowings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowings Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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

                {{-- Tabel data peminjaman --}}
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">User Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Book Title</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Borrow Date</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                                <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($borrowings as $borrowing)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $borrowing->user->name }}</td>
                                    <td class="px-4 py-2">{{ $borrowing->book->title }}</td>
                                    <td class="px-4 py-2">{{ $borrowing->borrow_date }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-black
                                            @if ($borrowing->status === 'Pending') bg-yellow-500
                                            @elseif ($borrowing->status === 'Borrowed') bg-green-500
                                            @elseif ($borrowing->status === 'Rejected') bg-red-500
                                            @elseif ($borrowing->status === 'Returned') bg-gray-500
                                            @endif">
                                            {{ ucfirst($borrowing->status) }}
                                        </span>
                                    </td>
                                    <td class="flex gap-2 justify-center items-center">
                                        @if ($borrowing->status === 'Pending')
                                            <form action="{{ route('admin.borrowings.approve', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.borrowings.reject', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Reject
                                                </button>
                                            </form>
                                        @elseif ($borrowing->status === 'Borrowed')
                                            <form action="{{ route('admin.borrowings.returned', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="btn btn-info">
                                                    Mark Returned
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
