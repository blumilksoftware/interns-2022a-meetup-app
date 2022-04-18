@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Speaker</h1>
            @auth
                <form method="post" action="{{ route('speakers.update', $speaker) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $speaker->name) }}">
                        <x-input-error for="name"/>
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $speaker->description) }}</textarea>
                        <x-input-error for="description"/>
                    </div>
                    <img src="{{ asset("storage/" . $speaker->avatar_path) }}" alt="{{ $speaker->name }} avatar">
                    <div>
                        <label for="avatar">Avatar:</label>
                        <input type="file" id="avatar" name="avatar">
                        <x-input-error for="avatar"/>
                    </div>
                    <div>
                        <label for="linkedin_url">Linkedin url:</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $speaker->linkedinUrl) }}">
                        <x-input-error for="linkedin_url"/>
                    </div>
                    <div>
                        <label for="github_url">Github url:</label>
                        <input type="text" id="github_url" name="github_url" value="{{ old('github_url', $speaker->githubUrl) }}">
                        <x-input-error for="github_url"/>
                    </div>
                    <div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
