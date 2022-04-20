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
                    <button type="submit">Update</button>
                </div>
            </form>
                <h3>Organization profiles</h3>
                <a href="{{ route('organizations.profiles.create', $organization) }}">Add profile</a>
                @if ($organization->organizationProfiles->count())
                    @foreach ($organization->organizationProfiles as $profile)
                        <div>
                            {{ $profile->label }}
                            {{ $profile->link }}

                            <a href="{{ route('organizations.profiles.edit', [$organization, $profile]) }}">Edit</a>
                            <form action="{{ route('organizations.profiles.destroy', [$organization, $profile]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"  onclick="return confirm('Sure Want Delete?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>There are no organization profiles</p>
                @endif
            @endauth
        </div>
    </div>
@endsection
