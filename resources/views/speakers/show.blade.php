@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        <div class="bg-white p-6 mt-20 rounded-20 shadow-xl">
            <div>
                <a href="{{ route('speakers') }}">Go back to speaker list</a>
            </div>
            <div>
                {{ $speaker->name }}
            </div>
            <div>
                <img src="{{ $speaker->avatarPath }}" alt="{{ $speaker->name }} avatar">
            </div>
            <div>
                {{ $speaker->linkedinUrl }}
            </div>
            <div>
                {{ $speaker->githubUrl }}
            </div>
            <h1>Meetups:</h1>
            <div>
                @forelse ($speaker->meetups as $meetup)
                    <a href="{{ route('meetups.show', $meetup) }}">
                        <div>
                            {{ $meetup->title }}
                            <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} logo"
                                 class="w-[397px] h-[100px]">
                        </div>
                    </a>
                @empty
                    <p>There are no meetups</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
