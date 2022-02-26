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

                        @can('change', $meetup)
                            <a href="{{ route('meetups.edit', $meetup) }}">Edit</a>
                            <form action="{{ route('meetups.destroy', $meetup) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endcan
                    </div>
                @endforeach

                {{ $meetups->links() }}
            @else
                <p>There are no meetups</p>
            @endif
        </div>
    </div>
@endsection
