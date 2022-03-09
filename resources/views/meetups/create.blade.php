@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Create Meetup</h1>
            @auth
                <form action="{{ route('meetups') }}" method="post">
                    @csrf
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="dateTime-local" id="date" name="date" value="{{ old('date') }}">
                        @error('date')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="place">Place:</label>
                        <input type="text" id="place" name="place" value="{{ old('place') }}">
                        @error('place')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="language">Language:</label>
                        <input type="text" id="language" name="language" value="{{ old('language') }}">
                        @error('language')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Post</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
