@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Organizations</h1>
            @auth
                <a href="{{ route('organizations.create') }}">Create new organization</a>
            @endauth
            @if ($organizations->count())
                @foreach ($organizations as $organization)
                    <div>
                        {{ $organization->name }}
                        {{ $organization->description }}
                        {{ $organization->location }}
                        {{ $organization->organization_type }}
                        {{ $organization->foundation_date }}
                        {{ $organization->number_of_employers }}
                        <a href="{{ $organization->website_url }}"> Website </a>
                        <a href="{{ $organization->facebook_url }}"> Facebook </a>
                        <a href="{{ $organization->linkedin_url }}"> Linkedin </a>
                        <a href="{{ $organization->instagram_url }}"> Instagram </a>
                        <a href="{{ $organization->youtube_url }}"> YouTube </a>
                        <a href="{{ $organization->twitter_url }}"> Twitter </a>
                        <a href="{{ $organization->github_url }}"> Github </a>

                        <a href="{{ route('organizations.edit', $organization) }}">Edit</a>
                        <form action="{{ route('organizations.destroy', $organization) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach

                {{ $organizations->links() }}
            @else
                <p>There are no organizations</p>
            @endif
        </div>
    </div>
@endsection
