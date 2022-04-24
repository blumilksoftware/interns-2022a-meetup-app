@extends('layouts.app')

@section('content')
    <div>
        <div>
            {{ $meetup->title }}
        </div>
        <div>
            <img src="{{ $meetup->getLogoPath() }}" alt="{{ $meetup->title }} logo">
        </div>
        <div>
            {{ $meetup->description }}
        </div>
        <div>
            {{ $meetup->date }}
        </div>
        <div>
            {{ $meetup->place }}
        </div>
        <div>
            {{ $meetup->language }}
        </div>
        <h1>Organization:</h1>
        <a href="{{ route('organizations.show', $meetup->organization) }}">
            <div>
                {{ $meetup->organization->name }}
            </div>
        </a>
        <h1>Speakers:</h1>
        <div>
            @foreach ($meetup->speakers as $speaker)
                <a href="{{ route('speakers.show', $speaker) }}">
                    <div>
                        <img src="{{ $speaker->getAvatarPath() }}" alt="{{ $speaker->name }} avatar">
                        {{ $speaker->name }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
