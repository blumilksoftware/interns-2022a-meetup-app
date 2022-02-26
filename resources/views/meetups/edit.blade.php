@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Meetup</h1>
            @auth
                <form method="post" action="{{ route('meetups.update', $meetup) }}">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="{{ $meetup->title }}">
                        @error('title')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ $meetup->description }}</textarea>
                        @error('description')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="dateTime-local" id="date" name="date" value="{{ $meetup->date->format('Y-m-d\TH:i') }}">
                        @error('date')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="place">Place:</label>
                        <input type="text" id="place" name="place" value="{{ $meetup->place }}">
                        @error('place')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="language">Language:</label>
                        <input type="text" id="language" name="language" value="{{ $meetup->language }}">
                        @error('language')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
