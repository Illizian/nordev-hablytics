@extends("layouts.default")

@section("content")
    <form method="POST" action="/diary/{{ $diary->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $diary->name }}" />
        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </form>
@endsection
