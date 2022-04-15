@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Meetup</h1>
            @auth
                <form method="post" action="{{ route('meetups.update', $meetup) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $meetup->title) }}">
                        <x-input-error for="title"/>
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $meetup->description) }}</textarea>
                        <x-input-error for="description"/>
                    </div>
                    <div>
                        <label for="date">Date:</label>
                        <input type="dateTime-local" id="date" name="date" value="{{ old('date', $meetup->date) }}">
                        <x-input-error for="date"/>
                    </div>
                    <div>
                        <label for="place">Place:</label>
                        <input type="text" id="place" name="place" value="{{ old('place', $meetup->place) }}">
                        <x-input-error for="place"/>
                    </div>
                    <div>
                        <label for="language">Language:</label>
                        <input type="text" id="language" name="language" value="{{ old('language', $meetup->language) }}">
                        <x-input-error for="language"/>
                    </div>
                    <div>
                        <label for="logo">Logo image:</label>
                        <input type="file" id="logo" name="logo">
                        <x-input-error for="logo"/>
                    </div>
                    <div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
