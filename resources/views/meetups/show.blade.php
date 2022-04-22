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
    </div>
@endsection
