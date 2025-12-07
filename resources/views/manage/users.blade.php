<x-app-layout>


    <div class="container mt-4">
        <h1 class="fs-3 fw-semibold mb-3">Library Users</h1>
        <div class="d-block">
            @foreach($users as $index => $user)
                <div class="border p-3 mt-2 rounded w-50">
                    <div class="d-flex justify-content-between border-bottom pb-2">
                        <h2 class="fw-bold fs-5" >{{$user->name}}</h2>
                        <p class="fw-bold fs-7">ID: {{$user->id}}</p>
                        <p class="fw-bold fs-8">{{$user->email}}</p>
                    </div>
                     <p class="fs-7 mt-2">Joined On: {{ $user->created_at->format('F j, Y') }}</p>
                    @if($user->borrow->count() > 0)
                        <p class="fs-7 mt-2">Borrowings item: {{$user->borrow->count()}}</p>
                    @else
                        <p class="fs-7 mt-2">No borrowing records on this users</p>
                    @endif

                     <div class="mt-3">
                        @foreach($user->borrow as $index => $book)
                            <div class="d-flex gap-2 {{$index > 0 ? 'border-top pt-2 mt-2' : ''}}">
                                <p class="fs-7">{{$book->book->title}}</p>
                                <div class="border-end"></div>
                                <p class="fs-7 px-3 rounded-pill fw-bold
                                    {{
                                        $book->status == 'Returned' ? 'bg-success' :
                                        ($book->status == 'Late' ? 'bg-danger' :
                                        ($book->status == 'Borrowed' ? 'bg-primary' : ''))
                                    }}">{{$book->status}}
                                </p>
                                @if($book->status == 'Late' && $book->fine_remaining > 0)
                                    <p class="text-danger"> Fine remaining Rp {{ number_format($book->fine_remaining, 0, ',', '.') }}</p>
                                @elseif($book->status == 'Returned' && $book->fine_remaining > 0)
                                     <p class="text-danger"> Fine remaining Rp {{ number_format($book->fine_remaining, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        @endforeach
                     </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
