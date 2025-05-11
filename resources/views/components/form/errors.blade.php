@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-500 text-sm">{{ $error }}</li>
        @endforeach
    </ul>
@endif
