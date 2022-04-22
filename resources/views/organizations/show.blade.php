@extends('layouts.app')

@section('content')
    <div>
        <div>
            {{ $organization->name }}
        </div>
        <div>
            <img src="{{ $organization->getLogoPath() }}" alt="{{ $organization->name }} logo">
        </div>
        <div>
            {{ $organization->description }}
        </div>
        <div>
            {{ $organization->location }}
        </div>
        <div>
            {{ $organization->organizationType }}
        </div>
        <div>
            {{ $organization->foundationDate }}
        </div>
        <h1>Meetups:</h1>
        <div>
            @foreach ($organization->meetups as $meetup)
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
