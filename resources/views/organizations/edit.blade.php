@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Organization</h1>
            @auth
            <form method="post" action="{{ route('organizations.update', $organization) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $organization->name) }}">
                    <x-input-error for="name"/>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="30" rows="4">{{ old('description', $organization->description) }}</textarea>
                    <x-input-error for="description"/>
                </div>
                <div>
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $organization->location) }}">
                    <x-input-error for="location"/>
                </div>
                <div>
                    <label for="organization_type">Organization type:</label>
                    <input type="text" id="organization_type" name="organization_type" value="{{ old('organization_type', $organization->organizationType) }}">
                    <x-input-error for="organization_type"/>
                </div>
                <div>
                    <label for="foundation_date">Foundation date:</label>
                    <input type="dateTime-local" id="foundation_date" name="foundation_date" value="{{ old('foundation_date', $organization->foundationDate) }}">
                    <x-input-error for="foundation_date"/>
                </div>
                <div>
                    <label for="number_of_employers">Number of employers:</label>
                    <input type="text" id="number_of_employers" name="number_of_employers" value="{{ old('number_of_employers', $organization->numberOfEmployers) }}">
                    <x-input-error for="number_of_employers"/>
                </div>
                <img src="{{ $organization->getLogoPath() }}" alt="{{ $organization->name }} logo">
                <div>
                    <label for="logo">Logo image:</label>
                    <input type="file" id="logo" name="logo">
                    <x-input-error for="logo"/>
                </div>
                <div>
                    <label for="website_url">Website:</label>
                    <input type="text" id="website_url" name="website_url" value="{{ old('website_url', $organization->websiteUrl) }}">
                    <x-input-error for="website_url"/>
                </div>
                <div>
                    <label for="facebook_url">Facebook:</label>
                    <input type="text" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $organization->facebookUrl) }}">
                    <x-input-error for="website_url"/>
                </div>
                <div>
                    <label for="linkedin_url">Linkedin:</label>
                    <input type="text" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $organization->linkedinUrl) }}">
                    <x-input-error for="linkedin_url"/>
                </div>
                <div>
                    <label for="instagram_url">Instagram:</label>
                    <input type="text" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $organization->instagramUrl) }}">
                    <x-input-error for="instagram_url"/>
                </div>
                <div>
                    <label for="youtube_url">YouTube:</label>
                    <input type="text" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $organization->youtubeUrl) }}">
                    <x-input-error for="youtube_url"/>
                </div>
                <div>
                    <label for="twitter_url">Twitter:</label>
                    <input type="text" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $organization->twitterUrl) }}">
                    <x-input-error for="twitter_url"/>
                </div>
                <div>
                    <label for="github_url">Github:</label>
                    <input type="text" id="github_url" name="github_url" value="{{ old('github_url', $organization->githubUrl) }}">
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
