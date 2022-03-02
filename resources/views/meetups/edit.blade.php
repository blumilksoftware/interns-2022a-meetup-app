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
                        <input type="text" id="title" name="title" value="{{ old('title', $meetup->title) }}">
                        @error('title')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $meetup->description) }}</textarea>
                        @error('description')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="dateTime-local" id="date" name="date" value="{{ old('date', $meetup->date) }}">
                        @error('date')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="place">Place:</label>
                        <input type="text" id="place" name="place" value="{{ old('place', $meetup->place) }}">
                        @error('place')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="language">Language:</label>
                        <input type="text" id="language" name="language" value="{{ old('language', $meetup->language) }}">
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
