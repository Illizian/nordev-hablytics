@extends("layouts.default")

@section("content")
    <form method="POST" action="/diary/{{ $diary->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $diary->name }}" />
    </form>
@endsection
