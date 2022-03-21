@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>News</h1>
            @auth
                <a href="{{ route('news.create') }}">Create new news</a>
            @endauth
            @if ($organizations->count())
                @foreach ($organizations as $organization)
                    <div>
                        {{ $organization->name }}
                        {{ $organization->location }}
                        {{ $organization->organizationType }}
                        {{ $organization->numberOfEmployers }}
                        <a href="{{ $organization->websiteUrl }}"> Website </a>

                        <a href="{{ route('news.edit', $organization) }}">Edit</a>
                        <form action="{{ route('news.destroy', $organization) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach

                {{ $organizations->links() }}
            @else
                <p>There are no news</p>
            @endif
        </div>
    </div>
@endsection
