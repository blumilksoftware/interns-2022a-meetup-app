@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Create Organization</h1>
            @auth
                <form action="{{ route('organizations') }}" method="post">
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
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}">
                        @error('location')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="organization_type">Organization type:</label>
                        <input type="text" id="organization_type" name="organization_type" value="{{ old('organization_type') }}">
                        @error('organization_type')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="foundation_date">Foundation date:</label>
                        <input type="dateTime-local" id="foundation_date" name="foundation_date" value="{{ old('foundation_date') }}">
                        @error('foundation_date')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="number_of_employers">Number of employers:</label>
                        <input type="text" id="number_of_employers" name="number_of_employers" value="{{ old('number_of_employers') }}">
                        @error('number_of_employers')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="website_url">Website:</label>
                        <input type="text" id="website_url" name="website_url" value="{{ old('website_url') }}">
                        @error('website_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="facebook_url">Facebook:</label>
                        <input type="text" id="facebook_url" name="facebook_url" value="{{ old('facebook_url') }}">
                        @error('facebook_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="linkedin_url">Linkedin:</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url') }}">
                        @error('linkedin_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="instagram_url">Instagram:</label>
                        <input type="text" id="instagram_url" name="instagram_url" value="{{ old('instagram_url') }}">
                        @error('instagram_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="youtube_url">YouTube:</label>
                        <input type="text" id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}">
                        @error('youtube_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="twitter_url">Twitter:</label>
                        <input type="text" id="twitter_url" name="twitter_url" value="{{ old('twitter_url') }}">
                        @error('twitter_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="github_url">Github:</label>
                        <input type="text" id="github_url" name="github_url" value="{{ old('github_url') }}">
                        @error('github_url')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Create</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
