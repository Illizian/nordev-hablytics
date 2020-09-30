@extends("layouts.default")

@section("content")
    <form method="POST" action="/diary">
        @csrf

        <input type="text" name="name" />
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </form>
@endsection
