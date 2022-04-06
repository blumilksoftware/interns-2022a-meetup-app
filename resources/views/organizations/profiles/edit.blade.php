@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit Profile</h1>
            @auth
                <form method="post" action="{{ route('organizations.profiles.update', [$organization, $profile]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="label">Label:</label>
                        <select id="label" name="label" data-value="{{ $profile ? $profile->label : old('label') }}">
                            <option value="Website">Website</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Linkedin">Linkedin</option>
                            <option value="Instagram">Instagram</option>
                            <option value="YouTube">YouTube</option>
                            <option value="Twitter">Twitter</option>
                            <option value="GitHub">GitHub</option>
                        </select>
                        <x-input-error for="label"/>
                    </div>
                    <div>
                        <label for="link">Link:</label>
                        <input type="text" id="link" name="link" value="{{ old('link', $profile->link) }}">
                        <x-input-error for="link"/>
                    </div>
                    <div>
                        <button type="submit">Update</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
@endsection
