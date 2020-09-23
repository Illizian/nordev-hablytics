@extends("layouts.default")

@section("content")
    <form method="POST">
        @csrf

        <input type="text" name="tag" />
        <input type="number" name="value" />

        <button type="submit">Submit</button>
    </form>
@endsection
