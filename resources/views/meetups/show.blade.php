@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        <div class="bg-white p-6 mt-20 rounded-20 shadow-xl">
            <div>
                <a href="{{ route('meetups') }}">Go back to Meetups</a>
            </div>
            <div>
                {{ $meetup->title }}
            </div>
            <div>
                <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} logo" class="w-[397px] h-[167px]">
            </div>
            <div>
                Date: {{ $meetup->date }}
            </div>
            <div>
                Place: {{ $meetup->place }}
            </div>
            <div>
                Language: {{ $meetup->language }}
            </div>
            <h1 class="text-lg font-medium text-gray-900">About meetup</h1>
            <div>
                {{ $meetup->description }}
            </div>
            <h1>Organization:</h1>
            @if($meetup->organization)
                <a href="{{ route('organizations.show', $meetup->organization) }}">
                    <div>
                        {{ $meetup->organization->name }}
                        <img src="{{ $meetup->organization->logoPath }}" alt="{{ $meetup->organization->name }} avatar">
                    </div>
                </a>
            @else
                <p>There is no organization</p>
            @endif
            <h1>Speakers:</h1>
            <div>
                @forelse ($meetup->speakers as $speaker)
                    <a href="{{ route('speakers.show', $speaker) }}">
                        <div>
                            <img src="{{ $speaker->avatarPath }}" alt="{{ $speaker->name }} avatar">
                            {{ $speaker->name }}
                        </div>
                    </a>
                @empty
                    <p>There are no speakers</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
