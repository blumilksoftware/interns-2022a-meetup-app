@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Speaker</h1>
            @auth
                <form method="post" action="{{ route('speakers.update', $speaker) }}">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $speaker->name) }}">
                        @error('name')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $speaker->description) }}</textarea>
                        @error('description')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="avatar">Avatar:</label>
                        <input type="text" id="avatar" name="avatar" value="{{ old('avatar', $speaker->avatar) }}">
                        @error('avatar')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="linkedin_url">Linkedin url:</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $speaker->linkedin_url) }}">
                        @error('linkedin_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="github_url">Github url:</label>
                        <input type="text" id="github_url" name="github_url" value="{{ old('github_url', $speaker->github_url) }}">
                        @error('github_url')
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
