@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Speakers</h1>
            @auth
                <a href="{{ route('speakers.create') }}">Add new speakers</a>
            @endauth
            @if ($speaker->count())
                @foreach ($speakers as $speaker)
                    <div>
                        {{ $speaker->name }}
                        {{ $speaker->description }}
                        {{ $speaker->avatar }}
                        {{ $speaker->linkedin_url }}
                        {{ $speaker->github_url }}

                        <a href="{{ route('speakers.edit', $speaker) }}">Edit</a>
                        <form action="{{ route('speakers.destroy', $speaker) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach

                {{ $speaker->links() }}
            @else
                <p>There are no speakers</p>
            @endif
        </div>
    </div>
@endsection
