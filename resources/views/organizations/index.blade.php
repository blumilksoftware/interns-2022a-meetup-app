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
                        {{ $organization->location }}
                        {{ $organization->organizationType }}
                        {{ $organization->numberOfEmployers }}
                        <a href="{{ $organization->websiteUrl }}"> Website </a>

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
