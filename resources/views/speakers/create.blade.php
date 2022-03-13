@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Add Speakers</h1>
            @auth
                <form action="{{ route('speakers') }}" method="post">
                    @csrf
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
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
                        <label for="avatar">Avatar:</label>
                        <input type="file" id="avatar" name="avatar" value="{{ old('avatar') }}">
                        @error('avatar')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="linkedin_url">Linkedin url:</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url') }}">
                        @error('linkedin_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="github_url">Github url:</label>
                        <input type="text" id="github_url" name="github_url" value="{{ old('github_url') }}">
                        @error('github_url')
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
