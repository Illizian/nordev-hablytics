@extends("layouts.default")

@section("content")
    <h1>{{ $diary->name }}</h1>
    <p>
        To create new Events, <a href="/diary/{{ $diary->id}}/tag">Click Here</a>
    </p>

    <ol>
        @foreach($diary->events as $event)
            <li>
                {{ $event->name }} ({{ $event->pivot->value }})
            </li>
        @endforeach
    </ol>
@endsection
