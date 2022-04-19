@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Create Organization</h1>
            @auth
                <form action="{{ route('organizations.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}">
                        <x-input-error for="name"/>
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>
                        <x-input-error for="description"/>
                    </div>
                    <div>
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}">
                        <x-input-error for="location"/>
                    </div>
                    <div>
                        <label for="organization_type">Organization type:</label>
                        <input type="text" id="organization_type" name="organization_type" value="{{ old('organization_type') }}">
                        <x-input-error for="organization_type"/>
                    </div>
                    <div>
                        <label for="foundation_date">Foundation date:</label>
                        <input type="dateTime-local" id="foundation_date" name="foundation_date" value="{{ old('foundation_date') }}">
                        <x-input-error for="foundation_date"/>
                    </div>
                    <div>
                        <label for="number_of_employers">Number of employers:</label>
                        <input type="text" id="number_of_employers" name="number_of_employers" value="{{ old('number_of_employers') }}">
                        <x-input-error for="number_of_employers"/>
                    </div>
                    <div>
                        <label for="logo">Logo image:</label>
                        <input type="file" id="logo" name="logo">
                        <x-input-error for="logo"/>
                    </div>
                    <div>
                        <label for="website_url">Website:</label>
                        <input type="text" id="website_url" name="website_url" value="{{ old('website_url') }}">
                        <x-input-error for="website_url"/>
                    </div>
                    <div>
                        <button type="submit">Create</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
