@extends("layouts.default")

@section("content")
    <ol>
        @foreach ($diaries as $diary)
            <li>
                <a href="/diary/{{ $diary->id }}">
                    {{ $diary->name }}
                </a>

                <form method="POST" action="/diary/{{ $diary->id }}">
                    @csrf
                    @method("DELETE")

                    <button type="submit">
                        DELETE
                    </button>
                </form>
            </li>
        @endforeach
    </ol>
@endsection
