@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Meetups</h1>
            @auth
                <a href="{{ route('meetups.create') }}">Create new meetup</a>
            @endauth
            @if ($meetups->count())
                @foreach ($meetups as $meetup)
                    <div>
                        {{ $meetup->title }}
                        {{ $meetup->description }}
                        {{ $meetup->date }}
                        {{ $meetup->place }}
                        {{ $meetup->language }}

                        <a href="{{ route('meetups.edit', $meetup) }}">Edit</a>
                        <form action="{{ route('meetups.destroy', $meetup) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  onclick="return confirm('Delete meetup? This operation is irreversible.')">Delete</button>
                        </form>
                    </div>
                @endforeach

                {{ $meetups->links() }}
            @else
                <p>There are no meetups</p>
            @endif
        </div>
    </div>
@endsection
