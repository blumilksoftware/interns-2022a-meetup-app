@extends('layouts.app')

@section('content')
    <div>
        <div>
            {{ $speaker->name }}
        </div>
        <div>
            <img src="{{ $speaker->getAvatarPath() }}" alt="{{ $speaker->name }} avatar">
        </div>
        <div>
            {{ $speaker->linkedinUrl }}
        </div>
        <div>
            {{ $speaker->githubUrl }}
        </div>
        <h1>Meetups:</h1>
        <div>
            @foreach ($speaker->meetups as $meetup)
                <a href="{{ route('meetups.show', $meetup) }}">
                    <div>
                        {{ $meetup->title }}
                        <img src="{{ $meetup->getLogoPath() }}" alt="{{ $meetup->title }} logo">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
