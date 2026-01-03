 @if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close"data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif
