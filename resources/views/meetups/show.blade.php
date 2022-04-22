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
        <h1>Speakers:</h1>
        <div>
            @foreach ($meetup->speakers as $speaker)
                <li> {{ $speaker->name }} </li>
            @endforeach
        </div>
        <div>
            {{ $test }}
        </div>
    </div>
@endsection
